<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\Notification;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
    public function coupon()
    {
        return $this->hasMany(Coupon::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
