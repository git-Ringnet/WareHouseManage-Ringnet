<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provides extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','privide_name','provide_represent','provide_phone','provide_email','provide_status'
    ];
}