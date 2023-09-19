<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function getAllGuests($filter = [],$perPage,$users_name=[],$name = null,$represent = null,$phonenumber = null,$email = null, $status = [], $keywords = null, $sortByArr = null)
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
}