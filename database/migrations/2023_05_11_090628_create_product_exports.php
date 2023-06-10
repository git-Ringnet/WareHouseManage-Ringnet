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
        Schema::create('product_exports', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('products_id');
            $table->integer('product_id');
            $table->integer('export_id');
            $table->string('product_name');
            $table->string('product_unit');
            $table->integer('product_qty');
            $table->decimal('product_price', 15, 4);
            $table->string('product_note')->nullable();
            $table->integer('product_tax');
            $table->decimal('product_total', 15, 4);
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
        Schema::dropIfExists('product_exports');
    }
};
