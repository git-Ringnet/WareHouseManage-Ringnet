<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $products;
    private $orders;
    private $exports;

    public function __construct()
    {
        $this->products = new Product();
        $this->orders = new Orders();
        $this->exports = new Exports();
    }
    public function index()
    {
        $title = "Trang chủ";

        // Nhập hàng
        // Tất cả
        $orders = $this->orders->allNhaphang();
        $orders = count($orders);
        $getMinDateOrders = $this->orders->getMinDateOrders();




        return view('index', compact('title', 'orders', 'getMinDateOrders'));
    }

    public function count(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Orders::selectSub(function ($query) {
                $query->from('Orders')
                    ->selectRaw('count(id)');
            }, 'countID')
                ->selectSub(function ($query) {
                    $query->from('Orders')
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return $count;
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $count = Orders::selectSub(function ($query) use ($today) {
                $query->from('Orders')
                    ->whereMonth('created_at', $today->month)
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($today) {
                    $query->from('Orders')
                        ->whereMonth('created_at', $today->month)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return $count;
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')
                        ->whereMonth('created_at', $lastMonth->month)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')
                            ->whereMonth('created_at', $lastMonth->month)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return $count;
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return $count;
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Orders::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('Orders')
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('Orders')
                        ->where('created_at', '>=', $date_start)
                        ->where('created_at', '<=', $date_end)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return $count;
        }
    }
}
