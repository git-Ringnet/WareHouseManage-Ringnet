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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('note_form');
        });
        Schema::table('serinumbers', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('export_seri');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('description');
        });
        Schema::table('provides', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('debt');
        });
        Schema::table('product_exports', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('product_total');
        });
        Schema::table('productorders', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('provide_id');
        });
        Schema::table('product', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('product_trademark');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('total_tax');
        });
        Schema::table('history', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('history_note');
        });
        Schema::table('guests', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('debt');
        });
        Schema::table('exports', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('export_code');
        });
        Schema::table('debt_import', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('debt_note');
        });
        Schema::table('debts', function (Blueprint $table) {
            $table->bigInteger('license_id')->nullable()->after('date_end');
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
