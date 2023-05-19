<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_id', 'users_id', 'order_status', 'total'
    ];
    protected $table = 'orders';

    public function getAllOrders($filter = [], $status = [],$provide_name=[], $name = [], $date = [], $keywords = null, $orderBy = null, $orderType = null)
    {
        $productIds = array();
        $order = Orders::orderByDesc('id')->get();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
                // dd($order);

        $orders = Orders::join('users', 'users.id', '=', 'orders.users_id')
        ->leftJoin('provides', 'provides.id', '=', 'orders.provide_id')
        ->whereIn('users.id', $productIds);
        
        // Các điều kiện tìm kiếm và lọc dữ liệu ở đây

        if (!empty($filter)) {
            $orders = $orders->where($filter);
        }
        // dd($filter);
        if (!empty($status)) {
            $orders = $orders->whereIn('orders.order_status', $status);
        } 
        if (!empty($provide_name)) {
            $orders = $orders->whereIn('orders.provide_id', $provide_name);
        }

        if (!empty($name)) {
            $orders = $orders->whereIn('users.name', $name);
        }
        if (!empty($date)) {
            $orders = $orders->wherebetween('orders.updated_at', $date);
        }
        if (!empty($keywords)) {
            $orders = $orders->where(function ($query) use ($keywords) {
                $query->orWhere('orders.id', 'like', '%' . $keywords . '%');
                $query->orWhere('users.name', 'like', '%' . $keywords . '%');
                $query->orWhere('provides.provide_name', 'like', '%' . $keywords . '%');
            });
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "orders." . $orderBy;
            };
            if ($orderBy == 'id') {
                $orderBy = "orders." . $orderBy;
            };
            $orders = $orders->orderBy($orderBy, $orderType);

        }

        $orders = $orders->orderBy('orders.created_at', 'asc')->paginate(10);
        return $orders;
    }
    // public function getProvide()
    // {
    //     return $this->hasOne(Provides::class,'id','provide_id');
    // }
}
