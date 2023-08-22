<?php

namespace App\Console;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\Message;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $debtExport = Debt::all();
            $today = Carbon::now()->format('d-m-Y');
            foreach ($debtExport as $d) {
                $check = date_format(new DateTime($d->date_end), 'd-m-Y');
                if ($check == $today) {
                    $m = Message::where('id_debtExport', $d->id)->first();
                    if ($m === null) {
                        $data = new Message();
                        $data->message = 'Tới hạn thanh toán';
                        $data->user_id = $d->user_id;
                        $data->status = 0;
                        $data->id_debtExport = $d->id;
                        $data->id_debtImport = 0;
                        $data->created_at = Carbon::now();
                        $data->updated_at = Carbon::now();
                        $data->save();
                    }
                }
            }
            $debtImport = DebtImport::all();
            foreach ($debtImport as $d) {
                $checkImport = date_format(new DateTime($d->date_end), 'd-m-Y');
                if ($checkImport == $today) {
                    $m = Message::where('id_debtImport', $d->id)->first();
                    if ($m === null) {
                        $data = new Message();
                        $data->message = 'Tới hạn thanh toán';
                        $data->user_id = $d->user_id;
                        $data->status = 0;
                        $data->id_debtImport = $d->id;
                        $data->id_debtExport = 0;
                        $data->created_at = Carbon::now();
                        $data->updated_at = Carbon::now();
                        $data->save();
                    }
                }
            }
        })->everyMinute(); // Hoặc thời gian cố định khác
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
