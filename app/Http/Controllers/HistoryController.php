<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Provides;
use App\Models\User;
use Carbon\Carbon;
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
            if (!empty($nhanvien)) {
                $selectedRoles = User::whereIn('id', $nhanvien)->get();
                $selectedRoleNames = $selectedRoles->pluck('name')->toArray();
            }
            array_push($string, ['label' => 'Nhân viên:', 'values' => $selectedRoleNames, 'class' => 'name']);
        }
        // SL xuất
        if (!empty($request->export_qty_operator) && !empty($request->export_qty)) {
            $sum = $request->input('export_qty');
            $export_qty_operator = $request->input('product_qty_operator');
            $filters[] = ['export_qty', $export_qty_operator, $sum];
            $importArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Số lượng xuất ' . $export_qty_operator, 'values' => $importArray, 'class' => 'export_qty']);
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
        // Giá Bán
        if (!empty($request->sale_operator) && !empty($request->sum_sale)) {
            $sum = $request->input('sum_sale');
            $sale_operator = $request->input('sale_operator');
            $filters[] = ['price_export', $sale_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Giá bán ' . $sale_operator, 'values' => $saleArray, 'class' => 'sum-sale']);
        }
        // Thành tiền xuất
        if (!empty($request->total_sale_operator) && !empty($request->total_sum_sale)) {
            $sum = $request->input('total_sum_sale');
            $total_sale_operator = $request->input('total_sale_operator');
            $filters[] = ['export_total', $total_sale_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Thành tiền xuất ' . $total_sale_operator, 'values' => $saleArray, 'class' => 'total_sum_sale']);
        }
        // Lợi nhuận
        if (!empty($request->total_difference_operator) && !empty($request->total_difference)) {
            $sum = $request->input('total_difference');
            $total_difference_operator = $request->input('total_difference_operator');
            $filters[] = ['history.total_difference', $total_difference_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Lợi nhuận ' . $total_difference_operator, 'values' => $saleArray, 'class' => 'total_difference']);
        }
        // Chi phí vận chuyển
        if (!empty($request->tranport_fee_operator) && !empty($request->tranport_fee)) {
            $sum = $request->input('tranport_fee');
            $tranport_fee_operator = $request->input('tranport_fee_operator');
            $filters[] = ['tranport_fee', $tranport_fee_operator, $sum];
            $saleArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Chi phí vận chuyển ' . $tranport_fee_operator, 'values' => $saleArray, 'class' => 'tranport_fee']);
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
            array_push($string, ['label' => 'Tình trạng xuất:', 'values' => $statusLabels, 'class' => 'status_export']);
        }
        //Khách hàng
        $guest = [];
        if (!empty($request->guest)) {
            $guest = $request->input('guest', []);
            array_push($string, ['label' => 'Khách hàng:', 'values' => $guest, 'class' => 'guest']);
        }

        // Đơn vị tính
        $unitarr = [];
        if (!empty($request->unitarr)) {
            $unitarr = $request->input('unitarr', []);
            array_push($string, ['label' => 'Đơn vị tính:', 'values' => $unitarr, 'class' => 'unit']);
        }
        // Thời gian
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

        // Tên Serial NUMBER
        $sn = null;
        if (!empty($request->sn)) {
            $sn = $request->sn;
            $nameArr = explode(',.@', $sn);
            array_push($string, [
                'label' => 'Serial number:', 'values' => $nameArr, 'class' => 'sn'
            ]);
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
        $perPage = $request->input('perPageinput', 25);
        $guests = History::leftjoin('guests', 'guests.id', '=', 'history.guest_id')->select('guests.guest_name as guests', 'history.export_unit as unit')->get();

        $debtsSale =  History::leftjoin('users', 'history.user_id', '=', 'users.id')->get();
        $provides = History::leftjoin('provides', 'history.provide_id', '=', 'provides.id')->get();

        $history = $this->history->getAllHistory($filters, $perPage, $keywords, $sn, $date, $nhanvien, $provide_namearr, $guest, $status, $unitarr, $status_export, $sortBy, $sortType);

        return view('tables.history.historyindex', compact('history', 'perPage', 'title', 'guests', 'debtsSale', 'provides', 'string', 'sortType'));
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
    public function exportHistory()
    {
        $data = History::select(
            'id',
            'user_id',
            'date_time',
            'provide_id',
            'product_name',
            'product_qty',
            'price_import',
            'product_total',
            'import_code',
            'debt_import',
            'import_status',
            'guest_id',
            'export_qty',
            'export_unit',
            'price_export',
            'export_total',
            'export_code',
            'debt_export',
            'export_status',
            'total_difference',
            'tranport_fee',
            // 'history_note'
        )
            ->with('getUsers')
            ->with('getProvides')
            ->with('getGuests')
            ->get();

        foreach ($data as $row) {
            if ($row->getUsers && $row->getProvides && $row->getGuests) {
                $row->user_id = $row->getUsers->name;
                $row->date_time = Carbon::parse($row->date_time)->format('d-m-Y');
                $row->provide_id = $row->getProvides->provide_name;
                $row->price_import = number_format($row->price_import);
                $row->product_total = number_format($row->product_total);
                if ($row->import_status == 0) {
                    $row->import_status = "Quá hạn";
                } elseif ($row->import_status == 1) {
                    $row->import_status = "Thanh toán đủ";
                } elseif ($row->import_status == 2) {
                    $row->import_status = "Gần đến hạn";
                } elseif ($row->import_status == 3) {
                    $row->import_status = "Công nợ";
                } elseif ($row->import_status == 4) {
                    $row->import_status = "Chưa thanh toán";
                } else {
                    $row->import_status = "Đến hạn";
                }
                $row->guest_id = $row->getGuests->guest_name;
                $row->price_export = number_format($row->price_export);
                $row->export_total = number_format($row->export_total);
                if ($row->export_status == 0) {
                    $row->export_status = "Quá hạn";
                } elseif ($row->export_status == 1) {
                    $row->export_status = "Thanh toán đủ";
                } elseif ($row->export_status == 2) {
                    $row->export_status = "Gần đến hạn";
                } elseif ($row->export_status == 3) {
                    $row->export_status = "Công nợ";
                } elseif ($row->export_status == 4) {
                    $row->export_status = "Chưa thanh toán";
                } else {
                    $row->export_status = "Đến hạn";
                }
                $row->total_difference = number_format($row->total_difference);
                $row->tranport_fee = number_format($row->tranport_fee);
            }
            unset($row->getUsers);
            unset($row->getProvides);
            unset($row->getGuests);
        }
        return response()->json(['success' => true, 'msg' => 'Xuất file thành công', 'data' => $data]);
    }
}
