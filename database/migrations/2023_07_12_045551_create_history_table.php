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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->integer('export_id')->nullable();
            $table->integer('import_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('provide_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('product_qty')->nullable();
            $table->string('product_unit')->nullable();
            $table->decimal('price_import', 15, 4)->nullable();
            $table->decimal('product_total', 15, 4)->nullable();
            $table->integer('import_code')->nullable();
            $table->integer('debt_import')->default(0);
            $table->integer('import_status')->nullable();
            $table->integer('guest_id')->nullable();
            $table->integer('export_qty')->nullable();
            $table->string('export_unit')->nullable();
            $table->decimal('price_export', 15, 4)->nullable();
            $table->decimal('export_total', 15, 4)->nullable();
            $table->integer('export_code')->nullable();
            $table->integer('debt_export')->default(0);
            $table->integer('export_status')->nullable();
            $table->dateTime('debt_export_start')->nullable();
            $table->dateTime('debt_export_end')->nullable();
            $table->dateTime('debt_import_start')->nullable();
            $table->dateTime('debt_import_end')->nullable();
            $table->decimal('total_difference', 15, 4)->nullable();
            $table->integer('tranport_fee')->nullable();
            $table->string('history_note')->nullable();
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
        Schema::dropIfExists('history');
    }
};
