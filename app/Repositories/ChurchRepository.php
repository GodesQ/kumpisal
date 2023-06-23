<?php

namespace App\Repositories;

use App\Models\Church;
use Illuminate\Support\Str;
use App\Repositories\AdminLogRepository;

class ChurchRepository
{
    public function __construct(AdminLogRepository $adminLogRepository) {
        $this->title_create_log = 'Create Church';
        $this->title_update_log = 'Update Church';
        $this->AdminLogRepository = $adminLogRepository;
    }
    public function store($request, $data, $church_image_name) {
        $inputs = [];
        $church = new Church;
        $create_church = $church->create(array_merge($data, [
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

        $churchChangedAttributes = $church->getChanges();

        foreach ($churchChangedAttributes as $attribute => $value) {
            if($value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_church', $create_church->id);
        return $create_church;
    }

    public function update($request, $data, $church, $church_image_path) {
        $inputs = [];
        $update_church = $church->update(array_merge($data, [
            'church_image' => $church_image_path,
            'is_active' => $request->has('is_active') ? true : false,
            'has_monday_sched' => $request->has('has_monday_sched') ? true : null,
            'has_tuesday_sched' => $request->has('has_tuesday_sched') ? true : null,
            'has_wednesday_sched' => $request->has('has_wednesday_sched') ? true : null,
            'has_thursday_sched' => $request->has('has_thursday_sched') ? true : null,
            'has_friday_sched' => $request->has('has_friday_sched') ? true : null,
            'has_saturday_sched' => $request->has('has_saturday_sched') ? true : null,
            'has_sunday_sched' => $request->has('has_sunday_sched') ? true : null,
        ]));

        $churchChangedAttributes = $church->getChanges();

        foreach ($churchChangedAttributes as $attribute => $value) {
            if($value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_update_log, 'update_church', $church->id);
        return $update_church;
    }
}
