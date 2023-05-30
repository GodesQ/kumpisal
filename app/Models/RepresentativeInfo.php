<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeInfo extends Model
{
    use HasFactory;
    protected $table = 'representatives_otherinfo';
    protected $fillable = [
        'main_id',
        'church_id',
        'years_of_service',
        'age',
        'birthdate',
        'contact_no'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id','main_id');
    }

    public function church() {
        return $this->hasOne(Church::class, 'id', 'church_id');
    }
}
