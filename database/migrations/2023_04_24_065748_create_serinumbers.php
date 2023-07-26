<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerinumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serinumbers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('serinumber');
            $table->integer('product_orderid')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('seri_status');
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
        Schema::dropIfExists('serinumber');
    }
}