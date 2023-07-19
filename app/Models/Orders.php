<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'provide_id', 'users_id', 'order_status', 'total', 'created_at', 'updated_at', 'product_code'
    ];
    protected $table = 'orders';

    public function getAllOrders($filter = [], $status = [], $provide_name = [], $name = [], $date = [], $keywords = null, $orderBy = null, $orderType = null)
    {
        $productIds = array();
        $order = Orders::orderByDesc('id')->get();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
        $orders = Orders::join('users', 'users.id', '=', 'orders.users_id')
            ->leftJoin('provides', 'provides.id', '=', 'orders.provide_id')
            ->select('orders.id', 'orders.product_code', 'provides.provide_name', 'users.name', 'orders.total', 'orders.created_at', 'orders.updated_at', 'order_status')
            ->whereIn('orders.id', $productIds);
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
            $orders = $orders->wherebetween('orders.created_at', $date);
        }
        if (!empty($keywords)) {
            $orders = $orders->where(function ($query) use ($keywords) {
                $query->orWhere('orders.product_code', 'like', '%' . $keywords . '%');
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

        $orders = $orders->orderBy('orders.id', 'desc')->paginate(20);
        return $orders;
    }
    // public function getProvide()
    // {
    //     return $this->hasOne(Provides::class,'id','provide_id');
    // }
    public function allOrders()
    {
        $startDate = now()->subDays(30); // Ngày bắt đầu là ngày hiện tại trừ đi 30 ngày
        $endDate = now(); // Ngày kết thúc là ngày hiện tại
        $orders = DB::table($this->table)
            ->where('order_status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return $orders;
    }

    public function allNhaphang()
    {
        $orders = DB::table($this->table)
            ->get();
        return $orders;
    }
    public function getMinDateOrders()
    {
        $minDate = DB::table($this->table)
            ->selectRaw('MIN(DATE(created_at)) AS min_date')
            ->first();
        return $minDate->min_date;
    }

    public function sumTotalOrders()
    {
        $startDate = now()->subDays(30); // Ngày bắt đầu là ngày hiện tại trừ đi 30 ngày
        $endDate = now(); // Ngày kết thúc là ngày hiện tại

        $totalSum = DB::table($this->table)
            ->where('order_status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');

        return $totalSum;
    }

    public function addOrder($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateOrder($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
}
