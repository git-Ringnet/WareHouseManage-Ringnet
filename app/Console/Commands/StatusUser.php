<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatusUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateStatusUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật tình trạng license cho Users';

    /**
     * Execute the console command.
     *
     * @return int
     */


    // Cập nhật tình trạng status của bảng users thành 0 khi hết license by nqv
    public function handle()
    {
        $now = now();
        $disableUser = DB::table('manager_license')->where('date_end', '<', $now)->get();
        foreach ($disableUser as $user) {
            User::where('id', $user->user_id)->update(['status' => 0]);
        }
        return Command::SUCCESS;
    }
}
