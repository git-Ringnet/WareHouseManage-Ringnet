<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('details')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'provide_id' =>1
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'provide_id' =>1
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'provide_id' =>1
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'provide_id' =>2
            ],
            [
                'id' => 5,
                'product_id' => 5,
                'provide_id' =>2
            ],
            [
                'id' => 6,
                'product_id' => 6,
                'provide_id' =>2
            ],
        ]);
    }
}