<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'from',
        'to',
        'discount_type',
        'value',
        'status',
        'projects',
        'count_used'
    ];

    public function order(){
        return $this->hasOne(Order::class,'coupon_id','id');
    }

    public function project(){
        return $this->belongsToMany(Project::class,'coupon_products','coupon_id','project_id');
    }
}
