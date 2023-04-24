<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GuestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guests')->insert([
            ['id' => 1,
            'guest_name' => 'Công ty TNHH TMDV Ringnet',
            'guest_represent' => 'Nguyễn Văn B',
            'guest_phone' => '0933294810',
            'guest_email' => 'abc@gmail.com',
            'guest_status' => 1
            ],
            ['id' => 2,
            'guest_name' => 'Công ty TNHH TMDV Ringnet',
            'guest_represent' => 'Nguyễn Văn C',
            'guest_phone' => '0933294811',
            'guest_email' => 'abcd@gmail.com',
            'guest_status' => 1
            ],
            ['id' => 3,
            'guest_name' => 'Công ty TNHH TMDV Ringnet',
            'guest_represent' => 'Nguyễn Văn D',
            'guest_phone' => '0933294812',
            'guest_email' => 'abcde@gmail.com',
            'guest_status' => 1
            ],
            ['id' => 4,
            'guest_name' => 'Công ty TNHH TMDV Ringnet',
            'guest_represent' => 'Nguyễn Văn E',
            'guest_phone' => '0933294813',
            'guest_email' => 'abcdef@gmail.com',
            'guest_status' => 1
            ],
            ['id' => 5,
            'guest_name' => 'Công ty TNHH TMDV Ringnet',
            'guest_represent' => 'Nguyễn Văn F',
            'guest_phone' => '0933294812',
            'guest_email' => 'abcdefg@gmail.com',
            'guest_status' => 1
            ],
        ]);
    }
}