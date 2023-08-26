<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategories::all();
        return view('product_categories.index', compact('product_categories'));
    }

public function create()
{
    return view('admin.product_categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:product_categories',
    ]);

    ProductCategories::create([
        'name' => $request->name,
    ]);

    return redirect()->route('product-categories.index')->with('success', 'Product category created successfully.');
}
}
