<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_id', 'users_id', 'order_status', 'total'
    ];
    public function getProvide()
    {
        return $this->hasOne(Provides::class);
    }
}
