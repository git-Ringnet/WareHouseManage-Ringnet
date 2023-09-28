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
                'id' => 0,
                'name' => 'SuperAdmin',
                'shortname' => 'spadmin',
                'description' => 'SuperAdmin',
            ],
            [
                'id' => 1,
                'name' => 'SiteManager',
                'shortname' => 'sitemanager',
                'description' => 'SiteManager',
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'shortname' => 'admin',
                'description' => 'Admin',
            ],
            [
                'id' => 3,
                'name' => 'Quản lí kho',
                'shortname' => 'manager',
                'description' => 'Quản lí kho',
            ],
            [
                'id' => 4,
                'name' => 'Sale',
                'shortname' => 'sale',
                'description' => 'Sale',
            ],
        ]);
    }
}
