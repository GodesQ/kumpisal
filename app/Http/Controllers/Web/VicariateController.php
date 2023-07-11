<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vicariate;

use DataTables;
use DB;

class VicariateController extends Controller
{
    //
    public function lists(Request $request) {
        if($request->ajax()) {
            $data = Vicariate::with('church_diocese')->latest();
            return Datatable::of($data)
                    ->addIndexColumn()
                    ->addColumn('church_diocese', function ($row) {
                        return $row->church_diocese ? $row->church_diocese->name : 'Diocese Not Found';
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/diocese/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    });
        }
    }

    public function create(Request $request) {

    }

    public function store(Request $request) {

    }
}
