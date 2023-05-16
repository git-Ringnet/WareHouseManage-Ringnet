<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_name',
        'guest_represent',
        'guest_phone',
        'guest_email',
        'guest_status',
        'guest_addressInvoice',
        'guest_code',
        'guest_addressDeliver',
        'guest_receiver',
        'guest_phoneReceiver',
        'guest_pay',
        'guest_payTerm',
        'guest_note',
    ];
}