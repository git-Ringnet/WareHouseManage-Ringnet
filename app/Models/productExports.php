<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productExports extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'product_name', 'product_unit', 'product_qty', 'product_price', 'product_note',
        'product_tax', 'product_total'
    ];
}
