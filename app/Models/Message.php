<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'client_id',
        'sender',
        'message',
        'attachments',
        'read'
    ];

    public function client(){
        return $this->belongsTo(User::class,'client_id','id');
    }
}
