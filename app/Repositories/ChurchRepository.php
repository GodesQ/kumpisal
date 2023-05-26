<?php

namespace App\Repositories;

use App\Models\Church;
use Illuminate\Support\Str;

class ChurchRepository
{
    public function store($request, $data, $church_image_name) {
        return Church::create(array_merge($data, [
            'church_uuid' => Str::orderedUuid(),
            'church_image' => $church_image_name,
            'has_monday_sched' => $request->has('has_monday_sched'),
            'has_tuesday_sched' => $request->has('has_tuesday_sched'),
            'has_wednesday_sched' => $request->has('has_wednesday_sched'),
            'has_thursday_sched' => $request->has('has_thursday_sched'),
            'has_friday_sched' => $request->has('has_friday_sched'),
            'has_saturday_sched' => $request->has('has_saturday_sched'),
            'has_sunday_sched' => $request->has('has_sunday_sched'),
        ]));
    }

    public function update($request, $data, $church, $church_image_path) {
        $church->update(array_merge($data, [
            'church_image' => $church_image_path,
            'is_active' => $request->has('is_active') ? true : false,
            'has_monday_sched' => $request->has('has_monday_sched'),
            'has_tuesday_sched' => $request->has('has_tuesday_sched'),
            'has_wednesday_sched' => $request->has('has_wednesday_sched'),
            'has_thursday_sched' => $request->has('has_thursday_sched'),
            'has_friday_sched' => $request->has('has_friday_sched'),
            'has_saturday_sched' => $request->has('has_saturday_sched'),
            'has_sunday_sched' => $request->has('has_sunday_sched'),
        ]));
    }
}
