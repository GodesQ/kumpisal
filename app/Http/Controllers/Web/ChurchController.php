<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests\Church\CreateChurchRequest;
use App\Http\Requests\Church\UpdateChurchRequest;

use DataTables;
use App\Models\Church;
use App\Models\ChurchDay;

use App\Repositories\ChurchRepository;
use App\Repositories\ChurchTimeScheduleRepository;

class ChurchController extends Controller
{
    protected $ChurchRepository;
    protected $ChurchTimeScheduleRepository;

    public function __construct(ChurchRepository $ChurchRepository, ChurchTimeScheduleRepository $ChurchTimeScheduleRepository)
    {
        $this->ChurchRepository = $ChurchRepository;
        $this->ChurchTimeScheduleRepository = $ChurchTimeScheduleRepository;
    }

    public function searchPage(Request $request) {
        $churches = Church::active(1)->latest()->with('schedules')->paginate(10);
        return view('user-page.church-listing.churches', compact('churches'));
    }

    public function fetchData(Request $request) {
        abort_if(!$request->ajax(), 404);

        $church_name = $request->church_name;
        $church_address = $request->church_address;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $criterias = json_decode($request->criterias);

        $churches = Church::select('*')
                    ->active(1)
                    ->where(DB::raw('lower(name)'), 'like', '%' . strtolower($church_name) . '%')
                    ->when($criterias, function ($q) use ($criterias) {
                        if ($criterias[0]) {
                            return $q->whereIn('criteria', $criterias);
                        }
                    })
                    ->when($latitude and $longitude && $church_address, function ($q) use ($latitude, $longitude) {
                        return $q->addSelect(DB::raw('6371 * acos(cos(radians(' . $latitude ."))
                                * cos(radians(churches.latitude)) * cos(radians(churches.longitude) - radians(" .  $longitude . ")) + sin(radians(" .  $latitude . "))
                                * sin(radians(churches.latitude))) AS distance"))
                            ->having('distance', '<=', '3')
                            ->orderBy('distance', 'asc');
                    })
                    ->paginate(10);

        $view_data = view('user-page.church-listing.church-data', compact('churches'))->render();

        return response()->json([
            'view_data' => $view_data,
            'churches' => $churches,
        ]);
    }

    public function detailPage(Request $request) {
        $church = Church::where('church_uuid', $request->uuid)->with('schedules')->first();
        return view('user-page.church-listing.church-info', compact('church'));
    }

    public function lists(Request $request) {

        if($request->ajax()) {
            $churches = Church::get();
            return Datatables::of($churches)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/church/edit/' .$row->church_uuid. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->church_uuid. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-page.churches.list');
    }

    public function create(Request $request) {
        return view('admin-page.churches.create');
    }

    public function store(CreateChurchRequest $request) {
        $data = $request->validated();

        $file = $request->file('church_image');
        $church_image_name = Str::snake($request->name) . '.' . $file->getClientOriginalExtension();

        $save_file = $file->move(public_path().'/admin-assets/images/churches', $church_image_name);

        if($save_file) {
            $church = $this->ChurchRepository->store($request, $data, $church_image_name);
            $saveScheduleTime = $this->ChurchTimeScheduleRepository->saveTime($request, $church);

            if(!$church) {
                $new_upload_image = public_path('/admin-assets/images/churches/') . $request->church_image_name;
                $remove_image = @unlink($new_upload_image);
                return back()->with('fail', 'Failed to create church. Please Try Again.');
            }

            return redirect()->route('admin.churches.list')->with('success', 'Church Successfully Created.');
        }

        return back()->with('fail', 'Failed to upload image of church. Please Try Again.');
    }

    public function edit(Request $request) {
        $church = Church::where('church_uuid', $request->uuid)->with('schedules')->firstOrFail();
        return view('admin-page.churches.edit', compact('church'));
    }

    public function update(UpdateChurchRequest $request) {
        // dd($request->all());
        $data = $request->validated();
        $church = Church::where('church_uuid', $request->uuid)->firstOrFail();

        $church_image_path = $request->current_image;
        $save_file = null;

        if($request->hasFile('church_image')) {
            $file = $request->file('church_image');

            $old_upload_image = public_path('/admin-assets/images/churches/') . $request->church_image_path;
            $remove_image = @unlink($old_upload_image);

            $church_image_path = Str::snake($request->name) . '.' . $file->getClientOriginalExtension();
            // save to directory
            $save_file = $file->move(public_path().'/admin-assets/images/churches', $church_image_path);
        }

        $save_church = $this->ChurchRepository->update($request, $data, $church, $church_image_path);
        $saveScheduleTime = $this->ChurchTimeScheduleRepository->saveTime($request, $church);

        if(!$save_church && $save_file) {
            $new_upload_image = public_path('/admin-assets/images/churches/') . $request->church_image_name;
            $remove_image = @unlink($new_upload_image);
            return back()->with('fail', 'Failed to create church. Please Try Again.');
        }

        return redirect()->route('admin.church.edit', $church->church_uuid)->with('success', 'Church Successfully Updated.');
    }
}
