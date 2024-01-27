<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'phone',
        'phone_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = [
    //     'full_phone'
    // ];


     /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCustomer($query)
    {
        return $query->where('role', '=', 1);
    }


    public function orders(){
        return $this->hasMany(Order::class,'customer_id','id');
    }

    public function order_items()
    {
        return $this->hasManyThrough(
            OrderItem::class,
            Order::class,
            'customer_id', // Foreign key on the Order table...
            'order_id', // Foreign key on the OrderItem table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }


    public function reviews(){
        return $this->HasMany(Review::class,'customer_id','id');
    }

    public function getFullPhoneAttribute() {
        return $this->phone_code.$this->phone ?: 'غير متوفر';
    }

    public function messages(){
        return $this->hasMany(Message::class,'client_id','id');
    }
}
