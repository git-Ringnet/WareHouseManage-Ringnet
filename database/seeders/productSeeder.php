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
                'products_id' => 1,
                'product_name' => 'Cisco Catalyst 9800-CL Wireless Controler for Cloud',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 2,
                'products_id' => 1,
                'product_name' => 'Thiết bị quản lý không dây Cisco Catalyst 9800-CL',
                'product_category' => 'Nhập khẩu',
                'product_trademark' => '',
                'product_qty' => 4,
                'product_price' => 3750000,
            ],
            [
                'id' => 3,
                'products_id' => 1,
                'product_name' => 'Cisco 9800-CL WLC',
                'product_category' => 'Nhập khẩu',
                'product_trademark' => '',
                'product_qty' => 8,
                'product_price' => 3500000,
            ],
            [
                'id' => 4,
                'products_id' => 2,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 1',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 5,
                'products_id' => 2,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 2',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 6,
                'products_id' => 2,
                'product_name' => 'Catalyst IE3400 with 8 GE Copper ports 3',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 7,
                'products_id' => 3,
                'product_name' => 'Wireless Router 1',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 8,
                'products_id' => 3,
                'product_name' => 'Wireless Router 2',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 9,
                'products_id' => 3,
                'product_name' => 'Wireless Router 3',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 10,
                'products_id' => 5,
                'product_name' => 'Firewall 1',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 11,
                'products_id' => 5,
                'product_name' => 'Firewall 2',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 12,
                'products_id' => 5,
                'product_name' => 'Firewall 3',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 13,
                'products_id' => 4,
                'product_name' => 'Access Point 1',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 14,
                'products_id' => 4,
                'product_name' => 'Access Point 2',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
            [
                'id' => 15,
                'products_id' => 4,
                'product_name' => 'Access Point 3',
                'product_category' => 'Chính hãng',
                'product_trademark' => 'CO,CQ',
                'product_qty' => 3,
                'product_price' => 4000000,
            ],
        ]);
    }
}