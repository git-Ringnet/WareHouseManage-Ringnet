<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\Exports;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $formattedLoinhuan = number_format($sumLoinhuan->tongLoiNhuan);
        //Tổng công nợ
        $sumCongNo = Debt::select(DB::raw('SUM(total_sales) as tongCongNo'))->limit(1)->first();
        $CongNo = $sumCongNo->tongCongNo;


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

        $debtsSale = Exports::leftjoin('users', 'exports.user_id', '=', 'users.id')->get();
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
        $Tableexports = $this->exports->reportExports($filters, $nhanvien, $sortBy, $sortType);
        return view('tables.report.report-export', compact('title', 'debtsSale', 'allRoles', 'string', 'Tableexports', 'sortType', 'exports', 'sumExport', 'formattedLoinhuan', 'CongNo'));
    }


    // Nhập hàng
    public function indexImport(Request $request)
    {
        $title = 'Báo cáo nhập hàng';
        //Tổng đơn nhập
        $orders = $this->orders->allNhaphang();
        $orders = count($orders);
        //Tổng tiền đơn nhập + vat
        $totalSum = ProductOrders::select(DB::raw('SUM((productorders.product_price * productorders.product_qty) + ((productorders.product_price * productorders.product_qty * productorders.product_tax)/100)) as total_sum'))
            ->leftJoin('orders', 'orders.id', 'productorders.order_id')
            ->where('orders.order_status', 1)
            ->limit(1)
            ->first();
        $sumTotalOrders = $totalSum->total_sum;
        //Tổng công nợ + vat
        $sumDebtImport = DebtImport::select(DB::raw('SUM(total_import) as total_import'))->limit(1)
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

        $debtsSale = Exports::leftjoin('users', 'exports.user_id', '=', 'users.id')->get();
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
        $tableorders = $this->orders->reportOrders($filters, $nhanvien, $sortBy, $sortType);
        // dd($tableorders);
        return view('tables.report.report-import', compact('title', 'debtsSale', 'string', 'tableorders', 'sortType', 'orders', 'sumTotalOrders', 'sumDebtImportVAT', 'tableorders', 'exports', 'sumExport', 'formattedLoinhuan', 'CongNo'));
    }
}
