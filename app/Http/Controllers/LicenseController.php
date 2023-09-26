<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\ManagerLicense;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\ManagerLicenseSeeder;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    private $users;
    private $license;
    private $manager_license;
    public function __construct()
    {
        $this->users = new User();
        $this->license = new License();
    }
    public function updateLicense(Request $request)
    {
        $data = $request->all();
        $manager_license = ManagerLicense::where('user_id', $data['idUser'])->first();
        $manager_license->license_id = $data['newLicense'];

        // Cập nhật date end ajax
        $date_start = $manager_license->date_start;
        if ($data['newLicense'] == 2) {
            $new_date_timestamp = strtotime($date_start . ' +90 days');
            $new_date = Carbon::createFromTimestamp($new_date_timestamp);
        } elseif ($data['newLicense'] == 3) {
            $new_date_timestamp = strtotime($date_start . ' +365 days');
            $new_date = Carbon::createFromTimestamp($new_date_timestamp);
        } elseif ($data['newLicense'] == 1) {
            $new_date_timestamp = strtotime($date_start . ' +30 days');
            $new_date = Carbon::createFromTimestamp($new_date_timestamp);
        }

        $manager_license->date_end = $new_date;

        $user = User::where('id', $data['idUser'])->first();

        if ($new_date > now()) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->save();

        $manager_license->save();
        return $new_date;
    }
}
