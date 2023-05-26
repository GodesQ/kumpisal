<?php

namespace App\Repositories;

use App\Models\ChurchConfessionSchedule;

class ChurchTimeScheduleRepository
{
    public function saveTime($request, $church)
    {
        // First, remove the existing schedule
        ChurchConfessionSchedule::where('church_id', $church->id)->delete();

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            $startTimeKey = "{$day}_sched_starttime";
            $endTimeKey = "{$day}_sched_endtime";

            if (isset($request->$startTimeKey[0]) && isset($request->$endTimeKey[0])) {
                foreach ($request->$startTimeKey as $key => $scheduleTime) {
                    $endTime = $request->$endTimeKey[$key];
                    $this->createSchedule($church->id, $day, $scheduleTime, $endTime);
                }
            }
        }
    }

    private function createSchedule($churchId, $day, $startTime, $endTime)
    {
        if ($startTime && $endTime) {
            return ChurchConfessionSchedule::create([
                'church_id' => $churchId,
                'day' => $day,
                'start_time' => $startTime,
                'end_time' => $endTime
            ]);
        }

        return null;
    }
}
