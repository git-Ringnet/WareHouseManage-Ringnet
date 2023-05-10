<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [   'id' => 1,
                'products_code' => 'N3K-C3548P-XL',
                'products_name' => 'Cisco Catalyst 9800-CL Wireless Controller for Cloud',
                'ID_category' => 1,
                'products_trademark' => 'Cisco',
                'products_description' => 'Ringnet1',
                'inventory' => 15,
                'price_avg' => 3666667,
                'price_inventory' => 55000000,
            ],
            [   'id' => 2,
                'products_code' => 'IEM-3400-8T',
                'products_name' => 'Catalyst IE3400 with 8 GE Copper ports',
                'ID_category' => 2,
                'products_trademark' => 'Cisco',
                'products_description' => 'Ringnet2',
                'inventory' => 9,
                'price_avg' => 4000000,
                'price_inventory' => 36000000,
            ],
            [   'id' => 3,
                'products_code' => 'ASR1002X-5G-K9',
                'products_name' => 'Cisco Catalyst 9800-CL Wireless Controller for Cloud',
                'ID_category' => 3,
                'products_trademark' => 'Cisco',
                'products_description' => 'Ringnet3',
                'inventory' => 9,
                'price_avg' => 4000000,
                'price_inventory' => 36000000,
            ],
            [   'id' => 4,
                'products_code' => 'ASR1002-X',
                'products_name' => 'Cisco Catalyst 9800-CL Wireless Controller for Cloud',
                'ID_category' => 4,
                'products_trademark' => 'Cisco',
                'products_description' => 'Ringnet4',
                'inventory' => 9,
                'price_avg' => 4000000,
                'price_inventory' => 36000000,
            ],
            [   'id' => 5,
                'products_code' => 'ASR1001X-2.5G-K9',
                'products_name' => 'Cisco Catalyst 9800-CL Wireless Controller for Cloud',
                'ID_category' => 5,
                'products_trademark' => 'Cisco',
                'products_description' => 'Ringnet5',
                'inventory' => 9,
                'price_avg' => 4000000,
                'price_inventory' => 36000000,
            ],
        ]);
    }
}