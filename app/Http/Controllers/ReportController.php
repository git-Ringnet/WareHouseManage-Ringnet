<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\Exports;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductOrders;
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
    public function index(Request $request)
    {
        $title = 'Báo cáo';
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
        $tableorders = Orders::leftJoin('users', 'users.id', 'orders.users_id')
            ->leftJoin('roles', 'users.roleid', 'roles.id')
            ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
            ->select('users.name as nhanvien', 'roles.name as vaitro', 'orders.users_id')
            ->where('orders.order_status', 1)
            ->selectSub(function ($query) {
                $query->from('Orders')
                    ->where('orders.order_status', 1)
                    ->whereColumn('orders.users_id', 'users.id')
                    ->selectRaw('COUNT(id)');
            }, 'product_qty_count')
            ->selectSub(function ($query) {
                $query->from('productorders')
                    ->whereColumn('orders.users_id', 'users.id')
                    ->selectRaw('SUM((productorders.product_price * productorders.product_qty) + ((productorders.product_price * productorders.product_qty * productorders.product_tax)/100))');
            }, 'total_sum')
            ->selectSub(function ($query) {
                $query->from('debt_import')
                    ->whereColumn('debt_import.user_id', 'users.id')
                    ->whereColumn('orders.users_id', 'users.id')
                    ->selectRaw('SUM(total_import)');
            }, 'total_debt')
            ->groupBy('users.id', 'users.name', 'roles.name', 'orders.users_id')
            ->paginate(20);
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
        //Table xuất hàng
        $Tableexports = Exports::leftJoin('users', 'users.id', 'exports.user_id')
            ->leftJoin('roles', 'users.roleid', 'roles.id')
            ->leftJoin('debts', 'debts.export_id', 'exports.id')
            ->where('exports.export_status', 2)
            ->select('users.name as nhanvien', 'roles.name as vaitro', 'users.email as email')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('COUNT(id)');
            }, 'donxuat')
            ->selectSub(function ($query) {
                $query->from('exports')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('SUM(total)');
            }, 'tongtienxuat')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('SUM(total_difference)');
            }, 'tongloinhuan')
            ->selectSub(function ($query) {
                $query->from('debts')
                    ->where('exports.export_status', 2)
                    ->whereColumn('exports.user_id', 'users.id')
                    ->selectRaw('SUM(total_sales)');
            }, 'tongcongno')
            ->distinct()
            ->paginate(20);
        return view('tables.report.report', compact('title', 'Tableexports', 'orders', 'sumTotalOrders', 'sumDebtImportVAT', 'tableorders', 'exports', 'sumExport', 'formattedLoinhuan', 'CongNo'));
    }
}
