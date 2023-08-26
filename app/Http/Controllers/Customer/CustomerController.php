<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class CustomerController extends Controller
{
    public function showCustomerDashboard()
    {
        $products = Product::latest()->paginate(21);

        $newOrders = Order::with('items')->latest()->get();

        return view('customer/customerDashboard', compact('products', 'newOrders'));
    }

    public function CustomerLandingPage()
    {
        return view('customer.landing-page');
    }
}