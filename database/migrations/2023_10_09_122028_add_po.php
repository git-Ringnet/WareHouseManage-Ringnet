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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('product_po')->nullable()->after('total_tax');
        });
        Schema::table('exports', function (Blueprint $table) {
            $table->string('export_po')->nullable()->after('export_code');
        });
        Schema::table('history', function (Blueprint $table) {
            $table->string('product_po')->nullable()->after('history_note');
        });
        Schema::table('history', function (Blueprint $table) {
            $table->string('export_po')->nullable()->after('history_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
