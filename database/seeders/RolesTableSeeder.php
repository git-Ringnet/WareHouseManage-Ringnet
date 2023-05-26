<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'shortname' => 'admin',
                'description' => 'Admin',
            ],
            [
                'id' => 2,
                'name' => 'Quản lí kho',
                'shortname' => 'manager',
                'description' => 'Quản lí kho',
            ],
            [
                'id' => 3,
                'name' => 'Sale',
                'shortname' => 'sale',
                'description' => 'Sale',
            ],
        ]);
    }
}
