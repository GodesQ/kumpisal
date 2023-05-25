<?php

namespace App\Repositories;

use App\Models\ChurchDay;

class ChurchScheduleRepository
{
    public function createDay($request, $church) {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $key => $day) {
            ChurchDay::updateOrCreate([
                'church_id' => $church->id,
                'day' => $day,
                'status' => in_array($day, $request->day)
            ]);
        }
    }
}
