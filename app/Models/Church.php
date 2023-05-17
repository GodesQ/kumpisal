<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;
    protected $table = 'churches';
    protected $fillable = ['church_uuid', 'name', 'church_image', 'address', 'latitude', 'longitude', 'parish_priest', 'feast_date', 'criteria', 'is_active', 'is_delete'];
}
