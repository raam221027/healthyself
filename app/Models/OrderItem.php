<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'subtotal',
        'customized_product_id',
    ];

 // Define the relationship with the Product model
 public function product()
 {
     return $this->belongsTo(Product::class);
 }

 
 

 // Define the relationship with the CustomizedProduct model
 public function customizedProduct()
 {
     return $this->belongsTo(CustomizedProduct::class, 'customized_product_id');
 }

 // Define the inverse relationship with the Order model
 public function order()
 {
     return $this->belongsTo(Order::class);
 }
}
