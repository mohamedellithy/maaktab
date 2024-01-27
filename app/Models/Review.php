<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'project_id',
        'degree',
        'review',
        'status',
        'replay_on'
    ];

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function replays(){
        return $this->hasMany(Review::class,'replay_on','id');
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }


}
