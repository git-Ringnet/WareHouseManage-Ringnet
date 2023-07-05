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
                'product_code' => 111,
                'product_name' => 'Cisco Catalyst 9800-CL Wireless Controler for Cloud',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
            [
                'id' => 2,
                'product_code' => 112,
                'product_name' => 'Thiết bị quản lý không dây Cisco Catalyst 9800-CL',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 10,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 3
            ],
            [
                'id' => 3,
                'product_code' => 113,
                'product_name' => 'Cisco 9800-CL WLC',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 8,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 0
            ],
            [
                'id' => 4,
                'product_code' => 114,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 1',
                'product_unit' => 'Cái',
                'product_qty' => 5,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 5
            ],
            [
                'id' => 5,
                'product_code' => 115,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 2',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
            [
                'id' => 6,
                'product_code' => 116,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 3',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
            [
                'id' => 7,
                'product_code' => 117,
                'product_name' => 'Wireless Router 1',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
            [
                'id' => 8,
                'product_code' => 118,
                'product_name' => 'Wireless Router 2',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
            [
                'id' => 9,
                'product_code' => 119,
                'product_name' => 'Wireless Router 3',
                'product_unit' => 'Cái',
                'product_qty' => 4,
                'product_price' => 4000000,
                'tax' => 0,
                'total' => 16000000,
                'provide_id' => 1,
                'product_trade' => 2
            ],
        ]);
    }
}