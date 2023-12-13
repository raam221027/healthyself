<?php

namespace App\Http\Controllers\Kitchen;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\AddOns;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\Kitchen;
use App\Models\CustomerOrder;
use RealRashid\SweetAlert\Facades\Alert;
use App\Events\NewPaidOrder;
use Illuminate\Pagination\LengthAwarePaginator;




class KitchenController extends Controller
{
    public function kitchenDashboard()
{
    $processedOrders = Order::where('status', 'Paid')
        ->whereNotNull('updated_at') 
        ->orderBy('updated_at', 'asc')
        ->get();

    $processedOrders->load('orderItems');
    
    $addons = [];

    foreach ($processedOrders as $order) {
        $addons[$order->id] = AddOns::with('customizedProduct')->where('order_id', $order->id)->get();
    }
    return view('kitchen.kitchenDashboard', compact('processedOrders', 'addons'));
}
public function markOrderAsPaid($orderId)
{
    event(new NewPaidOrder());
}

public function show($id)
{
    $order = Order::find($id);

    return view('order.show', ['order' => $order]);
}

public function doneOrder(Request $request, $id)
{
    $kitchen = Order::findOrFail($id);
    $kitchen->status = 'Done';
    $kitchen->save();
    
    Alert::success('Order Completed Successfully!');

    return redirect()->back();
}
}

