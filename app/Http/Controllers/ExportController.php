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
        //Số hóa đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['exports.export_code', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Số hóa đơn:', 'values' => $nameArr, 'class' => 'id']);
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
            ->leftjoin('users', 'exports.user_id', '=', 'users.id')->select('guests.guest_name as guests', 'users.name as name')->get();
        $productEx = productExports::all();
        $perPage = $request->input('perPageinput', 25);
        $export = $this->exports->getAllExports($filters, $perPage, $status, $name, $guest, $date, $keywords, $sortBy, $sortType);
        $title = 'Xuất hàng';
        $productsCreator = $this->exports->productsCreator();
        // dd($productsCreator);
        return view('tables.export.exports', compact('productEx', 'perPage', 'export', 'exports', 'sortType', 'string', 'title', 'productsCreator'));
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
        $customer = Guests::all();
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
            $export_seris = $request->selected_serial_numbers;
            $totalQtyNeeded = 0;
            $firstProduct = true;
            if ($request->has('submitBtn')) {
                $action = $request->input('submitBtn');
                //Chốt đơn
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
                            $product = Product::select('product.*')
                                ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
                                ->where('product.id', $productID)
                                ->first();
                            $limit = $product->qty_exist;
                            if ($productQty > $limit) {
                                $hasEnoughQty = false;
                                break;
                            }
                        }
                        if (!$hasEnoughQty) {
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng khi lưu nhanh
                            if ($request->checkguest == 2 && $clickValue == null) {
                                $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                    ->orwhere('guest_code', $request->guest_code)
                                    ->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
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
                                    $guest->user_id = Auth::user()->id;
                                    $guest->save();
                                    $guestID = $guest->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                    //lấy hóa đơn vào
                                    $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('orders.product_code');
                                    //lấy bảng nhập hàng
                                    $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_total');
                                    //công nợ nhập
                                    $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt');
                                    //tình trạng nhập hàng
                                    $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt_status');
                                    //lấy số lượng nhập
                                    $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_qty');
                                    //lấy id Import
                                    $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.import_id');
                                    //lấy công nợ nhập
                                    $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)->first();
                                    //lấy thông tin sản phẩm
                                    $product = Product::find($productID);
                                    // Lấy thông tin từ bảng Guests
                                    $guest = Guests::find($export->guest_id);
                                    //thêm lịch sử giao dịch
                                    $history = new History();
                                    $history->export_id = $export->id;
                                    $history->product_id = $productID;
                                    $history->import_id = $import_id;
                                    $history->date_time = $export->created_at;
                                    $history->user_id = Auth::user()->id;
                                    $history->provide_id = $provide_id;
                                    $history->product_name = $nameProduct;
                                    $history->product_qty = $qty_exist;
                                    $history->product_unit = $product->product_unit;
                                    $history->price_import = $product->product_price;
                                    $history->product_total = $productorders;
                                    $history->import_code = $import_code;
                                    $history->debt_import = $debt_import;
                                    $history->import_status = $import_status;
                                    $history->guest_id = $export->guest_id;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $export->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    if ($firstProduct && $history->tranport_fee === null) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $export->transport_fee;
                                        $history->tranport_fee = $export->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
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
                                $debt->created_at = $request->export_create;
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
                                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                                    $debt->debt_status = 2;
                                } elseif ($daysDiff == 0) {
                                    $debt->debt_status = 5;
                                } elseif ($daysDiff < 0) {
                                    $debt->debt_status = 0;
                                } else {
                                    $debt->debt_status = 3;
                                }
                                $debt->save();
                                //tình trạng xuất hàng
                                $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                                    ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                                    ->leftJoin('debts', 'debts.export_id', 'exports.id')
                                    ->where('product.id', $productID)
                                    ->where('exports.id', $export->id)
                                    ->value('debts.debt_status');
                                //cập nhật tình trạng xuất hàng cho bảng History
                                History::where('export_id', $history->export_id)
                                    ->update([
                                        'export_status' => $export_status,
                                        'debt_export_end' => $debt->date_end,
                                    ]);
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 3]);
                                }
                            }
                            //cập nhật khách hàng khi lưu nhanh
                            if ($request->checkguest == 1 && $updateClick == null) {
                                $existingCustomer = Guests::where('id', '!=', $request->id)
                                    ->where(function ($query) use ($request) {
                                        $query->where('guest_name', $request->guest_name)
                                            ->orWhere('guest_code', $request->guest_code);
                                    })->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
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
                                    $guestID = $guest->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                    //lấy hóa đơn vào
                                    $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('orders.product_code');
                                    //lấy bảng nhập hàng
                                    $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_total');
                                    //công nợ nhập
                                    $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt');
                                    //tình trạng nhập hàng
                                    $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt_status');
                                    //lấy số lượng nhập
                                    $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_qty');
                                    //lấy id Import
                                    $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.import_id');
                                    //lấy công nợ nhập
                                    $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)->first();
                                    //lấy thông tin sản phẩm
                                    $product = Product::find($productID);
                                    // Lấy thông tin từ bảng Guests
                                    $guest = Guests::find($export->guest_id);
                                    //thêm lịch sử giao dịch
                                    $history = new History();
                                    $history->export_id = $export->id;
                                    $history->product_id = $productID;
                                    $history->import_id = $import_id;
                                    $history->date_time = $export->created_at;
                                    $history->user_id = Auth::user()->id;
                                    $history->provide_id = $provide_id;
                                    $history->product_name = $nameProduct;
                                    $history->product_qty = $qty_exist;
                                    $history->product_unit = $product->product_unit;
                                    $history->price_import = $product->product_price;
                                    $history->product_total = $productorders;
                                    $history->import_code = $import_code;
                                    $history->debt_import = $debt_import;
                                    $history->import_status = $import_status;
                                    $history->guest_id = $export->guest_id;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $export->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    if ($firstProduct && $history->tranport_fee === null) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $export->transport_fee;
                                        $history->tranport_fee = $export->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
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
                                $debt->created_at = $request->export_create;
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
                                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                                    $debt->debt_status = 2;
                                } elseif ($daysDiff == 0) {
                                    $debt->debt_status = 5;
                                } elseif ($daysDiff < 0) {
                                    $debt->debt_status = 0;
                                } else {
                                    $debt->debt_status = 3;
                                }
                                $debt->save();
                                //tình trạng xuất hàng
                                $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                                    ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                                    ->leftJoin('debts', 'debts.export_id', 'exports.id')
                                    ->where('product.id', $productID)
                                    ->where('exports.id', $export->id)
                                    ->value('debts.debt_status');
                                //cập nhật tình trạng xuất hàng cho bảng History
                                History::where('export_id', $history->export_id)
                                    ->update([
                                        'export_status' => $export_status,
                                        'debt_export_end' => $debt->date_end,
                                    ]);
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 3]);
                                }
                            }
                            //tạo đơn khi đã nhấn cập nhật
                            if ($request->checkguest == 1 && $updateClick == 1) {
                                $existingCustomer = Guests::where('id', '!=', $request->id)
                                    ->where(function ($query) use ($request) {
                                        $query->where('guest_name', $request->guest_name)
                                            ->orWhere('guest_code', $request->guest_code);
                                    })->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
                                    $guestID = $request->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                    //lấy hóa đơn vào
                                    $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('orders.product_code');
                                    //lấy bảng nhập hàng
                                    $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_total');
                                    //công nợ nhập
                                    $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt');
                                    //tình trạng nhập hàng
                                    $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt_status');
                                    //lấy số lượng nhập
                                    $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_qty');
                                    //lấy id Import
                                    $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.import_id');
                                    //lấy công nợ nhập
                                    $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)->first();
                                    //lấy thông tin sản phẩm
                                    $product = Product::find($productID);
                                    // Lấy thông tin từ bảng Guests
                                    $guest = Guests::find($export->guest_id);
                                    //thêm lịch sử giao dịch
                                    $history = new History();
                                    $history->export_id = $export->id;
                                    $history->product_id = $productID;
                                    $history->import_id = $import_id;
                                    $history->date_time = $export->created_at;
                                    $history->user_id = Auth::user()->id;
                                    $history->provide_id = $provide_id;
                                    $history->product_name = $nameProduct;
                                    $history->product_qty = $qty_exist;
                                    $history->product_unit = $product->product_unit;
                                    $history->price_import = $product->product_price;
                                    $history->product_total = $productorders;
                                    $history->import_code = $import_code;
                                    $history->debt_import = $debt_import;
                                    $history->import_status = $import_status;
                                    $history->guest_id = $export->guest_id;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $export->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    if ($firstProduct && $history->tranport_fee === null) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $export->transport_fee;
                                        $history->tranport_fee = $export->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
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
                                $debt->created_at = $request->export_create;
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
                                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                                    $debt->debt_status = 2;
                                } elseif ($daysDiff == 0) {
                                    $debt->debt_status = 5;
                                } elseif ($daysDiff < 0) {
                                    $debt->debt_status = 0;
                                } else {
                                    $debt->debt_status = 3;
                                }
                                $debt->save();
                                //tình trạng xuất hàng
                                $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                                    ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                                    ->leftJoin('debts', 'debts.export_id', 'exports.id')
                                    ->where('product.id', $productID)
                                    ->where('exports.id', $export->id)
                                    ->value('debts.debt_status');
                                //cập nhật tình trạng xuất hàng cho bảng History
                                History::where('export_id', $history->export_id)
                                    ->update([
                                        'export_status' => $export_status,
                                        'debt_export_end' => $debt->date_end,
                                    ]);
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 3]);
                                }
                            }
                            //tạo đơn khi đã nhấn thêm
                            if ($clickValue == 1 && $request->checkguest == 2) {
                                $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                    ->orwhere('guest_code', $request->guest_code)
                                    ->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
                                    $guestID = $request->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                    //lấy hóa đơn vào
                                    $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('orders.product_code');
                                    //lấy bảng nhập hàng
                                    $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_total');
                                    //công nợ nhập
                                    $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt');
                                    //tình trạng nhập hàng
                                    $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.debt_status');
                                    //lấy số lượng nhập
                                    $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->where('product.id', $productID)->value('productorders.product_qty');
                                    //lấy id Import
                                    $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)
                                        ->value('debt_import.import_id');
                                    //lấy công nợ nhập
                                    $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                        ->where('product.id', $productID)->first();
                                    //lấy thông tin sản phẩm
                                    $product = Product::find($productID);
                                    // Lấy thông tin từ bảng Guests
                                    $guest = Guests::find($export->guest_id);
                                    //thêm lịch sử giao dịch
                                    $history = new History();
                                    $history->export_id = $export->id;
                                    $history->product_id = $productID;
                                    $history->import_id = $import_id;
                                    $history->date_time = $export->created_at;
                                    $history->user_id = Auth::user()->id;
                                    $history->provide_id = $provide_id;
                                    $history->product_name = $nameProduct;
                                    $history->product_qty = $qty_exist;
                                    $history->product_unit = $product->product_unit;
                                    $history->price_import = $product->product_price;
                                    $history->product_total = $productorders;
                                    $history->import_code = $import_code;
                                    $history->debt_import = $debt_import;
                                    $history->import_status = $import_status;
                                    $history->guest_id = $export->guest_id;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $export->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    if ($firstProduct && $history->tranport_fee === null) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $export->transport_fee;
                                        $history->tranport_fee = $export->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
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
                                $debt->created_at = $request->export_create;
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
                                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                                    $debt->debt_status = 2;
                                } elseif ($daysDiff == 0) {
                                    $debt->debt_status = 5;
                                } elseif ($daysDiff < 0) {
                                    $debt->debt_status = 0;
                                } else {
                                    $debt->debt_status = 3;
                                }
                                $debt->save();
                                //tình trạng xuất hàng
                                $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                                    ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                                    ->leftJoin('debts', 'debts.export_id', 'exports.id')
                                    ->where('product.id', $productID)
                                    ->where('exports.id', $export->id)
                                    ->value('debts.debt_status');
                                //cập nhật tình trạng xuất hàng cho bảng History
                                History::where('export_id', $history->export_id)
                                    ->update([
                                        'export_status' => $export_status,
                                        'debt_export_end' => $debt->date_end,
                                    ]);
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 3]);
                                }
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
                }
                //Đang báo giá
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
                            $product = Product::select('product.*')
                                ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
                                ->where('product.id', $productID)
                                ->first();
                            $limit = $product->qty_exist;
                            if ($productQty > $limit) {
                                $hasEnoughQty = false;
                                break;
                            }
                        }
                        if (!$hasEnoughQty) {
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng khi lưu nhanh
                            if ($request->checkguest == 2 && $clickValue == null) {
                                $guestID = null;
                                $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                    ->orwhere('guest_code', $request->guest_code)
                                    ->first();
                                if (!$existingCustomer) {
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
                                    $guest->user_id = Auth::user()->id;
                                    $guest->save();
                                    $guestID = $guest->id;
                                } else {
                                    $guestID = $existingCustomer->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 2]);
                                }
                            }
                            //cập nhật khách hàng khi lưu nhanh
                            if ($request->checkguest == 1 && $updateClick == null) {
                                $guestID = null;
                                $existingCustomer = Guests::where('id', '!=', $request->id)
                                    ->where(function ($query) use ($request) {
                                        $query->where('guest_name', $request->guest_name)
                                            ->orWhere('guest_code', $request->guest_code);
                                    })->first();
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
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
                                    $guestID = $guest->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 2]);
                                }
                            }
                            //tạo đơn khi đã click nút thêm
                            if ($request->checkguest == 2 && $clickValue == 1) {
                                $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                    ->orwhere('guest_code', $request->guest_code)
                                    ->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
                                    $guestID = $request->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 2]);
                                }
                            }
                            //tạo đơn khi đã click nút cập nhật
                            if ($updateClick == 1 && $request->checkguest == 1) {
                                $existingCustomer = Guests::where('id', '!=', $request->id)
                                    ->where(function ($query) use ($request) {
                                        $query->where('guest_name', $request->guest_name)
                                            ->orWhere('guest_code', $request->guest_code);
                                    })->first();
                                $guestID = null;
                                if ($existingCustomer) {
                                    $guestID = $existingCustomer->id;
                                } else {
                                    $guestID = $request->id;
                                }
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guestID;
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
                                // Thêm S/N vào đơn xuất hàng
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $export->id, 'seri_status' => 2]);
                                }
                            }
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
        $exports = Exports::where('exports.id', $id)
            ->first();
        $check = Exports::where('exports.id', $id)
            ->leftJoin('debts', 'debts.export_id', 'exports.id')
            ->first();
        $guest = Guests::find($exports->guest_id);
        $customer = Guests::all();
        $productExport = productExports::select('product_exports.*', 'product.product_tax as thue')
            ->join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->join('product', 'product.id', '=', 'product_exports.product_id')
            ->selectRaw('(product.product_qty - product.product_trade) as tonkho')
            ->where('export_id', $id)
            ->get();
        $SnProduct = Serinumbers::all();
        $productCancel = productExports::select('product_exports.*')
            ->join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->where('export_id', $id)
            ->get();
        $product_code = Product::select('product.*')
            ->whereRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) > 0')
            ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
            ->get();
        $title = 'Chi tiết đơn hàng';
        return view('tables.export.editExport', compact('SnProduct', 'productCancel', 'check', 'exports', 'guest', 'productExport', 'product_code', 'customer', 'title'));
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
        $firstProduct = true;
        $clickValue = $request->input('click');
        $updateClick = $request->input('updateClick');
        $export_seris = $request->selected_serial_numbers;

        if ($request->has('submitBtn')) {
            $action = $request->input('submitBtn');
            //Chốt đơn
            if ($action === 'action1') {
                if ($exports->export_status === 1) {
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
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //lấy hóa đơn vào
                                $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('orders.product_code');
                                //công nợ nhập
                                $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt');
                                //tình trạng nhập hàng
                                $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt_status');
                                //lấy số lượng nhập
                                $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_qty');
                                // lấy id Import
                                $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.import_id');
                                //lấy công nợ nhập
                                $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)->first();
                                //lấy bảng nhập hàng
                                $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_total');
                                //lấy thông tin sản phẩm
                                $product = Product::find($productID);
                                // Lấy thông tin từ bảng Guests
                                $guest = Guests::find($exports->guest_id);
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $exports->id;
                                $history->import_id = $import_id;
                                $history->product_id = $productID;
                                if ($request->export_create == null) {
                                    $history->date_time = Carbon::now();
                                } else {
                                    $history->date_time = $request->export_create;
                                }
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $qty_exist;
                                $history->product_unit = $product->product_unit;
                                $history->price_import = $product->product_price;
                                $history->product_total = $productorders;
                                $history->import_code = $import_code;
                                $history->debt_import = $debt_import;
                                $history->import_status = $import_status;
                                $history->guest_id = $exports->guest_id;
                                $history->export_qty = $productQty;
                                $history->export_unit = $request->product_unit[$i];
                                $history->price_export = $request->product_price[$i];
                                $history->export_total = $productQty * $request->product_price[$i];
                                $history->export_code = $exports->export_code;
                                $history->debt_export = $guest->debt;
                                if ($request->export_create == null) {
                                    $history->debt_export_start = Carbon::now();
                                } else {
                                    $history->debt_export_start = $request->export_create;
                                }
                                $history->debt_import_start = $date_import->date_start;
                                $history->debt_import_end = $date_import->date_end;
                                if ($firstProduct && $history->tranport_fee === null) {
                                    $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $request->transport_fee;
                                    $history->tranport_fee = $request->transport_fee;
                                    $firstProduct = false;
                                } else {
                                    $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                    $history->tranport_fee = 0;
                                }
                                $history->history_note = null;
                                $history->save();
                                //Cập nhật S/N
                                DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 WHERE export_seri = $exports->id");
                                //Cập nhật lại S/N
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $exports->id, 'seri_status' => 3]);
                                }
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
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //lấy hóa đơn vào
                                $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('orders.product_code');
                                //công nợ nhập
                                $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt');
                                //tình trạng nhập hàng
                                $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt_status');
                                //lấy số lượng nhập
                                $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_qty');
                                // lấy id Import
                                $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.import_id');
                                //lấy công nợ nhập
                                $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)->first();
                                //lấy bảng nhập hàng
                                $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_total');
                                //lấy thông tin sản phẩm
                                $product = Product::find($productID);
                                // Lấy thông tin từ bảng Guests
                                $guest = Guests::find($exports->guest_id);
                                //thêm lịch sử giao dịch
                                $history = new History();
                                $history->export_id = $exports->id;
                                $history->import_id = $import_id;
                                $history->product_id = $productID;
                                if ($request->export_create == null) {
                                    $history->date_time = Carbon::now();
                                } else {
                                    $history->date_time = $request->export_create;
                                }
                                $history->user_id = Auth::user()->id;
                                $history->provide_id = $provide_id;
                                $history->product_name = $nameProduct;
                                $history->product_qty = $qty_exist;
                                $history->product_unit = $product->product_unit;
                                $history->price_import = $product->product_price;
                                $history->product_total = $productorders;
                                $history->import_code = $import_code;
                                $history->debt_import = $debt_import;
                                $history->import_status = $import_status;
                                $history->guest_id = $exports->guest_id;
                                $history->export_qty = $productQty;
                                $history->export_unit = $request->product_unit[$i];
                                $history->price_export = $request->product_price[$i];
                                $history->export_total = $productQty * $request->product_price[$i];
                                $history->export_code = $exports->export_code;
                                $history->debt_export = $guest->debt;
                                if ($request->export_create == null) {
                                    $history->debt_export_start = Carbon::now();
                                } else {
                                    $history->debt_export_start = $request->export_create;
                                }
                                $history->debt_import_start = $date_import->date_start;
                                $history->debt_import_end = $date_import->date_end;
                                if ($firstProduct && $history->tranport_fee === null) {
                                    $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $request->transport_fee;
                                    $history->tranport_fee = $request->transport_fee;
                                    $firstProduct = false;
                                } else {
                                    $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                    $history->tranport_fee = 0;
                                }
                                $history->history_note = null;
                                $history->save();
                                //Cập nhật S/N
                                DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 WHERE export_seri = $exports->id");
                                //Cập nhật lại S/N
                                if ($export_seris !== null) {
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $exports->id, 'seri_status' => 3]);
                                }
                            }

                            $totalQtyNeeded += $productQty;
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
                        if ($request->transport_fee === null) {
                            $debtTransportFee = 0;
                        } else {
                            $debtTransportFee = $request->transport_fee;
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
                        $debt->created_at = $request->export_create;
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
                        } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                            $debt->debt_status = 2;
                        } elseif ($daysDiff == 0) {
                            $debt->debt_status = 5;
                        } elseif ($daysDiff < 0) {
                            $debt->debt_status = 0;
                        } else {
                            $debt->debt_status = 3;
                        }
                        $debt->save();
                        //tình trạng xuất hàng
                        $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                            ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                            ->leftJoin('debts', 'debts.export_id', 'exports.id')
                            ->where('product.id', $productID)
                            ->where('exports.id', $exports->id)
                            ->value('debts.debt_status');
                        //cập nhật tình trạng xuất hàng cho bảng History
                        History::where('export_id', $history->export_id)
                            ->update([
                                'export_status' => $debt->debt_status,
                                'debt_export_end' => $debt->date_end,
                            ]);
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
                            DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 
                                WHERE export_seri = $exports->id AND product_id = $productID");
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
                            $guestID = null;
                            $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                ->orwhere('guest_code', $request->guest_code)
                                ->first();
                            if ($existingCustomer) {
                                $guestID = $existingCustomer->id;
                            } else {
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
                                $guest->user_id = Auth::user()->id;
                                $guest->save();
                                $guestID = $guest->id;
                            }
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $guestID;
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
                        return redirect()->route('exports.index')->with('msg', 'Duyệt đơn thành công!');
                    } else {
                        return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                    }
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
            }
            //Hủy đơn 
            elseif ($action === 'action2') {
                if ($exports->export_status === 1) {
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
                        DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 
                            WHERE export_seri = $exports->id AND product_id = $productID");
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
                    // Cập nhật SN
                    Serinumbers::where('export_seri', $exports->id)->update(['export_seri' => null, 'seri_status' => 1]);
                    return redirect()->route('exports.index')->with('msg', 'Hủy đơn thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
            }
            //Đang báo giá
            elseif ($action === 'action3') {
                if ($exports->export_status === 1) {
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
                                //Cập nhật S/N
                                DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 WHERE export_seri = $exports->id");
                                if ($export_seris !== null) {
                                    //Cập nhật lại S/N
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $exports->id, 'seri_status' => 2]);
                                }
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
                                //Cập nhật S/N
                                DB::statement("UPDATE serinumbers SET export_seri = NULL,seri_status = 1 WHERE export_seri = $exports->id");
                                if ($export_seris !== null) {
                                    //Cập nhật lại S/N
                                    Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $exports->id, 'seri_status' => 2]);
                                }
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
                            DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 
                                WHERE export_seri = $exports->id AND product_id = $productID");
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
                            $guestID = null;
                            $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                ->orwhere('guest_code', $request->guest_code)
                                ->first();
                            if ($existingCustomer) {
                                $guestID = $existingCustomer->id;
                            } else {
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
                                $guest->user_id = Auth::user()->id;
                                $guest->save();
                                $guestID = $guest->id;
                            }
                            $exports->guest_id = $guestID;
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
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
            }
            //Hủy đơn đã chốt
            elseif ($action === 'action4') {
                if ($exports->export_status === 2) {
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
                    //xóa lịch sử
                    History::where('export_id', $exports->id)->delete();
                    // Cập nhật SN
                    Serinumbers::where('export_seri', $exports->id)->update(['export_seri' => null, 'seri_status' => 1]);
                    return redirect()->route('exports.index')->with('msg', 'Hủy đơn thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
            }
            //Chỉnh sửa khi chốt đơn 
            elseif ($action === 'action5') {
                if ($exports->export_status === 2) {
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
                                $currentQty = Product::where('id', $productID)->value('product_qty');
                                $existingQuantity = $existingProductQuantities[$productID] ?? 0;
                                $newQty = ($currentQty + $existingQuantity) - $productQty;
                                Product::where('id', $productID)
                                    ->update([
                                        'product_qty' => $newQty,
                                    ]);
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //lấy hóa đơn vào
                                $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('orders.product_code');
                                //công nợ nhập
                                $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt');
                                //tình trạng nhập hàng
                                $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt_status');
                                //lấy số lượng nhập
                                $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_qty');
                                // lấy id Import
                                $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.import_id');
                                //lấy công nợ nhập
                                $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)->first();
                                //lấy bảng nhập hàng
                                $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_total');
                                //lấy thông tin sản phẩm
                                $product = Product::find($productID);
                                // Lấy thông tin từ bảng Guests
                                $guest = Guests::find($exports->guest_id);
                                //Cập nhật lịch sử
                                $history = History::where('export_id', $exports->id)
                                    ->where('product_id', $productID)
                                    ->first();
                                if ($history) {
                                    if ($request->export_create == null) {
                                        $history->date_time = Carbon::now();
                                    } else {
                                        $history->date_time = $request->export_create;
                                    }
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $request->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    $history->tranport_fee = 0;
                                    $history->history_note = null;
                                    $history->save();
                                    if ($firstProduct && $history->tranport_fee === null || $firstProduct && $history->tranport_fee === 0) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $request->transport_fee;
                                        $history->tranport_fee = $request->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
                                    $history->save();
                                }
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
                                $currentQty = Product::where('id', $productID)->value('product_qty');
                                $existingQuantity = $existingProductQuantities[$productID] ?? 0;
                                $newQty = ($currentQty + $existingQuantity) - $productQty;
                                Product::where('id', $productID)
                                    ->update([
                                        'product_qty' => $newQty,
                                    ]);
                                //lấy thông tin nhà cung cấp
                                $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('productorders.provide_id');
                                //lấy hóa đơn vào
                                $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('orders.product_code');
                                //công nợ nhập
                                $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt');
                                //tình trạng nhập hàng
                                $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)
                                    ->value('debt_import.debt_status');
                                $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->where('product.id', $productID)->value('productorders.product_total');
                                //lấy công nợ nhập
                                $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                                    ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                                    ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                                    ->where('product.id', $productID)->first();
                                //lấy thông tin sản phẩm
                                $product = Product::find($productID);
                                // Lấy thông tin từ bảng Guests
                                $guest = Guests::find($exports->guest_id);
                                //Cập nhật lịch sử
                                $history = History::where('export_id', $exports->id)
                                    ->where('product_id', $productID)->first();
                                if ($history) {
                                    $history->export_id = $exports->id;
                                    $history->date_time = Carbon::now();
                                    $history->user_id = Auth::user()->id;
                                    $history->provide_id = $provide_id;
                                    $history->product_name = $nameProduct;
                                    $history->product_qty = $product->product_qty;
                                    $history->product_unit = $product->product_unit;
                                    $history->price_import = $product->product_price;
                                    $history->product_total = $productorders;
                                    $history->import_code = $import_code;
                                    $history->debt_import = $debt_import;
                                    $history->import_status = $import_status;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->guest_id = $exports->guest_id;
                                    $history->export_qty = $productQty;
                                    $history->export_unit = $request->product_unit[$i];
                                    $history->price_export = $request->product_price[$i];
                                    $history->export_total = $productQty * $request->product_price[$i];
                                    $history->export_code = $exports->export_code;
                                    $history->debt_export = $guest->debt;
                                    if ($request->export_create == null) {
                                        $history->debt_export_start = Carbon::now();
                                    } else {
                                        $history->debt_export_start = $request->export_create;
                                    }
                                    $history->debt_import_start = $date_import->date_start;
                                    $history->debt_import_end = $date_import->date_end;
                                    if ($firstProduct && $history->tranport_fee === null) {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty) - $request->transport_fee;
                                        $history->tranport_fee = $request->transport_fee;
                                        $firstProduct = false;
                                    } else {
                                        $history->total_difference = ($productQty * $request->product_price[$i]) - ($product->product_price * $productQty);
                                        $history->tranport_fee = 0;
                                    }
                                    $history->history_note = null;
                                    $history->save();
                                }
                            }
                            $totalQtyNeeded += $productQty;
                        }

                        //Cập nhật S/N
                        DB::statement("UPDATE serinumbers SET export_seri = NULL, seri_status = 1 WHERE export_seri = $exports->id");
                        if ($export_seris !== null) {
                            //Cập nhật lại S/N
                            Serinumbers::whereIn('id', $export_seris)->update(['export_seri' => $exports->id, 'seri_status' => 3]);
                        }

                        // Xóa các sản phẩm đã bị xóa
                        $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                            ->whereNotIn('product_id', $productIDs)
                            ->get();
                        foreach ($productExportsToDelete as $productExport) {
                            // Xóa sản phẩm
                            $productExport->delete();
                        }

                        // Giảm số lượng của sản phẩm trong bảng product
                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];

                            // Lấy số lượng hiện tại của sản phẩm
                            $currentQty = Product::where('id', $productID)->value('product_qty');

                            // Lấy giá sản phẩm
                            $product = Product::find($productID);
                            $productPrice = $product->product_price;

                            // Tính toán giá trị total
                            $total = $currentQty * $productPrice;

                            // Cập nhật số lượng và trường 'total'
                            Product::where('id', $productID)
                                ->update([
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
                            $guestID = null;
                            $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
                                ->orwhere('guest_code', $request->guest_code)
                                ->first();
                            if ($existingCustomer) {
                                $guestID = $existingCustomer->id;
                            } else {
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
                                $guest->user_id = Auth::user()->id;
                                $guest->save();
                                $guestID = $guest->id;
                            }
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $guestID;
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
                        $totalDifference = $totalSales - $totalImport - $exports->transport_fee;
                        // Lấy thông tin từ bảng Guests
                        $guest = Guests::find($exports->guest_id);
                        // Tạo đối tượng Debt và cập nhật giá trị
                        $debt = Debt::where('export_id', $exports->id)->first();
                        $debt->guest_id = $guest->id;
                        $debt->user_id = Auth::user()->id;
                        $debt->export_id = $exports->id;
                        $debt->total_sales = $totalSales;
                        $debt->total_import = $totalImport;
                        $debt->debt_transport_fee = $exports->transport_fee == null ? 0 : $exports->transport_fee;
                        $debt->total_difference = $totalDifference;
                        $debt->debt = $guest->debt;
                        $debt->date_start = $request->export_create;
                        $debt->created_at = $request->export_create;
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
                        } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                            $debt->debt_status = 2;
                        } elseif ($daysDiff == 0) {
                            $debt->debt_status = 5;
                        } elseif ($daysDiff < 0) {
                            $debt->debt_status = 0;
                        } else {
                            $debt->debt_status = 3;
                        }
                        $debt->save();
                        //cập nhật tình trạng xuất hàng cho bảng History
                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];
                            $history = History::where('export_id', $exports->id)
                                ->where('product_id', $productID)->first();
                            if ($history) {
                                $history->update([
                                    'debt_export' => $debt->debt,
                                    'guest_id' => $exports->guest_id,
                                    'export_status' => $debt->debt_status,
                                    'debt_export_end' => $debt->date_end,
                                ]);
                            }
                        }
                        return redirect()->route('exports.index')->with('msg', 'Chỉnh sửa đơn hàng thành công');
                    } else {
                        return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                    }
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
            }
            //Xóa đơn đã hủy
            elseif ($action === 'action6') {
                if ($exports->export_status === 0) {
                    Exports::where('id', $exports->id)->where('export_status', 0)->delete();
                    return redirect()->route('exports.index')->with('msg', 'Xóa đơn thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Thao tác không thành công');
                }
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
            $existingCustomer = Guests::where('id', '!=', $data['id'])
                ->where(function ($query) use ($data) {
                    $query->where('guest_name', $data['guest_name'])
                        ->orWhere('guest_code', $data['guest_code']);
                })->first();
            if ($existingCustomer) {
                return response()->json(['success' => false, 'message' => 'Cập nhật thất bại, do thông tin khách hàng đã có trong hệ thống!']);
            } else {
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
                if ($data['debt'] === null) {
                    $update_guest->debt = 0;
                } else {
                    $update_guest->debt = $data['debt'];
                }
                $update_guest->save();
                return response()->json(['message' => 'Lưu thông tin thành công!']);
            }
        }
    }
    public function addCustomer(Request $request)
    {
        $data = $request->all();
        if ($data['click'] == 1) {
            $check = Guests::where(function ($query) use ($data) {
                $query->where('guest_name', $data['guest_name'])
                    ->orWhere('guest_code', $data['guest_code']);
            })->first();
            if (!$check) {
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
                if ($data['debt'] === null) {
                    $guest->debt = 0;
                } else {
                    $guest->debt = $data['debt'];
                }
                $guest->user_id = Auth::user()->id;
                $guest->save();

                // Trả về giá trị id của khách hàng vừa lưu
                return response()->json(['id' => $guest->id]);
            } else {
                return response()->json(['success' => false, 'message' => 'Mã số thuế hoặc tên khách hàng đã tồn tại']);
            }
        }
    }

    public function getProduct(Request $request)
    {
        $data = $request->all();
        $product = Product::select('product.*')
            ->selectRaw('COALESCE(ROUND(product.product_qty - COALESCE(product.product_trade, 0), 2), 0) as qty_exist')
            ->where('product.id', $data['idProduct'])
            ->first();
        return response()->json($product);
    }

    public function limit_qty(Request $request)
    {
        $data = $request->all();
        $limit_qty = Product::select('product.*')
            ->selectRaw('COALESCE(ROUND(product.product_qty - COALESCE(product.product_trade, 0), 2), 0) as qty_exist')
            ->where('product.id', $data['product_id'])
            ->first();
        return response()->json($limit_qty);
    }

    // Xóa đơn hàng AJAX
    public function deleteExports(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $exports = Exports::whereIn('id', $list)->get();
            foreach ($exports as $item) {
                if ($item->export_status === 0) {
                    Exports::whereIn('id', $list)->where('export_status', 0)->delete();
                    productExports::whereIn('export_id', $list)->delete();
                }
            }
            session()->flash('msg', 'Xóa đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Xóa đơn hàng thành công', 'ids' => $list]);
        }
        session()->flash('warning', 'Không tìm thấy đơn hàng cần xóa');
        return response()->json(['success' => false, 'msg' => 'Không tìm thấy đơn hàng cần xóa']);
    }

    //Kiểm tra tình trạng xuất
    public function checkStatusEx(Request $request)
    {
        if (isset($request->arrId)) {
            $list = $request->arrId;
            $exports = Exports::whereIn('id', $list)->get();
            return $exports;
        }
    }

    public function cancelBillExport(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Exports::leftJoin('product_exports', 'product_exports.export_id', 'exports.id')
                ->leftJoin('product', 'product.id', 'product_exports.product_id')
                ->leftJoin('debts', 'debts.export_id', 'exports.id')
                ->select('exports.*', 'product.*', 'product_exports.*', 'product_exports.product_qty as soluongbandau', 'debts.debt_status as tinhtrang')
                ->whereIn('exports.id', $list)
                ->get();

            foreach ($listOrder as $orderItem) {
                $productId = $orderItem->product_id;
                // Lấy số lượng từ bảng product_exports
                $quantityFromExport = $orderItem->soluongbandau;
                if ($orderItem->export_status == 2) {
                    $currentQty = Product::where('id', $productId)->value('product_qty');
                    $currentPrice = Product::where('id', $productId)->value('product_price');
                    $currentTotal = Product::where('id', $productId)->value('product_total');

                    $newQty = $currentQty + $quantityFromExport;
                    $product_total = $quantityFromExport * $currentPrice;
                    $total = $product_total + $currentTotal;

                    //cập nhật số lượng và tổng tiền
                    Product::where('id', $productId)
                        ->update([
                            'product_qty' => $newQty,
                            'product_total' => $total,
                        ]);
                    //cập nhật tình trạng xuất hàng
                    Exports::where('id', $orderItem->export_id)
                        ->update([
                            'export_status' => 0,
                        ]);
                    //xóa công nợ
                    Debt::where('export_id', $orderItem->export_id)->delete();
                    //xóa lịch sử
                    History::where('export_id', $orderItem->export_id)->delete();
                    // Cập nhật SN
                    Serinumbers::where('export_seri', $orderItem->export_id)->update(['export_seri' => null, 'seri_status' => 1]);
                } elseif ($orderItem->export_status == 1) {
                    $currentTrade = Product::where('id', $productId)->value('product_trade');
                    $newTrade = ($currentTrade - $quantityFromExport) + $productId;
                    $updateTrade = $newTrade - $productId;
                    Product::where('id', $productId)
                        ->update([
                            'product_trade' => $updateTrade,
                        ]);
                    //cập nhật tình trạng xuất hàng
                    Exports::where('id', $orderItem->export_id)
                        ->update([
                            'export_status' => 0,
                        ]);
                    // Cập nhật SN
                    Serinumbers::where('export_seri', $orderItem->export_id)->update(['export_seri' => null, 'seri_status' => 1]);
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

    // S/N tạo đơn
    public function getSN(Request $request)
    {
        $data = $request->all();
        $sn = Serinumbers::where('product_id', $data['productCode'])->where('seri_status', '1')->get();
        return response()->json($sn);
    }

    // S/N đã chốt đơn
    public function getSN1(Request $request)
    {
        $data = $request->all();
        $sn = Serinumbers::where('product_id', $data['productCode'])
            ->where('seri_status', '3')->where('export_seri', $data['idExport'])->get();
        return response()->json($sn);
    }

    // S/N chỉnh sửa sau khi đã chốt đơn
    public function getSN2(Request $request)
    {
        $data = $request->all();
        $sn = Serinumbers::where('product_id', $data['productCode'])
            ->where(function ($query) use ($data) {
                $query->where('export_seri', $data['idExport'])
                    ->orWhereNull('export_seri');
            })
            ->get();
        return response()->json($sn);
    }

    // S/N đang báo giá
    public function getSN3(Request $request)
    {
        $data = $request->all();
        $sn = Serinumbers::where('product_id', $data['productCode'])
            ->where(function ($query) use ($data) {
                $query->where('export_seri', $data['idExport'])
                    ->orWhere('export_seri', 0)
                    ->orWhereNull('export_seri');
            })
            ->get();
        return response()->json($sn);
    }
    public function getSN4(Request $request)
    {
        $data = $request->all();
        $sn = Serinumbers::where(function ($query) use ($data) {
            $query->where('export_seri', $data['idExport'])
                ->orWhere('export_seri', 0)
                ->orWhereNull('export_seri');
        })->get();
        return response()->json($sn);
    }

    public function getAllSN(Request $request)
    {
        $data = $request->all();
        $allSN = Serinumbers::where('product_id', $data['idProduct'])->get();
        return response()->json($allSN);
    }

    public function editEx($id)
    {
        $exports = Exports::find($id);
        $guest = Guests::find($exports->guest_id);
        $customer = Guests::all();
        $productExport = productExports::select('product_exports.*', 'product.product_qty as soluong', 'product.product_tax as thue')
            ->join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->join('product', 'product.id', '=', 'product_exports.product_id')
            ->selectRaw('(product.product_qty - product.product_trade) as tonkho')
            ->where('export_id', $id)
            ->get();
        $SnProduct = Serinumbers::all();
        $product_code = Product::select('product.*')
            ->whereRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) > 0')
            ->selectRaw('COALESCE((product.product_qty - COALESCE(product.product_trade, 0)), 0) as qty_exist')
            ->get();

        $title = 'Chi tiết đơn hàng';
        return view('tables.export.editEx', compact('SnProduct', 'exports', 'guest', 'productExport', 'product_code', 'customer', 'title'));
    }
    //Chốt đơn checkbox
    public function chotDonCheckBox(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $firstProduct = true;
            $exportIdsProcessed = [];
            $listOrder = Exports::leftJoin('product_exports', 'product_exports.export_id', 'exports.id')
                ->leftJoin('product', 'product.id', 'product_exports.product_id')
                ->leftJoin('debts', 'debts.export_id', 'exports.id')
                ->select(
                    'exports.*',
                    'product.*',
                    'product_exports.*',
                    'product_exports.product_qty as soluongbandau',
                    'product_exports.product_unit as donvitinh',
                    'product_exports.product_price as gia',
                    'debts.debt_status as tinhtrang'
                )
                ->whereIn('exports.id', $list)
                ->orderBy('exports.id') // Sắp xếp theo export_id
                ->get();
            //Tạo công nợ
            foreach ($list as $exportId) {
                $exports = Exports::find($exportId);

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
                $debt->date_start = $exports->created_at;
                $debt->created_at = $exports->created_at;

                $startDate = Carbon::parse($exports->created_at); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
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
                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt->debt_status = 2;
                } elseif ($daysDiff == 0) {
                    $debt->debt_status = 5;
                } elseif ($daysDiff < 0) {
                    $debt->debt_status = 0;
                } else {
                    $debt->debt_status = 3;
                }
                $debt->save();
                // Cập nhật SN
                Serinumbers::where('export_seri', $exportId)->update(['seri_status' => 3]);
            }
            foreach ($listOrder as $orderItem) {
                $exportId = $orderItem->export_id;
                // Kiểm tra xem đã xử lý export_id này chưa
                if (!in_array($exportId, $exportIdsProcessed)) {
                    // Lấy giá trị transport_fee từ Exports cho export_id này
                    $transportFee = $orderItem->transport_fee;

                    // Lưu export_id đã xử lý vào mảng $exportIdsProcessed
                    $exportIdsProcessed[] = $exportId;

                    // Đặt lại giá trị $firstProduct về true để chuẩn bị xử lý export_id tiếp theo
                    $firstProduct = true;
                }
                //
                $productId = $orderItem->product_id;
                // Lấy số lượng từ bảng product_exports
                $quantityFromExport = $orderItem->soluongbandau;
                // Lấy đơn vị tính
                $dvt = $orderItem->donvitinh;
                // Lấy giá
                $gia = $orderItem->gia;
                if ($orderItem->export_status == 1) {
                    $currentQty = Product::where('id', $productId)->value('product_qty');
                    $currentPrice = Product::where('id', $productId)->value('product_price');
                    $currentTotal = Product::where('id', $productId)->value('product_total');
                    $currentTrade = Product::where('id', $productId)->value('product_trade');
                    //cập nhật số lượng, và trị tồn kho
                    $newQty = $currentQty - $quantityFromExport;
                    $product_total = $quantityFromExport * $currentPrice;
                    $total = $currentTotal - $product_total;

                    //Cập nhật đang giao dịch
                    $newTrade = $currentTrade - $quantityFromExport;

                    //cập nhật số lượng, đang giao dịch và trị tồn kho
                    Product::where('id', $productId)
                        ->update([
                            'product_qty' => $newQty,
                            'product_total' => $total,
                            'product_trade' => $newTrade,
                        ]);
                    //cập nhật tình trạng xuất hàng
                    Exports::where('id', $orderItem->export_id)
                        ->update([
                            'export_status' => 2,
                        ]);
                    //Tạo lịch sử
                    $exports = Exports::find($orderItem->export_id);
                    $nameProduct = Product::where('id', $productId)->value('product_name');
                    //lấy thông tin nhà cung cấp
                    $provide_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->where('product.id', $productId)
                        ->value('productorders.provide_id');
                    //lấy hóa đơn vào
                    $import_code = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->where('product.id', $productId)
                        ->value('orders.product_code');
                    //công nợ nhập
                    $debt_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                        ->where('product.id', $productId)
                        ->value('debt_import.debt');
                    //tình trạng nhập hàng
                    $import_status = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                        ->where('product.id', $productId)
                        ->value('debt_import.debt_status');
                    //lấy số lượng nhập
                    $qty_exist = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->where('product.id', $productId)->value('productorders.product_qty');
                    // lấy id Import
                    $import_id = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                        ->where('product.id', $productId)
                        ->value('debt_import.import_id');
                    //lấy công nợ nhập
                    $date_import = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->leftJoin('debt_import', 'debt_import.import_id', 'orders.id')
                        ->where('product.id', $productId)->first();
                    //lấy bảng nhập hàng
                    $productorders = Product::leftJoin('productorders', 'productorders.product_id', 'product.id')
                        ->leftJoin('orders', 'productorders.order_id', 'orders.id')
                        ->where('product.id', $productId)->value('productorders.product_total');
                    //lấy thông tin sản phẩm
                    $product = Product::find($productId);
                    // Lấy thông tin từ bảng Guests
                    $guest = Guests::find($exports->guest_id);
                    //
                    $history = new History();
                    $history->export_id = $exports->id;
                    $history->import_id = $import_id;
                    $history->product_id = $productId;
                    if ($exports->created_at == null) {
                        $history->date_time = Carbon::now();
                    } else {
                        $history->date_time = $exports->created_at;
                    }
                    $history->user_id = Auth::user()->id;
                    $history->provide_id = $provide_id;
                    $history->product_name = $nameProduct;
                    $history->product_qty = $qty_exist;
                    $history->product_unit = $product->product_unit;
                    $history->price_import = $product->product_price;
                    $history->product_total = $productorders;
                    $history->import_code = $import_code;
                    $history->debt_import = $debt_import;
                    $history->import_status = $import_status;
                    $history->guest_id = $exports->guest_id;
                    $history->export_qty = $quantityFromExport;
                    $history->export_unit = $dvt;
                    $history->price_export = $gia;
                    $history->export_total = $quantityFromExport * $gia;
                    $history->export_code = $exports->export_code;
                    $history->debt_export = $guest->debt;
                    if ($exports->created_at == null) {
                        $history->debt_export_start = Carbon::now();
                    } else {
                        $history->debt_export_start = $exports->created_at;
                    }
                    $history->debt_import_start = $date_import->date_start;
                    $history->debt_import_end = $date_import->date_end;
                    if ($firstProduct && $history->transport_fee === null) {
                        $history->total_difference = ($quantityFromExport * $gia) - ($product->product_price * $quantityFromExport) - $transportFee;
                        $history->tranport_fee = $transportFee;
                        $firstProduct = false;
                    } else {
                        $history->total_difference = ($quantityFromExport * $gia) - ($product->product_price * $quantityFromExport);
                        $history->tranport_fee = 0;
                    }
                    $history->history_note = null;
                    $history->save();
                    $export_status = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                        ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                        ->leftJoin('debts', 'debts.export_id', 'exports.id')
                        ->where('product.id', $productId)
                        ->where('exports.id', $orderItem->export_id)
                        ->value('debts.debt_status');
                    $debt_end = Product::leftJoin('product_exports', 'product_exports.product_id', 'product.id')
                        ->leftJoin('exports', 'product_exports.export_id', 'exports.id')
                        ->leftJoin('debts', 'debts.export_id', 'exports.id')
                        ->where('product.id', $productId)
                        ->where('exports.id', $orderItem->export_id)
                        ->value('debts.date_end');
                    //cập nhật tình trạng xuất hàng cho bảng History
                    History::where('export_id', $history->export_id)
                        ->update([
                            'export_status' =>  $export_status,
                            'debt_export_end' => $debt_end,
                        ]);
                }
            }
            session()->flash('msg', 'Chốt đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Chốt Đơn Hàng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
    //xuất excel
    public function export_excel()
    {
        $data = Exports::leftJoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->leftJoin('users', 'exports.user_id', '=', 'users.id')
            ->select(
                'exports.id as id',
                'exports.export_code as sohoadon',
                'guests.guest_name as guests',
                'exports.created_at',
                'users.name as name',
                'exports.total',
                'exports.export_status',
            );
        if (Auth::user()->roleid != 1) {
            $data->where('users.id', Auth::user()->id);
        }
        $data = $data->get();


        $data->map(function ($da) {
            if ($da->guests && $da->name) {
                $da->guest_id = $da->guests;
                $da->users_id = $da->name;
            }

            if ($da->export_status == 1) {
                $da->export_status = "Đã báo giá";
            } elseif ($da->export_status == 2) {
                $da->export_status = "Đã chốt";
            } else {
                $da->export_status = "Đã hủy";
            }

            $da->total = number_format($da->total);
            $da->formatted_created_at = $da->created_at->format('d-m-Y');

            // Xóa các cột không cần thiết sau khi đã định dạng dữ liệu
            unset($da->guests);
            unset($da->name);
            unset($da->created_at);

            // Chọn lại các thuộc tính theo thứ tự mong muốn
            $da = $da->only('id', 'sohoadon', 'guest_id', 'formatted_created_at', 'users_id', 'total', 'export_status');

            return $da;
        });

        return response()->json(['success' => true, 'msg' => 'Xuất file thành công', 'data' => $data]);
    }
}
