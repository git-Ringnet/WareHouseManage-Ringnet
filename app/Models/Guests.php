<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Guests extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_name',
        'guest_phone',
        'guest_email',
        'guest_status',
        'guest_address',
        'guest_code',
        'guest_email_personal',
        'guest_receiver',
        'guest_phoneReceiver',
        'guest_email_personal',
        'guest_note',
        'user_id',
        'debt'
    ];
    protected $table = 'guests';
    public function getAllGuests($filter = [], $perPage, $users_name = [], $name = null, $represent = null, $phonenumber = null, $email = null, $status = [], $keywords = null, $sortByArr = null)
    {
        $guests = DB::table($this->table)
            ->leftJoin('users', 'guests.user_id', '=', 'users.id')
            ->select('guests.*', 'users.name as users_name');


        $orderBy = 'created_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $guests = $guests->orderBy($orderBy, $orderType);

        if (!empty($filter)) {
            $guests = $guests->where($filter);
        }
        if (!empty($name)) {
            $guests = $guests->where(function ($query) use ($name) {
                $query->orWhere('guest_name', 'like', '%' . $name . '%');
            });
        }
        if (!empty($users_name)) {
            $guests = $guests->whereIn('users.name', $users_name);
        }
        if (!empty($represent)) {
            $guests = $guests->where(function ($query) use ($represent) {
                $query->orWhere('guest_represent', 'like', '%' . $represent . '%');
            });
        }
        if (!empty($phonenumber)) {
            $guests = $guests->where(function ($query) use ($phonenumber) {
                $query->orWhere('guest_phone', 'like', '%' . $phonenumber . '%');
            });
        }
        if (!empty($email)) {
            $guests = $guests->where(function ($query) use ($email) {
                $query->orWhere('guest_email', 'like', '%' . $email . '%');
            });
        }
        if (!empty($status)) {
            $guests = $guests->whereIn('guest_status', $status);
        }
        if (!empty($keywords)) {
            $guests = $guests->where(function ($query) use ($keywords) {
                $query->orWhere('guest_name', 'like', '%' . $keywords . '%');
                // $query->orWhere('guest_represent', 'like', '%' . $keywords . '%');
                $query->orWhere('guest_email', 'like', '%' . $keywords . '%');
            });
        }
        // dd($guests);
        $guests = $guests->orderBy('id', 'asc')->paginate($perPage);
        return $guests;
    }
    public function guestsCreator($perPage)
    {
        $userId = Auth::user()->id;
        $guests = DB::table($this->table)->where('user_id', $userId)->paginate($perPage);
        return $guests;
    }
    public function reportGuest($filter = [], $name = [], $orderBy = null, $orderType = null, $perPage)
    {
        $tableorders = Exports::select('guests.guest_name', DB::raw('SUM(exports.total) as totaltong'))
            ->leftJoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->groupBy('guests.guest_name');
        if (!empty($filter)) {
            $tableorders = $tableorders->where($filter);
        }
        if (!empty($name)) {
            $tableorders = $tableorders->whereIn('guests.guest_name', $name);
        }
        if (empty($orderBy)) {
            $orderBy = 'totaltong';
        }
        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'totaltong') {
                $orderBy ==  $orderBy;
            };
            $tableorders = $tableorders->orderBy($orderBy, $orderType);
        }

        $tableorders = $tableorders->get();


        return $tableorders;
    }
    public function dataReportGuest($filter = [], $guestIds = [])
    {
        $tableorders = Exports::select('guests.guest_name', DB::raw('SUM(exports.total) as totaltong'))
            ->leftJoin('guests', 'exports.guest_id', '=', 'guests.id');
        if (!empty($guestIds)) {
            $tableorders->whereIn('guests.guest_name', $guestIds);
        }
        $tableorders->groupBy('guests.guest_name');
        if (count($filter) === 2) {
            $tableorders->whereBetween('exports.created_at', [$filter[0], $filter[1]]);
        }
        $tableorders = $tableorders->get();
        return $tableorders;
    }
    public function ajax($data = [])
    {

        $tableorders = Exports::select('guests.guest_name', DB::raw('SUM(exports.total) as totaltong'))
            ->leftJoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->groupBy('guests.guest_name');
        if (!empty($data['guestIds'])) {
            $tableorders->whereIn('guests.guest_name', $data['guestIds']);
        }
        if (!empty($data['date_start']) && !empty($data['date_end'])) {
            $dateStart = Carbon::parse($data['date_start']);
            $dateEnd = Carbon::parse($data['date_end']);

            $tableorders->whereBetween('exports.created_at', [$dateStart, $dateEnd]);
        }
        if (isset($data['sort_by']) && $data['sort_type']) {
            $tableorders = $tableorders->orderBy($data['sort_by'], $data['sort_type']);
        }
        $tableorders = $tableorders->get();
        return $tableorders;
    }
}
