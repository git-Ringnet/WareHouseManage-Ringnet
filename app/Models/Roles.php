<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function getAll()
    {
        $roles = DB::table($this->table)
        ->orderBy('name', 'DESC')
        ->get();
        return $roles;
    }
}
