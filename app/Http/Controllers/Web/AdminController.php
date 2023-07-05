<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use DB;

use App\Models\Church;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;

use App\Http\Requests\Admin\SaveAdminProfileRequest;
use App\Http\Requests\Admin\ChangeAdminPasswordRequest;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

use DataTables;
use App\Repositories\AdminLogRepository;


class AdminController extends Controller
{
    public function __construct(AdminLogRepository $adminLogRepository) {
        $this->title_create_log = 'Create Admin';
        $this->title_update_log = 'Update Admin';
        $this->AdminLogRepository = $adminLogRepository;
    }

    public function dashboard() {
        $latest_users = User::latest()->limit(5)->get();
        $latest_churches = Church::latest()->limit(5)->get();
        return view('admin-page.dashboard', compact('latest_users', 'latest_churches'));
    }

    public function profile(Request $request) {
        return view('admin-page.admin-profile.profile');
    }

    public function saveProfile(SaveAdminProfileRequest $request) {
        $data = $request->validated();
        $admin = Admin::where('id', $request->id)->update($data);

        return back()->with('success', 'Save Profile Successfully');
    }

    public function changePassword(ChangeAdminPasswordRequest $request) {
        $data = $request->validated();
        $user = Auth::guard('admin')->user();

        if(!Hash::check($request->old_password, $user->password)) return back()->with('old_password_incorrect', 'Your old password is incorrect. Please Try Again.');
        $update_user = $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        if($request->has('is_logout') && $update_user) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('success', 'Your Password Updated Successfully. Login now with your new password.');
        } else {
            return back()->with('success', 'Your Password Updated Successfully.');
        }

        return back()->with('fail', 'Failed to update your password.');
    }

    public function lists(Request $request) {
        if($request->ajax()) {
            $admins = Admin::get();
            return Datatables::of($admins)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a> ';

                        if (Gate::allows('delete_admin')) {
                            $btn .= '<a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        }

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin-page.admins.list');
    }

    public function create(Request $request) {
        $roles = Role::get();
        return view('admin-page.admins.create', compact('roles'));
    }

    public function store(CreateAdminRequest $request) {
        $inputs = [];
        $data = $request->validated();
        $admin =  new Admin;

        $create_admin = $admin->create(array_merge($data, [
            'name' => $request->firstname . ' ' . $request->lastname,
            'password' => Hash::make($request->password)
        ]));

        $adminChangedAttributes = $admin->getChanges();

        foreach ($adminChangedAttributes as $attribute => $value) {
            array_push($inputs, "Attribute: $attribute, Value: $value");
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_admin', $create_admin->id);

        return redirect()->route('admin.admins.list')->with('success', 'Admin Created Successfully');
    }

    public function edit(Request $request) {
        $admin = Admin::where('id', $request->id)->first();
        $roles = Role::get();
        return view('admin-page.admins.edit', compact('admin', 'roles'));
    }

    public function update(UpdateAdminRequest $request) {
        $data = $request->validated();
        $admin = Admin::where('id', $request->id)->first();

        $update_admin = $admin->update(array_merge($data, [
            'name' => $request->firstname . ' ' . $request->lastname
        ]), 400);



        return back()->with('success', 'Admin Updated Successfully');
    }
}
