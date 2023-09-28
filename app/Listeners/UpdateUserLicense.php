<?php

namespace App\Listeners;

use App\Models\ManagerLicense;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\View;

class UpdateUserLicense
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Kiểm tra hoạt động của các license
        $licenseUser = $event->user->license_id;
        $managerLicense = ManagerLicense::where('user_id', $licenseUser)->first();

        $flag = false;

        if ($managerLicense) {
            // Cập nhật trường updated_at
            $managerLicense->updated_at = now();
            $managerLicense->save();

            // Tính số ngày còn lại và lưu vào session
            $date_end = new DateTime($managerLicense->date_end);
            $current_date = new DateTime();
            $interval = $current_date->diff($date_end);
            $days_remaining = $interval->days;
            $days_remaining = 'Thời gian thử nghiệm còn lại ' . $days_remaining . ' ngày';
            session()->put('days_remaining', $days_remaining);

            // Kiểm tra date_end và thực hiện các hành động khác nếu cần
            if ($managerLicense->date_end < now()) {
                // Thực hiện các hành động sau khi license hết hạn
                $flag == true;
            }
        }
        View::share('flag', $flag);
    }
}
