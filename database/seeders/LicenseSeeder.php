<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licenses')->insert([
            [
                'license_name' => '30 ngày',
                'dayleft' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_name' => '90 ngày',
                'dayleft' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_name' => '365 ngày',
                'dayleft' => 365,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
