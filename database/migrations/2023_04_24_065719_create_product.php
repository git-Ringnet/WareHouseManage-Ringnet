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
            $table->string('product_name');
            $table->string('product_unit')->nullable();
            $table->integer('product_qty')->nullable();
            $table->decimal('product_price', 15, 4)->nullable();
            $table->integer('product_tax')->nullable();
            $table->decimal('product_total',15,4)->nullable();
            $table->integer('provide_id')->nullable();
            $table->integer('product_trade')->nullable();
            $table->integer('product_code')->nullable();
            $table->string('product_trademark')->nullable();
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