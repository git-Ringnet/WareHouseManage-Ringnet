<?php

namespace App\Http\Controllers;

use App\Models\DebtImport;
use App\Models\Provides;
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
            array_push($filters, ['orders.product_code', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Hóa đơn vào:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Nhà cung cấp
        $provides = DebtImport::leftjoin('provides', 'debt_import.provide_id', '=', 'provides.id')->get();
        $provide_namearr = [];
        if (!empty($request->provide_namearr)) {
            $provide_namearr = $request->input('provide_namearr', []);
            if (!empty($provide_namearr)) {
                $selectedProvides = Provides::whereIn('id', $provide_namearr)->get();
                $selectedProvides = $selectedProvides->pluck('provide_name')->toArray();
            }
            array_push($string, ['label' => 'Nhà cung cấp:', 'values' => $selectedProvides, 'class' => 'provide_name']);
        }
        //Name
        $nhanvien = [];
        if (!empty($request->nhanvien)) {
            $nhanvien = $request->input('nhanvien', []);
            array_push($string, ['label' => 'Nhân viên:', 'values' => $nhanvien, 'class' => 'name']);
        }

        // nhập
        if (!empty($request->import_operator) && !empty($request->sum_import)) {
            $sum = $request->input('sum_import');
            $import_operator = $request->input('import_operator');
            $filters[] = ['orders.total', $import_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền nhập(+VAT) ' . $import_operator, 'values' => $importArray, 'class' => 'sum-import']);
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
        if (!empty($request->trip_start) && !empty($request->trip_end)) {
            $trip_start = $request->input('trip_start');
            $trip_end = $request->input('trip_end');
            $date[] = [$trip_start, $trip_end];
            $datearr = ['label' => 'Ngày nhập hóa đơn:', 'values' => [
                date('d/m/Y', strtotime($trip_start)),
                date('d/m/Y', strtotime($trip_end))
            ], 'class' => 'date'];
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


        $debtsSale = DebtImport::leftjoin('users', 'debt_import.user_id', '=', 'users.id')->get();
        $debts = $this->debts->getAllDebts($filters, $keywords, $nhanvien, $date,$provide_namearr, $status, $sortBy, $sortType);
        $product = $this->debts->getAllProductsDebts();
        $debtsCreator = $this->debts->debtsCreator();
        // dd($debts);
        return view('tables.debtImport.debts-import', compact('title', 'debts','provides', 'debtsSale', 'product', 'string', 'sortType', 'debtsCreator'));
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
    public function paymentdebtimport(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = DebtImport::whereIn('id', $list)->get();
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
}
