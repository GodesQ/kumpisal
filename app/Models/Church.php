<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;
    protected $table = 'churches';
    protected $fillable = [
        'church_uuid',
        'name', 'description', 'church_image', 'address', 'latitude', 'longitude', 'parish_priest', 'feast_date', 'criteria', 'contact_number', 'facebook_link', 'is_active', 'is_delete'];

    public function schedules() {
        return $this->hasMany(ConfessionSchedule::class, 'church_uuid', 'church_uuid');
    }

    public function active_schedules() {
        $today = date('Y-m-d');
        return $this->hasMany(ConfessionSchedule::class, 'church_uuid', 'church_uuid')->where('schedule_date', '>=', $today);
    }

    public function church_days() {
        return $this->hasOne(ChurchDay::class, 'church_id');
    }

    public function scopeActive($query, $arg) {
        return $query->where('is_active', $arg);
    }

    public function scopeIsNotDeleted($query) {
        return $query->where('is_delete', 0);
    }
}
