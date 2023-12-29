<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provides extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_name', 'provide_represent', 'provide_phone', 'provide_email', 'provide_status', 'provide_address', 'provide_code', 'debt'
    ];
    protected $table = 'provides';
    public function getAllProvides($filter = [], $perPage, $name = null, $represent = null, $phonenumber = null, $email = null, $status = [], $keywords = null, $sortByArr = null)
    {
        $provides = DB::table($this->table)
            ->select('provides.*');

        $orderBy = 'created_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $provides = $provides->orderBy($orderBy, $orderType);

        if (!empty($filter)) {
            $provides = $provides->where($filter);
        }
        if (!empty($name)) {
            $provides = $provides->where(function ($query) use ($name) {
                $query->orWhere('provide_name', 'like', '%' . $name . '%');
            });
        }
        if (!empty($represent)) {
            $provides = $provides->where(function ($query) use ($represent) {
                $query->orWhere('provide_represent', 'like', '%' . $represent . '%');
            });
        }
        if (!empty($phonenumber)) {
            $provides = $provides->where(function ($query) use ($phonenumber) {
                $query->orWhere('provide_phone', 'like', '%' . $phonenumber . '%');
            });
        }
        if (!empty($email)) {
            $provides = $provides->where(function ($query) use ($email) {
                $query->orWhere('provide_email', 'like', '%' . $email . '%');
            });
        }
        if (!empty($status)) {
            $provides = $provides->whereIn('provide_status', $status);
        }
        if (!empty($keywords)) {
            $provides = $provides->where(function ($query) use ($keywords) {
                $query->orWhere('provide_name', 'like', '%' . $keywords . '%');
                $query->orWhere('provide_represent', 'like', '%' . $keywords . '%');
                $query->orWhere('provide_email', 'like', '%' . $keywords . '%');
            });
        }
        // dd($provides);
        $provides = $provides->orderBy('id', 'asc')->paginate($perPage);
        return $provides;
    }

    public function addProvides($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateProvides($data, $id)
    {
        $check = DB::table($this->table)
            ->where('id', '!=', $id)
            ->where('provide_name', preg_replace('/\s+/', ' ', $data['provide_name']))
            ->orWhere('provide_code', preg_replace('/\s+/', ' ', $data['provide_code']))->first();
        if (!$check) {
            return DB::table($this->table)->where('id', $id)->update($data);
        } else {
            return 0;
        }
    }
    public function checkProvidesCode($provide_code, $data)
    {
        $data1 = DB::table($this->table)->where('provide_code', $provide_code)
            ->orWhere('provide_name', $data['provide_name'])
            ->first();

        if ($data1 === null) {
            $id = DB::table($this->table)->insertGetId($data);
            return $id;
        } else {
            // DB::table($this->table)->where('id', $data1->id)->update($data);
            return $id = $data1->id;
        }
    }
}
