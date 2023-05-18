<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

use DataTables;
use App\Models\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function dashboard(Request $request) {
        return view('user-page.dashboard');
    }

    public function lists(Request $request) {
        if($request->ajax()) {
            $users = User::get();
            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('verified', function($row){
                        if($row->is_verify) {
                            $badge = '<span class="badge bg-success rounded-3 fw-semibold">Verified</span>';
                        } else {
                            $badge = '<span class="badge bg-warning rounded-3 fw-semibold">Not Verify</span>';
                        }
                        return $badge;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/user/edit/' .$row->user_uuid. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a id="' .$row->user_uuid. '" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'verified'])
                    ->make(true);
        }
        return view('admin-page.users.list');
    }

    public function create(Request $request) {
        return view('admin-page.users.create');
    }

    public function store(CreateUserRequest $request) {
        $data = $request->except('_token', 'password');

        $store = User::create(array_merge($data, [
            'name' => $request->firstname . ' ' . $request->lastname,
            'password' => Hash::make($request->password),
            'user_uuid' => Str::orderedUuid()
        ]));

        if($store) return redirect()->route('admin.users.list')->with('success', 'Created Successfully');
    }

    public function edit(Request $request) {
        $user = User::where('user_uuid', $request->uuid)->firstOrFail();
        return view('admin-page.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request) {
        $data = $request->validated();

        $update = User::where('user_uuid', $request->uuid)->update(array_merge($data, [
            'name' => $request->firstname . ' ' . $request->lastname,
            'password' => $request->new_password ? $request->new_password : DB::raw('password'),
            'is_verify' => $request->has('is_verify') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
        ]));

        if($update) return back()->with('success', 'Update User Successfully');
    }
}
