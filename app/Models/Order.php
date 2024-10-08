<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'payment_method',
        'order_type',
       
    ];
    
    public function items()
    {
       return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantity');
    }
    

    public function totalAmount()
    {
        return $this->items->sum(function ($item) {
            return $item->pivot->quantity * $item->price;
        });
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addons()
    {
        return $this->hasMany(AddOns::class);
    }

}