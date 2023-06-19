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
            [
                'id' => 1,
                'guest_name' => 'Công ty TNHH TMDV Ringnet',
                'guest_phone' => '0933294810',
                'guest_email' => 'abc@gmail.com',
                'guest_status' => 1,
                'guest_addressInvoice' => '38 Út Tịch, P4, Tân Bình',
                'guest_code' => '0933294812',
                'guest_addressDeliver' => '38 Út Tịch, P4, Tân Bình',
                'guest_receiver' => 'Trần Nguyễn Mai A',
                'guest_phoneReceiver' => '0933294812',
                'guest_pay' => '0',
                'guest_payTerm' => '0',
                'guest_note' => 'Giao hàng buổi sáng',
                'debt' => '0',
            ],
            [
                'id' => 2,
                'guest_name' => 'Công ty TNHH TMDV Ringnet',
                'guest_phone' => '0933294811',
                'guest_email' => 'abcd@gmail.com',
                'guest_status' => 1,
                'guest_addressInvoice' => 'P4, Tân Bình',
                'guest_code' => '0123456789',
                'guest_addressDeliver' => 'P4, Tân Bình',
                'guest_receiver' => 'Trần Nguyễn Mai B',
                'guest_phoneReceiver' => '0933294812',
                'guest_pay' => '0',
                'guest_payTerm' => '0',
                'guest_note' => 'Giao hàng buổi chiều',
                'debt' => '0',
            ],
            [
                'id' => 3,
                'guest_name' => 'Công ty TNHH TMDV Ringnet',
                'guest_phone' => '0933294812',
                'guest_email' => 'abcde@gmail.com',
                'guest_status' => 1,
                'guest_addressInvoice' => 'Tân Bình',
                'guest_code' => '0123456789',
                'guest_addressDeliver' => 'Tân Bình',
                'guest_receiver' => 'Trần Nguyễn Mai A',
                'guest_phoneReceiver' => '0933294812',
                'guest_pay' => '0',
                'guest_payTerm' => '0',
                'guest_note' => 'Giao hàng buổi sáng',
                'debt' => '0',
            ],
            [
                'id' => 4,
                'guest_name' => 'Công ty TNHH TMDV Ringnet',
                'guest_phone' => '0933294813',
                'guest_email' => 'abcdef@gmail.com',
                'guest_status' => 1,
                'guest_addressInvoice' => '38 Út Tịch',
                'guest_code' => '0123456789',
                'guest_addressDeliver' => '38 Út Tịch',
                'guest_receiver' => 'Trần Nguyễn Mai A',
                'guest_phoneReceiver' => '0933294812',
                'guest_pay' => '0',
                'guest_payTerm' => '0',
                'guest_note' => 'Giao hàng buổi sáng',
                'debt' => '0',
            ],
            [
                'id' => 5,
                'guest_name' => 'Công ty TNHH TMDV Ringnet',
                'guest_phone' => '0933294812',
                'guest_email' => 'abcdefg@gmail.com',
                'guest_status' => 1,
                'guest_addressInvoice' => '38 Út Tịch, P4, Tân Bình',
                'guest_code' => '0123456789',
                'guest_addressDeliver' => '38 Út Tịch, P4, Tân Bình',
                'guest_receiver' => 'Trần Nguyễn Mai A',
                'guest_phoneReceiver' => '0933294812',
                'guest_pay' => '0',
                'guest_payTerm' => '0',
                'guest_note' => 'Giao hàng buổi sáng',
                'debt' => '0',
            ],
        ]);
    }
}
