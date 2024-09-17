<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItems extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id');
                $table->string('item_name');
                $table->decimal('item_price', 10, 2);
                $table->integer('quantity');
                $table->timestamps();
    
                // Foreign key constraint (if applicable)
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            });
        }
    }
    
    

    public function down()
    {
        Schema::dropIfExists('order_items');

        Schema::create('order_items', function (Blueprint $table) {
            // Your table definition here
        });
    }
}

