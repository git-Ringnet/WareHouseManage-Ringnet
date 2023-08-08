<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\Exports;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use ZipArchive;

class ReportController extends Controller
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
    public function indexExport(Request $request)
    {
        $title = 'Báo cáo xuất hàng';
        //Tổng đơn xuất
        $exports = $this->exports->alldonxuat();
        $exports = count($exports);
        //Tổng tiền xuất
        $sumExport = $this->exports->tongtienxuat();
        //Tổng lợi nhuận
        $sumLoinhuan = Debt::select(DB::raw('SUM(total_difference) as tongLoiNhuan'))->limit(1)->first();
        $formattedLoinhuan = $sumLoinhuan->tongLoiNhuan;
        //Tổng công nợ
        $sumCongNo = Debt::select(DB::raw('SUM(total_sales) as tongCongNo'))
            ->where('debts.debt_status', '!=', 1)->limit(1)->first();
        $CongNo = $sumCongNo->tongCongNo;
        $mindate = $this->exports->mindate();


        $filters = [];
        //Name
        $nhanvien = [];
        $string = [];

        if (!empty($request->nhanvien)) {
            $nhanvien = $request->input('nhanvien', []);
            array_push($string, ['label' => 'Nhân viên:', 'values' => $nhanvien, 'class' => 'name']);
        }
        if (!empty($request->email)) {
            $email = $request->email;
            array_push($filters, ['email', 'like', '%' . $email . '%']);
            $nameArr = explode(',.@', $email);
            array_push($string, ['label' => 'Email:', 'values' => $nameArr, 'class' => 'email']);
        }
        $roles = [];
        if (!empty($request->roles)) {
            $roles = $request->input('roles', []);
            if (!empty($roles)) {
                $selectedRoles = Roles::whereIn('id', $roles)->get();
                $selectedRoleNames = $selectedRoles->pluck('name')->toArray();
            }
            array_push($string, ['label' => 'Vai trò:', 'values' => $selectedRoleNames, 'class' => 'roles']);
        }
        // Tổng đơn xuất
        if (!empty($request->import_operator) && !empty($request->sum_import)) {
            $sum = $request->input('sum_import');
            $import_operator = $request->input('import_operator');
            // $filters[] = ['donxuat', $import_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng đơn xuất ' . $import_operator, 'values' => $importArray, 'class' => 'sum-import']);
        }
        // Tổng tiền xuất
        if (!empty($request->sale_operator) && !empty($request->sum_sale)) {
            $sum = $request->input('sum_sale');
            $sale_operator = $request->input('sale_operator');
            // $filters[] = ['tongtienxuat', $sale_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền xuất ' . $sale_operator, 'values' => $saleArray, 'class' => 'sum-sale']);
        }
        // Lợi nhuận
        if (!empty($request->difference_operator) && !empty($request->sum_difference)) {
            $sum = $request->input('sum_difference');
            $difference_operator = $request->input('difference_operator');
            // $filters[] = ['tongloinhuan', $difference_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền chênh lệch ' . $difference_operator, 'values' => $inventoryArray, 'class' => 'sum-difference']);
        }
        // Công nợ
        if (!empty($request->sum_debt_operator) && !empty($request->sum_debt)) {
            $sum = $request->input('sum_debt');
            $sum_debt_operator = $request->input('sum_debt_operator');
            // $filters[] = ['tongloinhuan', $difference_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng công nợ ' . $sum_debt_operator, 'values' => $inventoryArray, 'class' => 'sum-difference']);
        }

        $debtsSale = Exports::leftjoin('users', 'exports.user_id', '=', 'users.id')->where('exports.export_status', 2)->get();
        $sortType = $request->input('sort-type');
        $sortBy = $request->input('sort-by');
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'desc';
        }
        $allRoles = new Roles();
        $allRoles = $allRoles->getAll();
        $Tableexports = $this->exports->reportExports($filters, $nhanvien, $roles, $sortBy, $sortType);
        $perPage = $request->input('perPageinput', 10);
        return view('tables.report.report-export', compact('perPage','mindate', 'title', 'debtsSale', 'allRoles', 'string', 'Tableexports', 'sortType', 'exports', 'sumExport', 'formattedLoinhuan', 'CongNo'));
    }


    // Nhập hàng
    public function indexImport(Request $request)
    {
        $title = 'Báo cáo nhập hàng';
        //Tổng đơn nhập
        $orders = $this->orders->allNhaphang();
        $orders = count($orders);
        //Tổng tiền đơn nhập + vat
        $totalSum = Orders::select(DB::raw('SUM(orders.total_tax) as total_sum'))
            ->where('orders.order_status', 1)
            ->limit(1)
            ->first();
        $sumTotalOrders = $totalSum->total_sum;
        //Tổng công nợ + vat
        $sumDebtImport = DebtImport::select(DB::raw('SUM(total_import) as total_import'))
            ->where('debt_import.debt_status', '!=', 1)->limit(1)
            ->first();
        $sumDebtImportVAT = $sumDebtImport->total_import;
        //table nhập hàng

        //Tổng đơn xuất
        $exports = $this->exports->alldonxuat();
        $exports = count($exports);
        //Tổng tiền xuất
        $sumExport = $this->exports->tongtienxuat();
        //Tổng lợi nhuận
        $sumLoinhuan = Debt::select(DB::raw('SUM(total_difference) as tongLoiNhuan'))->limit(1)->first();
        $formattedLoinhuan = number_format($sumLoinhuan->tongLoiNhuan);
        //Tổng công nợ
        $sumCongNo = Debt::select(DB::raw('SUM(total_sales) as tongCongNo'))->limit(1)->first();
        $CongNo = $sumCongNo->tongCongNo;
        $mindate = $this->orders->getMinDateOrders();

        $filters = [];
        //Name
        $nhanvien = [];
        $string = [];

        if (!empty($request->nhanvien)) {
            $nhanvien = $request->input('nhanvien', []);
            array_push($string, ['label' => 'Nhân viên:', 'values' => $nhanvien, 'class' => 'name']);
        }
        if (!empty($request->email)) {
            $email = $request->email;
            array_push($filters, ['email', 'like', '%' . $email . '%']);
            $nameArr = explode(',.@', $email);
            array_push($string, ['label' => 'Email:', 'values' => $nameArr, 'class' => 'email']);
        }
        $roles = [];
        if (!empty($request->roles)) {
            $roles = $request->input('roles', []);
            if (!empty($roles)) {
                $selectedRoles = Roles::whereIn('id', $roles)->get();
                $selectedRoleNames = $selectedRoles->pluck('name')->toArray();
            }
            array_push($string, ['label' => 'Vai trò:', 'values' => $selectedRoleNames, 'class' => 'roles']);
        }

        $debtsSale = Orders::leftjoin('users', 'orders.users_id', '=', 'users.id')->get();
        $sortType = $request->input('sort-type');
        $sortBy = $request->input('sort-by');
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'desc';
        }
        $tableorders = $this->orders->reportOrders($filters, $nhanvien, $roles, $sortBy, $sortType);
        $allRoles = new Roles();
        $allRoles = $allRoles->getAll();
        // dd($tableorders);
        $perPage = $request->input('perPageinput', 10);
        return view('tables.report.report-import', compact('perPage','mindate', 'title', 'allRoles', 'debtsSale', 'string', 'tableorders', 'sortType', 'orders', 'sumTotalOrders', 'sumDebtImportVAT', 'tableorders', 'exports', 'sumExport', 'formattedLoinhuan', 'CongNo'));
    }
    public function timeImport(Request $request)
    {
        $data = $request->all();
        $today = Carbon::today();
        $data1 = [];
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
            $countDebtImport = DebtImport::selectSub(function ($query) use ($today) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->whereMonth('created_at', $today->month)
                    ->whereYear('created_at', $today->year)
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $filters = [];
            $filters[] = $minCreatedAt;
            $filters[] = $today->endOfMonth()->format('Y-m-d');
            $tableorders = $this->orders->dataReportAjax($filters);
            $test1 = [];
            foreach ($tableorders as $item) {
                $test1[] = $item;
            }
            return [
                'test' => $test1,
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'countDebtImport' => $countDebtImport->countDebtImport,
                'start_date' => $minCreatedAt->format('d-m-Y'),
                'end_date' => $today->format('d-m-Y'),
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d'); // Ngày kết thúc của tháng, đã được định dạng            
            $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('orders')->where('orders.order_status', '=', 1)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('COUNT(id)');
            }, 'countID')
                ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_tax)');
                }, 'sumTotal')->first();
            $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('SUM(total_import)');
            }, 'countDebtImport')->first();
            $filters = [];
            $filters[] = $today->startOfMonth();
            $filters[] = Carbon::today();
            $tableorders = $this->orders->dataReportAjax($filters);
            $test1 = [];
            foreach ($tableorders as $item) {
                $test1[] = $item;
            }
            return [
                'test' => $test1,
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'countDebtImport' => $countDebtImport->countDebtImport,
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
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth());
                $tableorders = $this->orders->dataReportAjax($filters);
                $test1 = [];
                foreach ($tableorders as $item) {
                    $test1[] = $item;
                }
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth());
                $tableorders = $this->orders->dataReportAjax($filters);
                $test1 = [];
                foreach ($tableorders as $item) {
                    $test1[] = $item;
                }
            }
            return [
                'test' => $test1,
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'countDebtImport' => $countDebtImport->countDebtImport,
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
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth()->addMonths(2));
                $tableorders = $this->orders->dataReportAjax($filters);
                $test1 = [];
                foreach ($tableorders as $item) {
                    $test1[] = $item;
                }
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Orders::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('orders')->where('orders.order_status', '=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countID')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('orders')->where('orders.order_status', '=', 1)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total_tax)');
                    }, 'sumTotal')->first();
                $countDebtImport = DebtImport::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debt_import')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_import)');
                },  'countDebtImport')->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth()->addMonths(2));
                $tableorders = $this->orders->dataReportAjax($filters);
                $test1 = [];
                foreach ($tableorders as $item) {
                    $test1[] = $item;
                }
            }
            return [
                'test' => $test1,
                'countID' => $count->countID,
                'sumTotal' => $count->sumTotal,
                'countDebtImport' => $countDebtImport->countDebtImport,
                'start_date' => $lastMonth->startOfMonth()->subMonths(5)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
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
            $countDebtImport = DebtImport::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debt_import')->where('debt_status', '!=', 1)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('SUM(total_import)');
            },  'countDebtImport')->first();
            $filters = [];
            $filters[] = Carbon::parse($data['date_start']);
            $filters[] = Carbon::parse($data['date_end']);
            $tableorders = $this->orders->dataReportAjax($filters);
            $test1 = [];
            foreach ($tableorders as $item) {
                $test1[] = $item;
            }
            array_push($data1, $count);
            array_push($data1, $countDebtImport);
            array_push($data1, $test1);
            return $data1;
        }
    }
    public function timeExport(Request $request)
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
                ->selectSub(function ($query) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->selectRaw('MAX(created_at)');
                }, 'maxCreatedAt')
                ->first();
            $countDebt = Debt::selectSub(function ($query) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->selectRaw('SUM(total_sales)');
            }, 'countDebt')->first();
            $countProfit = Debt::selectSub(function ($query) {
                $query->from('debts')
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            $minCreatedAt = Carbon::parse($count->minCreatedAt);
            $maxCreatedAt = Carbon::parse($count->maxCreatedAt);
            $filters = [];
            $filters[] = $minCreatedAt;
            $filters[] = $today->endOfMonth()->format('Y-m-d');
            $Tableexports = $this->exports->dataReportAjax($filters);
            $test1 = [];
            foreach ($Tableexports as $item) {
                $test1[] = $item;
            }
            return [
                'test' => $test1,
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'countDebt' => $countDebt->countDebt,
                'countProfit' => $countProfit->countProfit,
                'start_date' => $minCreatedAt->format('d-m-Y'), // Định dạng lại ngày bắt đầu
                'end_date' => $today->format('d-m-Y'), // Định dạng lại ngày hôm nay
            ];
        } elseif ($data['data'] == 1) {  //Xử lý lấy dữ liệu tháng này
            $today = Carbon::today();
            $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
            $lastDayOfMonth = $today->endOfMonth()->format('Y-m-d');
            $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('exports')->where('exports.export_status', '=', 2)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('COUNT(id)');
            }, 'countExport')
                ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total)');
                }, 'sumExport')
                ->first();
            $countDebt = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('SUM(total_sales)');
            }, 'countDebt')->first();
            $countProfit = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                $query->from('debts')
                    ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            $filters = [];
            $filters[] = $today->startOfMonth();
            $filters[] = Carbon::today();
            $Tableexports = $this->exports->dataReportAjax($filters);
            $test1 = [];
            foreach ($Tableexports as $item) {
                $test1[] = $item;
            }
            return [
                'test' => $test1,
                'countDebt' => $countDebt->countDebt,
                'countProfit' => $countProfit->countProfit,
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' =>  $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $today->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 2) { //Xử lý lấy dữ liệu tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth();
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d'); // Ngày bắt đầu của tháng, đã được định dạng
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
                $countDebt = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'countDebt')->first();
                $countProfit = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth());
                $Tableexports = $this->exports->dataReportAjax($filters);
                $test1 = [];
                foreach ($Tableexports as $item) {
                    $test1[] = $item;
                }
            } else {
                $lastMonth = $today->subMonthNoOverflow();
                $firstDayOfMonth = $today->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
                $countDebt = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'countDebt')->first();
                $countProfit = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth());
                $Tableexports = $this->exports->dataReportAjax($filters);
                $test1 = [];
                foreach ($Tableexports as $item) {
                    $test1[] = $item;
                }
            }
            return [
                'test' => $test1,
                'countDebt' => $countDebt->countDebt,
                'countProfit' => $countProfit->countProfit,
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' =>  $today->startOfMonth()->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->format('d-m-Y')
            ];
        } elseif ($data['data'] == 3) { // Xử lý lấy dữ liệu 3 tháng trước
            if ($today->month == 1) {
                $lastMonth = $today->subMonth(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
                $countDebt = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'countDebt')->first();
                $countProfit = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')
                    ->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth()->addMonths(2));
                $Tableexports = $this->exports->dataReportAjax($filters);
                $test1 = [];
                foreach ($Tableexports as $item) {
                    $test1[] = $item;
                }
            } else {
                $lastMonth = $today->subMonthNoOverflow(3);
                $firstDayOfMonth = $lastMonth->startOfMonth()->format('Y-m-d');
                $lastDayOfMonth = $lastMonth->endOfMonth()->addMonths(2)->format('Y-m-d');
                $count = Exports::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('exports')->where('exports.export_status', '=', 2)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('COUNT(id)');
                }, 'countExport')
                    ->selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                        $query->from('exports')->where('exports.export_status', '=', 2)
                            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                            ->selectRaw('SUM(total)');
                    }, 'sumExport')
                    ->first();
                $countDebt = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')->where('debt_status', '!=', 1)
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('SUM(total_sales)');
                },  'countDebt')->first();
                $countProfit = Debt::selectSub(function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
                    $query->from('debts')
                        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                        ->selectRaw('sum(total_difference)');
                }, 'countProfit')->first();
                $filters = [];
                $filters[] = Carbon::parse($lastMonth->startOfMonth());
                $filters[] = Carbon::parse($lastMonth->endOfMonth()->addMonths(2));
                $Tableexports = $this->exports->dataReportAjax($filters);
                $test1 = [];
                foreach ($Tableexports as $item) {
                    $test1[] = $item;
                }
            }
            return [
                'test' => $test1,
                'countDebt' => $countDebt->countDebt,
                'countProfit' => $countProfit->countProfit,
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
                'start_date' =>  $lastMonth->startOfMonth()->subMonths(5)->format('d-m-Y'),
                'end_date' => $lastMonth->endOfMonth()->addMonths(2)->format('d-m-Y')
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
            $countProfit = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('sum(total_difference)');
            }, 'countProfit')
                ->first();
            $countDebt = Debt::selectSub(function ($query) use ($date_start, $date_end) {
                $query->from('debts')->where('debt_status', '!=', 1)
                    ->where('created_at', '>=', $date_start)
                    ->where('created_at', '<=', $date_end)
                    ->selectRaw('SUM(total_sales)');
            },  'countDebt')->first();
            $filters = [];
            $filters[] = Carbon::parse($data['date_start']);
            $filters[] = Carbon::parse($data['date_end']);
            $Tableexports = $this->exports->dataReportAjax($filters);
            $test1 = [];
            foreach ($Tableexports as $item) {
                $test1[] = $item;
            }
            return [
                'test' => $test1,
                'countDebt' => $countDebt->countDebt,
                'countProfit' => $countProfit->countProfit,
                'countExport' => $count->countExport,
                'sumExport' => $count->sumExport,
            ];
        }
    }

    // Backup DATABASE
    public function exportDatabase()
    {
        // Đường dẫn đến thư mục lưu trữ các file backup
        $backupPath = storage_path('app/backupdata/');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        // Thay đổi các thông số dưới đây nếu cần thiết
        $dbUsername = 'root';
        $dbName = 'laravel';
        $dbPass = ''; // If you have a password, provide it here.

        // Sử dụng lệnh mysqldump để xuất cơ sở dữ liệu
        $passwordOption = $dbPass !== '' ? "-p$dbPass" : "";

        // Lấy ngày giờ hiện tại của hệ thống máy tính
        $date = date('d_m_Y_H_i_s');

        // Thực hiện mysqldump để tạo file SQL và lưu vào thư mục tạm thời
        $fileName = "backup_$date.sql";
        $command = "mysqldump -u $dbUsername $passwordOption $dbName > $backupPath$fileName";
        exec($command);

        // Tạo tệp zip và nén tệp SQL vào trong đó
        $zip = new ZipArchive();
        $zipFileName = "backup_$date.zip";
        if ($zip->open($backupPath . $zipFileName, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($backupPath . $fileName, $fileName);
            $zip->close();
        }

        // Xóa tệp SQL không nén nữa
        unlink($backupPath . $fileName);

        // Trả về file backup để tải xuống
        return back()->with('msg', 'Backup dữ liệu thành công !');
    }

    // Restore DATABASE
    public function importDatabase(Request $request)
    {
        $getFile = $request->file('file');
        $name = $getFile->getClientOriginalName();
        $fullPath = storage_path('backup');

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        // Lưu file vào thư mục backup
        $getFile->move($fullPath, $name);

        $dbUsername = 'root';
        $dbName = 'laravel';
        $dbPass = '';
        $passwordOption = $dbPass !== '' ? "-p$dbPass" : "";

        $command = "mysql -u $dbUsername $passwordOption $dbName < \"$fullPath/$name\"";
        exec($command);

        // Import xong, tiến hành xóa file
        $filePath = "$fullPath/$name";
        if (file_exists($filePath)) {
            unlink($filePath); // Xóa file
        }

        return redirect()->back()->with('msg', 'Restore dữ liệu thành công !');
    }
}
