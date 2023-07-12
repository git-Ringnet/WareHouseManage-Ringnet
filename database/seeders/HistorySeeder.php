<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('history')->insert([
            [
                'export_id' => 1,
                'date_time' => now(),
                'user_id' => '1',
                'provide_id' => '1',
                'product_name' => 'product 1',
                'product_qty' => 3,
                'product_unit' => 'Cái',
                'price_import' => 1000000,
                'product_total' => 1000000,
                'import_code' => 123456,
                'import_status' => 1,
                'guest_id' => 1,
                'export_qty' => 1,
                'export_unit' => 'Cái',
                'price_export' => 2000000,
                'export_total' => 2000000,
                'export_code' => 123,
                'export_status' => 1,
                'total_difference' => 1000000,
                'tranport_fee' => 0,
                'history_note' => null,
            ],
        ]);
    }
}
