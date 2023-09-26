<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manager_license')->insert([
            // [
            //     'license_id' => 1,
            //     'user_id' => 2,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'license_id' => 1,
            //     'user_id' => 5,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
