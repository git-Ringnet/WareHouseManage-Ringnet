<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrders extends Model
{
    use HasFactory;
    protected $table = 'productorders';
    protected $fillable = [
        'products_id','product_name','product_category','product_unit','product_trademark','product_qty',
        'product_price','order_id'
    ];
}
