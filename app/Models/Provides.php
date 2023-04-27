<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provides extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_name','provide_represent','provide_phone','provide_email','provide_status'
    ];
}