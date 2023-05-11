<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public function getProductsCode()
    {
       
    }
    public function getSerinumbers()
    {
        return $this->hasMany(Serinumbers::class);
    }
    protected $fillable = [
        'products_id','product_name','product_category','product_trademark','product_qty',
        'product_price'
    ];
    
}