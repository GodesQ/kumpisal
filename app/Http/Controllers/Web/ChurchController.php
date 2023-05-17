<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Http\Requests\Church\CreateChurchRequest;

use DataTables;
use App\Models\Church;

class ChurchController extends Controller
{
    public function lists(Request $request) {

        if($request->ajax()) {
            $churches = Church::get();
            return Datatables::of($churches)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/user/edit/' .$row->user_uuid. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->user_uuid. '" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>';
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
        dd($request->validated());
    }
}
