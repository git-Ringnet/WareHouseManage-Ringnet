<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exports extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_id',
        'user_id',
        'total',
        'export_status',
    ];
}
