<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOns extends Model
{
    use HasFactory;

    public function customizedProduct()
    {
       return $this->belongsTo(CustomizedProduct::class, 'c_id');
    }

    public function order()
    {
       return $this->belongsTo(Order::class);
    }
}
