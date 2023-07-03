<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SerinumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serinumbers')->insert([
            ['id' => 1, 'serinumber' => "SP01-01",'product_id' => 1,'seri_status' => 2],
            ['id' => 2, 'serinumber' => "SP01-02",'product_id'=>1,'seri_status' => 2],
            ['id' => 3, 'serinumber' => "SP01-03",'product_id'=>1,'seri_status' => 2],
            ['id' => 4, 'serinumber' => "SP02-01",'product_id'=>2,'seri_status'=> 1],
            ['id' => 5, 'serinumber' => "SP02-02",'product_id'=>2,'seri_status'=> 1],
            ['id' => 6, 'serinumber' => "SP02-03",'product_id'=>2,'seri_status' => 1],
            ['id' => 7, 'serinumber' => "SP03-01",'product_id'=>3,'seri_status' => 1],
            ['id' => 8, 'serinumber' => "SP03-02",'product_id'=>3,'seri_status' => 1],
            ['id' => 9, 'serinumber' => "SP03-03",'product_id'=>3,'seri_status' => 1],
            ['id' => 10, 'serinumber' => "SP04-01",'product_id'=>4,'seri_status' => 1],
            ['id' => 11, 'serinumber' => "SP04-02",'product_id'=>4,'seri_status' => 1],
            ['id' => 12, 'serinumber' => "SP04-03",'product_id'=>4,'seri_status' => 1],
            ['id' => 13, 'serinumber' => "SP05-01",'product_id'=>5,'seri_status' => 1],
            ['id' => 14, 'serinumber' => "SP05-02",'product_id'=>5,'seri_status' => 1],
            ['id' => 15, 'serinumber' => "SP05-03",'product_id'=>5,'seri_status' => 1],
            ['id' => 16, 'serinumber' => "SP06-01",'product_id'=>6,'seri_status' => 1],
            ['id' => 17, 'serinumber' => "SP01-04",'product_id'=>1,'seri_status' => 1],
        ]);
    }
}