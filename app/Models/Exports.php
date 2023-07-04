<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Exports extends Model
{
    protected $table = 'exports';

    use HasFactory;
    public function getAllExports($filter = [], $status = [], $name = [], $date = [], $keywords = null, $orderBy = null, $orderType = null)
    {
        
        $exports = DB::table($this->table)
            ->leftJoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->leftJoin('users', 'exports.user_id', '=', 'users.id')
            ->select('exports.id','exports.user_id', 'guests.guest_receiver', 'users.name', 'exports.total', 'exports.updated_at', 'export_status');
        // Các điều kiện tìm kiếm và lọc dữ liệu ở đây

        $userId = Auth::user()->id;
        if( Auth::user()->roleid != 1){
            $exports = $exports->where('exports.user_id',$userId);
        }
        
        if (!empty($filter)) {
            $exports = $exports->where($filter);
        }

        if (!empty($status)) {
            $exports = $exports->whereIn('exports.export_status', $status);
        }

        if (!empty($name)) {
            $exports = $exports->whereIn('users.name', $name);
        }
        if (!empty($date)) {
            $exports = $exports->wherebetween('exports.updated_at', $date);
        }
        // dd($exports = $exports->wherebetween('exports.updated_at', $date));
        if (!empty($keywords)) {
            $exports = $exports->where(function ($query) use ($keywords) {
                $query->orWhere('exports.id', 'like', '%' . $keywords . '%');
                $query->orWhere('guests.guest_receiver', 'like', '%' . $keywords . '%');
                $query->orWhere('users.name', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "exports." . $orderBy;
            };
            $exports = $exports->orderBy($orderBy, $orderType);
        }

        $exports = $exports->orderBy('exports.id', 'desc')->paginate(8);
        return $exports;
    }
    public function productExports()
    {
        return $this->hasMany(productExports::class, 'export_id');
    }

    public function allExports()
    {
        $startDate = now()->subDays(30); // Ngày bắt đầu là ngày hiện tại trừ đi 30 ngày
        $endDate = now(); // Ngày kết thúc là ngày hiện tại
        $exports = DB::table($this->table)
        ->where('export_status', 2)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();
        return $exports;
    }
    protected $fillable = [
        'guest_id',
        'user_id',
        'total',
        'export_status',
        'note_form',
    ];
    public function sumTotalExports()
    {
        $startDate = now()->subDays(30); // Ngày bắt đầu là ngày hiện tại trừ đi 30 ngày
        $endDate = now(); // Ngày kết thúc là ngày hiện tại
        
        $totalSum = DB::table($this->table)
            ->where('export_status', 2)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');
        
        return $totalSum;
        
    }
    public function productsCreator()
    {
        $userId = Auth::user()->id;
        $products = DB::table($this->table)->where('user_id', $userId)->paginate(8);
        // dd($products);
        return $products;
    }
}
