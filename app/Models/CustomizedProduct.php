<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedProduct extends Model
{
    // Define the fillable properties (columns).
    protected $fillable = [
        'name',
        'price',
        'product_code',
        'description',
        'is_disabled',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function addons()
    {
        return $this->hasMany(AddOns::class, 'c_id');
    }
}

