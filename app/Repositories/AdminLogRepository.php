<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\AdminLog;

class AdminLogRepository {
    public function create($request, $inputs, $title, $type, $type_id) {
        $create = AdminLog::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'type' => $type,
            'type_id' => $type_id,
            'title' => $title,
            'inputs' => implode("|", $inputs)
        ]);
        return $create;
    }
}
