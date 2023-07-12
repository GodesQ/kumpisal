<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vicariate;
use App\Models\Diocese;

use App\Http\Requests\Vicariate\CreateVicariateRequest;
use App\Http\Requests\Vicariate\UpdateVicariateRequest;

use DataTables;
use DB;

class VicariateController extends Controller
{
    //
    public function lists(Request $request) {

        if($request->ajax()) {
            $data = Vicariate::latest()->with('church_diocese');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('church_diocese', function ($row) {
                        return $row->church_diocese ? $row->church_diocese->name : 'Diocese Not Found';
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/vicariate/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                                <a id="' .$row->id. '" class="btn btn-danger btn-sm remove-btn"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-page.vicariates.list');
    }

    public function create(Request $request) {
        $dioceses = Diocese::get();
        return view('admin-page.vicariates.create', compact('dioceses'));
    }

    public function store(CreateVicariateRequest $request) {
        $data = $request->validated();
        $vicariate = Vicariate::create($data);

        if($vicariate) {
            if($request->has('redirect_to_list')) {
                return redirect()->route('admin.vicariates.list')->with('success', 'Vicariate Created Successfully');
            } else {
                return redirect()->back()->with('success', 'Vicariate Created Successfully');
            }
        }
        abort(500);
    }

    public function edit(Request $request) {
        $vicariate = Vicariate::where('id', $request->id)->first();
        $dioceses = Diocese::get();
        return view('admin-page.vicariates.edit', compact('vicariate', 'dioceses'));
    }

    public function update(UpdateVicariateRequest $request) {
        $data = $request->validated();
        $vicariate = Vicariate::where('id', $request->id)->first();

        $update_vicariate = $vicariate->update($data);

        if($update_vicariate) return redirect()->back()->with('success', 'Update Vicariate Successfully');
        abort(500);
    }

    public function destroy(Request $request) {
        $vicariate = Vicariate::where('id', $request->id)->first();

        $remove_vicariate = $vicariate->delete();

        if($remove_vicariate) return response([
            'status' => true,
            'message' => 'Vicariate Removed Successfully'
        ], 200);

        return response(500);

    }
}
