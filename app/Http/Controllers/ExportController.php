<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Exports;
use App\Models\Guests;
use App\Models\Product;
use App\Models\productExports;
use App\Models\Products;
use App\Models\Serinumbers;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
            array_push($filters, ['exports.id', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Mã đơn hàng:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Khách hàng
        if (!empty($request->guest)) {
            $guest = $request->guest;
            array_push($filters, ['guests.guest_receiver', 'like', '%' . $guest . '%']);
            $nameArr = explode(',.@', $guest);
            array_push($string, ['label' => 'Khách hàng:', 'values' => $nameArr, 'class' => 'guest']);
        }

        //Tổng tiền
        if (!empty($request->comparison_operator) && !empty($request->sum)) {
            $sum = $request->input('sum');
            $comparison_operator = $request->input('comparison_operator');
            $filters[] = ['exports.total', $comparison_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền' . $comparison_operator, 'values' => $inventoryArray, 'class' => 'sum']);
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
        //Đến ngày
        $date = [];
        if (!empty($request->trip_start) && !empty($request->trip_end)) {
            $trip_start = $request->input('trip_start');
            $trip_end = $request->input('trip_end');
            $date[] = [$trip_start, $trip_end];
            $datearr = ['label' => 'Chỉnh sửa cuối:', 'values' => [
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
            ->leftjoin('users', 'exports.user_id', '=', 'users.id')->get();
        $export = $this->exports->getAllExports($filters, $status, $name, $date, $keywords, $sortBy, $sortType);
        $title = 'Xuất hàng';
        $exportCreator = $this->exports->productsCreator();
        return view('tables.export.exports', compact('export', 'exports', 'sortType', 'string', 'title', 'exportCreator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        $customer = Guests::where('guest_status', 1)->get();
        $guest_id = DB::table('guests')->select('id')->orderBy('id', 'DESC')->first();
        $title = 'Tạo đơn xuất hàng';
        return view('tables.export.addExport', compact('customer', 'products', 'title'));
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
            $products_id = $request->input('products_id');
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

                        // Kiểm tra và cập nhật seri_status
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
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng khi lưu nhanh
                            if ($request->checkguest == 2 && $clickValue == null) {
                                $guest = new Guests();
                                $guest->guest_name = $request->guest_name;
                                $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                $guest->guest_code = $request->guest_code;
                                $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                $guest->guest_receiver = $request->guest_receiver;
                                $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                $guest->guest_email = $request->guest_email;
                                $guest->guest_status = 1;
                                $guest->guest_phone = $request->guest_phone;
                                $guest->guest_pay = $request->guest_pay;
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
                                $export->save();
                                // Cập nhật seri_status
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 3;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
                                }
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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
                                $debt->date_start = now();
                                // //Xử lí workingday
                                $startDate = $debt->debt_start;
                                $daysToAdd = $debt->debt;
                                $newDate = ($this->calculateWorkingDate($startDate, $daysToAdd));
                                $debt->date_end = $newDate;
                                // Xử lí status debt
                                $endDate = new DateTime($debt->date_end);
                                $now = new DateTime();
                                $interval = $endDate->diff($now);
                                $daysDiff = $interval->format('%R%a');
                                $daysDiff = intval($daysDiff);
                                $daysDiff = -$daysDiff;
                                if ($guest->debt == 0) {
                                    $debt->debt_status = 1;
                                } elseif ($daysDiff <= 3) {
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
                                $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                $guest->guest_code = $request->guest_code;
                                $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                $guest->guest_receiver = $request->guest_receiver;
                                $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                $guest->guest_email = $request->guest_email;
                                $guest->guest_status = 1;
                                $guest->guest_phone = $request->guest_phone;
                                $guest->guest_pay = $request->guest_pay;
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
                                $export->save();
                                // Cập nhật seri_status
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 3;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
                                }
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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
                               
                                $debt->date_start = now();
                                
                                // //Xử lí workingday
                                $startDate = $debt->debt_start;
                                $daysToAdd = $debt->debt;
                                $newDate = ($this->calculateWorkingDate($startDate, $daysToAdd));
                                $debt->date_end = $newDate;

                                // Xử lí status debt
                                $endDate = new DateTime($debt->date_end);
                                $now = new DateTime();
                                $interval = $endDate->diff($now);
                                $daysDiff = $interval->format('%R%a');
                                $daysDiff = intval($daysDiff);
                                $daysDiff = -$daysDiff;
                                    
                                if ($guest->debt == 0) {
                                    $debt->debt_status = 4;
                                } elseif ($daysDiff <= 3) {
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
                                $export->save();
                                // Cập nhật seri_status
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 3;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
                                }
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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

                                $debt->date_start = now();
                                
                                // //Xử lí workingday
                                $startDate = $debt->debt_start;
                                $daysToAdd = $debt->debt;
                                $newDate = ($this->calculateWorkingDate($startDate, $daysToAdd));
                                $debt->date_end = $newDate;

                                // Xử lí status debt
                                $endDate = new DateTime($debt->date_end);
                                $now = new DateTime();
                                $interval = $endDate->diff($now);
                                $daysDiff = $interval->format('%R%a');
                                $daysDiff = intval($daysDiff);
                                $daysDiff = -$daysDiff;

                                if ($guest->debt == 0) {
                                    $debt->debt_status = 4;
                                } elseif ($daysDiff <= 3) {
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
                                $export->save();
                                // Cập nhật seri_status
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 3;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
                                }
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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

                                $debt->date_start = now();
                                
                                // //Xử lí workingday
                                $startDate = $debt->debt_start;
                                $daysToAdd = $debt->debt;
                                $newDate = ($this->calculateWorkingDate($startDate, $daysToAdd));
                                $debt->date_end = $newDate;

                                // Xử lí status debt
                                $endDate = new DateTime($debt->date_end);
                                $now = new DateTime();
                                $interval = $endDate->diff($now);
                                $daysDiff = $interval->format('%R%a');
                                $daysDiff = intval($daysDiff);
                                $daysDiff = -$daysDiff;

                                if ($guest->debt == 0) {
                                    $debt->debt_status = 4;
                                } elseif ($daysDiff <= 3) {
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
                                        'total' => $total
                                    ]);
                            }
                            // Cập nhật tình trạng seri sau khi chốt
                            // for ($i = 0; $i < count($productIDs); $i++) {
                            //     $productID = $productIDs[$i];
                            //     $productQty = $productQtys[$i];

                            //     // Cập nhật seri_status theo số lượng đã nhập
                            //     $serinumbers = Serinumbers::where('product_id', $productID)
                            //         ->where('seri_status', 1)
                            //         ->limit($productQty)
                            //         ->get();

                            //     foreach ($serinumbers as $serinumber) {
                            //         if ($serinumber->seri_status == 1) {
                            //             $serinumber->seri_status = 3;
                            //             $serinumber->save();
                            //         }
                            //     }
                            // }

                            //cập nhật số lượng tồn kho sản phẩm cha
                            $query = "UPDATE `products` 
      INNER JOIN `product` ON `products`.`id` = `product`.`products_id` 
      SET `products`.`inventory` = (
          SELECT SUM(`product`.`product_qty`) 
          FROM `product` 
          WHERE `product`.`products_id` = `products`.`id`
      ),
      `products`.`price_inventory` = (
          SELECT SUM(`product`.`total`) 
          FROM `product` 
          WHERE `product`.`products_id` = `products`.`id`
      ),
      `products`.`price_avg` = (
          SELECT CASE WHEN (
              SELECT SUM(`product`.`product_qty`) 
              FROM `product` 
              WHERE `product`.`products_id` = `products`.`id`
          ) = 0 THEN 0 ELSE (
              SELECT SUM(`product`.`total`) 
              FROM `product` 
              WHERE `product`.`products_id` = `products`.`id`
          ) / (
              SELECT SUM(`product`.`product_qty`) 
              FROM `product` 
              WHERE `product`.`products_id` = `products`.`id`
          ) END
      )
      WHERE `products`.`id` IN (" . implode(',', $products_id) . ")";
                            DB::statement($query);
                            return redirect()->route('exports.index')->with('msg', 'Duyệt đơn thành công!');
                        }
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

                        // Kiểm tra và cập nhật seri_status
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
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng khi lưu nhanh
                            if ($request->checkguest == 2 && $clickValue == null) {
                                $existingCustomer = Guests::orwhere('guest_code', $request->guest_code)
                                    ->orwhere('guest_name', $request->guest_name)
                                    ->first();
                                if (!$existingCustomer) {
                                    $guest = new Guests();
                                    $guest->guest_name = $request->guest_name;
                                    $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                    $guest->guest_code = $request->guest_code;
                                    $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                    $guest->guest_receiver = $request->guest_receiver;
                                    $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                    $guest->guest_email = $request->guest_email;
                                    $guest->guest_status = 1;
                                    $guest->guest_phone = $request->guest_phone;
                                    $guest->guest_pay = $request->guest_pay;
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
                                    $export->save();
                                    // Tạo các bản ghi trong bảng product export
                                    for ($i = 0; $i < count($productIDs); $i++) {
                                        $productID = $productIDs[$i];
                                        $productQty = $productQtys[$i];
                                        $nameProduct = Product::where('id', $productID)->value('product_name');
                                        $proExport = new ProductExports();
                                        $proExport->products_id = $request->products_id[$i];
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
                                    }
                                    // Cập nhật seri_status bằng 2 cho các sản phẩm
                                    foreach ($serinumbers as $serinumber) {
                                        if ($serinumber->seri_status == 1) {
                                            $serinumber->seri_status = 2;
                                            $serinumber->export_seri = $export->id;
                                            $serinumber->save();
                                        }
                                    }
                                } else {
                                    // Tạo đơn xuất hàng
                                    $export = new Exports();
                                    $export->guest_id = $existingCustomer->id;
                                    $export->user_id = Auth::user()->id;
                                    $export->total = $request->totalValue;
                                    $export->export_status = 1;
                                    $export->note_form = $request->note_form;
                                    $export->transport_fee = $request->transport_fee;
                                    $export->save();
                                    // Tạo các bản ghi trong bảng product export
                                    for ($i = 0; $i < count($productIDs); $i++) {
                                        $productID = $productIDs[$i];
                                        $productQty = $productQtys[$i];
                                        $nameProduct = Product::where('id', $productID)->value('product_name');
                                        $proExport = new ProductExports();
                                        $proExport->products_id = $request->products_id[$i];
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
                                    }
                                    // Cập nhật seri_status bằng 2 cho các sản phẩm
                                    foreach ($serinumbers as $serinumber) {
                                        if ($serinumber->seri_status == 1) {
                                            $serinumber->seri_status = 2;
                                            $serinumber->export_seri = $export->id;
                                            $serinumber->save();
                                        }
                                    }
                                }
                            }
                            //cập nhật khách hàng khi lưu nhanh
                            if ($request->checkguest == 1 && $updateClick == null) {
                                $guest = Guests::find($request->id);
                                $guest->guest_name = $request->guest_name;
                                $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                $guest->guest_code = $request->guest_code;
                                $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                $guest->guest_receiver = $request->guest_receiver;
                                $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                $guest->guest_email = $request->guest_email;
                                $guest->guest_status = 1;
                                $guest->guest_phone = $request->guest_phone;
                                $guest->guest_pay = $request->guest_pay;
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
                                $export->save();
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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
                                }
                                // Cập nhật seri_status bằng 2 cho các sản phẩm
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 2;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
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
                                $export->save();
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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
                                }
                                // Cập nhật seri_status bằng 2 cho các sản phẩm
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 2;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
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
                                $export->save();
                                // Tạo các bản ghi trong bảng product export
                                for ($i = 0; $i < count($productIDs); $i++) {
                                    $productID = $productIDs[$i];
                                    $productQty = $productQtys[$i];
                                    $nameProduct = Product::where('id', $productID)->value('product_name');
                                    $proExport = new ProductExports();
                                    $proExport->products_id = $request->products_id[$i];
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
                                }
                                // Cập nhật seri_status bằng 2 cho các sản phẩm
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 2;
                                        $serinumber->export_seri = $export->id;
                                        $serinumber->save();
                                    }
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
    function calculateWorkingDate($startDate, $daysToAdd)
    {
        $createdDate = Carbon::parse($startDate);
        $daysRemaining = $daysToAdd;

        $currentDate = $createdDate->copy();

        while ($daysRemaining > 0) {
            $currentDate = $currentDate->addDay();

            if ($currentDate->isWeekday()) {
                $daysRemaining--;
            }
        }

        if ($currentDate->isWeekend()) {
            $currentDate = $currentDate->nextWeekday();
        }

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
        $productExport = productExports::select('product_exports.*')->join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->join('products', 'products.id', 'product_exports.products_id')
            ->where('export_id', $id)
            ->get();
        $product_code = Products::all();
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
        $totalQtyNeeded = 0;
        $serinumbersToUpdate = [];
        $products_id = $request->input('products_id');
        $clickValue = $request->input('click');
        $updateClick = $request->input('updateClick');

        if ($request->has('submitBtn')) {
            $action = $request->input('submitBtn');
            if ($action === 'action1') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
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

                            // Lấy số lượng hiện tại của sản phẩm
                            $currentQty = Product::where('id', $productID)->value('product_qty');

                            // Kiểm tra số lượng sản phẩm mới được cập nhật
                            $availableQty = $currentQty + $proExport->product_qty - $productQty;

                            if ($availableQty < 0) {
                                return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                            }

                            // Cập nhật seri_status khi số lượng sản phẩm tăng hoặc giảm
                            if ($productQty > $proExport->product_qty) {
                                $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                    ->where('seri_status', 1)
                                    ->limit($productQty - $proExport->product_qty)
                                    ->get();

                                foreach ($serinumbersToUpdate as $serinumber) {
                                    $serinumber->seri_status = 2;
                                    $serinumber->save();
                                }
                            } elseif ($productQty < $proExport->product_qty) {
                                $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                    ->where('seri_status', 2)
                                    ->limit($proExport->product_qty - $productQty)
                                    ->get();

                                foreach ($serinumbersToUpdate as $serinumber) {
                                    $serinumber->seri_status = 1;
                                    $serinumber->save();
                                }
                            }

                            // Cập nhật thông tin sản phẩm
                            $proExport->products_id = $request->products_id[$i];
                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                        } else {
                            // Kiểm tra số lượng sản phẩm mới được thêm
                            $currentQty = Product::where('id', $productID)->value('product_qty');
                            if ($productQty > $currentQty) {
                                return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                            }
                            $proExport = new ProductExports();
                            $proExport->products_id = $request->products_id[$i];
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

                            // Cập nhật seri_status bằng 2 cho sản phẩm mới
                            $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 1)
                                ->limit($productQty)
                                ->get();

                            foreach ($serinumbersToUpdate as $serinumber) {
                                $serinumber->seri_status = 2;
                                $serinumber->save();
                            }
                        }

                        $totalQtyNeeded += $productQty;
                    }

                    // Xóa các sản phẩm đã bị xóa
                    $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                        ->whereNotIn('product_id', $productIDs)
                        ->get();

                    foreach ($productExportsToDelete as $productExport) {
                        // Cập nhật seri_status thành 1 cho sản phẩm bị xóa
                        $serinumbersToUpdate = Serinumbers::where('product_id', $productExport->product_id)
                            ->where('seri_status', 2)
                            ->limit($productExport->product_qty)
                            ->get();

                        foreach ($serinumbersToUpdate as $serinumber) {
                            $serinumber->seri_status = 1;
                            $serinumber->save();
                        }

                        // Xóa sản phẩm
                        $productExport->delete();
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
                                'total' => $total
                            ]);
                    }

                    // Kiểm tra số lượng tổng cần thiết
                    $availableQtyTotal = $this->getAvailableProductQtyTotal();

                    if ($totalQtyNeeded > $availableQtyTotal) {
                        return redirect()->route('exports.index')->with('warning', 'Vượt quá tổng số lượng sản phẩm!');
                    } else {
                        //thêm khách hàng
                        if ($request->checkguest == 2 && $clickValue == null) {
                            $existingCustomer = Guests::orwhere('guest_code', $request->guest_code)
                                ->orwhere('guest_name', $request->guest_name)
                                ->first();
                            if (!$existingCustomer) {
                                $guest = new Guests();
                                $guest->guest_name = $request->guest_name;
                                $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                $guest->guest_code = $request->guest_code;
                                $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                $guest->guest_receiver = $request->guest_receiver;
                                $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                $guest->guest_email = $request->guest_email;
                                $guest->guest_status = 1;
                                $guest->guest_phone = $request->guest_phone;
                                $guest->guest_pay = $request->guest_pay;
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
                                $exports->save();
                            } else {
                                $exports->guest_id = $existingCustomer->id;
                                $exports->user_id = Auth::user()->id;
                                $exports->total = $request->totalValue;
                                $exports->export_status = 2;
                                $exports->note_form = $request->note_form;
                                $exports->transport_fee = $request->transport_fee;
                                $exports->save();
                            }
                        }
                        //cập nhật khách hàng
                        if ($request->checkguest == 1 && $updateClick == null) {
                            $guest = Guests::find($request->id);
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_addressInvoice = $request->guest_addressInvoice;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_addressDeliver = $request->guest_addressDeliver;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_pay = $request->guest_pay;
                            $guest->guest_note = $request->guest_note;
                            $guest->debt = $request->debt;
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $guest->id;
                            $exports->user_id = Auth::user()->id;
                            $exports->total = $request->totalValue;
                            $exports->export_status = 2;
                            $exports->note_form = $request->note_form;
                            $exports->transport_fee = $request->transport_fee;
                            $exports->save();
                        }
                        //cập nhật
                        if ($updateClick == 1 && $request->checkguest == 1) {
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $request->id;
                            $exports->user_id = Auth::user()->id;
                            $exports->total = $request->totalValue;
                            $exports->export_status = 2;
                            $exports->note_form = $request->note_form;
                            $exports->transport_fee = $request->transport_fee;
                            $exports->save();
                        }
                        //thêm
                        if($request->checkguest == 2 && $clickValue == 1)
                        {
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $request->id;
                            $exports->user_id = Auth::user()->id;
                            $exports->total = $request->totalValue;
                            $exports->export_status = 2;
                            $exports->note_form = $request->note_form;
                            $exports->transport_fee = $request->transport_fee;
                            $exports->save();
                        }

                        // Cập nhật tình trạng seri sau khi chốt
                        // Serinumbers::whereIn('product_id', $productIDs)
                        //     ->where('seri_status', 2)
                        //     ->update(['seri_status' => 3]);

                        for ($i = 0; $i < count($productIDs); $i++) {
                            $productID = $productIDs[$i];
                            $productQty = $productQtys[$i];

                            // Cập nhật seri_status theo số lượng đã nhập
                            $serinumbers = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 2)
                                ->where('export_seri', $id)
                                ->limit($productQty)
                                ->get();

                            foreach ($serinumbers as $serinumber) {
                                if ($serinumber->seri_status == 2) {
                                    $serinumber->seri_status = 3;
                                    $serinumber->save();
                                }
                            }
                        }

                        //cập nhật số lượng tồn kho sản phẩm cha
                        $query = "UPDATE `products` 
          INNER JOIN `product` ON `products`.`id` = `product`.`products_id` 
          SET `products`.`inventory` = (
              SELECT SUM(`product`.`product_qty`) 
              FROM `product` 
              WHERE `product`.`products_id` = `products`.`id`
          ),
          `products`.`price_inventory` = (
              SELECT SUM(`product`.`total`) 
              FROM `product` 
              WHERE `product`.`products_id` = `products`.`id`
          ),
          `products`.`price_avg` = (
              SELECT CASE WHEN (
                  SELECT SUM(`product`.`product_qty`) 
                  FROM `product` 
                  WHERE `product`.`products_id` = `products`.`id`
              ) = 0 THEN 0 ELSE (
                  SELECT SUM(`product`.`total`) 
                  FROM `product` 
                  WHERE `product`.`products_id` = `products`.`id`
              ) / (
                  SELECT SUM(`product`.`product_qty`) 
                  FROM `product` 
                  WHERE `product`.`products_id` = `products`.`id`
              ) END
          )
          WHERE `products`.`id` IN (" . implode(',', $products_id) . ")";
                        DB::statement($query);
                        // Lấy thông tin từ bảng productExport và Export
                        $productExports = $exports->productExports;

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

                        $debt->date_start = now();
                        
                        // //Xử lí workingday
                        $startDate = $debt->debt_start;
                        $daysToAdd = $debt->debt;
                        $newDate = ($this->calculateWorkingDate($startDate, $daysToAdd));
                        $debt->date_end = $newDate;

                        // Xử lí status debt
                        $endDate = new DateTime($debt->date_end);
                        $now = new DateTime();
                        $interval = $endDate->diff($now);
                        $daysDiff = $interval->format('%R%a');
                        $daysDiff = intval($daysDiff);
                        $daysDiff = -$daysDiff;

                        if ($guest->debt == 0) {
                            $debt->debt_status = 4;
                        } elseif ($daysDiff <= 3) {
                            $debt->debt_status = 2;
                        } elseif ($daysDiff < 0) {
                            $debt->debt_status = 0;
                        } else {
                            $debt->debt_status = 3;
                        }
                        $debt->save();
                        return redirect()->route('exports.index')->with('msg', 'Duyệt đơn thành công!');
                    }
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                }
            } elseif ($action === 'action2') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
                    }
                }
                // Xóa các sản phẩm đã bị xóa
                $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                    ->whereNotIn('product_id', $productIDs)
                    ->get();

                foreach ($productExportsToDelete as $productExport) {
                    // Cập nhật seri_status thành 1 cho sản phẩm bị xóa
                    $serinumbersToUpdate = Serinumbers::where('product_id', $productExport->product_id)
                        ->where('seri_status', 2)
                        ->limit($productExport->product_qty)
                        ->get();

                    foreach ($serinumbersToUpdate as $serinumber) {
                        $serinumber->seri_status = 1;
                        $serinumber->save();
                    }

                    // Xóa sản phẩm
                    $productExport->delete();
                }

                for ($i = 0; $i < count($productIDs); $i++) {
                    $productID = $productIDs[$i];
                    $productQty = $productQtys[$i];
                    $nameProduct = Product::where('id', $productID)->value('product_name');

                    if (in_array($productID, $existingProductIDs)) {
                        $proExport = ProductExports::where('export_id', $id)
                            ->where('product_id', $productID)
                            ->first();

                        // Lấy số lượng hiện tại của sản phẩm
                        $currentQty = Product::where('id', $productID)->value('product_qty');

                        // Kiểm tra số lượng sản phẩm mới được cập nhật
                        $availableQty = $currentQty + $proExport->product_qty - $productQty;

                        if ($availableQty < 0) {
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                        }

                        // Cập nhật seri_status khi số lượng sản phẩm tăng hoặc giảm
                        if ($productQty > $proExport->product_qty) {
                            $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 1)
                                ->limit($productQty - $proExport->product_qty)
                                ->get();

                            foreach ($serinumbersToUpdate as $serinumber) {
                                $serinumber->seri_status = 2;
                                $serinumber->save();
                            }
                        } elseif ($productQty < $proExport->product_qty) {
                            $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 2)
                                ->limit($proExport->product_qty - $productQty)
                                ->get();

                            foreach ($serinumbersToUpdate as $serinumber) {
                                $serinumber->seri_status = 1;
                                $serinumber->save();
                            }
                        }

                        // Cập nhật thông tin sản phẩm
                        $proExport->products_id = $request->products_id[$i];
                        $proExport->product_unit = $request->product_unit[$i];
                        $proExport->product_qty = $productQty;
                        $proExport->product_price = $request->product_price[$i];
                        $proExport->product_note = $request->product_note[$i];
                        $proExport->product_tax = $request->product_tax[$i];
                        $proExport->product_total = $request->totalValue;
                        $proExport->save();
                    } else {
                        // Kiểm tra số lượng sản phẩm mới được thêm
                        $currentQty = Product::where('id', $productID)->value('product_qty');
                        if ($productQty > $currentQty) {
                            return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                        }
                        $proExport = new ProductExports();
                        $proExport->products_id = $request->products_id[$i];
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

                        // Cập nhật seri_status bằng 2 cho sản phẩm mới
                        $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                            ->where('seri_status', 1)
                            ->limit($productQty)
                            ->get();

                        foreach ($serinumbersToUpdate as $serinumber) {
                            $serinumber->seri_status = 2;
                            $serinumber->save();
                        }
                    }

                    $totalQtyNeeded += $productQty;
                }

                Serinumbers::whereIn('product_id', $productIDs)
                    ->where('seri_status', 2)
                    ->where('export_seri', $id)
                    ->update(['seri_status' => 1]);

                // Cập nhật trạng thái và tổng giá trị của export
                $exports->export_status = 0;
                $exports->total = $request->totalValue;
                $exports->note_form = $request->note_form;
                $exports->transport_fee = $request->transport_fee;
                $exports->save();

                // for ($i = 0; $i < count($productIDs); $i++) {
                //     $productID = $productIDs[$i];
                //     $productQty = $productQtys[$i];

                //     // Cập nhật seri_status theo số lượng đã nhập
                //     $serinumbers = Serinumbers::where('product_id', $productID)
                //         ->where('seri_status', 2)
                //         ->get();

                //     foreach ($serinumbers as $serinumber) {
                //         if ($serinumber->seri_status == 2) {
                //             $serinumber->seri_status = 1;
                //             $serinumber->save();
                //         }
                //     }
                // }

                return redirect()->route('exports.index')->with('msg', 'Hủy đơn thành công!');
            } elseif ($action === 'action3') {
                // Lấy danh sách sản phẩm đã tồn tại trong xuất hàng
                if ($exports->productExports != null) {
                    foreach ($exports->productExports as $productExport) {
                        $existingProductIDs[] = $productExport->product_id;
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

                            // Kiểm tra số lượng sản phẩm mới được cập nhật
                            $availableQty = $this->getAvailableProductQty($productID) + $proExport->product_qty - $productQty;

                            if ($availableQty < 0) {
                                return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                            }

                            // Cập nhật seri_status khi số lượng sản phẩm tăng hoặc giảm
                            if ($productQty > $proExport->product_qty) {
                                $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                    ->where('seri_status', 1)
                                    ->limit($productQty - $proExport->product_qty)
                                    ->get();

                                foreach ($serinumbersToUpdate as $serinumber) {
                                    $serinumber->seri_status = 2;
                                    $serinumber->export_seri = $exports->id;
                                    $serinumber->save();
                                }
                            } elseif ($productQty < $proExport->product_qty) {
                                $serinumbersToUpdate = Serinumbers::where('product_id', $productID)
                                    ->where('seri_status', 2)
                                    ->limit($proExport->product_qty - $productQty)
                                    ->get();

                                foreach ($serinumbersToUpdate as $serinumber) {
                                    $serinumber->seri_status = 1;
                                    $serinumber->save();
                                }
                            }

                            $proExport->products_id = $request->products_id[$i];
                            $proExport->product_unit = $request->product_unit[$i];
                            $proExport->product_qty = $productQty;
                            $proExport->product_price = $request->product_price[$i];
                            $proExport->product_note = $request->product_note[$i];
                            $proExport->product_tax = $request->product_tax[$i];
                            $proExport->product_total = $request->totalValue;
                            $proExport->save();
                        } else {
                            // Kiểm tra số lượng sản phẩm mới được thêm
                            $availableQty = $this->getAvailableProductQty($productID);

                            if ($productQty > $availableQty) {
                                return redirect()->route('exports.index')->with('warning', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
                            }

                            $proExport = new ProductExports();
                            $proExport->products_id = $request->products_id[$i];
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

                            $serinumbersToUpdate = Serinumbers::where('product_id', $proExport->product_id)
                                ->where('seri_status', 1)
                                ->limit($productQty)
                                ->get();

                            foreach ($serinumbersToUpdate as $serinumber) {
                                $serinumber->export_seri = $proExport->export_id;
                                $serinumber->seri_status = 2;
                                $serinumber->save();
                            }
                        }

                        $totalQtyNeeded += $productQty;
                    }

                    // Xóa các sản phẩm đã bị xóa
                    $productExportsToDelete = ProductExports::where('export_id', $exports->id)
                        ->whereNotIn('product_id', $productIDs)
                        ->get();

                    foreach ($productExportsToDelete as $productExport) {
                        // Cập nhật seri_status thành 1 cho sản phẩm bị xóa
                        $serinumbersToUpdate = Serinumbers::where('product_id', $productExport->product_id)
                            ->where('seri_status', 2)
                            ->limit($productExport->product_qty)
                            ->get();

                        foreach ($serinumbersToUpdate as $serinumber) {
                            $serinumber->seri_status = 1;
                            $serinumber->save();
                        }

                        // Xóa sản phẩm
                        $productExport->delete();
                    }

                    // Kiểm tra số lượng tổng cần thiết
                    $availableQtyTotal = $this->getAvailableProductQtyTotal();
                    //thêm khách hàng khi lưu nhanh
                    if ($request->checkguest == 2 && $clickValue == null) {
                        $existingCustomer = Guests::orwhere('guest_code', $request->guest_code)
                            ->orwhere('guest_name', $request->guest_name)
                            ->first();
                        if (!$existingCustomer) {
                            $guest = new Guests();
                            $guest->guest_name = $request->guest_name;
                            $guest->guest_addressInvoice = $request->guest_addressInvoice;
                            $guest->guest_code = $request->guest_code;
                            $guest->guest_addressDeliver = $request->guest_addressDeliver;
                            $guest->guest_receiver = $request->guest_receiver;
                            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                            $guest->guest_email = $request->guest_email;
                            $guest->guest_status = 1;
                            $guest->guest_phone = $request->guest_phone;
                            $guest->guest_pay = $request->guest_pay;
                            $guest->guest_note = $request->guest_note;
                            if ($request->debt == null) {
                                $guest->debt = 0;
                            } else {
                                $guest->debt = $request->debt;
                            }
                            $guest->save();
                            // Tạo đơn xuất hàng
                            $exports->guest_id = $guest->id;
                            $exports->user_id = Auth::user()->id;
                            $exports->total = $request->totalValue;
                            $exports->export_status = 1;
                            $exports->note_form = $request->note_form;
                            $exports->transport_fee = $request->transport_fee;
                            $exports->save();
                        } else {
                            $exports->guest_id = $existingCustomer->id;
                            $exports->user_id = Auth::user()->id;
                            $exports->total = $request->totalValue;
                            $exports->export_status = 1;
                            $exports->note_form = $request->note_form;
                            $exports->transport_fee = $request->transport_fee;
                            $exports->save();
                        }
                    }
                    //cập nhật khách hàng khi lưu nhanh
                    if ($request->checkguest == 1 && $updateClick == null) {
                        $guest = Guests::find($request->id);
                        $guest->guest_name = $request->guest_name;
                        $guest->guest_addressInvoice = $request->guest_addressInvoice;
                        $guest->guest_code = $request->guest_code;
                        $guest->guest_addressDeliver = $request->guest_addressDeliver;
                        $guest->guest_receiver = $request->guest_receiver;
                        $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                        $guest->guest_email = $request->guest_email;
                        $guest->guest_status = 1;
                        $guest->guest_phone = $request->guest_phone;
                        $guest->guest_pay = $request->guest_pay;
                        $guest->guest_note = $request->guest_note;
                        if ($request->debt == null) {
                            $guest->debt = 0;
                        } else {
                            $guest->debt = $request->debt;
                        }
                        $guest->save();
                        // Tạo đơn xuất hàng
                        $exports->guest_id = $guest->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 1;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->save();
                    }
                    //Tạo đơn khi đã nhấn cập nhật
                    if ($updateClick == 1 && $request->checkguest == 1) {
                        $exports->guest_id = $request->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 1;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->save();
                    }
                    //Tạo đơn khi đã nhấn thêm
                    if ($request->checkguest == 2 && $clickValue == 1) {
                        $exports->guest_id = $request->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 1;
                        $exports->note_form = $request->note_form;
                        $exports->transport_fee = $request->transport_fee;
                        $exports->save();
                    }
                    return redirect()->route('exports.index')->with('msg', 'Cập nhật thành công!');
                } else {
                    return redirect()->route('exports.index')->with('warning', 'Chưa được thêm sản phẩm nào!');
                }
            }
        }
    }

    // Lấy số lượng sản phẩm có sẵn cho một product_id
    private function getAvailableProductQty($productID)
    {
        return Serinumbers::where('product_id', $productID)
            ->where('seri_status', 1)
            ->count();
    }

    // Lấy tổng số lượng sản phẩm có sẵn
    private function getAvailableProductQtyTotal()
    {
        return Serinumbers::where('seri_status', 1)
            ->count();
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
            // Kiểm tra xem dữ liệu đã tồn tại trong cơ sở dữ liệu hay chưa
            // $existingCustomer = Guests::where('guest_name', $request->guest_name)
            //     ->where('guest_email', $request->guest_email)
            //     ->where('guest_code', $request->guest_code)
            //     ->where('guest_phone', $request->guest_phone)
            //     ->first();

            // if ($existingCustomer) {
            //     // Dữ liệu đã tồn tại, trả về thông báo
            //     // session()->flash('warning', 'Thông tin khách hàng đã có trong hệ thống');
            //     return response()->json(['message' => 'Thông tin khách hàng đã có trong hệ thống']);
            // } else {
            //     $update_guest = Guests::findOrFail($data['id']);
            //     $update_guest->guest_name = $data['guest_name'];
            //     $update_guest->guest_addressInvoice = $data['guest_addressInvoice'];
            //     $update_guest->guest_code = $data['guest_code'];
            //     $update_guest->guest_addressDeliver = $data['guest_addressDeliver'];
            //     $update_guest->guest_receiver = $data['guest_receiver'];
            //     $update_guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
            //     $update_guest->guest_email = $data['guest_email'];
            //     $update_guest->guest_phone = $data['guest_phone'];
            //     $update_guest->guest_pay = $data['guest_pay'];
            //     $update_guest->guest_note = $data['guest_note'];
            //     $update_guest->debt = $data['debt'];
            //     $update_guest->save();
            //     return response()->json(['message' => 'Lưu thông tin thành công!']);
            // }
            $update_guest = Guests::findOrFail($data['id']);
            $update_guest->guest_name = $data['guest_name'];
            $update_guest->guest_addressInvoice = $data['guest_addressInvoice'];
            $update_guest->guest_code = $data['guest_code'];
            $update_guest->guest_addressDeliver = $data['guest_addressDeliver'];
            $update_guest->guest_receiver = $data['guest_receiver'];
            $update_guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
            $update_guest->guest_email = $data['guest_email'];
            $update_guest->guest_phone = $data['guest_phone'];
            $update_guest->guest_pay = $data['guest_pay'];
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
                $guest->guest_addressInvoice = $data['guest_addressInvoice'];
                $guest->guest_code = $data['guest_code'];
                $guest->guest_addressDeliver = $data['guest_addressDeliver'];
                $guest->guest_receiver = $data['guest_receiver'];
                $guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
                $guest->guest_email = $data['guest_email'];
                $guest->guest_status = 1;
                $guest->guest_phone = $data['guest_phone'];
                $guest->guest_pay = $data['guest_pay'];
                $guest->guest_note = $data['guest_note'];
                $guest->debt = $data['debt'];
                $guest->user_id = Auth::user()->id;
                $guest->save();

                // Trả về giá trị id của khách hàng vừa lưu
                return response()->json(['id' => $guest->id]);
            }
        }
    }

    public function nameProduct(Request $request)
    {
        $data = $request->all();
        $selectedProductIds = $data['selectedProductIds'] ?? [];

        // Retrieve the parent product ID from the request data
        $parentId = $data['idProducts'];

        // Retrieve the selected product names based on the selected product IDs
        $selectedProductNames = Product::whereIn('id', $selectedProductIds)->pluck('product_name')->toArray();

        // Retrieve the child products excluding the selected product IDs and names
        $products = Product::where('products_id', $parentId)
            ->whereNotIn('id', $selectedProductIds)
            ->whereNotIn('product_name', $selectedProductNames)
            ->get();

        return response()->json($products);
    }

    public function getProduct(Request $request)
    {
        $data = $request->all();
        $product = Product::join('serinumbers', 'serinumbers.product_id', 'product.id')
            ->where('product.id', $data['idProduct'])
            ->groupBy(
                'product.id',
                'product.products_id',
                'product.product_name',
                'product.product_category',
                'product.product_trademark',
                'product.product_unit',
                'product_qty',
                'product.product_price',
                'product.product_orderid',
                'product.created_at',
                'product.updated_at',
                'product.provide_id',
                'product.tax',
                'product.total',
            )
            ->select(
                'product.*',
                DB::raw('SUM(CASE WHEN serinumbers.seri_status = 2 THEN 1 ELSE 0 END) as trading'),
                DB::raw('SUM(CASE WHEN serinumbers.seri_status = 1 THEN 1 ELSE 0 END) as qty_exist')
            )
            ->first();
        return response()->json($product);
    }

    public function getSN(Request $request)
    {
        $data = $request->all();
        if ($data['qty'] == null) {
            return;
        } else {
            $sn = Serinumbers::where('product_id', $data['productCode'])
                ->where('seri_status', '1')->limit($data['qty'])->get();
            return response()->json($sn);
        }
    }

    public function getSN1(Request $request)
    {
        $data = $request->all();
        if ($data['qty'] == null) {
            return;
        } else {
            $sn = Serinumbers::where('product_id', $data['productCode'])
                ->where('export_seri', $data['export_id'])
                ->where('seri_status', '3')->limit($data['qty'])->get();
            return response()->json($sn);
        }
    }

    public function getSN2(Request $request)
    {
        $data = $request->all();
        if ($data['qty'] == null) {
            return;
        } else {
            $sn = Serinumbers::where('product_id', $data['productCode'])
                ->where('export_seri', $data['export_id'])
                ->orderByRaw("CASE WHEN seri_status = 2 THEN 0 ELSE 1 END")
                ->limit($data['qty'])
                ->get();
            return response()->json($sn);
        }
    }

    //lấy seri đơn xuất hàng hủy
    public function getSN3(Request $request)
    {
        $data = $request->all();
        if ($data['qty'] == null) {
            return;
        } else {
            $sn = Serinumbers::where('product_id', $data['productCode'])
                ->where('export_seri', $data['export_id'])
                ->where('seri_status', '1')->limit($data['qty'])->get();
            return response()->json($sn);
        }
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
