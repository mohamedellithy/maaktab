<?php

namespace App\Models;

use App\Models\Image;
use App\Services\UploadImage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'whatsapStatus',
        'whatsapNumber',
        'loginStatus',
        'meta_title',
        'meta_description',
        'slug',
        'main_category_id',
        'child_category_id',
        'application_id',
        'status'
    ];

    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_replace(' ','-',$value ?: $this->name),
        );
    }

    public function image_info()
    {
        return $this->belongsTo(Image::class, 'image', 'id');
    }

    public function application(){
        return $this->belongsTo(Application::class,'application_id','id');
    }

    public function main_category(){
        return $this->belongsTo(Category::class,'main_category_id','id');
    }

    public function child_category(){
        return $this->belongsTo(Category::class,'child_category_id','id');
    }

    public function order(): MorphOne
    {
        return $this->morphOne(Order::class, 'modelable');
    }
}
