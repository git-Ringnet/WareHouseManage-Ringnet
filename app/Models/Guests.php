<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_name','guest_represent','guest_phone','guest_email','guest_status'
    ];
}