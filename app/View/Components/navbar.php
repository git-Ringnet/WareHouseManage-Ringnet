<?php

namespace App\View\Components;

use App\Models\License;
use App\Models\ManagerLicense;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\Component;

class navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;

    public function __construct($title = 'Trang chủ')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //Kiểm tra hoạt động của các license
        $licenseUser = Auth::user()->license_id;
        $managerLicense = ManagerLicense::where('user_id', $licenseUser)->first(); // Tìm bản ghi với license_id tương ứng
        $flag = false;
        if ($managerLicense) {
            $managerLicense->updated_at = now(); // Đặt trường updated_at thành giá trị hiện tại
            $managerLicense->save(); // Lưu lại bản ghi đã thay đổi
            // Tính số ngày còn lại in ra nếu đó là admin của 1 site
            $date_end = new DateTime($managerLicense->date_end);
            $current_date = new DateTime(); // Ngày hôm nay
            $interval = $current_date->diff($date_end);
            $days_remaining = $interval->days;
            $days_remaining = 'Bạn còn ' . $days_remaining . ' ngày còn lại';
            session()->put('days_remaining', $days_remaining);
            // dd($managerLicense->date_end < now());
            $request = request(); // Lấy request hiện tại
            // Lấy host từ request
            $host = $request->getHost();
            if ($managerLicense->date_end < now()) {
                $flag == true;
            };
        }
        // dd($managerLicense);

        return view('components.navbar', compact('flag'));
    }
}
