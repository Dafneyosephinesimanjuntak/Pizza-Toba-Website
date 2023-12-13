<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function carts(){
        return $this->belongsTo(Cart::class);
    }
    public function order_details(){
        return $this->belongsTo(OrderDetail::class);
    }
}
