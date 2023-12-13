<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'price'];
    
    public function customizedProducts()
    {
        return $this->hasMany(CustomizedProduct::class);
    }

    public function getLimitedCustomizedProducts($limit)
    {
        return $this->customizedProducts()->limit($limit)->get();
    }
}