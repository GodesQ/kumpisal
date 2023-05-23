<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use App\Models\ConfessionSchedule;
use App\Models\Church;

use App\Http\Requests\ConfessionSchedule\CreateConfessionScheduleRequest;
use App\Http\Requests\ConfessionSchedule\UpdateConfessionScheduleRequest;

class ConfessionScheduleController extends Controller
{
    public function lists(Request $request) {
        if($request->ajax()) {
            $data = ConfessionSchedule::select('*')->with('church');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('church_name', function($row) {
                        return $row->church->name;
                    })
                    ->addColumn('schedule_date', function($row) {
                        return date_format(new \DateTime($row->schedule_date), 'F d, Y');
                    })
                    ->addColumn('started_time', function($row) {
                        return date_format(new \DateTime($row->started_time), 'h:i A');
                    })
                    ->addColumn('end_time', function($row) {
                        return date_format(new \DateTime($row->end_time), 'h:i A');
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/confession_schedule/edit/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>
                        <a id="' .$row->id. '" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-page.schedules.list');
    }

    public function create(Request $request) {
        $churches = Church::get();
        return view('admin-page.schedules.create', compact('churches'));
    }

    public function store(CreateConfessionScheduleRequest $request) {
        $data = $request->validated();
        $schedule = ConfessionSchedule::updateOrCreate(
            ['schedule_date' => $request->schedule_date],
            array_merge($data, [
                'church_uuid' => $request->church_uuid,
                'is_active' => $request->has('is_active') ? true : false,
            ])
        );

        if($schedule) return redirect()->route('admin.confession_schedule.edit', $schedule->id)->with('success', 'Schedule Successfully Created.');
    }

    public function edit(Request $request) {
        $churches = Church::get();
        $schedule = ConfessionSchedule::findOrFail($request->id);
        return view("admin-page.schedules.edit", compact('churches', 'schedule'));
    }

    public function update(UpdateConfessionScheduleRequest $request) {
        $data = $request->validated();

        $schedule = ConfessionSchedule::updateOrCreate(
            ['schedule_date' => $request->schedule_date, 'id' => $request->id],
            array_merge($data, [
                'church_uuid' => $request->church_uuid,
                'is_active' => $request->has('is_active') ? true : false,
            ])
        );

        if($schedule) return redirect()->route('admin.confession_schedule.edit', $schedule->id)->with('success', 'Schedule Successfully Updated.');
    }
}
