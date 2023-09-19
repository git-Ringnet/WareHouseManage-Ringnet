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
        Schema::create('debt_import', function (Blueprint $table) {
            $table->id();
            $table->integer('provide_id');
            $table->integer('user_id');
            $table->integer('import_id');
            $table->decimal('total_import', 15, 4);
            $table->integer('debt')->default(0);
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
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
        Schema::dropIfExists('debt_import');
    }
};
