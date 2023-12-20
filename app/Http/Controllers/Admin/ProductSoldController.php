<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSold;
use Illuminate\Support\Facades\DB;

class ProductSoldController extends Controller
{
    public function monthlyProductSoldReport()
    {
        $productReports = DB::table('order_items as oi')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->select(
                'p.id as product_id',
                'p.title as product_name',
                DB::raw('SUM(oi.quantity) as total_sold'),
                DB::raw('MONTH(oi.created_at) as month')
            )
            ->groupBy('p.id', 'p.title', 'month')
            ->get();

        return view('admin.product_sold_report', compact('productReports'));
        
    }
}
