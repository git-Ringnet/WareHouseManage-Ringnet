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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_id');
            $table->integer('user_id');
            $table->integer('export_id');
            $table->decimal('total_sales', 15, 4);
            $table->decimal('total_import', 15, 4);
            $table->decimal('debt_transport_fee', 15, 4);
            $table->decimal('total_difference', 15, 4);
            $table->integer('debt');
            $table->integer('debt_status');
            $table->text('debt_note')->nullable();
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
        Schema::dropIfExists('debt');
    }
};
