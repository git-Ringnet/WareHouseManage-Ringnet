<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guests extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_name','guest_represent','guest_phone','guest_email','guest_status'
    ];
    protected $table = 'guests';
    public function getAllGuests($filter = [], $status = [], $keywords = null, $sortByArr = null)
    {
        $guests = DB::table($this->table)
            ->select('guests.*');

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
        if (!empty($status)) {
            $guests = $guests->whereIn('guest_status', $status);
        }
        if (!empty($keywords)) {
            $guests = $guests->where(function ($query) use ($keywords) {
                $query->orWhere('guest_name', 'like', '%' . $keywords . '%');
                $query->orWhere('guest_represent', 'like', '%' . $keywords . '%');
                $query->orWhere('guest_email', 'like', '%' . $keywords . '%');
            });
        }
        // dd($guests);
        $guests = $guests->orderBy('id', 'asc')->paginate(5);
        return $guests;
    }
}