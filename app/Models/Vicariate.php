<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vicariate extends Model
{
    use HasFactory;
    protected $table = 'vicariates';
    protected $fillable = ['name', 'diocese'];

    public function church_diocese() {
        return $this->hasOne(Diocese::class, 'id', 'diocese');
    }
}
