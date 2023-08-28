<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getAllOrders($filter = [], $perPage, $status = [], $provide_name = [], $name = [], $date = [], $keywords = null, $orderBy = null, $orderType = null)
    {
        $productIds = array();
        $order = Orders::orderByDesc('id')->get();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
        $orders = Orders::join('users', 'users.id', '=', 'orders.users_id')
            ->leftJoin('provides', 'provides.id', '=', 'orders.provide_id')
            ->select('orders.id', 'orders.product_code', 'provides.provide_name', 'users.name', 'orders.total', 'orders.total_tax',  'orders.created_at', 'orders.updated_at', 'order_status')
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

        $orders = $orders->orderBy('orders.id', 'desc')->paginate($perPage);
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
            ->where('orders.order_status', '=', 1)
            ->get();
        return $orders;
    }
    public function maxdate()
    {
        $exports = DB::table($this->table)
            ->where('order_status', 1)
            ->get();

        $maxdate = $exports->MAX('created_at');

        $formattedDate = date('d-m-Y', strtotime($maxdate));

        return $formattedDate;
    }
    public function getMinDateOrders()
    {
        $minDate = DB::table($this->table)
            ->selectRaw('MIN(DATE(created_at)) AS min_date')
            ->first();
    
        // Check if $minDate is not null before formatting
        if ($minDate && $minDate->min_date) {
            // Format the date in dd-mm-yyyy format
            $formattedDate = date('d-m-Y', strtotime($minDate->min_date));
            return $formattedDate;
        }
    
        return null; // Return null if there is no minimum date
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
    public function getNameProvide()
    {
        return $this->hasOne(Provides::class, 'id', 'provide_id');
    }
    public function getNameUsers()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    public function reportOrders($filter = [], $name = [], $roles = [], $orderBy = null, $orderType = null)
    {
        $tableorders = Orders::leftJoin('users', 'users.id', 'orders.users_id')
            ->leftJoin('roles', 'users.roleid', 'roles.id')
            ->leftJoin('debts', 'debts.export_id', 'orders.id')
            ->select('users.name as nhanvien', 'roles.name as vaitro', 'users.email as email', 'users.id as userid')
            ->where('orders.order_status', 1)
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->where('orders.order_status', 1)
                    ->whereColumn('orders.users_id', 'users.id')
                    ->selectRaw('COUNT(id)');
            }, 'product_qty_count')

            ->selectSub(function ($query) {
                $query->from('orders')
                    ->whereColumn('orders.users_id', 'users.id')
                    ->selectRaw('SUM(orders.total_tax)')
                    ->where('orders.order_status', 1);
            }, 'total_sum')

            ->selectSub(function ($query) {
                $query->from('debt_import')
                    ->whereColumn('debt_import.user_id', 'users.id')
                    ->where('debt_import.debt_status', '!=', 1)
                    ->selectRaw('SUM(total_import)');
            }, 'total_debt')->distinct();
        if (!empty($filter)) {
            $tableorders = $tableorders->where($filter);
        }
        if (!empty($name)) {
            $tableorders = $tableorders->whereIn('users.name', $name);
        }
        if (!empty($roles)) {
            $tableorders = $tableorders->whereIn('users.roleid', $roles);
        }
        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "orders." . $orderBy;
            };
            $tableorders = $tableorders->orderBy('orders.id', $orderType);
        }
        $tableorders = $tableorders->get();
        return $tableorders;
    }
    public function dataReportAjax($filter = [])
    {
        $tableorders = Orders::leftJoin('users', 'users.id', 'orders.users_id')
            ->leftJoin('roles', 'users.roleid', 'roles.id')
            ->leftJoin('debts', 'debts.export_id', 'orders.id')
            ->select('users.name as nhanvien', 'roles.name as vaitro', 'users.email as email', 'users.id as userid')
            ->where('orders.order_status', 1)
            ->selectSub(function ($query) use ($filter) {
                $query->from('orders')
                    ->where('orders.order_status', 1)
                    ->whereColumn('orders.users_id', 'users.id')
                    ->when(!empty($filter), function ($query) use ($filter) {
                        $startDate = $filter[0];
                        $endDate = $filter[1];
                        return $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->selectRaw('COUNT(id)');
            }, 'product_qty_count')
            ->selectSub(function ($query) use ($filter) {
                $query->from('orders')
                    ->whereColumn('orders.users_id', 'users.id')
                    ->when(!empty($filter), function ($query) use ($filter) {
                        $startDate = $filter[0];
                        $endDate = $filter[1];
                        return $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->selectRaw('SUM(orders.total_tax)')
                    ->where('orders.order_status', 1);
            }, 'total_sum')
            ->selectSub(function ($query) use ($filter) {
                $query->from('debt_import')
                    ->whereColumn('debt_import.user_id', 'users.id')
                    ->where('debt_import.debt_status', '!=', 1)
                    ->when(!empty($filter), function ($query) use ($filter) {
                        $startDate = $filter[0];
                        $endDate = $filter[1];
                        return $query->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->selectRaw('SUM(total_import)');
            }, 'total_debt')
            ->distinct();
        $tableorders = $tableorders->get();
        return $tableorders;
    }
    public function getStatus()
    {
        return $this->hasOne(DebtImport::class, 'import_id', 'id');
    }

    public function delBillCamcel($id)
    {
        $check = DB::table($this->table)->where('id', $id)
            ->where('order_status', 2)
            ->first();
        if ($check) {
            DB::table($this->table)->where('id', $id)->delete();
            return $status = 0;
        } else {
            return $status = 1;
        }
    }

    public function accessBill($list_ID)
    {
        $check = DB::table($this->table)->whereIn('id', $list_ID)->get();
        $status = 1;
        foreach ($check as $c) {
            if ($c->order_status == 0) {
                $status = 0;
                DB::table($this->table)->where('id', $c->id)->update(['order_status' => 1]);
                $productOrders = ProductOrders::where('order_id', $c->id)->get();
                foreach ($productOrders as $order) {
                    $product = Product::create([
                        'product_name' => $order->product_name,
                        'product_unit' => $order->product_unit,
                        'product_qty' => $order->product_qty,
                        'product_price' => $order->product_price,
                        'product_tax' => $order->product_tax,
                        'product_total' => $order->product_total,
                        'provide_id' => $order->provide_id,
                        'product_trademark' => $order->product_trademark,
                        'product_code' => $order->getOrderCode === null ? "" : $order->getOrderCode->product_code,
                        'created_at' => $c->created_at
                    ]);
                    $order->update(['product_id' => $product->id]);
                }
                $NCC = Provides::find($c->provide_id);

                $startDate = Carbon::parse($c->created_at);
                $daysToAdd = $NCC->debt;

                $endDate = $startDate->copy()->addDays($daysToAdd);

                $endDateFormatted = $endDate->format('Y-m-d');

                $endDate = Carbon::parse($endDate);

                $currentDate = Carbon::now();

                $daysDiffss = $currentDate->diffInDays($endDate);

                if ($endDate < $currentDate) {
                    $daysDiff = -$daysDiffss;
                } else {
                    $daysDiff = $daysDiffss;
                }

                if ($NCC->debt == 0) {
                    $debt_status = 4;
                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt_status = 2;
                } elseif ($daysDiff == 0) {
                    $debt_status = 5;
                } elseif ($daysDiff < 0) {
                    $debt_status = 0;
                } else {
                    $debt_status = 3;
                }

                DebtImport::create([
                    'provide_id' => $c->provide_id,
                    'user_id' => $c->users_id,
                    'import_id' => $c->id,
                    'total_import' => $c->total_tax,
                    'debt' => $NCC->debt,
                    'date_start' => $c->created_at,
                    'date_end' => $endDateFormatted,
                    'debt_status' => $debt_status,
                    'created_at' => $c->created_at
                ]);
            }
        }
        return $status;
    }

    public function checkExist($id)
    {
        $check = DB::table($this->table)->where('id', $id)
            ->where('order_status', 1)
            ->first();
        if ($check) {
            return $status = 0;
        } else {
            return $status = 1;
        }
    }
}
