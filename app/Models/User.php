<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = TRUE;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'status',
    ];


    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function getAllUsers($filter = [], $status = [], $roles = [], $keywords = null, $sortByArr = null)
    {
        // $users = DB::select('SELECT * FROM users');
        $users = DB::table($this->table)
            ->select('users.*', 'roles.name as role_name')
            ->join('roles', 'users.roleid', '=', 'roles.id');


        $orderBy = 'users.created_at';
        $orderType = 'desc';
        if (!empty($sortByArr) && is_array($sortByArr)) {
            if (!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])) {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy, $orderType);

        if (!empty($filter)) {
            $users = $users->where($filter);
        }
        if (!empty($status)) {
            $users = $users->whereIn('status', $status);
        }
        if (!empty($roles)) {
            $users = $users->whereIn('roleid', $roles);
        }
        if (!empty($keywords)) {
            $users = $users->where(function ($query) use ($keywords) {
                $query->orWhere('users.name', 'like', '%' . $keywords . '%');
                $query->orWhere('users.email', 'like', '%' . $keywords . '%');
            });
        }
        // dd($users);
        $users = $users->orderBy('users.created_at', 'asc')->paginate(5);
        return $users;
    }
    public function addUser($data)
    {
        return DB::table($this->table)->insert($data);
    }
    // public function getDetailUser($id)
    // {
    //     return DB::select('SELECT * FROM ' . $this->table . ' WHERE id  = ?', [$id]);
    // }
    public function updateUser($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
}
