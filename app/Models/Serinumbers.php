<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serinumbers extends Model
{
    use HasFactory;
    protected $fillable = [
        'serinumber','product_id'
    ];
}