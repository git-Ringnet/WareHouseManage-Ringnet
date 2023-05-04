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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@ringnet.com',
                'password' => bcrypt('Ringnet@123'),
                'roleid' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sale',
                'email' => 'sale@ringnet.com',
                'password' => bcrypt('Ringnet@123'),
                'roleid' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
