<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ManagerLicense extends Model
{
    use HasFactory;
    protected $table = 'manager_license';
    protected $fillable = ['user_id', 'license_id', 'date_start', 'date_end'];
    public $timestamps = TRUE;

    public function getAllLicense()
    {
        $managerLC = DB::table($this->table)->get();
        return $managerLC;
    }
    public function createUserLicense($data)
    {
        return self::create($data);
    }
}
