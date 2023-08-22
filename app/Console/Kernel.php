<?php

namespace App\Console;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\History;
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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $debts = Debt::whereIn('debt_status', [2, 3, 0, 5])->get();
            foreach ($debts as $debt) {
                $currentDate = now();
                $daysDiffss = $currentDate->diffInDays($debt->date_end);
                $daysDiff = $debt->date_end < $currentDate ? -$daysDiffss : $daysDiffss;
                // Sử dụng dd() để hiển thị giá trị daysDiff trong chế độ debug
                if ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt->debt_status = 2;
                } elseif ($daysDiff == 0) {
                    $debt->debt_status = 5;
                } elseif ($daysDiff < 0) {
                    $debt->debt_status = 0;
                } else {
                    $debt->debt_status = 3;
                }
                var_dump("daysDiff for debt {$debt->id}::::{$debt->export_id}-----: $daysDiff:::::$debt->debt_status");
                var_dump("$currentDate -------- $debt->date_end");
                $data = [
                    'export_status' => $debt->debt_status,
                ];
                $history=new History();
                $history->updateHistoryByExport($data, $debt->export_id);
                $debt->save();
                $debt->refresh();
            }
            $debtsImport = DebtImport::whereIn('debt_status', [2, 3, 0, 5])->get();
            foreach ($debtsImport as $debt) {
                $currentDate = now();
                $daysDiffss = $currentDate->diffInDays($debt->date_end);
                $daysDiff = $debt->date_end < $currentDate ? -$daysDiffss : $daysDiffss;

                // Sử dụng dd() để hiển thị giá trị daysDiff trong chế độ debug
                if ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt->debt_status = 2;
                } elseif ($daysDiff == 0) {
                    $debt->debt_status = 5;
                } elseif ($daysDiff < 0) {
                    $debt->debt_status = 0;
                } else {
                    $debt->debt_status = 3;
                }
                var_dump("daysDiff for debtImport {$debt->id}::::{$debt->export_id}-----: $daysDiff:::::$debt->debt_status");
                var_dump("$currentDate -------- $debt->date_end");
                $data = [
                    'import_status' => $debt->debt_status,
                ];
                $history=new History();
                $history->updateHistoryByImport($data, $debt->import_id);
                // $debt->flushCache();
                $debt->save();
                $debt->refresh();
            }
        })->everyThreeHours();
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
