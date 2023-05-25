<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exports')->insert([
            [
                'guest_id' => '1',
                'user_id' => 1,
                'total' => 13200000,
                'export_status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
