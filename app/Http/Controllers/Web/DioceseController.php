<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\Diocese;
use DataTables;

use App\Repositories\AdminLogRepository;

use App\Http\Requests\Diocese\CreateDioceseRequest;
use App\Http\Requests\Diocese\UpdateDioceseRequest;

class DioceseController extends Controller
{
    public function __construct(AdminLogRepository $adminLogRepository) {
        $this->title_create_log = 'Create Diocese';
        $this->title_update_log = 'Update Diocese';
        $this->AdminLogRepository = $adminLogRepository;
    }

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
        $inputs = [];
        $data = $request->validated();
        $diocese = new Diocese;

        $create_diocese = $diocese->create($data);

        $dioceseChangedAttributes = $diocese->getChanges();

        foreach ($dioceseChangedAttributes as $attribute => $value) {
            if($value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_diocese', $create_diocese->id);

        if($create_diocese) return redirect()->route('admin.dioceses.list')->with('success', 'Diocese Created Successfully.');
        abort(500);
    }

    public function edit(Request $request) {
        $diocese = Diocese::where('id', $request->id)->first();
        return view('admin-page.dioceses.edit', compact('diocese'));
    }

    public function update(UpdateDioceseRequest $request) {
        $inputs = [];
        $data = $request->validated();
        $diocese = Diocese::where('id', $request->id)->first();

        $update_diocese = $diocese->update($data);

        $dioceseChangedAttributes = $diocese->getChanges();

        foreach ($dioceseChangedAttributes as $attribute => $value) {
            if($value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_update_log, 'update_diocese', $diocese->id);

        if($update_diocese) return back()->with('success', 'Diocese Updated Successfully.');
        abort(500);
    }
}
