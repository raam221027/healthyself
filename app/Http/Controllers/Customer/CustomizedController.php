<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomizedProduct;
use App\Models\OrderItem;
use App\Models\CustomizedItem;
use App\Services\CartService;



class CustomizedController extends Controller
{

    public function showCustomized()
    {
        $customizedProducts = CustomizedProduct::latest()->paginate(9);
        $newOrders = Order::with('items')->latest()->get();

        return view('customer.customized', compact('customizedProducts', 'newOrders'));
    }

    public function customizedOrderPage()
    {
        $cart = $this->cartService->getCart();
        return view('customized_order_page', ['cart' => $cart]);
    }

    public function CustomerLandingPage()
    {
        return view('customer.landing-page');
    }


    
}