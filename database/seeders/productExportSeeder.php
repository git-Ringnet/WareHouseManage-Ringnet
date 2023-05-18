<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_exports')->insert([
            [
                'products_id' => '1',
                'product_id' => '1',
                'export_id' => '1',
                'product_name' => 'Cisco Catalyst 9800-CL Wireless Controler for Cloud',
                'product_unit' => 'Cái',
                'product_qty' => 3,
                'product_price' => 4000000,
                'product_note' => 'Bảo hành 12 tháng',
                'product_tax' => '10',
                'product_total' => 12000000,
            ],
        ]);
    }
}
