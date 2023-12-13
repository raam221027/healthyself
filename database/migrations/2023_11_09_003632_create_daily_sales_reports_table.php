<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailySalesReportsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_sales_reports', function (Blueprint $table) {
            $table->id();
            $table->unique('report_date');
            $table->decimal('total_cash', 10, 2);
            $table->decimal('total_gcash', 10, 2);
            $table->decimal('total_sales', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_sales_reports');
    }
}
