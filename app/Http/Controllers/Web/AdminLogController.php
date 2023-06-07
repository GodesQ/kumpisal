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
            $logs = AdminLog::with('admin');

            return DataTables::of($logs)
                    ->addIndexColumn()
                    ->addColumn('staff_name', function($row) {
                        return $row->admin->firstname . ' ' . $row->admin->lastname;
                    })
                    ->addColumn('log_date', function($row) {
                        return date_format(new \DateTime($row->created_at), 'F d, Y h:i A');
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/contact_message/show/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                        return $btn;
                    })
                    ->filter(function ($instance) use ($request) { // Use $query instead of $instance
                        if (!empty($request->get('search'))) {
                            return response($request->search);
                            $instance->orWhere('type', $request->get('search'))
                            ->orWhere('title', $request->get('search'))
                            ->whereHas('admin', function ($q) use ($request) { // Pass $request to the nested function
                                $query = $request->get('search');
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
}
