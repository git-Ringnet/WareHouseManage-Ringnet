<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1,'category_name' => 'Switch'],
            ['id' => 2,'category_name' => 'Industrial Switch'],
            ['id' => 3,'category_name' => 'Network Router'],
            ['id' => 4,'category_name' => 'Access Point'],
            ['id' => 5,'category_name' => 'Network Firewall'],
        ]);
    }
}