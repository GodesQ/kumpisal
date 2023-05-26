<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchConfessionSchedule extends Model
{
    use HasFactory;
    protected $table = 'churches_confession_schedules';
    protected $fillable = [
        'church_id',
        'day',
        'start_time',
        'end_time',
        'is_deleted'
    ];
}
