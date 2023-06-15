<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedChurch extends Model
{
    use HasFactory;
    protected $table = 'saved_churches';
    protected $fillable = ['owner_id', 'church_id', 'saved_date'];

    public function church() {
        return $this->hasOne(Church::class, 'id', 'church_id');
    }

}
