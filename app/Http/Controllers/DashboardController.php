<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
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
        $today = Carbon::today();
        $count = Orders::selectSub(function ($query) {
            $query->from('Orders')->where('orders.order_status', '=', 1)
                ->selectRaw('count(id)');
        }, 'countID')
            ->selectSub(function ($query) {
                $query->from('Orders')->where('orders.order_status', '=', 1)
                    ->selectRaw('SUM(total_tax)');
            }, 'sumTotal') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('Orders')->where('orders.order_status', '=', 1)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->first();
        $minCreatedAt = Carbon::parse($count->minCreatedAt);
        $ordersAll = [
            'countID' => $count->countID,
            'sumTotal' => $count->sumTotal,
            'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
            'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
        ];
        $countExport = Exports::selectSub(function ($query) {
            $query->from('exports')->where('exports.export_status', '=', 2)
                ->selectRaw('count(id)');
        }, 'countExport')
            ->selectSub(function ($query) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->selectRaw('SUM(total)');
            }, 'sumExport') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->first();
        $minCreatedAt = Carbon::parse($countExport->minCreatedAt);
        $exportAll = [
            'countExport' => $countExport->countExport,
            'sumExport' => $countExport->sumExport,
            'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
            'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
        ];
        $countInvent = Product::selectSub(function ($query) {
            $query->from('product')->where('product.product_qty', '>', 0)
                ->selectRaw('count(id)');
        }, 'countInventory')
            ->selectSub(function ($query) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->selectRaw('SUM(product_total)');
            }, 'sumInventory') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->first();
        $minCreatedAt = Carbon::parse($countInvent->minCreatedAt);
        $inventAll = [
            'countInventory' => $countInvent->countInventory,
            'sumInventory' => $countInvent->sumInventory,
            'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
            'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
        ];

        $countDebtExport = Debt::selectSub(function ($query) {
            $query->from('debts')->where('debt_status', '!=', 1)
                ->selectRaw('SUM(total_sales)');
        }, 'count')->selectSub(function ($query) {
            $query->from('debts')->where('debt_status', '!=', 1)
                ->selectRaw('MIN(created_at)');
        }, 'exportCreatedAt')->first();
        $countDebtImport = DebtImport::selectSub(function ($query) {
            $query->from('debt_import')->where('debt_status', '!=', 1)
                ->selectRaw('SUM(total_import)');
        }, 'countDebtImport')->selectSub(function ($query) {
            $query->from('debt_import')->where('debt_status', '!=', 1)
                ->selectRaw('MIN(created_at)');
        }, 'importCreatedAt')->first();

        $minCreatedAt = Carbon::parse($countDebtImport->importCreatedAt);
        $minCreatedAt12 = Carbon::parse($countDebtExport->exportCreatedAt);
        $smallerDate = $minCreatedAt->min($minCreatedAt12);
        $debts = [
            'debt_import' => $countDebtImport->countDebtImport,
            'debt_export' => $countDebtExport->count,
            'start_date' => $smallerDate->format('d-m-Y'),
            'end_date' => $today->format('d-m-Y'),
        ];
        $countProfit = Debt::selectSub(function ($query) {
            $query->from('debts')
                ->selectRaw('sum(total_difference)');
        }, 'countProfit')
            // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->first();
        $minCreatedAt = Carbon::parse($countProfit->minCreatedAt);

        $profitAll =[
            'countProfit' => $countProfit->countProfit,
            'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
            'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
        ];

        return view('index', compact('title', 'orders', 'ordersAll', 'exportAll','inventAll','debts','profitAll', 'getMinDateOrders'));
    }

    // Nhập hàng
    public function count(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Orders::selectSub(function ($query) {
                $query->from('Orders')->where('orders.order_status', '=', 1)
                    ->selectRaw('count(id)');
            }, 'countID')
                ->selectSub(function ($query) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = Carbon::today()->format('d-m-Y'); // Ngày kết thúc của tháng, đã được định dạng            
            $count = Orders::selectSub(function ($query) use ($today) {
                $query->from('Orders')->where('orders.order_status', '=', 1)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($today) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')->where('orders.order_status', '=', 1)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')->where('orders.order_status', '=', 1)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')->where('orders.order_status', '=', 1)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Orders::selectSub(function ($query) use ($lastMonth) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('Orders')->where('orders.order_status', '=', 1)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Orders::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('Orders')->where('orders.order_status', '=', 1)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('Orders')->where('orders.order_status', '=', 1)
                        ->where('created_at', '>=', $date_start)
                        ->where('created_at', '<=', $date_end)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return $count;
        }
    }
    // Xuất hàng
    public function countExport(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn xuất
        if ($data['data'] == 0) {
            $count = Exports::selectSub(function ($query) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->selectRaw('count(id)');
            }, 'countExport')
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->selectRaw('SUM(total)');
                }, 'sumExport') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = Carbon::today()->format('d-m-Y');
            $count = Exports::selectSub(function ($query) use ($today) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('COUNT(id)');
            }, 'countExport')
                ->selectSub(function ($query) use ($today) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year)
                        ->selectRaw('SUM(total)');
                }, 'sumExport')
                ->first();
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Exports::selectSub(function ($query) use ($lastMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Exports::selectSub(function ($query) use ($lastMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            }
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Exports::selectSub(function ($query) use ($lastMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Exports::selectSub(function ($query) use ($lastMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            }
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Exports::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countExport')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('created_at', '>=', $date_start)
                        ->where('created_at', '<=', $date_end)
                        ->selectRaw('SUM(total)');
                }, 'sumExport')
                ->first();
            return $count;
        }
    }

    // Tồn kho
    public function countInventory(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Product::selectSub(function ($query) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->selectRaw('count(id)');
            }, 'countInventory')
                ->selectSub(function ($query) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->selectRaw('SUM(product_total)');
                }, 'sumInventory') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = Carbon::today()->format('d-m-Y');
            $count = Product::selectSub(function ($query) use ($today) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('COUNT(id)');
            }, 'countInventory')
                ->selectSub(function ($query) use ($today) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year)
                        ->selectRaw('SUM(product_total)');
                }, 'sumInventory')
                ->first();
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = Carbon::today()->format('d-m-Y');
                $count = Product::selectSub(function ($query) use ($lastMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Product::selectSub(function ($query) use ($lastMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            }
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Product::selectSub(function ($query) use ($lastMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Product::selectSub(function ($query) use ($lastMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($lastMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->whereMonth('created_at', '>=', $lastMonth->month)
                            ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                            ->whereYear('created_at', $lastMonth->year)
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            }
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Product::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countInventory')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('created_at', '>=', $date_start)
                        ->where('created_at', '<=', $date_end)
                        ->selectRaw('SUM(product_total)');
                }, 'sumInventory')
                ->first();
            return $count;
        }
    }

    // Công nợ
    public function countDebt(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        $data1 = [];
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Debt::selectSub(function ($query) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->selectRaw('SUM(total_sales)');
            }, 'count')->selectSub(function ($query) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->selectRaw('MIN(created_at)');
            }, 'exportCreatedAt')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->selectSub(function ($query) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->selectRaw('MIN(created_at)');
            }, 'importCreatedAt')->first();

            $minCreatedAt = Carbon::parse($countDebtImport->importCreatedAt);
            $minCreatedAt12 = Carbon::parse($count->exportCreatedAt);
            $smallerDate = $minCreatedAt->min($minCreatedAt12);
            return [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $count->count,
                'start_date' => $smallerDate->format('d-m-Y'),
                'end_date' => $today->format('d-m-Y'),
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = Carbon::today()->format('d-m-Y');
            $count = Debt::selectSub(function ($query) use ($today) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('SUM(total_sales)');
            }, 'count')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) use ($today) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->first();
            return [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $count->count,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debt_import')
                        ->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            }
            return [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $count->count,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            }
            return [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $count->count,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('SUM(total_sales)');
            },  'count')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('SUM(total_import)');
            },  'countDebtImport')->first();
            array_push($data1, $count);
            array_push($data1, $countDebtImport);
            return $data1;
        }
    }

    // Lợi nhuận
    public function countProfit(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Debt::selectSub(function ($query) {
                $query->from('debts')
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('debts')
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);

            return [
                'countProfit' => $count->countProfit,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = Carbon::today()->format('d-m-Y');
            $count = Debt::selectSub(function ($query) use ($today) {
                $query->from('debts')
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            }
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('d-m-Y');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y');
                $count = Debt::selectSub(function ($query) use ($lastMonth) {
                    $query->from('debts')
                        ->whereMonth('created_at', '>=', $lastMonth->month)
                        ->whereMonth('created_at', '<=', ($lastMonth->month + 2))
                        ->whereYear('created_at', $lastMonth->year)
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            }
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $firstDayOfMonth,
                'end_date' => $lastDayOfMonth
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            return $count;
        }
    }
}
