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

    // Store the order details in the database
    $order = new Order();
    $order->order_number = $nextOrderNumber;
    $order->save();

    // Continue with other order creation logic or redirect
}

}

