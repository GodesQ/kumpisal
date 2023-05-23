<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfessionSchedule extends Model
{
    use HasFactory;
    protected $table = 'confession_schedules';
    protected $fillable = ['church_uuid', 'schedule_date', 'started_time', 'end_time', 'is_active', 'is_delete'];

    public function church() {
        return $this->belongsTo(Church::class, 'church_uuid', 'church_uuid');
    }
}
