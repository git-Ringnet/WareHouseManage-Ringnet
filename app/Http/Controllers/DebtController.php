<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\History;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DebtController extends Controller
{

    private $debts;
    private $history;
    public function __construct()
    {
        $this->debts = new Debt();
        $this->history = new History();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Công nợ xuất';
        $filters = [];
        $string = [];
        //Mã đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['exports.export_code', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Hóa đơn ra:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Khách hàng
        $guest = [];
        if (!empty($request->guest)) {
            $guest = $request->input('guest', []);
            array_push($string, ['label' => 'Khách hàng:', 'values' => $guest, 'class' => 'guest']);
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

        $guests = Debt::leftjoin('guests', 'guests.id', '=', 'debts.guest_id')->select('guests.guest_name as guests')->get();

        $debtsSale = Debt::leftjoin('users', 'debts.user_id', '=', 'users.id')->get();
        $debts = $this->debts->getAllDebts($filters, $keywords, $nhanvien, $date, $guest, $datepaid, $status, $sortBy, $sortType);
        $product = $this->debts->getAllProductsDebts();
        $debtsCreator = $this->debts->debtsCreator();
        return view('tables.debt.debts', compact('title', 'debts', 'debtsSale', 'guests', 'product', 'string', 'sortType', 'debtsCreator'));
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
        $debts = Debt::select('debts.*', 'guests.guest_name as khachhang', 'users.name as nhanvien', 'exports.export_code as hdr')
            ->join('guests', 'debts.guest_id', '=', 'guests.id')
            ->join('users', 'debts.user_id', '=', 'users.id')
            ->leftJoin('exports', 'exports.id', 'debts.export_id')
            ->findOrFail($id);
        $product = Debt::select('debts.*', 'product_exports.id as madon', 'product_exports.product_qty as soluong', 'product_exports.product_price as giaban', 'product.product_price as gianhap', 'product.product_name as tensanpham')
            ->leftJoin('guests', 'guests.id', 'debts.guest_id')
            ->leftJoin('users', 'users.id', 'debts.user_id')
            ->leftJoin('exports', 'exports.id', 'debts.export_id')
            ->leftJoin('product_exports', 'exports.id', 'product_exports.export_id')
            ->leftJoin('product', 'product.id', 'product_exports.product_id')->where('debts.id', $id)->get();
        $title = "Chi tiết đơn hàng";
        return view('tables.debt.editDebt', compact('debts', 'product', 'title'));
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
        $debt = Debt::find($id);
        $data = [];
        if ($request->has('submitBtn')) {
            $action = $request->input('submitBtn');
            if ($action === 'action1') {
                $debt->debt_status = 1;
                $debt->debt = 0;
                $debt->update($request->all());
                $data = [
                    'debt_export' => 0,
                    'export_status' => 1
                ];
                $this->history->updateHistoryByExport($data, $debt->export_id);
                return redirect()->route('debt.index')->with('msg', 'Thanh toán thành công!');
            }
            if ($action === 'action2') {
                // Xử lí status debt
                $endDate = Carbon::parse($request->date_end);
                $currentDate = Carbon::now();
                $daysDiffss = $currentDate->diffInDays($endDate);
                if ($endDate < $currentDate) {
                    $daysDiff = -$daysDiffss;
                } else {
                    $daysDiff = $daysDiffss;
                }
                if ($request->debt_debt == null || $request->debt_debt == 0) {
                    $debt->debt_status = 4;
                    $debt->debt = 0;
                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt->debt_status = 2;
                    $debt->debt = $request->debt_debt;
                } elseif ($daysDiff == 0) {
                    $debt->debt_status = 5;
                    $debt->debt = $request->debt_debt;
                } elseif ($daysDiff < 0) {
                    $debt->debt_status = 0;
                    $debt->debt = $request->debt_debt;
                } else {
                    $debt->debt_status = 3;
                    $debt->debt = $request->debt_debt;
                }
                $data = [
                    'export_status' => $debt->debt_status,
                    'debt_export' => $debt->debt,
                    'debt_export_end' => $request->date_end,
                    'debt_export_start' => $request->date_start
                ];
                $debt->update($request->all());
                $this->history->updateHistoryByExport($data, $debt->export_id);
                return redirect()->route('debt.index')->with('msg', 'Cập nhật thành công!');
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
    public function paymentdebt(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Debt::whereIn('id', $list)->get();
            $history = History::leftJoin('debts', 'history.export_id', 'debts.export_id')
                ->whereIn('debts.id', $list)->get();
            foreach ($history as $value) {
                $value->export_status = 1;
                $value->save();
            };
            foreach ($listOrder as $value) {
                $value->debt_status = 1;
                $value->save();
            }
            session()->flash('msg', 'Thanh toán thành công');
            return response()->json(['success' => true, 'msg' => 'Thanh toán thành công']);
        }
        return response()->json(['success' => false, 'warning' => 'Thanh toán thất bại!']);
        session()->flash('msg', 'Thanh toán thất bại!');
    }

    // Exprort Excel
    public function export_import(){
        $data = DebtImport::select('id','import_id','date_start','provide_id','user_id','total_import','debt','debt_status','debt_note')
        ->with('getProvide')
        ->with('getUsers')
        ->with('getCode')
        ->get();
        foreach($data as $va){
            if($va->getProvide && $va->getUsers && $va->getCode){
                $va->provide_id = $va->getProvide->provide_name;
                $va->user_id = $va->getUsers->name;
                $va->import_id = $va->getCode->product_code;
                if($va->debt_status == 1){
                    $va->debt_status = "Thanh toán đủ";
                }elseif($va->debt_status == 2){
                    $va->debt_status = "Gần đến hạn";
                }elseif($va->debt_status == 3){
                    $va->debt_status = "Công nợ";
                }elseif($va->debt_status == 4){
                    $va->debt_status = "Chưa thanh toán";
                }else{
                    $va->debt_status = "Đến hạn";
                }
                $va->total_import = number_format($va->total_import);
                $va->date =  Carbon::parse($va->date_start)->format('Y-m-d');
            }
            unset($va->getProvide);
            unset($va->getUsers);
            unset($va->getCode);
            unset($va->date_start);
        }
        return response()->json(['success' => true, 'msg' => 'Xuất file thành công', 'data' => $data]);
    }
}
