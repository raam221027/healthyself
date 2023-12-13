<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\AddOns;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\CustomizedItem;
use App\Models\CustomizedProduct;
use App\Services\CartService;


class CustomerController extends Controller
{
    
    public function showCustomerDashboard()
    {
        $products = Product::where('is_disabled',0)->get();
        $salad = CustomizedProduct::where('is_disabled',0)->get();
    
        return view('customer/customerDashboard', compact('products', 'salad'));
    }
    

    public function save_order(Request $request)
    {
        // Generate a random order_number and check if it's unique
        do {
            $orderNumber = mt_rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        // Create a new order
        $order = new Order();
        $order->order_number = $orderNumber;
        $order->total_amount = $request->input('totalPrice');
        $order->order_type = $request->input('orderType');
        $order->payment_method = $request->input('paymentMethod');
        $order->save();

        // Assuming 'selectedProducts' is an array of related product data
        foreach ($request->input('selectedProducts') as $productData) {
            // Create a new order item
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productData['productId'];
            $orderItem->quantity = $productData['quantity'];
            $orderItem->subtotal = $productData['subtotal'];
            $orderItem->save();
        }

        foreach ($request->input('saladIds') as $saladId) {
            $orderSalad = new AddOns();
            $orderSalad->order_id = $order->id;
            $orderSalad->c_id = $saladId;
            $orderSalad->save();
        }

        return response()->json(['message' => 'Order and related products saved successfully'], 200);
    }



    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function mainPage()
    {
        // Retrieve cart data from the cart service
        $cart = $this->cartService->getCart();

        return view('main_page', ['cart' => $cart]);
    }


    public function CustomerLandingPage()
    {
        $products = Product::all();
        $salad = CustomizedProduct::all();
        return view('customer.landing-page', compact('products','salad'));
    }
}