<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\RepresentativeInfo;

use App\Repositories\AdminLogRepository;
use DB;

class RepresentativeRepository
{
    public function __construct(AdminLogRepository $adminLogRepository)
    {
        $this->title_create_log = 'Create Parish Representative';
        $this->title_update_log = 'Update Parish Representative';
        $this->title_remove_log = 'Remove Parish Representative';
        $this->AdminLogRepository = $adminLogRepository;
    }

    public function store($request, $data)
    {
        // Step 1: Create the representative in a transaction
        $transaction = DB::transaction(function () use ($data, $request) {
            $inputs = [];
            $representative = new User;

            $save_representative = $representative->create(
                array_merge($data, [
                    'is_admin_generated' => 1,
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'password' => Hash::make($data['password']),
                    'role' => 'representative',
                    'user_uuid' => Str::orderedUuid(),
                ]),
            );

            $representativeChangedAttributes = $representative->getChanges();

            // Loop through the changed attributes and do something with them
            foreach ($representativeChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 2: Check if the representative was successfully created
            if (!$save_representative) {
                return back()->with('error', 'Failed to create representative');
            }

            $representativeInfo = new RepresentativeInfo;

            // Step 3: Create the representative info
            $save_representative_info = $representativeInfo->create([
                'main_id' => $save_representative->id,
                'church_id' => $data['church'],
                'years_of_service' => $data['years_of_service'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'contact_no' => $data['contact_no'],
            ]);

            $infoChangedAttributes = $representativeInfo->getChanges();

            // Loop through the changed attributes and do something with them
            foreach ($infoChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 4: Check if the representative info was successfully created
            if (!$save_representative_info) {
                $save_representative->delete(); // Rollback by deleting the representative
                return back()->with('error', 'Failed to create representative info');
            }

            // Step 5: Create Log
            $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_representative', $save_representative->id);

            return $save_representative && $save_representative_info && $create_log ? true : false;

        });

        return $transaction ? true : false;
    }

    public function update($request, $data)
    {
        $transaction = DB::transaction(function () use ($data, $request) {
            $inputs = [];

            $representative = User::where('id', $request->id)->first();

            $representative_update = $representative->update(array_merge($data, [
                'name' => $data['firstname'] . ' ' . $data['lastname'],
                'is_verify' => $request->has('is_verify') ? true : false,
                'is_active' => $request->has('is_active') ? true : false,
            ]));

            $representativeChangedAttributes = $representative->getChanges();

            // Loop through the changed attributes and do something with them
            foreach ($representativeChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 2: Check if the representative was successfully created
            if (!$representative_update) {
                return back()->with('error', 'Failed to create representative');
            }

            // Step 3: Create the representative info
            $representativeInfo = RepresentativeInfo::where('main_id', $representative->id)->first();

            $representative_info_update = $representativeInfo->update([
                'main_id' => $representative->id,
                'church_id' => $data['church'],
                'years_of_service' => $data['years_of_service'],
                'age' => $data['age'],
                'birthdate' => $data['birthdate'],
                'contact_no' => $data['contact_no'],
            ]);

             $representativeInfo->save();

            $infoChangedAttributes = $representativeInfo->getChanges();

            // Loop through the changed attributes and do something with them
            foreach ($infoChangedAttributes as $attribute => $value) {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }

            // Step 4: Check if the representative info was successfully created
            if (!$representative_info_update) {
                $representative->delete(); // Rollback by deleting the representative
                return back()->with('error', 'Failed to create representative info');
            }

            $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_update_log, 'update_representative', $representative->id);

            return $representative_update && $representative_info_update  && $create_log ? true : false;
        });

        return $transaction ? true : false;
    }

    public function destroy($request) {
        $representative = User::where('id', $request->user_id)->firstOr(function() {
            return response([
                'status' => 'Fail',
                'message' => 'Representative Not Found'
            ], 404);
        });

        $remove_representative = $representative->update([
            'is_delete' => 1
        ]);

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_remove_log, 'destroy_representative', $representative->id);
        return $remove_representative && $create_log ? true : false;
    }
}
