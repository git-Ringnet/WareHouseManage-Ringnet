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
        Schema::table('product_exports', function (Blueprint $table) {
            $table->double('product_qty')->change();
        });
        Schema::table('history', function (Blueprint $table) {
            $table->double('product_qty')->change();
            $table->double('export_qty')->change();
        });
        Schema::table('product', function (Blueprint $table) {
            $table->double('product_trade')->change();
        });
    }
};
