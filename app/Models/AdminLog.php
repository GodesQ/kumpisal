<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;
    protected $table = 'admin_logs';
    protected $fillable = ['admin_id', 'title', 'type', 'type_id', 'inputs'];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
