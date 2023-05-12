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
            //người đại diện
            $table->string('guest_represent');
            //số điện thoại
            $table->string('guest_phone');
            //email
            $table->string('guest_email');
            //tình trạng 
            $table->string('guest_status');
            //địa chỉ xuất hóa đơn
            $table->string('guest_addressInvoice')->nullable();
            //mã số thuế
            $table->string('guest_code')->nullable();
            //Địa chỉ giao hàng
            $table->string('guest_addressDeliver')->nullable();
            //Người nhận hàng
            $table->string('guest_receiver')->nullable();
            //số điện thoại người nhận
            $table->string('guest_phoneReceiver')->nullable();
            //hình thức thanh toán
            $table->integer('guest_pay')->nullable();
            //điều kiện thanh toán
            $table->integer('guest_payTerm')->nullable();
            //ghi chú
            $table->string('guest_note')->nullable();
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
