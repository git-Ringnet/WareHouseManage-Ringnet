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
    public function getAllExports($filter = [],$perPage, $status = [], $name = [], $guest = [], $date = [], $keywords = null, $orderBy = null, $orderType = null)
    {

        $exports = DB::table($this->table)
            ->leftJoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->leftJoin('users', 'exports.user_id', '=', 'users.id')
            ->select('exports.*', 'exports.id', 'exports.user_id', 'guests.guest_name', 'users.name', 'exports.total', 'exports.updated_at', 'export_status');
        // Các điều kiện tìm kiếm và lọc dữ liệu ở đây

        $userId = Auth::user()->id;
        if (Auth::user()->roleid != 1) {
            $exports = $exports->where('exports.user_id', $userId);
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

        if (!empty($guest)) {
            $exports = $exports->whereIn('guests.guest_name', $guest);
        }
        if (!empty($date)) {
            $exports = $exports->wherebetween('exports.created_at', $date);
        }
        // dd($exports = $exports->wherebetween('exports.updated_at', $date));
        if (!empty($keywords)) {
            $exports = $exports->where(function ($query) use ($keywords) {
                $query->orWhere('guests.guest_name', 'like', '%' . $keywords . '%');
                $query->orWhere('exports.export_code', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "exports." . $orderBy;
            };
            $exports = $exports->orderBy($orderBy, $orderType);
        }
        $exports = $exports->orderBy('exports.id', 'desc')->paginate($perPage);
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
    public function alldonxuat()
    {
        $exports = DB::table($this->table)
            ->where('export_status', 2)
            ->get();
        return $exports;
    }
    protected $fillable = [
        'guest_id',
        'user_id',
        'total',
        'export_status',
        'note_form',
        'export_code',
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

    public function tongtienxuat()
    {
        $totalSum = DB::table($this->table)
            ->where('export_status', 2)
            ->sum('total');

        return $totalSum;
    }

    public function productsCreator()
    {
        $userId = Auth::user()->id;
        $products = DB::table($this->table)->where('user_id', $userId)->paginate(20);
        // dd($products);
        return $products;
    }

    public function reportExports($filter = [], $name = [], $roles = [], $orderBy = null, $orderType = null)
    {
        //Table xuất hàng
        $Tableexports = Exports::leftJoin('users', 'users.id', 'exports.user_id')
            ->leftJoin('roles', 'users.roleid', 'roles.id')
            ->leftJoin('debts', 'debts.export_id', 'exports.id')
            ->where('exports.export_status', 2)
            ->select('users.name as nhanvien', 'roles.name as vaitro', 'users.email as email')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('COUNT(exports.id)');
            }, 'donxuat')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('SUM(total)');
            }, 'tongtienxuat')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('exports.export_status', 2)
                    ->whereColumn('debts.user_id', 'users.id')
                    ->selectRaw('SUM(debts.total_difference)');
            }, 'tongloinhuan')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('exports.export_status', 2)
                    ->where('debts.debt_status', '!=', 1)
                    ->whereColumn('debts.user_id', 'users.id')
                    ->selectRaw('SUM(total_sales)');
            }, 'tongcongno')
            ->distinct();
        if (!empty($filter)) {
            $Tableexports = $Tableexports->where($filter);
        }
        if (!empty($name)) {
            $Tableexports = $Tableexports->whereIn('users.name', $name);
        }
        if (!empty($roles)) {
            $Tableexports = $Tableexports->whereIn('users.roleid', $roles);
        }
        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "exports." . $orderBy;
            };
            $Tableexports = $Tableexports->orderBy('exports.id', $orderType);
        }
        $Tableexports = $Tableexports->get();
        // dd($Tableexports);

        return $Tableexports;
    }
}
