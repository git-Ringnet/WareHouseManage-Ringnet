<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'ID_category');
    }
    public function getProducts()
    {
        return $this->hasMany(Product::class);
    }
    protected $table = 'products';
    protected $fillable = [
        'products_image',
        'products_code',
        'products_name',
        'products_trademark',
        'products_description',
        'inventory',
        'price_avg',
        'price_inventory',
    ];
    public function getAllProducts($filters = [], $status = [], $code = null, $products_name = null, $categoryarr, $trademarkarr, $keywords = null, $sortByArr = null)
    {
        //lấy tất cả products
        $products = DB::table($this->table)
            ->select('products.*');
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
                    $query->orWhere('inventory', '=', null);
                    $query->orWhere('inventory', '=', 0);
                }
                if (in_array("1", $status)) {
                    $query->orWhereBetween('inventory', [1, 5]);
                }
                if (in_array("2", $status)) {
                    $query->orWhere('inventory', '>', 5);
                }
            });
        }
        $products = $products->orderBy($orderBy, $orderType);
        if (!empty($filters)) {
            $products = $products->where($filters);
        }

        if (!empty($code)) {
            $products = $products->where(function ($query) use ($code) {
                $query->orWhere('products_code', 'like', '%' . $code . '%');
            });
        }
        if (!empty($products_name)) {
            $products = $products->where(function ($query) use ($products_name) {
                $query->orWhere('products_name', 'like', '%' . $products_name . '%');
            });
        }
        if (!empty($categoryarr)) {
            $products = $products->whereIn('products.ID_category', $categoryarr);
        }
        if (!empty($trademarkarr)) {
            $products = $products->whereIn('products.products_trademark', $trademarkarr);
        }

        if (!empty($keywords)) {
            $products = $products->where(function ($query) use ($keywords) {
                $query->orWhere('products_name', 'like', '%' . $keywords . '%');
                $query->orWhere('products_code', 'like', '%' . $keywords . '%');
            });
        }

        $products = $products->orderBy('products.created_at', 'asc')->paginate(8);
        // dd($products);

        return $products;
    }
    public function allProducts(){
        $products = DB::table($this->table)->get();
        return $products;
    }
    public function productsNearEnd(){
        $products = DB::table($this->table);
        $products = $products->whereBetween('inventory', [0, 5])->get();
        return $products;
    }
    public function productsStock(){
        $products = DB::table($this->table);
        $products = $products->where('inventory', '>', 5)->get();
        return $products;
    }
    public function productsEnd(){
        $products = DB::table($this->table);
        $products = $products->where('inventory', '=', 0)->get();
        return $products;
    }
    public function sumTotalInventory(){
        $totalSum = DB::table($this->table)->sum('price_inventory');
        return $totalSum;
    }
}
