<?php
  
namespace App\Http\Controllers\Product;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(4);
    
        return view('products.index', compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }
  
    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Generate a unique product code
    $productCode = 'HTS-' . uniqid();

    // Upload the photo to the 'product_photos' folder in the 'public' disk
    $photoPath = $request->file('photo')->store('product_photos', 'public');

    $product = new Product([
        'title' => $request->get('title'),
        'price' => $request->get('price'),
        'product_code' => $productCode,
        'description' => $request->get('description'),
        'photo' => $photoPath,
    ]);

    $product->save();

    return redirect()->route('products')->with('success', 'Product added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
 * Disable the specified resource.
 */
/**
     * Disable the specified product.
     */
    public function disableProduct(string $id)
{
    try {
        $rs = Product::findOrFail($id);
        $rs->is_disabled = true;
        $rs->save();

        session()->put('failed', 'Product has been disabled successfully'); // Store success message
        return redirect()->route('products.index');
    } catch (\Exception $e) {
        return redirect()->back();
    }
}

    

 /**
     * Enable the specified product.
     */ 
    public function enableProduct(string $id)
    {
        try {
            $rs = Product::findOrFail($id);
            $rs->is_disabled = false;
            $rs->save();
            
            Session::flash('success', 'Product has been enabled successfully');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Product not enabled');
            return redirect()->back();
        }
    }
public function toggleStatus(Request $request)
{
    $rs = Product::find($request->id);

    if ($rs) {
        $rs->update(['is_disabled' => !$rs->is_disabled]);
        return response()->json(['is_disabled' => $rs->is_disabled], 200);
    }

    return response()->json(['error' => 'Product not found'], 404);
}
}