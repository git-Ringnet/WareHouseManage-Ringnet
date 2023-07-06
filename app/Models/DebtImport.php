<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DebtImport extends Model
{
    use HasFactory;
    protected $table = 'debt_import';
    protected $fillable = [
        'provide_id',
        'user_id',
        'import_id',
        'total_import',
        'debt',
        'debt_status',
        'debt_note',
        'date_end',
        'date_start',
    ];
    public function getAllDebts($filter=[],$keywords=null,$name=[],$date=[],$datepaid=[],$status=[], $orderBy = null, $orderType = null)
    {
        $debt_import = DebtImport::select('debt_import.*', 'orders.id as madon', 'provides.guest_name as khachhang', 'users.name as nhanvien','orders.updated_at as debtdate')
            ->leftJoin('provides', 'provides.id', 'debt_import.provide_id')
            ->leftJoin('users', 'users.id', 'debt_import.user_id')
            ->leftJoin('orders', 'orders.id', 'debt_import.import_id');
        if (!empty($filter)) {
            $debt_import = $debt_import->where($filter);
        }
        if (!empty($keywords)) {
            $debt_import = $debt_import->where(function ($query) use ($keywords) {
                $query->orWhere('orders.id', 'like', '%' . $keywords . '%');
                $query->orWhere('provides.guest_name', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($name)) {
            $debt_import = $debt_import->whereIn('users.name', $name);
        }
        // dd($date[0][0]);
        if (!empty($date)) {
            $debt_import = $debt_import->where(function ($query) use ($date) {
                $query->where('debt_import.date_start', '>=', $date[0][0])
                    ->where('debt_import.date_end', '<=', $date[0][1]);
            });
        }
        if (!empty($datepaid)) {
            $debt_import = $debt_import->where('debt_import.debt_status', 1)->wherebetween('debt_import.updated_at', $datepaid);
        }
              

        if (!empty($status)) {
            $debt_import = $debt_import->whereIn('debt_import.debt_status', $status);
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "debt_import." . $orderBy;
            };
            $debt_import = $debt_import->orderBy($orderBy, $orderType);
        }
        

        $debt_import = $debt_import->orderBy('debt_import.id', 'desc')->paginate(8);


        return $debt_import;
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
