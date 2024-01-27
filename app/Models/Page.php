<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'thumbnail_id',
        'content',
        'position',
        'meta_title',
        'meta_description',
        'menu_position'
    ];

    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_replace(' ','-',$value ?: $this->title),
        );
    }

    public function content(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => @unserialize($value) !== false ? unserialize($value) : $value,
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => isset($value) ? $value : 'not-active',
        );
    }

    public function image_info()
    {
        return $this->belongsTo(Image::class, 'thumbnail_id', 'id');
    }
}
