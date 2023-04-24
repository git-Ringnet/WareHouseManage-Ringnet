<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function getProducts()
    {
        return $this->hasOne(Products::class);
    }
    protected $fillable = [
        'category_name','ID_products'
    ];
}
