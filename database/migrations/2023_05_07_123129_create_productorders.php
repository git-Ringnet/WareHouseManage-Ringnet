<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productorders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('product_id');
            $table->integer('products_id');
            $table->string('product_name');
            $table->string('product_category')->nullable();
            $table->integer('product_unit')->nullable();
            $table->string('product_trademark')->nullable();
            $table->integer('product_qty')->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('order_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productorders');
    }
};
