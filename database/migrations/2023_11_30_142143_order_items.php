<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItems extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('order_id')->unsigned()->notNullable();
            $table->bigInteger('product_id')->unsigned()->notNullable();
            $table->integer('quantity')->notNullable();
            $table->decimal('subtotal', 10, 2)->notNullable();
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('order_items');

        Schema::create('order_items', function (Blueprint $table) {
            // Your table definition here
        });
    }
}

