<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $casts = [
        'fields' => 'array'
    ];

    protected $fillable = [
        'app_name',
        'fields',
        'main_category_id',
        'child_category_id'
    ];


    public function main_category(){
        return $this->belongsTo(Category::class,'main_category_id','id')->whereNull('parent');
    }

    public function child_category(){
        return $this->belongsTo(Category::class,'child_category_id','id')->whereNotNull('parent');
    }
}
