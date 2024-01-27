<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','order_id','quantity'];

    public function product(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
}
