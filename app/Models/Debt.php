<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Debt extends Model
{
    use HasFactory;
    protected $table = 'debts';
    protected $fillable = [
        'guest_id',
        'user_id',
        'export_id',
        'total_sales',
        'total_import',
        'transport_fee',
        'total_difference',
        'debt',
        'debt_status',
        'debt_note',
        'date_end',
        'date_start',
    ];
    public function getAllDebts($filter = [], $keywords = null, $name = [], $date = [], $datepaid = [], $status = [], $orderBy = null, $orderType = null)
    {
        $debts = Debt::select('debts.*', 'exports.id as madon', 'guests.guest_name as khachhang', 'users.name as nhanvien', 'exports.updated_at as debtdate')
            ->leftJoin('guests', 'guests.id', 'debts.guest_id')
            ->leftJoin('users', 'users.id', 'debts.user_id')
            ->leftJoin('exports', 'exports.id', 'debts.export_id');
        if (!empty($filter)) {
            $debts = $debts->where($filter);
        }
        if (!empty($keywords)) {
            $debts = $debts->where(function ($query) use ($keywords) {
                $query->orWhere('exports.id', 'like', '%' . $keywords . '%');
                $query->orWhere('guests.guest_name', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($name)) {
            $debts = $debts->whereIn('users.name', $name);
        }
        // dd($date[0][0]);
        if (!empty($date)) {
            $debts = $debts->where(function ($query) use ($date) {
                $query->where('debts.date_start', '>=', $date[0][0])
                    ->where('debts.date_end', '<=', $date[0][1]);
            });
        }
        if (!empty($datepaid)) {
            $debts = $debts->where('debts.debt_status', 1)->wherebetween('debts.updated_at', $datepaid);
        }


        if (!empty($status)) {
            $debts = $debts->whereIn('debts.debt_status', $status);
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "debts." . $orderBy;
            };
            $debts = $debts->orderBy($orderBy, $orderType);
        }


        $debts = $debts->orderBy('debts.id', 'desc')->paginate(8);


        return $debts;
    }
    public function getAllProductsDebts()
    {
        $product = Debt::select('debts.*', 'product_exports.id as madon', 'product_exports.product_qty as soluong', 'product_exports.product_price as giaban', 'product.product_price as gianhap')
            ->leftJoin('guests', 'guests.id', 'debts.guest_id')
            ->leftJoin('users', 'users.id', 'debts.user_id')
            ->leftJoin('exports', 'exports.id', 'debts.export_id')
            ->leftJoin('product_exports', 'exports.id', 'product_exports.export_id')
            ->leftJoin('product', 'product.id', 'product_exports.product_id')->get();
        return $product;
    }
    public function debtsCreator()
    {
        $userId = Auth::user()->id;
        $debtsCreator = DB::table($this->table)->where('user_id', $userId)->paginate(8);
        return $debtsCreator;
    }
}
