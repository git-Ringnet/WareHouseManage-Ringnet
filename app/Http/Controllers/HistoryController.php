<?php

namespace App\Http\Controllers;

use App\Models\DebtImport;
use App\Models\Provides;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $debts;
    public function __construct()
    {
        $this->debts = new DebtImport();
    }
    public function index(Request $request)
    {
        $title = 'Lịch sử giao dịch';
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
        $provides = Provides::all();
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


        $debtsSale = User::whereIn('roleid', [1, 3])->get();
        $debts = $this->debts->getAllDebts($filters, $keywords, $nhanvien, $date,$provide_namearr, $status, $sortBy, $sortType);
        $product = $this->debts->getAllProductsDebts();
        $debtsCreator = $this->debts->debtsCreator();
        return view('tables.history.historyindex', compact('title', 'debts','provides', 'debtsSale', 'product', 'string', 'sortType', 'debtsCreator'));
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
