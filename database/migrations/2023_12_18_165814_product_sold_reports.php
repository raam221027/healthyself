<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSoldReports extends Migration
{
    public function up()
    {
        Schema::create('product_sold_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained(); // Assuming you have a products table
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sold_reports');
    }
}
