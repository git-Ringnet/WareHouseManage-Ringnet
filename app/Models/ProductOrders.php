<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductOrders extends Model
{
    use HasFactory;
    protected $table = 'productorders';
    public function serinumbes()
    {
        return $this->hasMany(Serinumbers::class, 'product_id', 'product_id');
    }
    public function getCodeProduct()
    {
        return $this->hasOne(Products::class, 'id', 'products_id');
    }
    protected $fillable = [
        'product_id', 'products_id', 'product_name', 'product_category', 'product_unit', 'product_trademark', 'product_qty',
        'product_price', 'order_id'
    ];

    public function addProductOrder($data){
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateProductOrder($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
}
