<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class License extends Model
{
    use HasFactory;
    protected $table = 'licenses';
    public $timestamps = TRUE;

    public function getAllLicense()
    {
        $licenses = DB::table($this->table)->get();
        return $licenses;
    }
}
