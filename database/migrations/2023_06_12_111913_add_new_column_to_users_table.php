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
        Schema::table('serinumbers', function (Blueprint $table) {
            $table->integer('products_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('check')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serinumbers', function (Blueprint $table) {
            //
        });
    }
};
