<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_uuid',
        'user_image',
        'name',
        'email',
        'password',
        'firstname',
        'lastname',
        'middlename',
        'address',
        'latitude',
        'longitude',
        'is_verify',
        'email_verified_at',
        'is_admin_generated',
        'role',
        'prefer_days',
        'is_active',
        'is_delete'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function representative_info() {
        return $this->belongsTo(RepresentativeInfo::class, 'id', 'main_id');
    }

    public function saved_churches() {
        return $this->hasMany(SavedChurch::class, 'owner_id');
    }
}
