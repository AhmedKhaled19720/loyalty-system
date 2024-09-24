<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price', 'Total', 'total_points', 'status', 'tracking_number', 'shipped_at', 'delivered_at', 'cancelled_at', 'cancel_reason'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
