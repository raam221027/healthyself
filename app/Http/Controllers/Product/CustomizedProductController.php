<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomizedProduct;
use App\Models\OrderItem;

class CustomizedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customizedProducts = CustomizedProduct::paginate(3); 

    return view('customized_products.index', compact('customizedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customized_products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Generate a unique product code
    $productCode = 'HTS-' . uniqid();

    // Get the uploaded file
    $photo = $request->file('photo');

    // Move the uploaded file to the 'public/product_photos' directory
    $photoPath = $photo->move(public_path('product_photos'), $productCode . '.' . $photo->getClientOriginalExtension());

    $customizedProduct = new CustomizedProduct([
        'name' => $request->get('name'),
        'category_id' => $request->get('category'),
        'product_code' => $productCode,
        'description' => $request->get('description'),
        'photo' => 'product_photos/' . $productCode . '.' . $photo->getClientOriginalExtension(),
    ]);

    $customizedProduct->save();

    return redirect()->route('customized_products.index')->with('success', 'Customized product added successfully');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customizedProduct = CustomizedProduct::findOrFail($id);

        return view('customized_products.show', compact('customizedProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customizedProduct = CustomizedProduct::findOrFail($id);

        return view('customized_products.edit', compact('customizedProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customizedProduct = CustomizedProduct::findOrFail($id);

        $customizedProduct->update($request->all());

        return redirect()->route('customized_products.index')->with('success', 'Customized product updated successfully');
    }

    /**
     * Disable the specified customized product.
     */
    public function disableProduct(string $id)
    {
        try {
            $customizedProduct = CustomizedProduct::findOrFail($id);
            $customizedProduct->is_disabled = true;
            $customizedProduct->save();

            session()->put('failed', 'Customized product has been disabled successfully'); // Store success message
            return redirect()->route('customized_products.index');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Enable the specified customized product.
     */
    public function enableProduct(string $id)
    {
        try {
            $customizedProduct = CustomizedProduct::findOrFail($id);
            $customizedProduct->is_disabled = false;
            $customizedProduct->save();

            Session::flash('success', 'Customized product has been enabled successfully');
            return redirect()->route('customized_products.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Customized product not enabled');
            return redirect()->back();
        }
    }

    public function toggleStatus(Request $request)
    {
        $customizedProduct = CustomizedProduct::find($request->id);

        if ($customizedProduct) {
            $customizedProduct->update(['is_disabled' => !$customizedProduct->is_disabled]);
            return response()->json(['is_disabled' => $customizedProduct->is_disabled], 200);
        }

        return response()->json(['error' => 'Customized product not found'], 404);
    }
}
