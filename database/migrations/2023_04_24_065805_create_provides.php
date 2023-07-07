<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provides', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('provide_name');
            $table->string('provide_represent')->nullable();
            $table->string('provide_phone')->nullable();
            $table->string('provide_email')->nullable();
            $table->integer('provide_status');
            $table->string('provide_address');
            $table->string('provide_code');
            $table->integer('debt')->nullable();
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
        Schema::dropIfExists('provides');
    }
}