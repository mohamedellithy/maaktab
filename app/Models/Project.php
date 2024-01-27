<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'thumbnail_id',
        'status','slug',
        'attachments_id',
        'price',
        'from',
        'to',
        'meta_title',
        'main_category_id',
        'child_category_id',
        'application_id',
        'meta_description'];

    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str_replace(' ','-',$value ?: $this->name),
        );
    }

    public function image_info()
    {
        return $this->belongsTo(Image::class, 'thumbnail_id', 'id');
    }

    public function downloads()
    {
        return $this->hasOne(Download::class,'project_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'project_id','id')->whereNull('replay_on');
    }

    public function coupon(){
        return $this->belongsToMany(Coupon::class,'coupon_products','project_id','coupon_id');
    }

    public function order(): MorphOne
    {
        return $this->morphOne(Order::class, 'modelable');
    }
}
