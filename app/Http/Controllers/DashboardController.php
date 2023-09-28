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
use Illuminate\Support\Facades\Auth;
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
            $query->from('orders')
                ->where('orders.order_status', '=', 1)
                ->where('orders.license_id', Auth::user()->license_id)
                ->selectRaw('count(id)');
        }, 'countID')
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->selectRaw('SUM(total_tax)');
            }, 'sumTotal') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxCreatedAt')
            ->first();
        if ($count) {
            $minCreatedAt = $count->minCreatedAt;
            $maxCreatedAt = $count->maxCreatedAt;
            $ordersAll = [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $minCreatedAt ? Carbon::parse($minCreatedAt)->format('d-m-Y') : null,
                'end_date' => $maxCreatedAt ? Carbon::parse($maxCreatedAt)->format('d-m-Y') : null,
            ];
        } else {
            $ordersAll = [
                'countID' => 0,
                'sumTotal' => 0,
                'start_date' => null, // Định dạng lại ngày bắt đầu
                'end_date' => null, // Định dạng lại ngày hôm nay
            ];
        }
        $countExport = Exports::selectSub(function ($query) {
            $query->from('exports')
                ->where('exports.export_status', '=', 2)
                ->where('exports.license_id', Auth::user()->license_id)
                ->selectRaw('count(id)');
        }, 'countExport')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', '=', 2)
                    ->where('exports.license_id', Auth::user()->license_id)
                    ->selectRaw('SUM(total)');
            }, 'sumExport') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', '=', 2)
                    ->where('exports.license_id', Auth::user()->license_id)

                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', '=', 2)
                    ->where('exports.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxCreatedAt')
            ->first();
        if ($countExport) {
            $minCreatedAt = $countExport->minCreatedAt;
            $maxCreatedAt = $countExport->maxCreatedAt;
            $exportAll = [
                'countExport' => $countExport->countExport,
                'sumExport' => $countExport->sumExport,
                'start_date' => $minCreatedAt ? Carbon::parse($minCreatedAt)->format('d-m-Y') : null,
                'end_date' => $maxCreatedAt ? Carbon::parse($maxCreatedAt)->format('d-m-Y') : null,
            ];
        } else {
            $exportAll = [
                'countExport' => 0,
                'sumExport' => 0,
                'start_date' => null, // Định dạng lại ngày bắt đầu
                'end_date' => null, // Định dạng lại ngày hôm nay
            ];
        }
        $countInvent = Product::selectSub(function ($query) {
            $query->from('product')->where('product.product_qty', '>', 0)
                ->where('product.license_id', Auth::user()->license_id)
                ->selectRaw('count(id)');
        }, 'countInventory')
            ->selectSub(function ($query) {
                $query->from('product')
                    ->where('product.product_qty', '>', 0)
                    ->where('product.license_id', Auth::user()->license_id)
                    ->selectRaw('SUM(product_total)');
            }, 'sumInventory') // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('product')
                    ->where('product.product_qty', '>', 0)
                    ->where('product.license_id', Auth::user()->license_id)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->selectSub(function ($query) {
                $query->from('product')
                    ->where('product.product_qty', '>', 0)
                    ->where('product.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxCreatedAt')
            ->first();
        if ($countInvent) {
            $minCreatedAt = $countInvent->minCreatedAt;
            $maxCreatedAt = $countInvent->maxCreatedAt;
            $inventAll = [
                'countInventory' => $countInvent->countInventory,
                'sumInventory' => $countInvent->sumInventory,
                'start_date' => $minCreatedAt ? Carbon::parse($minCreatedAt)->format('d-m-Y') : null,
                'end_date' => $maxCreatedAt ? Carbon::parse($maxCreatedAt)->format('d-m-Y') : null,
            ];
        } else {
            $inventAll = [
                'countInventory' => 0,
                'sumInventory' => 0,
                'start_date' => null, // Định dạng lại ngày bắt đầu
                'end_date' => null, // Định dạng lại ngày hôm nay
            ];
        }

        $countDebtExport = Debt::selectSub(function ($query) {
            $query->from('debts')
                ->where('debt_status', '!=', 1)
                ->where('debts.license_id', Auth::user()->license_id)
                ->selectRaw('SUM(total_sales)');
        }, 'count')->selectSub(function ($query) {
            $query->from('debts')
                ->where('debt_status', '!=', 1)
                ->where('debts.license_id', Auth::user()->license_id)
                ->selectRaw('MIN(created_at)');
        }, 'exportCreatedAt')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('debt_status', '!=', 1)
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxExportCreatedAt')->first();
        $countDebtImport = DebtImport::selectSub(function ($query) {
            $query->from('debt_import')
                ->where('debt_import.license_id', Auth::user()->license_id)
                ->where('debt_status', '!=', 1)
                ->selectRaw('SUM(total_import)');
        }, 'countDebtImport')->selectSub(function ($query) {
            $query->from('debt_import')
                ->where('debt_status', '!=', 1)
                ->where('debt_import.license_id', Auth::user()->license_id)
                ->selectRaw('MIN(created_at)');
        }, 'importCreatedAt')
            ->selectSub(function ($query) {
                $query->from('debt_import')
                    ->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxImportCreatedAt')->first();
        if ($countDebtImport && $countDebtExport) {
            $minCreatedAt = $countDebtImport->importCreatedAt;
            $minCreatedAt12 = $countDebtExport->exportCreatedAt;
            $maxCreatedAt = $countDebtImport->maxImportCreatedAt;
            $maxCreatedAt12 = $countDebtExport->maxExportCreatedAt;

            // Kiểm tra và thiết lập giá trị cho smallerDate và MAXDate
            $smallerDate = $minCreatedAt ? Carbon::parse($minCreatedAt)->min($minCreatedAt12) : null;
            $MAXDate = $maxCreatedAt ? Carbon::parse($maxCreatedAt)->max($maxCreatedAt12) : null;

            $debts = [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $countDebtExport->count,
                'start_date' => $smallerDate ? $smallerDate->format('d-m-Y') : null,
                'end_date' => $MAXDate ? $MAXDate->format('d-m-Y') : null,
            ];
        } else if ($countDebtImport && !$countDebtExport) {
            $minCreatedAt = $countDebtImport->importCreatedAt;
            $maxCreatedAt = $countDebtImport->maxImportCreatedAt;
            $debts = [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => 0,
                'start_date' => $minCreatedAt ? Carbon::parse($minCreatedAt)->format('d-m-Y') : null,
                'end_date' => $maxCreatedAt ? Carbon::parse($maxCreatedAt)->format('d-m-Y') : null,
            ];
        } else {
            $debts = [
                'debt_import' => 0,
                'debt_export' => 0,
                'start_date' => null,
                'end_date' => null,
            ];
        }
        $countProfit = Debt::selectSub(function ($query) {
            $query->from('debts')
                ->where('debts.license_id', Auth::user()->license_id)
                ->selectRaw('sum(total_difference)');
        }, 'countProfit')
            // Lấy ngày created_at bé nhất
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('MIN(created_at)');
            }, 'minCreatedAt')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxCreatedAt')
            ->first();
        if ($countProfit) {
            $minCreatedAt = $countProfit->minCreatedAt;
            $maxCreatedAt = $countProfit->maxCreatedAt;

            $profitAll = [
                'countProfit' => $countProfit->countProfit,
                'start_date' => $minCreatedAt ? Carbon::parse($minCreatedAt)->format('d-m-Y') : null,
                'end_date' => $maxCreatedAt ? Carbon::parse($maxCreatedAt)->format('d-m-Y') : null,
            ];
        } else {
            $profitAll = [
                'countProfit' => 0,
                'start_date' => null, // Định dạng lại ngày bắt đầu
                'end_date' => null, // Định dạng lại ngày hôm nay
            ];
        }

        if (Auth::user()->roleid == 0) {
            return redirect()->route('admin.manageruser');
        } else {
            return view('index', compact('title', 'orders', 'ordersAll', 'exportAll', 'inventAll', 'debts', 'profitAll', 'getMinDateOrders'));
        }
    }

    // Nhập hàng
    public function count(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        // Xử lý lấy tất cả hơn nhập
        if ($data['data'] == 0) {
            $count = Orders::selectSub(function ($query) {
                $query->from('orders')
                    ->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->selectRaw('count(id)');
            }, 'countID')
                ->selectSub(function ($query) {
                    $query->from('orders')
                        ->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('orders')
                        ->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->selectSub(function ($query) {
                    $query->from('orders')
                        ->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->selectRaw('MAX(created_at)');
                }, 'maxCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $maxCreatedAt = Carbon::parse($count->maxCreatedAt);
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $maxCreatedAt->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d'); // Ngày kết thúc của tháng, đã được định dạng

            $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('orders')->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $today->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->where('orders.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->where('orders.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->where('orders.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->where('orders.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
            }
            return [
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Orders::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('orders')->where('orders.order_status', '=', 1)
                    ->where('orders.license_id', Auth::user()->license_id)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->where('orders.license_id', Auth::user()->license_id)
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
                    ->where('exports.license_id', Auth::user()->license_id)
                    ->selectRaw('count(id)');
            }, 'countExport')
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->selectRaw('SUM(total)');
                }, 'sumExport') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->selectRaw('MAX(created_at)');
                }, 'maxCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $maxCreatedAt = Carbon::parse($count->maxCreatedAt);

            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $maxCreatedAt->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d'); // Ngày kết thúc của tháng, đã được định dạng
            $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->where('exports.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('COUNT(id)');
            }, 'countExport')
                ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total)');
                }, 'sumExport')
                ->first();
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $today->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->where('exports.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->where('exports.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            }
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->where('exports.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->where('exports.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
            }
            return [
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Exports::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->where('exports.license_id', Auth::user()->license_id)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countExport')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->where('exports.license_id', Auth::user()->license_id)
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
                    ->where('product.license_id', Auth::user()->license_id)
                    ->selectRaw('count(id)');
            }, 'countInventory')
                ->selectSub(function ($query) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->selectRaw('SUM(product_total)');
                }, 'sumInventory') // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->selectSub(function ($query) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->selectRaw('MAX(created_at)');
                }, 'maxCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $maxCreatedAt = Carbon::parse($count->maxCreatedAt);

            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $maxCreatedAt->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d');
            $count = Product::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->where('product.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('COUNT(id)');
            }, 'countInventory')
                ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(product_total)');
                }, 'sumInventory')
                ->first();
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $today->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = Carbon::today()->format('Y-m-d');
                $count = Product::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->where('product.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Product::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->where('product.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            }
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Product::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->where('product.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Product::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countInventory')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('product')->where('product.product_qty', '>', 0)
                            ->where('product.license_id', Auth::user()->license_id)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(product_total)');
                    }, 'sumInventory')
                    ->first();
            }
            return [
                'countInventory' => $count->countInventory,
                'sumInventory' => $count->sumInventory,
                'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Product::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('product')->where('product.product_qty', '>', 0)
                    ->where('product.license_id', Auth::user()->license_id)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('COUNT(id)');
            }, 'countInventory')
                ->selectSub(function ($query) use ($date_start, $date_end) {
                    $query->from('product')->where('product.product_qty', '>', 0)
                        ->where('product.license_id', Auth::user()->license_id)
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
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('SUM(total_sales)');
            }, 'count')->selectSub(function ($query) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('MIN(created_at)');
            }, 'exportCreatedAt')
                ->selectSub(function ($query) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->selectRaw('MAX(created_at)');
                }, 'maxExportCreatedAt')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->selectSub(function ($query) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->selectRaw('MIN(created_at)');
            }, 'importCreatedAt')->selectSub(function ($query) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->selectRaw('MAX(created_at)');
            }, 'maxImportCreatedAt')->first();

            $minCreatedAt = Carbon::parse($countDebtImport->importCreatedAt);
            $minCreatedAt12 = Carbon::parse($count->exportCreatedAt);
            $smallerDate = $minCreatedAt->min($minCreatedAt12);
            $maxCreatedAt = Carbon::parse($countDebtImport->maxImportCreatedAt);
            $maxCreatedAt12 = Carbon::parse($count->maxExportCreatedAt);
            $maxDate = $maxCreatedAt->max($maxCreatedAt12);
            return [
                'debt_import' => $countDebtImport->countDebtImport,
                'debt_export' => $count->count,
                'start_date' => $smallerDate->format('d-m-Y'),
                'end_date' => $maxDate->format('d-m-Y'),
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d');
            $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('SUM(total_sales)');
            }, 'count')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->first();
            if ($count) {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => $count->count,
                    'start_date' => $today->startOfMonth()->format('d-m-Y'),
                    'end_date' => $today->endOfMonth()->format('d-m-Y')
                ];
            } else {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => 0,
                    'start_date' => $today->startOfMonth()->format('d-m-Y'),
                    'end_date' => $today->endOfMonth()->format('d-m-Y')
                ];
            }
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->where('debt_import.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->where('debt_import.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            }
            if ($count) {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => $count->count,
                    'start_date' => $lastMonth->startOfMonth()->format('d-m-Y'),
                    'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
                ];
            } else {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => 0,
                    'start_date' => $lastMonth->startOfMonth()->format('d-m-Y'),
                    'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
                ];
            }
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->where('debt_import.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'count')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->where('debt_import.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
            }
            if ($count) {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => $count->count,
                    'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                    'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
                ];
            } else {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => 0,
                    'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                    'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
                ];
            }
        } else {
            $date_start = Carbon::parse($data['date_start'])->format('Y-m-d');
            $date_end = Carbon::parse($data['date_end'])->format('Y-m-d');
            $count = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$date_start, $date_end])
                    ->selectRaw('SUM(total_sales)');
            },  'count')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('debt_import.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$date_start, $date_end])
                    ->selectRaw('SUM(total_import)');
            },  'countDebtImport')->first();
            array_push($data1, $count);
            array_push($data1, $countDebtImport);
            if ($count) {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => $count->count,
                ];
            } else {
                return [
                    'debt_import' => $countDebtImport->countDebtImport,
                    'debt_export' => 0,
                ];
            }
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
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                // Lấy ngày created_at bé nhất
                ->selectSub(function ($query) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->selectRaw('MIN(created_at)');
                }, 'minCreatedAt')
                ->selectSub(function ($query) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->selectRaw('MAX(created_at)');
                }, 'maxCreatedAt')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $maxCreatedAt = Carbon::parse($count->maxCreatedAt);

            return [
                'countProfit' => $count->countProfit,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $maxCreatedAt->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d');
            $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debts')
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $today->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            }
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $lastMonth->startOfMonth()->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->where('debts.license_id', Auth::user()->license_id)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
            }
            return [
                'countProfit' => $count->countProfit,
                'start_date' => $lastMonth->startOfMonth()->subMonths(2)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
            ];
        } else {
            $date_start = Carbon::parse($data['date_start']);
            $date_end = Carbon::parse($data['date_end']);
            $count = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')
                    ->where('debts.license_id', Auth::user()->license_id)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            return $count;
        }
    }
}
