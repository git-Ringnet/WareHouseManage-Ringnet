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
        Schema::table('debts', function (Blueprint $table) {
            $table->decimal('total_sales', 20, 4)->change();
            $table->decimal('total_import', 20, 4)->change();
            $table->decimal('debt_transport_fee', 20, 4)->change();
            $table->decimal('total_difference', 20, 4)->change();
        });
        Schema::table('debt_import', function (Blueprint $table) {
            $table->decimal('total_import', 20, 4)->change();
        });
        Schema::table('exports', function (Blueprint $table) {
            $table->decimal('total', 20, 4)->change();
            $table->decimal('transport_fee', 20, 4)->change();
        });
        Schema::table('history', function (Blueprint $table) {
            $table->decimal('price_import', 20, 4)->change();
            $table->decimal('product_total', 20, 4)->change();
            $table->decimal('price_export', 20, 4)->change();
            $table->decimal('export_total', 20, 4)->change();
            $table->decimal('total_difference', 20, 4)->change();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 20, 4)->change();
            $table->decimal('total_tax', 20, 4)->change();
        });
        Schema::table('product', function (Blueprint $table) {
            $table->decimal('product_price', 20, 4)->change();
            $table->decimal('product_total', 20, 4)->change();
        });
        Schema::table('productorders', function (Blueprint $table) {
            $table->decimal('product_price', 20, 4)->change();
            $table->decimal('product_total', 20, 4)->change();
            $table->double('product_qty')->change();
        });
        Schema::table('product_exports', function (Blueprint $table) {
            $table->decimal('product_price', 20, 4)->change();
            $table->decimal('product_total', 20, 4)->change();
        });
    }
};
