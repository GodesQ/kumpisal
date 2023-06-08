<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = ['role', 'position', 'username', 'email', 'password', 'firstname', 'middlename', 'lastname', 'name', 'is_verify', 'is_active', 'is_delete'];

    public function logs() {
        $this->hasMany(AdminLog::class, 'admin_id');
    }
}
