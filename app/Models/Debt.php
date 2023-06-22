<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    protected $table = 'debts';
    protected $fillable = [
        'guest_id',
        'user_id',
        'export_id',
        'total_sales',
        'total_import',
        'transport_fee',
        'total_difference',
        'debt',
        'debt_status',
        'debt_note'
    ];
}
