<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;

use App\Models\User;
use App\Models\Church;
use App\Models\RepresentativeInfo;

use App\Http\Requests\Representative\CreateRepresentativeRequest;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use App\Http\Requests\Representative\SaveRepresentativeProfileRequest;

use App\Repositories\AdminLogRepository;

class RepresentativeController extends Controller
{
    protected $title_create_log;
    protected $title_update_log;
    protected $AdminLogRepository;

    public function __construct(AdminLogRepository $adminLogRepository) {
        $this->title_create_log = 'Create Parish Representative';
        $this->title_update_log = 'Update Parish Representative';
        $this->AdminLogRepository = $adminLogRepository;
    }
    public function dashboard(Request $request) {
        $church = Church::where('id', Auth::user()->representative_info->church->id)->with('schedules')->first();
        return view('user-page.representative-dashboard.dashboard', compact('church'));
    }

    public function profile(Request $request) {
        return view('user-page.representative-dashboard.representative-profile');
    }

    public function saveProfile(SaveRepresentativeProfileRequest $request) {
        $data = $request->validated();
        $user_image;

        if($request->hasFile('member_avatar')) {
            $old_upload_image = public_path('/user-assets/images/avatars/') . $request->old_user_image;
            $remove_image = @unlink($old_upload_image);
            $file = $request->file('member_avatar');
            $user_image = $request->uuid . '.' . $file->getClientOriginalExtension();

            // save to folder
            $save_file = $file->move(public_path() . '/user-assets/images/avatars', $user_image);
        }

        $representative = Auth::user();
        $save_representative = $representative->update(array_merge($data, [
            'user_image' => $user_image
        ]));

        $representative_info = RepresentativeInfo::where('main_id', $representative->id)->first();
        $save_info = $representative_info->update($data);
        return back()->with('success', 'Save Profile Successfully');
    }

    public function lists(Request $request) {
        // $representatives = User::where('is_admin_generated', 1)->with('representative_info.church')->get();
        // dd($representatives);
        if($request->ajax()) {
            $representatives = User::where('is_admin_generated', 1)->with('representative_info.church')->get();
            return Datatables::of($representatives)
                    ->addIndexColumn()
                    ->addColumn('contact_no', function($row) {
                        return $row->representative_info ? $row->representative_info->contact_no : null;
                    })
                    ->addColumn('church', function($row) {
                        return $row->representative_info ? substr(optional($row->representative_info->church)->name, 0, 30) . '...' : null;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/representative/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-page.representatives.list');
    }

    public function create(Request $request) {
        $churches = Church::get();
        return view('admin-page.representatives.create', compact('churches'));
    }

    public function store(CreateRepresentativeRequest $request) {
        $data = $request->validated();

        // Step 1: Create the representative in a transaction
        DB::transaction(function () use ($data, $request) {
            $inputs = [];
            $representative = new User;

            $representative->fill(array_merge($data, [
                'is_admin_generated' => 1,
                'name' => $data['firstname'] . ' ' . $data['lastname'],
                'password' => Hash::make($data['password']),
                'user_uuid' => Str::orderedUuid(),
            ]));

            $save_representative = $representative->save();

            $representativeChangedAttributes = $representative->getDirty();

            // Loop through the changed attributes and do something with them
            foreach ($representativeChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 2: Check if the representative was successfully created
            if (!$save_representative) {
                return back()->with('error', 'Failed to create representative');
            }

            $representativeInfo = new RepresentativeInfo;

            // Step 3: Create the representative info
            $representativeInfo->fill([
                'main_id' => $representative->id,
                'church_id' => $data['church'],
                'years_of_service' => $data['years_of_service'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'contact_no' => $data['contact_no'],
            ]);

            $save_representative_info = $representativeInfo->save();

            $infoChangedAttributes = $representativeInfo->getDirty();

            // Loop through the changed attributes and do something with them
            foreach ($infoChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 4: Check if the representative info was successfully created
            if (!$save_representative_info) {
                $representative->delete(); // Rollback by deleting the representative
                return back()->with('error', 'Failed to create representative info');
            }

            // Step 5: Create Log
            $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_representative');
        });

        // Step 6: Redirect with success message
        return redirect()->route('admin.representatives.list')->with('success', 'Representative and info created successfully');
    }

    public function edit(Request $request) {
        $representative = User::where('id', $request->id)->where('is_admin_generated', 1)->with('representative_info')->first();
        $churches = Church::get();
        return view('admin-page.representatives.edit', compact('representative', 'churches'));
    }

    public function update(UpdateRepresentativeRequest $request) {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request) {
            $inputs = [];

            $representative = User::where('id', $request->id)->first();

            $representative->fill(array_merge($data, [
                'is_admin_generated' => 1,
                'name' => $data['firstname'] . ' ' . $data['lastname'],
                'user_uuid' => Str::orderedUuid(),
                'is_verify' => $request->has('is_verify') ? true : false,
                'is_active' => $request->has('is_active') ? true : false,
            ]));

            $representative_update = $representative->save();

            $representativeChangedAttributes = $representative->getDirty();
            // dd($representativeChangedAttributes);

            // Loop through the changed attributes and do something with them
            foreach ($representativeChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 2: Check if the representative was successfully created
            if (!$representative_update) {
                return back()->with('error', 'Failed to create representative');
            }

            // Step 3: Create the representative info
            $representativeInfo = RepresentativeInfo::where('main_id', $representative->id)->first();

            $representativeInfo->fill([
                'main_id' => $representative->id,
                'church_id' => $data['church'],
                'years_of_service' => $data['years_of_service'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'contact_no' => $data['contact_no'],
            ]);

            $representative_info_update = $representativeInfo->update();

            // Step 4: Check if the representative info was successfully created
            if (!$representative_info_update) {
                $representative->delete(); // Rollback by deleting the representative
                return back()->with('error', 'Failed to create representative info');
            }

            $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_update_log, 'update_representative');
        });

        return back()->with('success', 'Update Successfully');
    }
}
