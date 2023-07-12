<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            ['id' => 1,'product_code' => '0000121','provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 100000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 2,'product_code' => '0000122','provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 200000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 3,'product_code' => '0000123','provide_id' => 3,'users_id'=> 1,'order_status' => 1,'total' => 300000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 4,'product_code' => '0000124','provide_id' => 2,'users_id'=> 2,'order_status' => 1,'total' => 400000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 5,'product_code' => '0000125','provide_id' => 1,'users_id'=> 3,'order_status' => 1,'total' => 500000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 6,'product_code' => '0000126','provide_id' => 1,'users_id'=> 2,'order_status' => 1,'total' => 600000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 7,'product_code' => '0000127','provide_id' => 2,'users_id'=> 3,'order_status' => 1,'total' => 700000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 8,'product_code' => '0000128','provide_id' => 3,'users_id'=> 3,'order_status' => 1,'total' => 800000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 9,'product_code' => '0000129','provide_id' => 3,'users_id'=> 1,'order_status' => 1,'total' => 10423400,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 10,'product_code' => '0000130','provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 11,'product_code' => '0000131','provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 1042340000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 12,'product_code' => '0000132','provide_id' => 2,'users_id'=> 1,'order_status' => 0,'total' => 1042340000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 13,'product_code' => '0000133','provide_id' => 3,'users_id'=> 1,'order_status' => 0,'total' => 1000423400,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 14,'product_code' => '0000134','provide_id' => 1,'users_id'=> 1,'order_status' => 0,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 15,'product_code' => '0000135','provide_id' => 1,'users_id'=> 1,'order_status' => 2,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
