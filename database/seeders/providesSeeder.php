<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provides')->insert([
            [
                'id' => 1,
                'provide_name' => 'FPT',
                'provide_represent' => 'Nguyễn Văn A',
                'provide_phone' => '113',
                'provide_email' => 'a@gmail.com',
                'provide_status' => 1,
                'provide_address' => '38 Út tịch',
                'provide_code' => 123
            ],
            [
                'id' => 2,
                'provide_name' => 'TinHocNgoiSao',
                'provide_represent' => 'Nguyễn Văn B',
                'provide_phone' => '114',
                'provide_email' => 'b@gmail.com',
                'provide_status' => 1,
                'provide_address' => '38 Út tịch',
                'provide_code' => 456
            ],
            [
                'id' => 3,
                'provide_name' => 'FPT HCM',
                'provide_represent' => 'Nguyễn Văn C',
                'provide_phone' => '115',
                'provide_email' => 'c@gmail.com',
                'provide_status' => 1,
                'provide_address' => '38 Út tịch',
                'provide_code' => 789
            ],
        ]);
    }
}