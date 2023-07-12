<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productorders')->insert([
            ['id' => 1,'product_id'=> 1,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 1],
            ['id' => 2,'product_id' => 2,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 2],
            ['id' => 3,'product_id' => 3 ,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 3],
            ['id' => 4,'product_id' => 4,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 4],
            ['id' => 5,'product_id' => 5,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 5],
            ['id' => 6,'product_id' => 6,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 6],
            ['id' => 7,'product_id' => 7,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 7],
            ['id' => 8,'product_id' => 8,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 8],
            ['id' => 9,'product_id' => 9,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 9],
            ['id' => 10,'product_id' => 10,'product_id' => 10,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 10],
            ['id' => 11,'product_id' => 11,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 11],
            ['id' => 12,'product_id' => 12,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 12],
            ['id' => 13,'product_id' => 13,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 13],
            ['id' => 14,'product_id' => 14,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 14],
            ['id' => 15,'product_id' => 15,'product_name'=> 'test 1','product_category' => 'Chính hãng','product_unit' => 5, 'product_trademark' => '', 'product_qty' => 1, 'product_price'=>'150000','order_id'=> 15],
        ]);
    }
}
