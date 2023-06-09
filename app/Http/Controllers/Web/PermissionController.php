<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

use App\Models\Permission;
use App\Models\Role;

use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function lists(Request $request) {
        if($request->ajax()) {
            $permissions = Permission::select('*')->latest();
            return Datatables::of($permissions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/admin/permission/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin-page.permissions.list');
    }

    public function create(Request $request) {
        $roles = Role::get();
        return view('admin-page.permissions.create', compact('roles'));
    }

    public function store(CreatePermissionRequest $request) {
        $data = $request->validated();
        $roles = implode("|", $request->roles);

        $permission = new Permission;

        $save_permission = $permission->create([
            'permission' => $request->permission,
            'roles' => $roles,
        ]);

        if($save_permission) {
            return redirect()->route('admin.permissions.list')->with('success', 'Permission Created Successfully');
        }
    }

    public function edit(Request $request) {
        $permission = Permission::where('id', $request->id)->first();
        $roles = Role::get();
        return view('admin-page.permissions.edit', compact('permission', 'roles'));
    }

    public function update(UpdatePermissionRequest $request) {
        $permission = Permission::where('id', $request->id)->first();
        $roles = implode("|", $request->roles);

        $update_permission = $permission->update([
            'permission' => $request->permission,
            'roles' => $roles,
        ]);

        if($update_permission) {
            return back()->with('success', 'Permission updated successfully');
        }
    }
}
