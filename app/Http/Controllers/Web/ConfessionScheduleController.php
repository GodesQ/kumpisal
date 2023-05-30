<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DataTables;
use App\Models\ConfessionSchedule;
use App\Models\Church;

// use App\Http\Requests\ConfessionSchedule\CreateConfessionScheduleRequest;
// use App\Http\Requests\ConfessionSchedule\UpdateConfessionScheduleRequest;
use App\Repositories\ChurchTimeScheduleRepository;

class ConfessionScheduleController extends Controller
{
    protected $ChurchTimeScheduleRepository;

    public function __construct(ChurchTimeScheduleRepository $ChurchTimeScheduleRepository)
    {
        $this->ChurchTimeScheduleRepository = $ChurchTimeScheduleRepository;
    }

    public function save_schedule(Request $request) {
        $church = Auth::user()->representative_info->church;
        $saveTime = $this->ChurchTimeScheduleRepository->saveTime($request, $church);
        return redirect()->back()->with('success', 'Save Schedule/s Successfully.');
    }
}
