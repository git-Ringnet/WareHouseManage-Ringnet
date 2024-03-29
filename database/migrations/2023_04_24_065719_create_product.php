<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('products_id');
            $table->string('product_name');
            $table->string('product_category')->nullable();
            $table->string('product_unit')->nullable();
            $table->string('product_trademark')->nullable();
            $table->integer('product_qty')->nullable();
            $table->decimal('product_price', 15, 4)->nullable();
            $table->string('tax')->nullable();
            $table->string('total')->nullable();
            $table->integer('provide_id')->nullable();
            $table->integer('product_orderid')->nullable();
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
        Schema::dropIfExists('product');
    }
}