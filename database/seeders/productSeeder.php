<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [
                'id' => 1,
                'product_name' => 'Cisco Catalyst 9800-CL Wireless Controler for Cloud',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 1,
                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0,
            ],
            [
                'id' => 2,
                'product_name' => 'Thiết bị quản lý không dây Cisco Catalyst 9800-CL',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 2,

                'product_tax' => 10,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 3,
                'product_name' => 'Cisco 9800-CL WLC',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 1,

                'product_tax' => 8,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 4,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 1',
                'product_unit' => 'Cái',
                'provide_id' => 2,
                'product_price' => 4000000,
                'product_qty' => 5,
                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 5,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 2',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 1,

                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 6,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 3',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 2,

                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 7,
                'product_name' => 'Wireless Router 1',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 3,

                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 8,
                'product_name' => 'Wireless Router 2',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 2,

                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
            [
                'id' => 9,
                'product_name' => 'Wireless Router 3',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'provide_id' => 3,
                'product_tax' => 0,
                'product_total' => 16000000,
                'product_trade' => 0
            ],
        ]);
    }
}
