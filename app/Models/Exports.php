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
            ->select('exports.id', 'guests.guest_receiver', 'users.name', 'exports.total', 'exports.updated_at', 'export_status');
        // Các điều kiện tìm kiếm và lọc dữ liệu ở đây

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
                // $query->orWhere('guests.guest_represent', 'like', '%' . $keywords . '%');
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
        return $this->hasMany(ProductExports::class, 'export_id');
    }
    public function allExports()
    {
        $exports = DB::table($this->table)->get();
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
        $totalSum = DB::table($this->table)->sum('total');
        return $totalSum;
    }
    public function productsCreator()
    {
        $userId = Auth::user()->id;
        $products = DB::table($this->table)->where('user_id', $userId)->paginate(8);
        return $products;
    }
}
