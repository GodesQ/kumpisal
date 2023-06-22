<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessageReply extends Model
{
    use HasFactory;
    protected $table = 'contact_messages_replies';
    protected $fillable = ['reply_to', 'reply_from', 'message', 'custom_subject'];

    public function admin() {
        return $this->hasOne(Admin::class, 'id','reply_from');
    }
}
