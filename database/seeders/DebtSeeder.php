<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('debts')->insert([
            [
                'id' => 1,
                'guest_id' => 1,
                'user_id' => 1,
                'export_id' => 1,
                'total_sales' => 1500000,
                'total_import' => 1200000,
                'debt_transport_fee' => 100000,
                'total_difference' => 400000,
                'debt' => 0,
                'debt_status' => 1,
                'debt_note' => 'Ghi chú',
            ],
        ]);
    }
}
