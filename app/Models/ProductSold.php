<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSold extends Model
{
    protected $fillable = ['product_id', 'quantity', 'created_at'];
    protected $table = 'product_sold_reports';

    public function product()
    {
        return $this->belongsTo(Product::class); // Assuming you have a Product model
    }
}
