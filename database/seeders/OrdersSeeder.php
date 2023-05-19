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
            ['id' => 1,'provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 100000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 2,'provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 200000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 3,'provide_id' => 3,'users_id'=> 1,'order_status' => 1,'total' => 300000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 4,'provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 400000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 5,'provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 500000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 6,'provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 600000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 7,'provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 700000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 8,'provide_id' => 3,'users_id'=> 1,'order_status' => 1,'total' => 800000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 9,'provide_id' => 3,'users_id'=> 1,'order_status' => 1,'total' => 10423400,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 10,'provide_id' => 2,'users_id'=> 1,'order_status' => 1,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 11,'provide_id' => 1,'users_id'=> 1,'order_status' => 1,'total' => 1042340000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 12,'provide_id' => 2,'users_id'=> 1,'order_status' => 0,'total' => 1042340000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 13,'provide_id' => 3,'users_id'=> 1,'order_status' => 0,'total' => 1000423400,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 14,'provide_id' => 1,'users_id'=> 1,'order_status' => 0,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
            ['id' => 15,'provide_id' => 1,'users_id'=> 1,'order_status' => 2,'total' => 1004234000,'created_at' => now(),
            'updated_at' => now(),],
        ]);
    }
}
