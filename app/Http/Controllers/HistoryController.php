<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Provides;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $history;
    public function __construct()
    {
        $this->history = new History();
    }
    public function index(Request $request)
    {
        $title = 'Lịch sử giao dịch';
        $filters = [];
        $string = [];
        //Mặt hàng
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['product_name', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Mặt hàng:', 'values' => $nameArr, 'class' => 'id']);
        }
         //Hóa đơn vào
         if (!empty($request->hdv)) {
            $hdv = $request->hdv;
            array_push($filters, ['import_code', 'like', '%' . $hdv . '%']);
            $nameArr = explode(',.@', $hdv);
            array_push($string, ['label' => 'Hóa đơn vào:', 'values' => $nameArr, 'class' => 'hdv']);
        }
         //Hóa đơn ra
         if (!empty($request->hdr)) {
            $hdr = $request->hdr;
            array_push($filters, ['export_code', 'like', '%' . $hdr . '%']);
            $nameArr = explode(',.@', $hdr);
            array_push($string, ['label' => 'Hóa đơn ra:', 'values' => $nameArr, 'class' => 'hdr']);
        }
        //Nhà cung cấp
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
        // SL nhập
          if (!empty($request->product_qty_operator) && !empty($request->product_qty)) {
            $sum = $request->input('product_qty');
            $product_qty_operator = $request->input('product_qty_operator');
            $filters[] = ['product_qty', $product_qty_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Số lượng nhập ' . $product_qty_operator, 'values' => $importArray, 'class' => 'product_qty']);
        }
        // Giá nhập
        if (!empty($request->price_import_operator) && !empty($request->price_import)) {
            $sum = $request->input('price_import');
            $price_import_operator = $request->input('price_import_operator');
            $filters[] = ['price_import', $price_import_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Giá nhập ' . $price_import_operator, 'values' => $importArray, 'class' => 'price_import']);
        }

        // Thành tiền nhập
        if (!empty($request->import_operator) && !empty($request->sum_import)) {
            $sum = $request->input('sum_import');
            $import_operator = $request->input('import_operator');
            $filters[] = ['product_total', $import_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Thành tiền nhập ' . $import_operator, 'values' => $importArray, 'class' => 'sum-import']);
        }
       
        //Trạng thái nhập
        $status = [];
        if (!empty($request->status)) {
            $statusValues = [0 => 'Quá hạn', 1 => 'Thanh toán đủ', 2 => 'Gần đến hạn', 3 => 'Công nợ', 4 => 'Chưa thanh toán', 5 => 'Đến hạn'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Tình trạng nhập:', 'values' => $statusLabels, 'class' => 'status']);
        }
         //Trạng thái xuất
         $status_export = [];
         if (!empty($request->status_export)) {
             $statusValues = [0 => 'Quá hạn', 1 => 'Thanh toán đủ', 2 => 'Gần đến hạn', 3 => 'Công nợ', 4 => 'Chưa thanh toán', 5 => 'Đến hạn'];
             $status_export = $request->input('status_export', []);
             $statusLabels = array_map(function ($value) use ($statusValues) {
                 return $statusValues[$value];
             }, $status_export);
             array_push($string, ['label' => 'Tình trạng xuất:', 'values' => $statusLabels, 'class' => 'status']);
         }

        $date = [];
        if (!empty($request->trip_start) && !empty($request->trip_end)) {
            $trip_start = $request->input('trip_start');
            $trip_end = $request->input('trip_end');
            $date[] = [$trip_start, $trip_end];
            $datearr = ['label' => 'Thời gian:', 'values' => [
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


        $debtsSale =  History::leftjoin('users', 'history.user_id', '=', 'users.id')->get();
        $provides = History::leftjoin('provides', 'history.provide_id', '=', 'provides.id')->get();
        $provide_namearr = [];


        // $debts = $this->debts->getAllDebts($filters, $keywords, $nhanvien, $date,$provide_namearr, $status, $sortBy, $sortType);
        // $product = $this->debts->getAllProductsDebts();
        // $debtsCreator = $this->debts->debtsCreator();
        $history = $this->history->getAllHistory($filters, $keywords,$date,$status,$status_export, $sortBy, $sortType);
       
        return view('tables.history.historyindex', compact('history','title','debtsSale','provides', 'string', 'sortType'));
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
        //
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
        //
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
