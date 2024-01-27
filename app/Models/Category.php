<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent'];

    public function ScopeMainCategory(Builder $query){
        $query->whereNull('parent');
    }

    public function ScopeChildCategory(Builder $query){
        $query->whereNotNull('parent');
    }

    public function main_category(){
        return $this->belongsTo(Category::class,'parent','id')->whereNull('parent');
    }

    public function childs_categories(){
        return $this->hasMany(Category::class,'parent','id')->whereNotNull('parent');
    }
}
