<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'gift_points', 'image', 'category', 'brand', 'stock', 'status', 'slug'];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
