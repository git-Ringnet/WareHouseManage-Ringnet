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
            ['id' => 1,'provide_id' => 1,'users_id'=> 1,'order_status' => 1],
            ['id' => 2,'provide_id' => 2,'users_id'=> 1,'order_status' => 1],
            ['id' => 3,'provide_id' => 3,'users_id'=> 1,'order_status' => 1],
            ['id' => 4,'provide_id' => 4,'users_id'=> 1,'order_status' => 1],
            ['id' => 5,'provide_id' => 5,'users_id'=> 1,'order_status' => 1],
            ['id' => 6,'provide_id' => 1,'users_id'=> 1,'order_status' => 1],
            ['id' => 7,'provide_id' => 2,'users_id'=> 1,'order_status' => 1],
            ['id' => 8,'provide_id' => 3,'users_id'=> 1,'order_status' => 1],
            ['id' => 9,'provide_id' => 4,'users_id'=> 1,'order_status' => 1],
            ['id' => 10,'provide_id' => 5,'users_id'=> 1,'order_status' => 1],
            ['id' => 11,'provide_id' => 1,'users_id'=> 1,'order_status' => 1],
            ['id' => 12,'provide_id' => 2,'users_id'=> 1,'order_status' => 0],
            ['id' => 13,'provide_id' => 3,'users_id'=> 1,'order_status' => 0],
            ['id' => 14,'provide_id' => 4,'users_id'=> 1,'order_status' => 0],
            ['id' => 15,'provide_id' => 5,'users_id'=> 1,'order_status' => 2],
        ]);
    }
}
