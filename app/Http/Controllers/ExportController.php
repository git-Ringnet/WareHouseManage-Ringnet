<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Guests;
use App\Models\Product;
use App\Models\productExports;
use App\Models\Products;
use App\Models\Serinumbers;
use App\Models\User;
use Illuminate\Http\Request;
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
            array_push($filters, ['guests.guest_represent', 'like', '%' . $guest . '%']);
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
            $datearr = ['label' => 'Chỉnh sửa cuối:', 'values' => [$trip_start, $trip_end], 'class' => 'date'];
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
        return view('tables.export.exports', compact('export', 'exports', 'sortType', 'string', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        $customer = Guests::all();
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
            $clickValue = $request->input('click');
            $totalQtyNeeded = 0;
            $existingProductIDs = [];
            if ($request->has('submitBtn')) {
                $action = $request->input('submitBtn');
                if ($action === 'action1') {
                    // Tính tổng số lượng cần thiết cho mỗi product_id
                    $productQtyMap = [];
                    if ($productIDs == null) {
                        return redirect()->route('exports.index')->with('danger', 'Chưa thêm sản phẩm!');
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
                        $hasEnoughQty = true;
                        foreach ($productQtyMap as $productID => $productQty) {
                            $serinumbers = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 1)
                                ->limit($productQty)
                                ->get();

                            if (count($serinumbers) < $productQty) {
                                $hasEnoughQty = false;
                                break;
                            } else {
                                // Cập nhật seri_status bằng 2 cho các sản phẩm
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 2;
                                        $serinumber->save();
                                    }
                                }
                            }
                        }
                        if (!$hasEnoughQty) {
                            return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng
                            if ($clickValue === null) {
                                $guest = new Guests();
                                $guest->guest_name = $request->guest_name;
                                $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                $guest->guest_code = $request->guest_code;
                                $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                $guest->guest_receiver = $request->guest_receiver;
                                $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                $guest->guest_represent = $request->guest_represent;
                                $guest->guest_email = $request->guest_email;
                                $guest->guest_status = 1;
                                $guest->guest_phone = $request->guest_phone;
                                $guest->guest_pay = $request->guest_pay;
                                $guest->guest_payTerm = $request->guest_payTerm;
                                $guest->guest_note = $request->guest_note;
                                $guest->save();
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $guest->id;
                                $export->user_id = Auth::user()->id;
                                $export->total = $request->totalValue;
                                $export->export_status = 2;
                                $export->save();
                            } else {
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $request->id;
                                $export->user_id = Auth::user()->id;
                                $export->total = $request->totalValue;
                                $export->export_status = 2;
                                $export->save();
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
                            return redirect()->route('exports.index')->with('msg', 'Chốt đơn thành công!');
                        }
                    }
                }
                if ($action === 'action2') {
                    // Tính tổng số lượng cần thiết cho mỗi product_id
                    $productQtyMap = [];
                    if ($productIDs == null) {
                        return redirect()->route('exports.index')->with('danger', 'Chưa thêm sản phẩm!');
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
                        $hasEnoughQty = true;
                        foreach ($productQtyMap as $productID => $productQty) {
                            $serinumbers = Serinumbers::where('product_id', $productID)
                                ->where('seri_status', 1)
                                ->limit($productQty)
                                ->get();

                            if (count($serinumbers) < $productQty) {
                                $hasEnoughQty = false;
                                break;
                            } else {
                                // Cập nhật seri_status bằng 2 cho các sản phẩm
                                foreach ($serinumbers as $serinumber) {
                                    if ($serinumber->seri_status == 1) {
                                        $serinumber->seri_status = 2;
                                        $serinumber->save();
                                    }
                                }
                            }
                        }
                        if (!$hasEnoughQty) {
                            return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng tồn kho!');
                        } else {
                            //thêm khách hàng
                            if ($clickValue === null) {
                                $existingCustomer = Guests::where('guest_name', $request->guest_name)
                                    ->where('guest_email', $request->guest_email)
                                    ->where('guest_addressInvoice', $request->guest_addressInvoice)
                                    ->where('guest_code', $request->guest_code)
                                    ->first();

                                if (!$existingCustomer) {
                                    $guest = new Guests();
                                    $guest->guest_name = $request->guest_name;
                                    $guest->guest_addressInvoice = $request->guest_addressInvoice;
                                    $guest->guest_code = $request->guest_code;
                                    $guest->guest_addressDeliver = $request->guest_addressDeliver;
                                    $guest->guest_receiver = $request->guest_receiver;
                                    $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
                                    $guest->guest_represent = $request->guest_represent;
                                    $guest->guest_email = $request->guest_email;
                                    $guest->guest_status = 1;
                                    $guest->guest_phone = $request->guest_phone;
                                    $guest->guest_pay = $request->guest_pay;
                                    $guest->guest_payTerm = $request->guest_payTerm;
                                    $guest->guest_note = $request->guest_note;
                                    $guest->save();
                                    // Tạo đơn xuất hàng
                                    $export = new Exports();
                                    $export->guest_id = $guest->id;
                                    $export->user_id = Auth::user()->id;
                                    $export->total = $request->totalValue;
                                    $export->export_status = 1;
                                    $export->save();
                                } else {
                                    $export = new Exports();
                                    $export->guest_id = $request->id;
                                    $export->user_id = Auth::user()->id;
                                    $export->total = $request->totalValue;
                                    $export->export_status = 1;
                                    $export->save();
                                }
                            } else {
                                // Tạo đơn xuất hàng
                                $export = new Exports();
                                $export->guest_id = $request->id;
                                $export->user_id = Auth::user()->id;
                                $export->total = $request->totalValue;
                                $export->export_status = 1;
                                $export->save();
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
                            return redirect()->route('exports.index')->with('msg', 'Tạo đơn thành công!');
                        }
                    }
                }
            }
        } else {
            return redirect()->back();
        }
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
        $productExport = productExports::join('exports', 'product_exports.export_id', '=', 'exports.id')
            ->join('products', 'products.id', 'product_exports.products_id')
            ->where('export_id', $id)
            ->get();
        $product_code = Products::all();
        $title = 'Chỉnh sửa đơn xuất hàng';
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
                                return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
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
                                return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
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
                        Product::where('id', $productID)->decrement('product_qty', $productQty);
                    }

                    // Kiểm tra số lượng tổng cần thiết
                    $availableQtyTotal = $this->getAvailableProductQtyTotal();

                    if ($totalQtyNeeded > $availableQtyTotal) {
                        return redirect()->route('exports.index')->with('danger', 'Vượt quá tổng số lượng sản phẩm!');
                    } else {
                        $exports->guest_id = $request->id;
                        $exports->user_id = Auth::user()->id;
                        $exports->total = $request->totalValue;
                        $exports->export_status = 2;
                        $exports->save();

                        // Cập nhật tình trạng seri sau khi chốt
                        Serinumbers::whereIn('product_id', $productIDs)
                            ->where('seri_status', 2)
                            ->update(['seri_status' => 3]);

                        //cập nhật số lượng tồn kho sản phẩm cha
                        $query = "UPDATE `products` 
                                            INNER JOIN `product` ON `products`.`id` = `product`.`products_id` 
                                            SET `products`.`inventory` = (SELECT SUM(`product`.`product_qty`) FROM `product` WHERE `product`.`products_id` = `products`.`id`) 
                                            WHERE `products`.`id` IN (" . implode(',', $products_id) . ")";
                        DB::statement($query);
                        return redirect()->route('exports.index')->with('msg', 'Chốt đơn thành công!');
                    }
                } else {
                    return redirect()->route('exports.index')->with('danger', 'Chưa được thêm sản phẩm nào!');
                }
            } elseif ($action === 'action2') {
                Serinumbers::whereIn('product_id', $productIDs)
                    ->where('seri_status', 2)
                    ->update(['seri_status' => 1]);

                // Cập nhật trạng thái và tổng giá trị của export
                $exports->export_status = 0;
                $exports->total = $request->totalValue;
                $exports->save();

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
                                return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
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
                                return redirect()->route('exports.index')->with('danger', 'Vượt quá số lượng cho sản phẩm ' . $nameProduct . '!');
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

                    // Kiểm tra số lượng tổng cần thiết
                    $availableQtyTotal = $this->getAvailableProductQtyTotal();

                    if ($totalQtyNeeded > $availableQtyTotal) {
                        return redirect()->route('exports.index')->with('danger', 'Vượt quá tổng số lượng sản phẩm!');
                    }

                    $exports->guest_id = $request->id;
                    $exports->user_id = Auth::user()->id;
                    $exports->total = $request->totalValue;
                    $exports->export_status = 1;
                    $exports->save();

                    return redirect()->route('exports.index')->with('msg', 'Cập nhật thành công!');
                } else {
                    return redirect()->route('exports.index')->with('danger', 'Chưa được thêm sản phẩm nào!');
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
        $update_guest = Guests::findOrFail($data['id']);
        $update_guest->guest_name = $data['guest_name'];
        $update_guest->guest_addressInvoice = $data['guest_addressInvoice'];
        $update_guest->guest_code = $data['guest_code'];
        $update_guest->guest_addressDeliver = $data['guest_addressDeliver'];
        $update_guest->guest_receiver = $data['guest_receiver'];
        $update_guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
        $update_guest->guest_represent = $data['guest_represent'];
        $update_guest->guest_email = $data['guest_email'];
        $update_guest->guest_phone = $data['guest_phone'];
        $update_guest->guest_pay = $data['guest_pay'];
        $update_guest->guest_payTerm = $data['guest_payTerm'];
        $update_guest->guest_note = $data['guest_note'];
        $update_guest->save();
    }
    public function addCustomer(Request $request)
    {
        $data = $request->all();
        if ($data['click'] == 1) {
            // Kiểm tra xem dữ liệu đã tồn tại trong cơ sở dữ liệu hay chưa
            $existingCustomer = Guests::where('guest_name', $data['guest_name'])
                ->where('guest_email', $data['guest_email'])
                ->where('guest_addressInvoice', $data['guest_addressInvoice'])
                ->where('guest_code', $data['guest_code'])
                ->first();

            if ($existingCustomer) {
                // Dữ liệu đã tồn tại, trả về thông báo
                return response()->json(['message' => 'Thông tin khách hàng đã có trong hệ thống']);
            }

            // Tạo mới bản ghi khách hàng
            $guest = new Guests();
            $guest->guest_name = $data['guest_name'];
            $guest->guest_addressInvoice = $data['guest_addressInvoice'];
            $guest->guest_code = $data['guest_code'];
            $guest->guest_addressDeliver = $data['guest_addressDeliver'];
            $guest->guest_receiver = $data['guest_receiver'];
            $guest->guest_phoneReceiver = $data['guest_phoneReceiver'];
            $guest->guest_represent = $data['guest_represent'];
            $guest->guest_email = $data['guest_email'];
            $guest->guest_status = 1;
            $guest->guest_phone = $data['guest_phone'];
            $guest->guest_pay = $data['guest_pay'];
            $guest->guest_payTerm = $data['guest_payTerm'];
            $guest->guest_note = $data['guest_note'];
            $guest->save();

            // Trả về giá trị id của khách hàng vừa lưu
            return response()->json(['id' => $guest->id]);
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
            $sn = Serinumbers::where('product_id', $data['productCode'])->limit($data['qty'])->get();
            return response()->json($sn);
        }
    }

    // Xóa đơn hàng AJAX
    public function deleteExports(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            Exports::whereIn('id', $list)->delete();
            return response()->json(['success' => true, 'msg' => 'Xóa đơn hàng thành công', 'ids' => $list]);
        }
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
            return response()->json(['success' => true, 'msg' => 'Hủy Đơn Hàng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
}
