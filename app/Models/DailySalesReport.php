<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DailySalesReport extends Model
{
    // Define the table associated with this model
    protected $table = 'daily_sales_reports';

    // Define the fillable columns (columns that can be mass-assigned)
    protected $fillable = [
        'report_date',
        'total_cash',
        'total_gcash',
        'total_sales',
    ];

    // Define any other model-specific methods, relationships, or properties here
}
