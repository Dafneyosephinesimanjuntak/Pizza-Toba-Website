<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function getPriceAttribute()
    {
        return $this->menu->price * $this->quantity;
    }
}
