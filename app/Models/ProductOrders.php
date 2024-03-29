<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
