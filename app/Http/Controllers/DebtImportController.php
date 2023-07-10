<?php

namespace App\Http\Controllers;

use App\Models\DebtImport;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DebtImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $debts;
    public function __construct()
    {
        $this->debts = new DebtImport();
    }
    public function index(Request $request)
    {
        $title = 'Công nợ nhập';
        $filters = [];
        $string = [];
        //Mã đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['debts.id', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Mã đơn:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Khách hàng
        if (!empty($request->guest)) {
            $guest = $request->guest;
            array_push($filters, ['guests.guest_name', 'like', '%' . $guest . '%']);
            $nameArr = explode(',.@', $guest);
            array_push($string, ['label' => 'Khách hàng:', 'values' => $nameArr, 'class' => 'guest']);
        }
        //Name
        $nhanvien = [];
        if (!empty($request->nhanvien)) {
            $nhanvien = $request->input('nhanvien', []);
            array_push($string, ['label' => 'Nhân viên:', 'values' => $nhanvien, 'class' => 'name']);
        }
        // Bán
        if (!empty($request->sale_operator) && !empty($request->sum_sale)) {
            $sum = $request->input('sum_sale');
            $sale_operator = $request->input('sale_operator');
            $filters[] = ['debts.total_sales', $sale_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền bán ' . $sale_operator, 'values' => $saleArray, 'class' => 'sum-sale']);
        }
        // nhập
        if (!empty($request->import_operator) && !empty($request->sum_import)) {
            $sum = $request->input('sum_import');
            $import_operator = $request->input('import_operator');
            $filters[] = ['debts.total_import', $import_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền nhập ' . $import_operator, 'values' => $importArray, 'class' => 'sum-import']);
        }
        // phí
        if (!empty($request->fee_operator) && !empty($request->sum_fee)) {
            $sum = $request->input('sum_fee');
            $fee_operator = $request->input('fee_operator');
            $filters[] = ['debts.debt_transport_fee', $fee_operator, $sum];
            $feeArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Phí vận chuyển ' . $fee_operator, 'values' => $feeArray, 'class' => 'sum-fee']);
        }
        // Chênh lệch
        if (!empty($request->difference_operator) && !empty($request->sum_difference)) {
            $sum = $request->input('sum_difference');
            $difference_operator = $request->input('difference_operator');
            $filters[] = ['debts.total_difference', $difference_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền chênh lệch ' . $difference_operator, 'values' => $inventoryArray, 'class' => 'sum-difference']);
        }
        // Công nợ
        if (!empty($request->debt_operator) && !empty($request->debt)) {
            $sum = $request->input('debt');
            $debt_operator = $request->input('debt_operator');
            $filters[] = ['debts.debt', $debt_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Ngày công nợ' . $debt_operator, 'values' => $inventoryArray, 'class' => 'debt']);
        }
        //Trạng thái
        $status = [];
        if (!empty($request->status)) {
            $statusValues = [0 => 'Quá hạn', 1 => 'Thanh toán đủ', 2 => 'Gần đến hạn', 3 => 'Công nợ', 4 => 'Chưa thanh toán'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Trạng thái:', 'values' => $statusLabels, 'class' => 'status']);
        }

        $date = [];
        if (!empty($request->date_start) && !empty($request->date_end)) {
            $date_start = $request->input('date_start');
            $date_end = $request->input('date_end');
            $date[] = [$date_start, $date_end];
            $datearr = ['label' => 'Công nợ:', 'values' => [
                date('d/m/Y', strtotime($date_start)),
                date('d/m/Y', strtotime($date_end))
            ], 'class' => 'debt'];
            array_push($string, $datearr);
        }
        // Công nợ đã thanh toán
        $datepaid = [];
        if (!empty($request->paid_date_start) && !empty($request->paid_date_end)) {
            $date_start = $request->input('paid_date_start');
            $date_end = $request->input('paid_date_end');
            $datepaid[] = [$date_start, $date_end];
            $datearr = ['label' => 'Đã thanh toán:', 'values' => [
                date('d/m/Y', strtotime($date_start)),
                date('d/m/Y', strtotime($date_end))
            ], 'class' => 'debt-paid'];
            array_push($string, $datearr);
        }

        //Search
        $keywords = null;
        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

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


        $debtsSale = User::whereIn('roleid', [1, 3])->get();
        $debts = $this->debts->getAllDebts($filters, $keywords, $nhanvien, $date, $datepaid, $status, $sortBy, $sortType);
        $product = $this->debts->getAllProductsDebts();
        $debtsCreator = $this->debts->debtsCreator();
        return view('tables.debtImport.debts-import', compact('title', 'debts', 'debtsSale', 'product', 'string', 'sortType', 'debtsCreator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debts = DebtImport::select('debt_import.*',  'productorders.product_tax as thue','orders.product_code as madon', 'provides.provide_name as nhacungcap', 'users.name as nhanvien', 'productorders.product_qty as soluong', 'productorders.product_price as gianhap')
            ->leftJoin('provides', 'provides.id', 'debt_import.provide_id')
            ->leftJoin('users', 'users.id', 'debt_import.user_id')
            ->leftJoin('orders', 'orders.id', 'debt_import.import_id')
            ->leftJoin('productorders', 'orders.id', 'productorders.order_id')
            ->leftJoin('product', 'product.id', 'productorders.product_id')
            ->findOrFail($id);
        $product = DebtImport::select('debt_import.*', 'productorders.product_tax as thue', 'productorders.product_name as tensanpham', 'productorders.product_unit as dvt', 'productorders.product_qty as soluong', 'productorders.product_price as gianhap')
            ->leftJoin('provides', 'provides.id', 'debt_import.provide_id')
            ->leftJoin('users', 'users.id', 'debt_import.user_id')
            ->leftJoin('orders', 'orders.id', 'debt_import.import_id')
            ->leftJoin('productorders', 'orders.id', 'productorders.order_id')
            ->leftJoin('product', 'product.id', 'productorders.product_id')->where('debt_import.id', $id)->get();
        $title = "Chi tiết đơn hàng nhập";
        return view('tables.debtImport.editDebt-import', compact('debts', 'product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $debt = DebtImport::find($id);
        // dd($request);
        if ($request->has('submitBtn')) {
            $action = $request->input('submitBtn');
            if ($action === 'action1') {
                $debt->debt_status = 1;
                $debt->debt = 0;
                $debt->update($request->all());
                return redirect()->route('debt_import.index')->with('msg', 'Thanh toán thành công!');
            }
            if ($action === 'action2') {
                $endDate = Carbon::parse($request->date_end);
                $currentDate = Carbon::now();
                $daysDiffss = $currentDate->diffInDays($endDate);
                $daysDiff = -$daysDiffss;

                if ($request->debt_debt == null || $request->debt_debt == 0) {
                    $debt->debt_status = 4;
                    $debt->debt = 0;
                } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                    $debt->debt_status = 2;
                    $debt->debt = $request->debt_debt;
                } elseif ($daysDiff < 0) {
                    $debt->debt_status = 0;
                    $debt->debt = $request->debt_debt;
                } else {
                    $debt->debt_status = 3;
                    $debt->debt = $request->debt_debt;
                }

                $debt->update($request->all());

                return redirect()->route('debt_import.index')->with('msg', 'Cập nhật thành công!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
