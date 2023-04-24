<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Products extends Model
{
    use HasFactory;
    public function getCategory() {
        return $this->hasOne(Category::class,'id','ID_category');
    }
    public function getProducts() {
        return $this->hasMany(Product::class);
    }
    protected $table = 'products';
    protected $fillable = [
        'products_code',
        'products_name',
        'products_trademark'
    ];
}