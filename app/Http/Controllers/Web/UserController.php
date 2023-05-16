<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
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
                        $btn = '<a class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.users.list');
    }

    public function create(Request $request) {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request) {
        dd($request->all());
    }

    public function edit(Request $request) {

    }
}
