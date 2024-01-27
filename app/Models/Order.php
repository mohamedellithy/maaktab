<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_status',
        'order_no',
        'order_total',
        'proposal_id',
        'read',
        'customer_id',
        'application_id',
        'modelable_id',
        'modelable_type'
    ];

    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function order_items(){
        return $this->hasOne(OrderItem::class,'order_id','id');
    }

    public function payment(){
        return $this->hasOne(Payment::class,'order_id','id');
    }

    public function order_attachments(){
        return $this->hasMany(OrderAttachment::class,'order_id','id');
    }

    public function modelable(): MorphTo
    {
        return $this->morphTo();
    }

    public function proposal(){
        return $this->hasMany(Proposal::class,'order_id','id');
    }
}
