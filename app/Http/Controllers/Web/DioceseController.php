<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\Diocese;
use DataTables;

use App\Http\Requests\Diocese\CreateDioceseRequest;
use App\Http\Requests\Diocese\UpdateDioceseRequest;

class DioceseController extends Controller
{
    public function lists(Request $request) {
        if($request->ajax()) {
            $data = Diocese::latest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/diocese/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-page.dioceses.list');
    }

    public function create(Request $request) {
        return view('admin-page.dioceses.create');
    }

    public function store(CreateDioceseRequest $request) {
       $data = $request->validated();
       $diocese = Diocese::create($data);

       if($diocese) return redirect()->route('admin.dioceses.list')->with('success', 'Diocese Created Successfully.');
       abort(500);
    }

    public function edit(Request $request) {
        $diocese = Diocese::where('id', $request->id)->first();
        return view('admin-page.dioceses.edit', compact('diocese'));
    }

    public function update(UpdateDioceseRequest $request) {
        $data = $request->validated();
        $diocese = Diocese::where('id', $request->id)->first();

        $update_diocese = $diocese->update($data);
        if($update_diocese) return back()->with('success', 'Diocese Updated Successfully.');
        abort(500);
    }
}
