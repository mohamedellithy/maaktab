<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'description',
        'attachments',
        'price',
        'status'
    ];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
