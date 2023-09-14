<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@ringnet.com',
                'password' => bcrypt('Ringnet@123'),
                'roleid' => 1,
                'status' =>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@ringnet.vn',
                'password' => bcrypt('Ringnet@123'),
                'roleid' => 2,
                'status' =>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sale',
                'email' => 'sale@ringnet.vn',
                'password' => bcrypt('Ringnet@123'),
                'roleid' => 3,
                'status' =>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
