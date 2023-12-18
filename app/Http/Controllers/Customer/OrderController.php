<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\CustomizedProduct;
use App\Models\User;
use Ramsey\Uuid\Uuid; 
use App\Models\AddOns;
use App\Models\Category;



class OrderController extends Controller
{
    public function showOrderReceipt($orderId)
    {
        $order = Order::find($orderId);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }
    
        return view('customer.order_receipt', compact('order'));
    }


    public function placeOrder()
    {
      
        $latestOrder = Order::latest()->first();

      
        if ($latestOrder) {
            $orderItems = OrderItem::with('product')->where('order_id', $latestOrder->id)->get();
            $addons = AddOns::where('order_id', $latestOrder->id)->get();
            
            return view('customer.order_receipt', [
                'order' => $latestOrder,
                'orderItems' => $orderItems,
                'addons' => $addons,    
            ]);
        }

        return view('customer.order_receipt', [
            'order' => null, 
            'orderItems' => [],
            'addons' => [],
        ]);
    }



public function create()
{
     // Retrieve the last used order number from the database
     $lastOrder = Order::orderBy('id', 'desc')->first();

     // Determine the next order number
     if ($lastOrder) {
         $nextOrderNumber = $lastOrder->order_number + 1;
     } else {
         // If there are no existing orders, start at 1
         $nextOrderNumber = 1;
     }
 
     // Calculate the total price for products in the order
    $productTotal = 0;

    // Retrieve products and their prices from the database
    $products = Product::all(); // Adjust this query based on your database schema

    foreach ($products as $product) {
        // Assuming each product has a 'price' column
        $productTotal += $product->price;
    }

    // Add a fixed price of 285 for customized salad (adjust the category ID accordingly)
    $customizedSaladCategory = Category::where('name', 'price')->first();

    if ($customizedSaladCategory) {
        $productTotal += 285; // Add 285 to the total for the customized salad
    }

    // Store the order details in the database
    $order = new Order();
    $order->order_number = $nextOrderNumber;
    $order->total_amount = $productTotal; // Set the total amount for the order
    $order->save();
    }
}

