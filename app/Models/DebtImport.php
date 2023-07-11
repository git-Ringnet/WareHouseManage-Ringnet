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
    public function getAllDebts($filter=[],$keywords=null,$name=[],$date=[],$provide_name=[],$status=[], $orderBy = null, $orderType = null)
    {
        $debt_import = DebtImport::select('debt_import.*', 'orders.product_code as madon', 'provides.provide_name as nhacungcap', 'users.name as nhanvien','orders.updated_at as debtdate')
            ->leftJoin('provides', 'provides.id', 'debt_import.provide_id')
            ->leftJoin('users', 'users.id', 'debt_import.user_id')
            ->leftJoin('orders', 'orders.id', 'debt_import.import_id')
            ->leftJoin('productorders', 'orders.id', 'productorders.order_id');
        if (!empty($filter)) {
            $debt_import = $debt_import->where($filter);
        }
        if (!empty($keywords)) {
            $debt_import = $debt_import->where(function ($query) use ($keywords) {
                $query->orWhere('orders.product_code', 'like', '%' . $keywords . '%');
                $query->orWhere('provides.provide_name', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($name)) {
            $debt_import = $debt_import->whereIn('users.name', $name);
        }
        if (!empty($date)) {
            $debt_import = $debt_import->wherebetween('orders.created_at', $date);
        }
        if (!empty($provide_name)) {
            $debt_import = $debt_import->whereIn('orders.provide_id', $provide_name);
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
        $product = DebtImport::select('debt_import.*','productorders.product_tax as thue','productorders.product_name as tensanpham','productorders.product_unit as dvt' ,'productorders.product_qty as soluong', 'productorders.product_price as gianhap')
            ->leftJoin('provides', 'provides.id', 'debt_import.provide_id')
            ->leftJoin('users', 'users.id', 'debt_import.user_id')
            ->leftJoin('orders', 'orders.id', 'debt_import.import_id')
            ->leftJoin('productorders', 'orders.id', 'productorders.order_id')
            ->leftJoin('product', 'product.id', 'productorders.product_id')->get();
        return $product;
    }
    public function debtsCreator()
    {
        $userId = Auth::user()->id;
        $debtsCreator = DB::table($this->table)->where('user_id', $userId)->paginate(8);
        return $debtsCreator;
    }
   
    public function updateDebtImport($data, $id)
    {
        return DB::table($this->table)->where('import_id', $id)->update($data);
    }
}
