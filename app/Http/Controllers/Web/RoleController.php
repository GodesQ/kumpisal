<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

use App\Models\Role;

use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

class RoleController extends Controller
{
    public function lists(Request $request) {
        if($request->ajax()) {
            $roles = Role::select('*');
            return Datatables::of($roles)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/role/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin-page.roles.list');
    }

    public function create(Request $request) {
        return view('admin-page.roles.create');
    }

    public function store(CreateRoleRequest $request) {
        $data = $request->validated();
        $role = new Role;
        $save_role = $role->create($data);

        if($save_role) {
            return redirect()->route('admin.roles.list')->with('success', 'Role Successfully Created');
        }
    }

    public function edit(Request $request) {
        $role = Role::where('id', $request->id)->first();
        return view('admin-page.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request) {
        $data = $request->validated();
        $role = Role::where('id', $request->id)->first();
        $save_role = $role->update($data);

        if($save_role) {
            return back()->with('success', 'Role Update Successfully ');
        }
    }
}
