<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('products_image')->nullable();
            $table->string('products_code');
            $table->string('products_name');
            $table->string('ID_category');
            $table->string('products_trademark');
            $table->text('products_description')->nullable();
            $table->integer('inventory')->nullable();
            $table->decimal('price_avg', 15, 4)->nullable();
            $table->decimal('price_inventory', 15, 4)->nullable();
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
        Schema::dropIfExists('products');
    }
}
