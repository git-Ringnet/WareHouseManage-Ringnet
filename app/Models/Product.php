<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    
    protected $fillable = [
        'product_name','product_unit','product_qty','product_price','tax','total','provide_id','product_trade'
     ];
    public function getAllProduct($filters = [], $status = [], $products_name = null, $providearr, $unitarr,$taxarr, $keywords = null, $sortByArr = null)
    {
        //lấy tất cả products
        $products = DB::table($this->table)
            ->leftJoin('provides', 'provides.id', '=', 'product.provide_id')
            ->select('product.*','provides.provide_name as provide','product.product_qty as soluong');
        $orderBy = 'created_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }

        if (!empty($status)) {
            $products = $products->where(function ($query) use ($status) {
                if (in_array("0", $status)) {
                    $query->orWhere('product.product_qty', '=', null);
                    $query->orWhere('product.product_qty', '=', 0);
                }
                if (in_array("1", $status)) {
                    $query->orWhereBetween('product.product_qty', [1, 5]);
                }
                if (in_array("2", $status)) {
                    $query->orWhere('product.product_qty', '>', 5);
                }
            });
        }
        $products = $products->orderBy($orderBy, $orderType);
        if (!empty($filters)) {
            $products = $products->where($filters);
        }

        // Tên sản phẩm
        if (!empty($products_name)) {
            $products = $products->where(function ($query) use ($products_name) {
                $query->orWhere('product_name', 'like', '%' . $products_name . '%');
            });
        }
        // Nhà cung cấp
        if (!empty($providearr)) {
            $products = $products->whereIn('provides.provide_name', $providearr);
        }
        // Đơn vị tính
        if (!empty($unitarr)) {
            $products = $products->whereIn('product.product_unit', $unitarr);
        }
        // Thuế
        // dd($taxarr);
        if (!empty($taxarr)) {
            $products = $products->whereIn('product.tax', $taxarr);
        }

        if (!empty($keywords)) {
            $products = $products->where(function ($query) use ($keywords) {
                $query->orWhere('product_name', 'like', '%' . $keywords . '%');
                $query->orWhere('provides.provide_name', 'like', '%' . $keywords . '%');
            });
        }

        $products = $products->orderBy('product.created_at', 'asc')->paginate(20);

        return $products;
    }
    public function getNameProvide()
    {
        return $this->hasOne(Provides::class,'id','provide_id');
    }
    public function addProduct($data){
        return DB::table($this->table)->insertGetId($data);
    }
    public function allProducts(){
        $products = DB::table($this->table)->get();
        return $products;
    }
    public function productsStock(){
        $products = DB::table($this->table);
        $products = $products->where('product_qty', '>', 5)->get();
        return $products;
    }
    public function productsEnd(){
        $products = DB::table($this->table);
        $products = $products->where(function ($query) {
            $query->orWhere('product_qty', '=', null);
            $query->orWhere('product_qty', '=', 0);
        });
        $products = $products->get();
        return $products;
    }
    public function sumTotalInventory(){
        $totalSum = DB::table($this->table)->sum('product_price');
        return $totalSum;
    }
    public function productsNearEnd(){
        $products = DB::table($this->table);
        $products = $products->whereBetween('product_qty', [1, 5])->get();
        return $products;
    }
    
}