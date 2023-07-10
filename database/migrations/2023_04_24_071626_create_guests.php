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
        Schema::create('guests', function (Blueprint $table) {
            $table->id()->autoIncrement();
            //tên công ty
            $table->string('guest_name');
            //địa chỉ
            $table->string('guest_address');
            //mã số thuế
            $table->string('guest_code');
            //số điện thoại
            $table->string('guest_phone')->nullable();
            //email
            $table->string('guest_email')->nullable();
            //email cá nhân
            $table->string('guest_email_personal')->nullable();
            //Người nhận hàng
            $table->string('guest_receiver')->nullable();
            //số điện thoại người nhận
            $table->string('guest_phoneReceiver')->nullable();
            //ghi chú
            $table->string('guest_note')->nullable();
            //tình trạng 
            $table->string('guest_status')->nullable();
            //người đại diện
            $table->string('guest_represent');
            //
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
        Schema::dropIfExists('guests');
    }
};
