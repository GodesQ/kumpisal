<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

use App\Models\AdminLog;

class AdminLogController extends Controller
{
    public function lists(Request $request) {
        if($request->ajax()) {
            $logs = AdminLog::select(DB::raw('admin_id'), DB::raw('MAX(id) as id'), DB::raw('MAX(type) as type'), DB::raw('MAX(title) as title'), DB::raw('MAX(created_at) as created_at'),
            DB::raw('MAX(updated_at) as updated_at'), DB::raw('MAX(type_id) as type_id'))->groupBy('type_id', 'admin_id');

            return DataTables::of($logs)
                ->addIndexColumn()
                ->addColumn('staff_name', function($row) {
                    return $row->admin->firstname . ' ' . $row->admin->lastname;
                })
                ->addColumn('log_date', function($row) {
                    return date_format(new \DateTime($row->created_at), 'F d, Y h:i A');
                })
                ->addColumn('actions', function($row) {
                    $btn = '<a href="/admin/log/show/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $query = $request->get('search');

                        $instance->orWhere('title', 'LIKE', '%' . $query . '%')
                            ->orWhere('type', 'LIKE', '%' . $query . '%')
                            ->orWhereHas('admin', function ($q) use ($query) {
                                $q->where('firstname', 'LIKE', '%' . $query . '%')
                                    ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                                    ->orWhere(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', '%' . $query . '%');
                            });
                    }
                }, true)
                ->rawColumns(['actions'])
                ->make(true);

        }
        return view('admin-page.admin-logs.list');
    }

    public function show(Request $request) {
        $id = $request->id;
        $log = AdminLog::where('id', $id)->with('admin')->firstOrFail();

        $other_logs = AdminLog::where('type_id', $log->type_id)
                    ->where('admin_id', $log->admin_id)
                    ->where('id', '!=', $log->id)
                    ->latest()
                    ->get();

        return view('admin-page.admin-logs.view', compact('log', 'other_logs'));
    }
}
