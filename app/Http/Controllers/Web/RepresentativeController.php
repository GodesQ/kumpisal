<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Church;
use App\Models\RepresentativeInfo;

use App\Http\Requests\Representative\CreateRepresentativeRequest;
use App\Http\Requests\Representative\UpdateRepresentativeRequest;
use App\Http\Requests\Representative\SaveRepresentativeProfileRequest;

use App\Repositories\RepresentativeRepository;

class RepresentativeController extends Controller
{
    public function __construct(RepresentativeRepository $representativeRepository) {
        $this->RepresentativeRepository = $representativeRepository;
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
            $representatives = User::where('is_admin_generated', 1)->where('is_delete', 0)->with('representative_info.church')->get();
            return Datatables::of($representatives)
                    ->addIndexColumn()
                    ->addColumn('contact_no', function($row) {
                        return $row->representative_info ? $row->representative_info->contact_no : null;
                    })
                    ->addColumn('church', function($row) {
                        return $row->representative_info ? substr(optional($row->representative_info->church)->name, 0, 30) . '...' : null;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/representative/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a> ';

                        if(Gate::allows('delete_representative')) {
                            $btn .= '<a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        }
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
        $save_representative = $this->RepresentativeRepository->store($request, $data);

        if($save_representative) return redirect()->route('admin.representatives.list')->with('success', 'Representative and info created successfully');
        abort(500);
    }

    public function edit(Request $request) {
        $representative = User::where('id', $request->id)->where('is_admin_generated', 1)->with('representative_info')->first();
        $churches = Church::get();

        return view('admin-page.representatives.edit', compact('representative', 'churches'));
    }

    public function update(UpdateRepresentativeRequest $request) {
        $data = $request->validated();
        $update_representative = $this->RepresentativeRepository->update($request, $data);

        if($update_representative) return back()->with('success', 'Update Successfully');
        abort(500);
    }

    public function delete(Request $request) {
        $removed_representative = $this->RepresentativeRepository->destroy($request);

        if($removed_representative) {
            return response([
                'status' => 'Removed',
                'message' => 'Representative Removed Successfully'
            ], 200);
        }
    }
}
