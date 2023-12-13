<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeProduct extends Model
{
    // Define the table associated with this model (optional).
    protected $table = 'customize_products';

    // Define the fillable properties (columns).
    protected $fillable = [
        'name',
        'price',
        'product_code',
        'description',
        'is_disabled',
        'photo',
    ];

    // Define any relationships here, for example:
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
