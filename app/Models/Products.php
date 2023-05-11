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
    public function getAllProducts($filter = [], $status = [], $categoryarr = [], $keywords = null, $sortByArr = null)
    {
        //lấy tất cả products
        $products = Products::all();
        
        $productIds = array();
        foreach ($products as $value) {
            array_push($productIds, $value->id);
        }
        $products = DB::table('products')
            ->leftjoin('product', 'product.products_id', '=', 'products.id')
            ->whereIn('products.id', $productIds)
            ->groupBy(
                'products.id',
                'products.products_code',
                'products.products_name',
                'products.ID_category',
                'products.products_trademark',
                'products.created_at',
                'products.updated_at',
            )
            ->select(
                'products.id',
                'products.products_code',
                'products.products_name',
                'products.ID_category',
                'products.products_trademark',
                'products.created_at',
                'products.updated_at',
                DB::raw('SUM(product.product_qty * product.product_price) as total_sum'),
                DB::raw('SUM(product.product_qty) as qty_sum'),
                DB::raw('SUM(product.product_qty * product.product_price) / SUM(product.product_qty) as price_avg'),
            );


        $orderBy = 'created_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $products = $products->orderBy($orderBy, $orderType);

        if (!empty($filter)) {
            $products = $products->where($filter);
        }
        if (!empty($status)) {
            $products = $products->whereIn('guest_status', $status);
        }
        if (!empty($categoryarr)) {
            $products = $products->whereIn('products.id', $categoryarr);
        }


        if (!empty($keywords)) {
            $products = $products->where(function ($query) use ($keywords) {
                $query->orWhere('products_name', 'like', '%' . $keywords . '%');
                $query->orWhere('products_code', 'like', '%' . $keywords . '%');
            });
        }
        $products = $products->orderBy('products.created_at', 'asc')->paginate(5);
        return $products;
    }
}
