<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provides extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_name','provide_represent','provide_phone','provide_email','provide_status'
    ];
    protected $table = 'provides';
    public function getAllProvides($filter = [], $status = [], $keywords = null, $sortByArr = null)
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
        $provides = $provides->orderBy('id', 'asc')->paginate(5);
        return $provides;
    }
}