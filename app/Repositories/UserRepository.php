<?php

namespace App\Repositories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Repositories\AdminLogRepository;

use DB;
use App\Mail\UserEmailVerification;

class UserRepository
{
    public function __construct(AdminLogRepository $adminLogRepository)
    {
        $this->title_create_log = 'Create User';
        $this->title_update_log = 'Update User';
        $this->AdminLogRepository = $adminLogRepository;
    }

    public function store($request, $data)
    {
        $inputs = [];
        $user = new User;

        $create_user = $user->create(
            array_merge($data, [
                'name' => $request->firstname . ' ' . $request->lastname,
                'password' => Hash::make($request->password),
                'user_uuid' => Str::orderedUuid(),
            ]),
        );

        $userChangedAttributes = $user->getChanges();

        foreach ($userChangedAttributes as $attribute => $value) {
            array_push($inputs, "Attribute: $attribute, Value: $value");
        }

        if ($request->missing('is_verify')) {

            # details for sending email to worker
            $details = [
                'title' => 'Verification Email from Kumpisalan App',
                'email' => $create_user->email,
                'name' => $create_user->name,
            ];

            // SEND EMAIL FOR VERIFICATION
            Mail::to($create_user->email)->send(new UserEmailVerification($details));
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_create_log, 'create_user', $create_user->id);

        if ($create_user && $create_log) {
            return true;
        }

        return false;
    }

    public function update($request, $data)
    {
        $inputs = [];
        $user = User::where('user_uuid', $request->uuid)->first();

        $update_user = $user->update(
            array_merge($data, [
                'name' => $request->firstname . ' ' . $request->lastname,
                'password' => $request->new_password ? $request->new_password : DB::raw('password'),
                'is_verify' => $request->has('is_verify') ? true : false,
                'is_active' => $request->has('is_active') ? true : false,
            ]),
        );

        $userChangedAttributes = $user->getChanges();

        foreach ($userChangedAttributes as $attribute => $value) {
            if ($attribute != 'password') {
                array_push($inputs, "Attribute: $attribute, Value: $value");
            }
        }

        $create_log = $this->AdminLogRepository->create($request, $inputs, $this->title_update_log, 'update_user', $user->id);
        if ($update_user && $create_log) {
            return true;
        }

        return false;
    }
}
