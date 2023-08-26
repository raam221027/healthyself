<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\User;

class OrderController extends Controller
{
    public function showOrderReceipt()
    {
        $orderId = session('order_id'); // Replace 'order_id' with the key you use to store the order ID in the session

        $order = Order::find($orderId);
    
        return view('customer.order_receipt', compact('order'));
    }

    public function placeOrder(Request $request)
{
    $listCarts = json_decode($request->input('listCarts'), true); // Convert JSON string to array

    // Calculate the total amount
    $total_amount = 0;
    foreach ($listCarts as $cartItem) {
        $total_amount += $cartItem['price'] * $cartItem['quantity'];
    }

    // Store the order details in the database
    $order = new Order();
    $order->order_number = '' . time() . '-' . mt_rand(1000, 9999); // Generate a unique order number

    // Set the order_type from the form input
    $order->order_type = $request->input('order_type'); // Make sure 'order_type' matches the name attribute of your radio inputs

    $order->total_amount = $total_amount;
    $order->save();

    foreach ($listCarts as $cartItem) {
        // Store each cart item in the order_items table
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $cartItem['id'];
        $orderItem->quantity = $cartItem['quantity'];
        $orderItem->subtotal = $cartItem['price'] * $cartItem['quantity'];
        $orderItem->save();
    }

    // Retrieve the saved order to ensure order_type is available
    $order = Order::find($order->id);

    return view('customer.order_receipt', compact('order'));
}
}
