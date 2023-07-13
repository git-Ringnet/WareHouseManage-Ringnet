<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Exports;
use App\Models\Guests;
use App\Models\History;
use App\Models\Product;
use App\Models\productExports;
use App\Models\Products;
use App\Models\Serinumbers;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $exports;
    public function __construct()
    {
        $this->exports = new Exports();
    }
    public function index(Request $request)
    {
        $string = array();
        $filters = [];
        $status = [];
        //Mã đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['exports.export_code', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Mã đơn hàng:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Khách hàng
        $guest = [];
        if (!empty($request->guest)) {
            $guest = $request->input('guest', []);
            array_push($string, ['label' => 'Khách hàng:', 'values' => $guest, 'class' => 'guest']);
        }

        //Tổng tiền
        if (!empty($request->comparison_operator) && !empty($request->sum)) {
            $sum = $request->input('sum');
            $comparison_operator = $request->input('comparison_operator');
            $filters[] = ['exports.total', $comparison_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền ' . $comparison_operator, 'values' => $inventoryArray, 'class' => 'sum']);
        }

        //Trạng thái
        if (!empty($request->status)) {
            $statusValues = [0 => 'Đã hủy', 1 => 'Đã báo giá', 2 => 'Đã chốt'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Trạng thái:', 'values' => $statusLabels, 'class' => 'status']);
        }

        //Name
        $name = [];
        if (!empty($request->name)) {
            $name = $request->input('name', []);
            array_push($string, ['label' => 'Người tạo:', 'values' => $name, 'class' => 'name']);
        }
        //Ngày tạo
        $date = [];
        if (!empty($request->trip_start) && !empty($request->trip_end)) {
            $trip_start = $request->input('trip_start');
            $trip_end = $request->input('trip_end');
            $date[] = [$trip_start, $trip_end];
            $datearr = ['label' => 'Ngày tạo:', 'values' => [
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
        $exports = Exports::leftjoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->leftjoin('users', 'exports.user_id', '=', 'users.id')->select('guests.guest_name as guests','users.name as name')->get();
        $productEx = productExports::all();
        $export = $this->exports->getAllExports($filters, $status, $name,$guest, $date, $keywords, $sortBy, $sortType);
        $title = 'Xuất hàng';
        $productsCreator = $this->exports->productsCreator();
        // dd($productsCreator);
        return view('tables.export.exports', compact('productEx', 'export', 'exports', 'sortType', 'string', 'title', 'productsCreator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('product.*')
            ->whereRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) > 0')
            ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
            ->get();
        $customer = Guests::where('guest_status', 1)->get();
        $guest_id = DB::table('guests')->select('id')->orderBy('id', 'DESC')->first();
        $title = 'Tạo đơn xuất hàng';
        return view('tables.export.addExport', compact('customer', 'product', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $productIDs = $request->input('product_id');
            $productQtys = $request->input('product_qty');
            $clickValue = $request->input('click');
            $updateClick = $request->input('updateClick');
            $totalQtyNeeded = 0;
            if ($request->has('submitBtn')) {
                $action = $request->input('submitBtn');
                if ($action === 'action1') {
                    // Tính tổng số lượng cần thiết cho mỗi product_id
                    $productQtyMap = [];
                    $hasEnoughQty = true;
                    if ($productIDs == null) {
                        return redirect()->route('exports.index')->with('warning', 'Chưa thêm sản phẩm!');
                    } else {
                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];

                            $totalQtyNeeded += $productQty;

                            if (!isset($productQtyMap[$productID])) {
                                $productQtyMap[$productID] = 0;
                            }
                            $productQtyMap[$productID] += $productQty;
                        }
                        //thêm khách hàng khi lưu nhanh
                        if ($request->checkguest == 2 && $clickValue == null) {
                            $guest = new Guests();
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_address = $request->guest_address;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_note = $request->guest_note;
                            if ($request->debt == null) {
                                $guest->debt = 0;
                            } else {
                                $guest->debt = $request->debt;
                            }
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $guest->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 2;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $export->id;
                                $history->date_time = Carbon::now();
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $productQty;
                                $history->product_unit = $request->product_unit[$i];
                                $history->price_import = $request->product_price[$i];
                                $history->product_total = $productQty * $request->product_price[$i];
                                $history->import_code = null;
                                $history->import_status = 1;
                                $history->guest_id = null;
                                $history->export_qty = null;
                                $history->export_unit = null;
                                $history->price_export = null;
                                $history->export_total = null;
                                $history->export_code = null;
                                $history->export_status = null;
                                $history->total_difference = null;
                                $history->tranport_fee = null;
                                $history->history_note = null;
                                $history->save();
                            }
                            // Lấy thông tin từ bảng productExport và Export
                            $productExports = $export->productExports;
                            // Tính toán giá trị total_sales
                            $totalSales = 0;
                            foreach ($productExports as $productExport) {
                                $totalSales += $productExport->product_price * $productExport->product_qty;
                            }
                            // Tính toán giá trị total_import
                            $totalImport = 0;
                            foreach ($productExports as $productExport) {
                                $product = Product::find($productExport->product_id);
                                $totalImport += $product->product_price * $productExport->product_qty;
                            }
                            // Tính toán giá trị total_difference
                            if ($export->transport_fee === null) {
                                $debtTransportFee = 0;
                            } else {
                                $debtTransportFee = $export->transport_fee;
                            }
                            $totalDifference = $totalSales - $totalImport - $debtTransportFee;
                            // Lấy thông tin từ bảng Guests
                            $guest = Guests::find($export->guest_id);
                            // Tạo đối tượng Debt và cập nhật giá trị
                            $debt = new Debt();
                            $debt->guest_id = $guest->id;
                            $debt->user_id = Auth::user()->id;
                            $debt->export_id = $export->id;
                            $debt->total_sales = $totalSales;
                            $debt->total_import = $totalImport;
                            $debt->debt_transport_fee = $debtTransportFee;
                            $debt->total_difference = $totalDifference;
                            $debt->debt = $guest->debt;
                            $debt->date_start = $request->export_create;
                            $startDate = Carbon::parse($request->export_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
                            $daysToAdd = $debt->debt; // Số ngày cần thêm

                            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                            // Định dạng ngày kết thúc theo ý muốn
                            $endDateFormatted = $endDate->format('Y-m-d');
                            // dd($endDateFormatted);
                            $debt->date_end = $endDateFormatted;

                            // Xử lí status debt
                            $endDate = Carbon::parse($endDateFormatted);
                            $currentDate = Carbon::now();
                            $daysDiffss = $currentDate->diffInDays($endDate);
                            if ($endDate < $currentDate) {
                                $daysDiff = -$daysDiffss;
                            } else {
                                $daysDiff = $daysDiffss;
                            }

                            if ($debt->debt == 0) {
                                $debt->debt_status = 4;
                            } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                                $debt->debt_status = 2;
                            } elseif ($daysDiff < 0) {
                                $debt->debt_status = 0;
                            } else {
                                $debt->debt_status = 3;
                            }
                            $debt->save();
                        }
                        //cập nhật khách hàng khi lưu nhanh
                        if ($request->checkguest == 1 && $updateClick == null) {
                            $guest = Guests::find($request->id);
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_address = $request->guest_address;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_note = $request->guest_note;
                            if ($request->debt == null) {
                                $guest->debt = 0;
                            } else {
                                $guest->debt = $request->debt;
                            }
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $guest->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 2;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $export->id;
                                $history->date_time = Carbon::now();
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $productQty;
                                $history->product_unit = $request->product_unit[$i];
                                $history->price_import = $request->product_price[$i];
                                $history->product_total = $productQty * $request->product_price[$i];
                                $history->import_code = null;
                                $history->import_status = 1;
                                $history->guest_id = null;
                                $history->export_qty = null;
                                $history->export_unit = null;
                                $history->price_export = null;
                                $history->export_total = null;
                                $history->export_code = null;
                                $history->export_status = null;
                                $history->total_difference = null;
                                $history->tranport_fee = null;
                                $history->history_note = null;
                                $history->save();
                            }
                            // Lấy thông tin từ bảng productExport và Export
                            $productExports = $export->productExports;

                            // Tính toán giá trị total_sales
                            $totalSales = 0;
                            foreach ($productExports as $productExport) {
                                $totalSales += $productExport->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_import
                            $totalImport = 0;
                            foreach ($productExports as $productExport) {
                                $product = Product::find($productExport->product_id);
                                $totalImport += $product->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_difference
                            if ($export->transport_fee === null) {
                                $debtTransportFee = 0;
                            } else {
                                $debtTransportFee = $export->transport_fee;
                            }

                            $totalDifference = $totalSales - $totalImport - $debtTransportFee;

                            // Lấy thông tin từ bảng Guests
                            $guest = Guests::find($export->guest_id);

                            // Tạo đối tượng Debt và cập nhật giá trị
                            $debt = new Debt();
                            $debt->guest_id = $guest->id;
                            $debt->user_id = Auth::user()->id;
                            $debt->export_id = $export->id;
                            $debt->total_sales = $totalSales;
                            $debt->total_import = $totalImport;
                            $debt->debt_transport_fee = $debtTransportFee;
                            $debt->total_difference = $totalDifference;
                            $debt->debt = $guest->debt;

                            $debt->date_start = $request->export_create;

                            $startDate = Carbon::parse($request->export_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
                            $daysToAdd = $debt->debt; // Số ngày cần thêm

                            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                            // Định dạng ngày kết thúc theo ý muốn
                            $endDateFormatted = $endDate->format('Y-m-d');
                            // dd($endDateFormatted);
                            $debt->date_end = $endDateFormatted;


                            // Xử lí status debt
                            $endDate = Carbon::parse($endDateFormatted);
                            $currentDate = Carbon::now();
                            $daysDiffss = $currentDate->diffInDays($endDate);
                            if ($endDate < $currentDate) {
                                $daysDiff = -$daysDiffss;
                            } else {
                                $daysDiff = $daysDiffss;
                            }

                            if ($debt->debt == 0) {
                                $debt->debt_status = 4;
                            } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                                $debt->debt_status = 2;
                            } elseif ($daysDiff < 0) {
                                $debt->debt_status = 0;
                            } else {
                                $debt->debt_status = 3;
                            }
                            $debt->save();
                        }
                        //tạo đơn khi đã nhấn cập nhật
                        if ($request->checkguest == 1 && $updateClick == 1) {
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $request->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 2;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $export->id;
                                $history->date_time = Carbon::now();
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $productQty;
                                $history->product_unit = $request->product_unit[$i];
                                $history->price_import = $request->product_price[$i];
                                $history->product_total = $productQty * $request->product_price[$i];
                                $history->import_code = null;
                                $history->import_status = 1;
                                $history->guest_id = null;
                                $history->export_qty = null;
                                $history->export_unit = null;
                                $history->price_export = null;
                                $history->export_total = null;
                                $history->export_code = null;
                                $history->export_status = null;
                                $history->total_difference = null;
                                $history->tranport_fee = null;
                                $history->history_note = null;
                                $history->save();
                            }
                            // Lấy thông tin từ bảng productExport và Export
                            $productExports = $export->productExports;

                            // Tính toán giá trị total_sales
                            $totalSales = 0;
                            foreach ($productExports as $productExport) {
                                $totalSales += $productExport->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_import
                            $totalImport = 0;
                            foreach ($productExports as $productExport) {
                                $product = Product::find($productExport->product_id);
                                $totalImport += $product->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_difference
                            if ($export->transport_fee === null) {
                                $debtTransportFee = 0;
                            } else {
                                $debtTransportFee = $export->transport_fee;
                            }

                            $totalDifference = $totalSales - $totalImport - $debtTransportFee;

                            // Lấy thông tin từ bảng Guests
                            $guest = Guests::find($export->guest_id);

                            // Tạo đối tượng Debt và cập nhật giá trị
                            $debt = new Debt();
                            $debt->guest_id = $guest->id;
                            $debt->user_id = Auth::user()->id;
                            $debt->export_id = $export->id;
                            $debt->total_sales = $totalSales;
                            $debt->total_import = $totalImport;
                            $debt->debt_transport_fee = $debtTransportFee;
                            $debt->total_difference = $totalDifference;
                            $debt->debt = $guest->debt;

                            $debt->date_start = $request->export_create;

                            $startDate = Carbon::parse($request->export_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
                            $daysToAdd = $debt->debt; // Số ngày cần thêm

                            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                            // Định dạng ngày kết thúc theo ý muốn
                            $endDateFormatted = $endDate->format('Y-m-d');
                            // dd($endDateFormatted);
                            $debt->date_end = $endDateFormatted;

                            // Xử lí status debt
                            $endDate = Carbon::parse($endDateFormatted);
                            $currentDate = Carbon::now();
                            $daysDiffss = $currentDate->diffInDays($endDate);
                            if ($endDate < $currentDate) {
                                $daysDiff = -$daysDiffss;
                            } else {
                                $daysDiff = $daysDiffss;
                            }

                            if ($debt->debt == 0) {
                                $debt->debt_status = 4;
                            } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                                $debt->debt_status = 2;
                            } elseif ($daysDiff < 0) {
                                $debt->debt_status = 0;
                            } else {
                                $debt->debt_status = 3;
                            }
                            $debt->save();
                        }
                        //tạo đơn khi đã nhấn thêm
                        if ($clickValue == 1 && $request->checkguest == 2) {
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $request->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 1;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //lấy hóa đơn vào
                                
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $export->id;
                                $history->date_time = Carbon::now();
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $productQty;
                                $history->product_unit = $request->product_unit[$i];
                                $history->price_import = $request->product_price[$i];
                                $history->product_total = $productQty * $request->product_price[$i];
                                $history->import_code = null;
                                $history->import_status = 1;
                                $history->guest_id = null;
                                $history->export_qty = null;
                                $history->export_unit = null;
                                $history->price_export = null;
                                $history->export_total = null;
                                $history->export_code = null;
                                $history->export_status = null;
                                $history->total_difference = null;
                                $history->tranport_fee = null;
                                $history->history_note = null;
                                $history->save();
                            }
                            // Lấy thông tin từ bảng productExport và Export
                            $productExports = $export->productExports;

                            // Tính toán giá trị total_sales
                            $totalSales = 0;
                            foreach ($productExports as $productExport) {
                                $totalSales += $productExport->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_import
                            $totalImport = 0;
                            foreach ($productExports as $productExport) {
                                $product = Product::find($productExport->product_id);
                                $totalImport += $product->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_difference
                            if ($export->transport_fee === null) {
                                $debtTransportFee = 0;
                            } else {
                                $debtTransportFee = $export->transport_fee;
                            }

                            $totalDifference = $totalSales - $totalImport - $debtTransportFee;

                            // Lấy thông tin từ bảng Guests
                            $guest = Guests::find($export->guest_id);

                            // Tạo đối tượng Debt và cập nhật giá trị
                            $debt = new Debt();
                            $debt->guest_id = $guest->id;
                            $debt->user_id = Auth::user()->id;
                            $debt->export_id = $export->id;
                            $debt->total_sales = $totalSales;
                            $debt->total_import = $totalImport;
                            $debt->debt_transport_fee = $debtTransportFee;
                            $debt->total_difference = $totalDifference;
                            $debt->debt = $guest->debt;

                            $debt->date_start = $request->export_create;

                            $startDate = Carbon::parse($request->export_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
                            $daysToAdd = $debt->debt; // Số ngày cần thêm

                            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                            // Định dạng ngày kết thúc theo ý muốn
                            $endDateFormatted = $endDate->format('Y-m-d');
                            // dd($endDateFormatted);
                            $debt->date_end = $endDateFormatted;

                            // Xử lí status debt
                            $endDate = Carbon::parse($endDateFormatted);
                            $currentDate = Carbon::now();
                            $daysDiffss = $currentDate->diffInDays($endDate);
                            if ($endDate < $currentDate) {
                                $daysDiff = -$daysDiffss;
                            } else {
                                $daysDiff = $daysDiffss;
                            }

                            if ($debt->debt == 0) {
                                $debt->debt_status = 4;
                            } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                                $debt->debt_status = 2;
                            } elseif ($daysDiff < 0) {
                                $debt->debt_status = 0;
                            } else {
                                $debt->debt_status = 3;
                            }
                            $debt->save();
                        }
                        // Giảm số lượng của sản phẩm trong bảng product
                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];

                            // Lấy số lượng hiện tại của sản phẩm
                            $currentQty = Product::where('id', $productID)->value('product_qty');

                            // Giảm số lượng sản phẩm
                            $newQty = $currentQty - $productQty;

                            // Lấy giá sản phẩm
                            $product = Product::find($productID);
                            $productPrice = $product->product_price;

                            // Tính toán giá trị total
                            $total = $newQty * $productPrice;

                            // Cập nhật số lượng và trường 'total'
                            Product::where('id', $productID)
                                ->update([
                                    'product_qty' => $newQty,
                                    'product_total' => $total
                                ]);
                        }
                        return redirect()->route('exports.index')->with('msg', 'Duyệt đơn thành công!');
                    }
                }
                if ($action === 'action2') {
                    // Tính tổng số lượng cần thiết cho mỗi product_id
                    $productQtyMap = [];
                    $hasEnoughQty = true;
                    if ($productIDs == null) {
                        return redirect()->route('exports.index')->with('warning', 'Chưa thêm sản phẩm!');
                    } else {
                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];

                            $totalQtyNeeded += $productQty;

                            if (!isset($productQtyMap[$productID])) {
                                $productQtyMap[$productID] = 0;
                            }
                            $productQtyMap[$productID] += $productQty;
                        }

                        //thêm khách hàng khi lưu nhanh
                        if ($request->checkguest == 2 && $clickValue == null) {
                            $guest = new Guests();
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_address = $request->guest_address;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_email_personal = $request->guest_email_personal;
                            $guest->guest_note = $request->guest_note;
                            if ($request->debt == null) {
                                $guest->debt = 0;
                            } else {
                                $guest->debt = $request->debt;
                            }
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $guest->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 1;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                $product = Product::findorfail($productID);
                                $product->product_trade += $productQty;
                                $product->save();
                            }
                        }
                        //cập nhật khách hàng khi lưu nhanh
                        if ($request->checkguest == 1 && $updateClick == null) {
                            $guest = Guests::find($request->id);
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_address = $request->guest_address;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_email_personal = $request->guest_email_personal;
                            $guest->guest_note = $request->guest_note;
                            if ($request->debt == null) {
                                $guest->debt = 0;
                            } else {
                                $guest->debt = $request->debt;
                            }
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $guest->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 1;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                $product = Product::findorfail($productID);
                                $product->product_trade += $productQty;
                                $product->save();
                            }
                        }
                        //tạo đơn khi đã click nút thêm
                        if ($request->checkguest == 2 && $clickValue == 1) {
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $request->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 1;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                $product = Product::findorfail($productID);
                                $product->product_trade += $productQty;
                                $product->save();
                            }
                        }
                        //tạo đơn khi đã click nút cập nhật
                        if ($updateClick == 1 && $request->checkguest == 1) {
                            // Tạo đơn xuất hàng
                            $export = new Exports();
                            $export->guest_id = $request->id;
                            $export->user_id = Auth::user()->id;
                            $export->total = $request->totalValue;
                            $export->export_status = 1;
                            $export->note_form = $request->note_form;
                            $export->transport_fee = $request->transport_fee;
                            $export->export_code = $request->export_code;
                            if ($request->export_create == null) {
                                $export->created_at = Carbon::now();
                            } else {
                                $export->created_at = $request->export_create;
                            }
                            $export->save();
                            // Tạo các bản ghi trong bảng product export
                            for ($i = 0; $i < count($productIDs); $i++) {
                                $productID = $productIDs[$i];
                                $productQty = $productQtys[$i];
                                $nameProduct = Product::where('id', $productID)->value('product_name');
                                $proExport = new ProductExports();
                                $proExport->product_id = $productID;
                                $proExport->export_id = $export->id;
                                $proExport->product_name = $nameProduct;
                                $proExport->product_unit = $request->product_unit[$i];
                                $proExport->product_qty = $productQty;
                                $proExport->product_price = $request->product_price[$i];
                                $proExport->product_note = $request->product_note[$i];
                                $proExport->product_tax = $request->product_tax[$i];
                                $proExport->product_total = $request->totalValue;
                                $proExport->save();
                                $product = Product::findorfail($productID);
                                $product->product_trade += $productQty;
                                $product->save();
                            }
                        }
                        if (!$hasEnoughQty) {
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng tồn kho!');
                        } else {
                            return redirect()->route('exports.index')->with('msg', 'Tạo đơn thành công!');
                        }
                    }
                }
            }
        } else {
            return redirect()->back();
        }
    }
    function calculateAllDays($startDate, $daysToAdd)
    {
        $createdDate = Carbon::parse($startDate);
        $currentDate = $createdDate->copy()->addDays($daysToAdd);

        return $currentDate->format('Y-m-d');
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
        $exports = Exports::find($id);
        $guest = Guests::find($exports->guest_id);
        $customer = Guests::all();
        $productExport = productExports::select('product_exports.*')
            ->join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->join('product', 'product.id', '=', 'product_exports.product_id')
            ->selectRaw('(product.product_qty - product.product_trade) as tonkho')
            ->where('export_id', $id)
            ->get();
        $product_code = Product::all();
        $title = 'Chi tiết đơn hàng';
        return view('tables.export.editExport', compact('exports', 'guest', 'productExport', 'product_code', 'customer', 'title'));
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
        $exports = Exports::find($id);
        $productIDs = $request->input('product_id');
        $productQtys = $request->input('product_qty');
        $existingProductIDs = [];
        $existingProductQuantities = [];
        $totalQtyNeeded = 0;
        $clickValue = $request->input('click');
        $updateClick = $request->input('updateClick');

        if ($request->has('submitBtn')) {
            $action = $request->input('submitBtn');
            if ($action === 'action1') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
                        $existingProductQuantities[$productExport->product_id] = $productExport->product_qty;
                    }
                }
                if ($productIDs != null) {
                    // Cập nhật thông tin sản phẩm đang tồn tại
                    for ($i = 0; $i < count($productIDs); $i++) {
                        $productID = $productIDs[$i];
                        $productQty = $productQtys[$i];
                        $nameProduct = Product::where('id', $productID)->value('product_name');

                        if (in_array($productID, $existingProductIDs)) {
                            $proExport = ProductExports::where('export_id', $id)
                                ->where('product_id', $productID)
                                ->first();

                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                            $currentTrade = Product::where('id', $productID)->value('product_trade');
                            $existingQuantity = $existingProductQuantities[$productID] ?? 0;
                            $newTrade = ($currentTrade - $existingQuantity) + $productQty;
                            $updateTrade = $newTrade - $productQty;

                            Product::where('id', $productID)
                                ->update([
                                    'product_trade' => $updateTrade,
                                ]);
                        } else {
                            $proExport = new ProductExports();
                            $proExport->product_id = $productID;
                            $proExport->export_id = $exports->id;
                            $proExport->product_name = $nameProduct;
                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                        }

                        $totalQtyNeeded += $productQty;
                    }

                    // Xóa các sản phẩm đã bị xóa
                    $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                        ->whereNotIn('product_id', $productIDs)
                        ->get();
                    foreach ($productExportsToDelete as $productExport) {
                        // Lấy số lượng, đang giao dịch hiện tại của sản phẩm
                        $productID = $productExport->product_id;
                        $productQty = $productExport->product_qty;
                        Product::where('id', $productID)
                            ->decrement('product_trade', $productQty);
                        // Xóa sản phẩm
                        $productExport->delete();
                    }

                    // Giảm số lượng của sản phẩm trong bảng product
                    for ($i = 0; $i < count($productIDs); $i++) {
                        $productID = $productIDs[$i];
                        $productQty = $productQtys[$i];

                        // Lấy số lượng, đang giao dịch hiện tại của sản phẩm
                        $currentQty = Product::where('id', $productID)->value('product_qty');

                        // Giảm số lượng sản phẩm và số lượng đang giao dịch
                        $newQty = $currentQty - $productQty;

                        // Lấy giá sản phẩm
                        $product = Product::find($productID);
                        $productPrice = $product->product_price;

                        // Tính toán giá trị total
                        $total = $newQty * $productPrice;

                        // Cập nhật số lượng và trường 'total'
                        Product::where('id', $productID)
                            ->update([
                                'product_qty' => $newQty,
                                'product_total' => $total,
                            ]);
                    }
                    if ($request->id != null) {
                        // Tạo đơn xuất hàng
                        $exports->guest_id = $request->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 2;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->export_code = $request->export_code;
                        if ($request->export_create == null) {
                            $exports->created_at = Carbon::now();
                        } else {
                            $exports->created_at = $request->export_create;
                        }
                        $exports->save();
                    } else if ($clickValue != 1) {
                        $guest = new Guests();
                        $guest->guest_name = $request->guest_name;
                        $guest->guest_address = $request->guest_address;
                        $guest->guest_code = $request->guest_code;
                        $guest->guest_receiver = $request->guest_receiver;
                        $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                        $guest->guest_email = $request->guest_email;
                        $guest->guest_status = 1;
                        $guest->guest_phone = $request->guest_phone;
                        $guest->guest_note = $request->guest_note;
                        if ($request->debt == 0) {
                            $guest->debt = 0;
                        } else {
                            $guest->debt = $request->debt;
                        }
                        $guest->save();
                        // Tạo đơn xuất hàng
                        $exports->guest_id = $guest->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 2;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->export_code = $request->export_code;
                        if ($request->export_create == null) {
                            $exports->created_at = Carbon::now();
                        } else {
                            $exports->created_at = $request->export_create;
                        }
                        $exports->save();
                    }
                    // Lấy lại thông tin exports từ cơ sở dữ liệu (nếu cần)
                    $exports = Exports::find($exports->id);

                    // Lấy thông tin productExports từ exports
                    $productExports = $exports->productExports;

                    // Tiếp tục tính toán các giá trị mong muốn
                    $totalSales = 0;
                    $totalImport = 0;
                    $totalDifference = 0;

                    foreach ($productExports as $productExport) {
                        // Tính toán giá trị total_sales
                        $totalSales += $productExport->product_price * $productExport->product_qty;

                        // Tính toán giá trị total_import
                        $product = Product::find($productExport->product_id);
                        $totalImport += $product->product_price * $productExport->product_qty;
                    }

                    // Tính toán giá trị total_difference
                    if ($exports->transport_fee === null) {
                        $debtTransportFee = 0;
                    } else {
                        $debtTransportFee = $exports->transport_fee;
                    }
                    $totalDifference = $totalSales - $totalImport - $debtTransportFee;
                    // Lấy thông tin từ bảng Guests
                    $guest = Guests::find($exports->guest_id);
                    // Tạo đối tượng Debt và cập nhật giá trị
                    $debt = new Debt();
                    $debt->guest_id = $guest->id;
                    $debt->user_id = Auth::user()->id;
                    $debt->export_id = $exports->id;
                    $debt->total_sales = $totalSales;
                    $debt->total_import = $totalImport;
                    $debt->debt_transport_fee = $debtTransportFee;
                    $debt->total_difference = $totalDifference;
                    $debt->debt = $guest->debt;
                    $debt->date_start = $request->export_create;

                    $startDate = Carbon::parse($request->export_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
                    $daysToAdd = $debt->debt; // Số ngày cần thêm

                    $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                    // Định dạng ngày kết thúc theo ý muốn
                    $endDateFormatted = $endDate->format('Y-m-d');
                    // dd($endDateFormatted);
                    $debt->date_end = $endDateFormatted;


                    // Xử lí status debt
                    $endDate = Carbon::parse($endDateFormatted);
                    $currentDate = Carbon::now();
                    $daysDiffss = $currentDate->diffInDays($endDate);
                    if ($endDate < $currentDate) {
                        $daysDiff = -$daysDiffss;
                    } else {
                        $daysDiff = $daysDiffss;
                    }

                    if ($debt->debt == 0) {
                        $debt->debt_status = 4;
                    } elseif ($daysDiff <= 3 && $daysDiff >= 0) {
                        $debt->debt_status = 2;
                    } elseif ($daysDiff < 0) {
                        $debt->debt_status = 0;
                    } else {
                        $debt->debt_status = 3;
                    }
                    $debt->save();
                    return redirect()->route('exports.index')->with('msg', 'Duyệt đơn thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                }
            } elseif ($action === 'action2') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
                        $existingProductQuantities[$productExport->product_id] = $productExport->product_qty;
                    }
                }
                // Xóa các sản phẩm đã bị xóa
                $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                    ->whereNotIn('product_id', $productIDs)
                    ->get();
                foreach ($productExportsToDelete as $productExport) {
                    // Lấy số lượng, đang giao dịch hiện tại của sản phẩm
                    $productID = $productExport->product_id;
                    $productQty = $productExport->product_qty;
                    Product::where('id', $productID)
                        ->decrement('product_trade', $productQty);
                    // Xóa sản phẩm
                    $productExport->delete();
                }

                // Cập nhật thông tin sản phẩm đang tồn tại
                for ($i = 0; $i < count($productIDs); $i++) {
                    $productID = $productIDs[$i];
                    $productQty = $productQtys[$i];
                    $nameProduct = Product::where('id', $productID)->value('product_name');

                    if (in_array($productID, $existingProductIDs)) {
                        $proExport = ProductExports::where('export_id', $id)
                            ->where('product_id', $productID)
                            ->first();

                        $proExport->product_unit = $request->product_unit[$i];
                        $proExport->product_qty = $productQty;
                        $proExport->product_price = $request->product_price[$i];
                        $proExport->product_note = $request->product_note[$i];
                        $proExport->product_tax = $request->product_tax[$i];
                        $proExport->product_total = $request->totalValue;
                        $proExport->save();
                        $currentTrade = Product::where('id', $productID)->value('product_trade');
                        $existingQuantity = $existingProductQuantities[$productID] ?? 0;
                        $newTrade = ($currentTrade - $existingQuantity) + $productQty;
                        $updateTrade = $newTrade - $productQty;
                        Product::where('id', $productID)
                            ->update([
                                'product_trade' => $updateTrade,
                            ]);
                    } else {
                        $proExport = new ProductExports();
                        $proExport->product_id = $productID;
                        $proExport->export_id = $exports->id;
                        $proExport->product_name = $nameProduct;
                        $proExport->product_unit = $request->product_unit[$i];
                        $proExport->product_qty = $productQty;
                        $proExport->product_price = $request->product_price[$i];
                        $proExport->product_note = $request->product_note[$i];
                        $proExport->product_tax = $request->product_tax[$i];
                        $proExport->product_total = $request->totalValue;
                        $proExport->save();
                        $currentTrade = Product::where('id', $productID)->value('product_trade');
                        $newTrade = $currentTrade + $productQty;

                        Product::where('id', $productID)
                            ->update([
                                'product_trade' => $newTrade,
                            ]);
                    }

                    $totalQtyNeeded += $productQty;
                }

                // Cập nhật trạng thái và tổng giá trị của export
                $exports->export_status = 0;
                $exports->total = $request->totalValue;
                $exports->note_form = $request->note_form;
                $exports->transport_fee = $request->transport_fee;
                $exports->export_code = $request->export_code;
                if ($request->export_create == null) {
                    $exports->created_at = Carbon::now();
                } else {
                    $exports->created_at = $request->export_create;
                }
                $exports->save();
                return redirect()->route('exports.index')->with('msg', 'Hủy đơn thành công!');
            } elseif ($action === 'action3') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
                        $existingProductQuantities[$productExport->product_id] = $productExport->product_qty;
                    }
                }

                if ($productIDs != null) {
                    // Cập nhật thông tin sản phẩm đang tồn tại
                    for ($i = 0; $i < count($productIDs); $i++) {
                        $productID = $productIDs[$i];
                        $productQty = $productQtys[$i];
                        $nameProduct = Product::where('id', $productID)->value('product_name');

                        if (in_array($productID, $existingProductIDs)) {
                            $proExport = ProductExports::where('export_id', $id)
                                ->where('product_id', $productID)
                                ->first();

                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                            $currentTrade = Product::where('id', $productID)->value('product_trade');
                            $existingQuantity = $existingProductQuantities[$productID] ?? 0;
                            $newTrade = ($currentTrade - $existingQuantity) + $productQty;

                            Product::where('id', $productID)
                                ->update([
                                    'product_trade' => $newTrade,
                                ]);
                        } else {
                            $proExport = new ProductExports();
                            $proExport->product_id = $productID;
                            $proExport->export_id = $exports->id;
                            $proExport->product_name = $nameProduct;
                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                            $currentTrade = Product::where('id', $productID)->value('product_trade');
                            $newTrade = $currentTrade + $productQty;

                            Product::where('id', $productID)
                                ->update([
                                    'product_trade' => $newTrade,
                                ]);
                        }

                        $totalQtyNeeded += $productQty;
                    }
                    // Xóa các sản phẩm đã bị xóa
                    $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                        ->whereNotIn('product_id', $productIDs)
                        ->get();
                    foreach ($productExportsToDelete as $productExport) {
                        // Lấy số lượng, đang giao dịch hiện tại của sản phẩm
                        $productID = $productExport->product_id;
                        $productQty = $productExport->product_qty;
                        Product::where('id', $productID)
                            ->decrement('product_trade', $productQty);
                        // Xóa sản phẩm
                        $productExport->delete();
                    }
                    //cập nhật, thêm
                    if ($request->id != null) {
                        $exports->guest_id = $request->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 1;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->export_code = $request->export_code;
                        if ($request->export_create == null) {
                            $exports->created_at = Carbon::now();
                        } else {
                            $exports->created_at = $request->export_create;
                        }
                        $exports->save();
                    } else if ($clickValue != 1) {
                        $guest = new Guests();
                        $guest->guest_name = $request->guest_name;
                        $guest->guest_address = $request->guest_address;
                        $guest->guest_code = $request->guest_code;
                        $guest->guest_receiver = $request->guest_receiver;
                        $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                        $guest->guest_email = $request->guest_email;
                        $guest->guest_status = 1;
                        $guest->guest_phone = $request->guest_phone;
                        $guest->guest_note = $request->guest_note;
                        if ($request->debt == 0) {
                            $guest->debt = 0;
                        } else {
                            $guest->debt = $request->debt;
                        }
                        $guest->save();
                        $exports->guest_id = $guest->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 1;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->export_code = $request->export_code;
                        if ($request->export_create == null) {
                            $exports->created_at = Carbon::now();
                        } else {
                            $exports->created_at = $request->export_create;
                        }
                        $exports->save();
                    }
                    return redirect()->route('exports.index')->with('msg', 'Cập nhật thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                }
            } elseif ($action === 'action4') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
                        $existingProductQuantities[$productExport->product_id] = $productExport->product_qty;
                    }
                }
                // Cập nhật thông tin sản phẩm đang tồn tại
                for ($i = 0; $i < count($productIDs); $i++) {
                    $productID = $productIDs[$i];
                    $productQty = $productQtys[$i];
                    $nameProduct = Product::where('id', $productID)->value('product_name');

                    if (in_array($productID, $existingProductIDs)) {
                        $proExport = ProductExports::where('export_id', $id)
                            ->where('product_id', $productID)
                            ->first();

                        $proExport->product_unit = $request->product_unit[$i];
                        $proExport->product_qty = $productQty;
                        $proExport->product_price = $request->product_price[$i];
                        $proExport->product_note = $request->product_note[$i];
                        $proExport->product_tax = $request->product_tax[$i];
                        $proExport->product_total = $request->totalValue;
                        $proExport->save();
                        //số lượng hiện tại
                        $currentQty = Product::where('id', $productID)->value('product_qty');
                        //giá nhập
                        $currentPrice = Product::where('id', $productID)->value('product_price');
                        //giá trị tồn kho
                        $currentTotal = Product::where('id', $productID)->value('product_total');
                        $newQty = $currentQty + $productQty;
                        $product_total = $productQty * $currentPrice;
                        $total = $product_total + $currentTotal;
                        Product::where('id', $productID)
                            ->update([
                                'product_qty' => $newQty,
                                'product_total' => $total,
                            ]);
                    }
                    $totalQtyNeeded += $productQty;
                }
                //cập nhật tình trạng xuất hàng
                $exports->export_status = 0;
                $exports->total = $request->totalValue;
                $exports->note_form = $request->note_form;
                $exports->transport_fee = $request->transport_fee;
                $exports->export_code = $request->export_code;
                if ($request->export_create == null) {
                    $exports->created_at = Carbon::now();
                } else {
                    $exports->created_at = $request->export_create;
                }
                $exports->save();
                //xóa công nợ
                Debt::where('export_id', $exports->id)->delete();
                return redirect()->route('exports.index')->with('msg', 'Hủy đơn thành công!');
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
    }
    public function searchExport(Request $request)
    {
        $data = $request->all();
        $customer = Guests::findOrFail($data['idCustomer']);
        return $customer;
    }
    public function updateCustomer(Request $request)
    {
        $data = $request->all();
        if ($data['updateClick'] == 1) {
            $update_guest = Guests::findOrFail($data['id']);
            $update_guest->guest_name = $data['guest_name'];
            $update_guest->guest_address = $data['guest_address'];
            $update_guest->guest_code = $data['guest_code'];
            $update_guest->guest_receiver = $data['guest_receiver'];
            $update_guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
            $update_guest->guest_email = $data['guest_email'];
            $update_guest->guest_phone = $data['guest_phone'];
            $update_guest->guest_email_personal = $data['guest_email_personal'];
            $update_guest->guest_note = $data['guest_note'];
            $update_guest->debt = $data['debt'];
            $update_guest->save();
            return response()->json(['message' => 'Lưu thông tin thành công!']);
        }
    }
    public function addCustomer(Request $request)
    {
        $data = $request->all();
        if ($data['click'] == 1) {
            // Kiểm tra xem dữ liệu đã tồn tại trong cơ sở dữ liệu hay chưa
            $existingCustomer = Guests::orwhere('guest_code', $request->guest_code)
                ->orwhere('guest_name', $request->guest_name)
                ->first();

            if ($existingCustomer) {
                // Dữ liệu đã tồn tại, trả về thông báo
                session()->flash('msg', 'Xóa đơn hàng thành công');
                return response()->json(['message' => 'Thông tin khách hàng đã có trong hệ thống']);
            } else {
                // Tạo mới bản ghi khách hàng
                $guest = new Guests();
                $guest->guest_name = $data['guest_name'];
                $guest->guest_address = $data['guest_address'];
                $guest->guest_code = $data['guest_code'];
                $guest->guest_receiver = $data['guest_receiver'];
                $guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
                $guest->guest_email = $data['guest_email'];
                $guest->guest_status = 1;
                $guest->guest_phone = $data['guest_phone'];
                $guest->guest_email_personal = $data['guest_email_personal'];
                $guest->guest_note = $data['guest_note'];
                $guest->debt = $data['debt'];
                $guest->user_id = Auth::user()->id;
                $guest->save();

                // Trả về giá trị id của khách hàng vừa lưu
                return response()->json(['id' => $guest->id]);
            }
        }
    }

    public function getProduct(Request $request)
    {
        $data = $request->all();
        $product = Product::select('product.*')
            ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
            ->where('product.id', $data['idProduct'])
            ->first();
        return response()->json($product);
    }

    public function limit_qty(Request $request)
    {
        $data = $request->all();
        $limit_qty = Product::select('product.*')
            ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
            ->where('product.id', $data['product_id'])
            ->first();
        return response()->json($limit_qty);
    }

    // Xóa đơn hàng AJAX
    public function deleteExports(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            Exports::whereIn('id', $list)->delete();
            session()->flash('msg', 'Xóa đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Xóa đơn hàng thành công', 'ids' => $list]);
        }
        session()->flash('warning', 'Không tìm thấy đơn hàng cần xóa');
        return response()->json(['success' => false, 'msg' => 'Không tìm thấy đơn hàng cần xóa']);
    }
    public function cancelBillExport(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Exports::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                if ($value->export_status != 2) {
                    $value->export_status = 0;
                    $value->save();
                }
            }
            session()->flash('msg', 'Hủy đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Hủy Đơn Hàng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
    public function checkqty(Request $request)
    {
        $productIDs = $request->input('productIDs');
        $productQtys = $request->input('productQtys');

        // Kiểm tra số lượng sản phẩm
        $productQtyMap = [];
        $hasEnoughQty = true;

        for ($i = 0; $i < count($productIDs); $i++) {
            $productID = $productIDs[$i];
            $productQty = $productQtys[$i];

            // Kiểm tra và cập nhật seri_status
            $hasEnoughQty = true;
            foreach ($productQtyMap as $productID => $productQty) {
                $serinumbers = Serinumbers::where('product_id', $productID)
                    ->where('seri_status', 1)
                    ->limit($productQty)
                    ->get();

                if (count($serinumbers) < $productQty) {
                    $hasEnoughQty = false;
                    break;
                }
            }

            if (!$hasEnoughQty) {
                return response()->json(['success' => false, 'message' => 'Vượt quá số lượng tồn kho!']);
            }
        }
        return response()->json(['success' => true]);
    }
}
