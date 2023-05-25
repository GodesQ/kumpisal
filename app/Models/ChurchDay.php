<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchDay extends Model
{
    use HasFactory;
    protected $table = 'churches_days';
    protected $fillable = ['church_id', 'day', 'status'];

    public function church() {
        return $this->belongsTo(Church::class);
    }


}
