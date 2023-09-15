<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\DebtImport;
use App\Models\Exports;
use App\Models\History;
use App\Models\Orders;
use App\Models\Product;
use App\Models\productExports;
use App\Models\ProductOrders;
use App\Models\Products;
use App\Models\Provides;
use App\Models\Serinumbers;
use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $orders;
    private $provides;
    private $productOrder;
    private $product;
    private $debtImport;
    private $history;
    private $Serinumbers;
    public function __construct()
    {
        $this->orders = new Orders();
        $this->provides = new Provides();
        $this->productOrder = new ProductOrders();
        $this->product = new Product();
        $this->debtImport = new DebtImport();
        $this->history = new History();
        $this->Serinumbers = new Serinumbers();
    }
    public function index(Request $request)
    {
        $string = array();
        $filters = [];
        $status = [];
        $provide_name = [];
        //Số hóa đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['orders.product_code', 'like', '%' . $id . '%']);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Số hóa đơn:', 'values' => $nameArr, 'class' => 'id']);
        }
        //Nhà cung cấp
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
            $filters[] = ['orders.total', $comparison_operator, $sum];
            $inventoryArray = explode(',.@', $sum);
            array_push($string, ['label' => 'Tổng tiền ' . $comparison_operator, 'values' => $inventoryArray, 'class' => 'sum']);
        }

        //Nhà cung cấp
        $provides = Orders::leftjoin('provides', 'orders.provide_id', '=', 'provides.id')->get();
        $provide_namearr = [];
        if (!empty($request->provide_namearr)) {
            $provide_namearr = $request->input('provide_namearr', []);
            if (!empty($provide_namearr)) {
                $selectedProvides = Provides::whereIn('id', $provide_namearr)->get();
                $selectedProvides = $selectedProvides->pluck('provide_name')->toArray();
            }
            array_push($string, ['label' => 'Nhà cung cấp:', 'values' => $selectedProvides, 'class' => 'provide_name']);
        }

        //Trạng thái
        if (!empty($request->status)) {
            $statusValues = [0 => 'Chờ duyệt', 1 => 'Đã nhập hàng', 2 => 'Đã hủy'];
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
        //Ngày nhập hóa đơn
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

        $productIds = array();
        $order = Orders::orderByDesc('id')->get();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
        $perPage = $request->input('perPageinput', 25);
        $orders = $this->orders->getAllOrders($filters, $perPage, $status, $provide_namearr, $name, $date, $keywords, $sortBy, $sortType);
        $product = ProductOrders::with('getCodeProduct')
            ->join('orders', 'productorders.order_id', '=', 'orders.id')
            ->whereIn('orders.id', $productIds)
            ->get();
        $ordersNameAndProvide = Orders::leftjoin('provides', 'orders.provide_id', '=', 'provides.id')
            ->leftjoin('users', 'orders.users_id', '=', 'users.id')->get();
        $title = 'Nhập hàng';
        return view('tables.order.insertProduct', compact('orders', 'perPage', 'product', 'sortType', 'string', 'ordersNameAndProvide', 'provides', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provide = Provides::all();
        $products = Products::all();
        $title = 'Tạo đơn nhập hàng';
        return view('tables.order.insert', compact('provide', 'products', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataProvide = [
            'provide_name' => $request->provide_id == null ? $request->provide_name_new : ($request->input('options') == 2 ? $request->provide_name_new : $request->provide_name),
            'provide_represent' => $request->provide_id == null ? $request->provide_represent_new : ($request->input('options') == 2 ? $request->provide_represent_new : $request->provide_represent),
            'provide_phone' => $request->provide_id == null ? $request->provide_phone_new : ($request->input('options') == 2 ? $request->provide_phone_new : $request->provide_phone),
            'provide_email' => $request->provide_id == null ? $request->provide_email_new : ($request->input('options') == 2 ? $request->provide_email_new : $request->provide_email),
            'provide_address' => $request->provide_id == null ? $request->provide_address_new : ($request->input('options') == 2 ? $request->provide_address_new : $request->provide_address),
            'provide_code' => $request->provide_id == null ? $request->provide_code_new : ($request->input('options') == 2 ? $request->provide_code_new : $request->provide_code),
            'provide_status' => 1,
            'debt' => $request->provide_debt == null ? 0 : $request->provide_debt
        ];
        if ($request['provide_id'] == null) {
            if (
                $request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null
            ) {
                $new_provide = $this->provides->checkProvidesCode($request->provide_code_new, $dataProvide);
            }
        } else {
            $this->provides->updateProvides($dataProvide, $request->provide_id);
        }
        $product_name = $request->product_name;
        $product_unit = $request->product_unit;
        $product_qty = $request->product_qty;
        $product_tax = $request->product_tax;
        $product_price = str_replace(',', '', $request->product_price);
        $product_total = str_replace(',', '', $request->product_total);

        $order = new Orders();
        for ($i = 0; $i < count($product_name); $i++) {
            $order->provide_id = $request->provide_id == null ? $new_provide :  $request->provide_id;
            $order->users_id = Auth::user()->id;
            $order->order_status = 0;
            $order->product_code = $request->product_code;
            $order->created_at =  $request->product_create == null ? Carbon::now() : $request->product_create;
            $order->total += $product_total[$i];
            $order->total_tax = $request->total_import;
            $order->save();

            $dataProductOrder = [
                'product_name' => $product_name[$i],
                'product_unit' => $product_unit[$i],
                'product_qty' => $product_qty[$i],
                'product_tax' => $product_tax[$i],
                'product_price' => $product_price[$i],
                'product_total' => $product_total[$i],
                'order_id' => $order->id,
                'provide_id' => $request->provide_id == null ? $new_provide : $request->provide_id
            ];

            $product_orderid = $this->productOrder->addProductOrder($dataProductOrder);
            $product_SN = $request->{'product_SN' . $i};
            if ($product_SN != null) {
                for ($y = 0; $y < count($product_SN); $y++) {
                    if ($product_SN[$y]) {
                        $dataSN = [
                            'serinumber' => $product_SN[$y],
                            'product_orderid' => $product_orderid,
                            'product_id' => 0,
                            'seri_status' => 0,
                            'products_id' => 0,
                            'order_id' => $order->id,
                            'check' => 0,
                            'export_seri' => 0
                        ];
                        $this->Serinumbers->addSN($dataSN);
                    }
                }
            }
        }
        return redirect()->route('insertProduct.index')->with('msg', 'Tạo đơn nháp thành công');
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
        $order = Orders::findOrFail($id);
        $provide_order = Provides::where('id', $order->provide_id)->get();
        $provide = Provides::all();
        $products = Products::all();
        $product_order = ProductOrders::with('getCodeProduct')->where('order_id', $order->id)->get();
        $productIds = array();
        foreach ($product_order as $value) {
            array_push($productIds, $value->id);
        }
        $serialnumber =  DB::table('serinumbers')
            ->join('productorders', 'serinumbers.product_orderid', '=', 'productorders.id')
            ->whereIn('productorders.id', $productIds)
            ->select('serinumbers.*')
            // ->select('serinumbers.*', 'productorders.id')
            ->get();

        $title = 'Chi tiết đơn nhập hàng';
        return view('tables.order.edit', compact('provide', 'order', 'product_order', 'provide_order', 'products', 'title', 'serialnumber'));
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
        $updateOrder = Orders::find($id);
        // Kiểm tra tình trạng 
        if ($updateOrder->order_status == 2 || $updateOrder->order_status == 1) {
            return redirect()->route('insertProduct.index')->with('warning', 'Thao tác không thành công');
        }
        $dataProvide = [
            'provide_name' => $request->provide_id == null ? $request->provide_name_new : ($request->options == 2 ? $request->provide_name_new : $request->provide_name),
            'provide_represent' => $request->provide_id == null ? $request->provide_represent_new : ($request->options == 2 ? $request->provide_represent_new : $request->provide_represent),
            'provide_phone' => $request->provide_id == null ? $request->provide_phone_new : ($request->options == 2 ? $request->provide_phone_new : $request->provide_phone),
            'provide_email' => $request->provide_id == null ? $request->provide_email_new : ($request->options == 2 ? $request->provide_email_new : $request->provide_email),
            'provide_address' => $request->provide_id == null ? $request->provide_address_new : ($request->options == 2 ? $request->provide_address_new : $request->provide_address),
            'provide_status' => 1,
            'provide_code' => $request->provide_id == null ? $request->provide_code_new : ($request->options == 2 ? $request->provide_code_new : $request->provide_code),
            'debt' => $request->provide_debt == null ? 0 : $request->provide_debt,
        ];
        if ($request->provide_id === null) {
            if ($request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null) {
                $newProvide = $this->provides->checkProvidesCode($request->provide_code_new, $dataProvide);
            }
        } else {
            $this->provides->updateProvides($dataProvide, $request->provide_id);
        }

        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_tax = $request->product_tax;
        $product_price = str_replace(',', '', $request->product_price);
        $product_total = str_replace(',', '', $request->product_total);
        $total_import =  str_replace(',', '', $request->total_import);
        $arr_new_product = [];
        $id_product = [];
        $arr_new_SN = [];
        $updateOrder->total = 0;
        if ($updateOrder->order_status == 0) {
            for ($i = 0; $i < count($product_name); $i++) {
                // Kiểm tra sản phẩm đã tồn tại chưa
                $check = ProductOrders::where('id', isset($product_id[$i]) ? $product_id[$i] : "")->first();
                $dataProduct = [
                    'product_name' => $product_name[$i],
                    'product_unit' => $product_unit[$i],
                    'product_trademark' => $product_trademark[$i],
                    'product_qty' => $product_qty[$i],
                    'product_price' => $product_price[$i],
                    'order_id' => $request->order_id,
                    'product_tax' => $product_tax[$i],
                    'product_total' => $product_total[$i],
                    'provide_id' => $request->provide_id == null ? $newProvide : $request->provide_id
                ];
                if ($check === null) {
                    $newProductOd = $this->productOrder->addProductOrder($dataProduct);
                    $product_SN = $request->{'product_SN' . $i};
                    if ($product_SN != null) {
                        for ($y = 0; $y < count($product_SN); $y++) {
                            if ($product_SN[$y]) {
                                $dataSN = [
                                    'serinumber' => $product_SN[$y],
                                    'product_orderid' => $newProductOd,
                                    'product_id' => 0,
                                    'seri_status' => 0,
                                    'products_id' => 0,
                                    'order_id' => $updateOrder->id,
                                    'check' => 0,
                                    'export_seri' => 0
                                ];
                                $newSN = $this->Serinumbers->addSN($dataSN);
                                array_push($arr_new_SN, $newSN);
                            }
                        }
                    }
                    array_push($arr_new_product, $newProductOd);
                    array_push($id_product, $newProductOd);
                } else {
                    $check->product_name = $product_name[$i];
                    $check->product_unit = $product_unit[$i];
                    $check->product_trademark = $product_trademark[$i];
                    $check->product_qty = $product_qty[$i];
                    $check->product_price = $product_price[$i];
                    $check->product_tax = $product_tax[$i];
                    $check->product_total = $product_total[$i];
                    $check->order_id = $request->order_id;
                    $check->provide_id = $request->provide_id == null ? $newProvide : $request->provide_id;
                    $check->save();
                    $id_SN = $request->{'productSN' . $i};
                    $product_SN = $request->{'product_SN' . $i};
                    if ($product_SN != null && $id_SN != null) {
                        for ($y = 0; $y < count($product_SN); $y++) {
                            if ($product_SN[$y]) {
                                $dataSN = [
                                    'serinumber' => $product_SN[$y],
                                ];
                                if (isset($id_SN[$y])) {
                                    $this->Serinumbers->updateSN($dataSN, $id_SN[$y]);
                                } else {
                                    $dataSN = [
                                        'serinumber' => $product_SN[$y],
                                        'product_orderid' => $check->id,
                                        'product_id' => 0,
                                        'seri_status' => 0,
                                        'products_id' => 0,
                                        'order_id' => $updateOrder->id,
                                        'check' => 0,
                                        'export_seri' => 0
                                    ];
                                    $newSN = $this->Serinumbers->addSN($dataSN);
                                    array_push($arr_new_SN, $newSN);
                                }
                            }
                        }
                    } else {
                        if ($product_SN != null) {
                            for ($y = 0; $y < count($product_SN); $y++) {
                                if ($product_SN[$y]) {
                                    $dataSN = [
                                        'serinumber' => $product_SN[$y],
                                        'product_orderid' => $check->id,
                                        'product_id' => 0,
                                        'seri_status' => 0,
                                        'products_id' => 0,
                                        'order_id' => $updateOrder->id,
                                        'check' => 0,
                                        'export_seri' => 0
                                    ];
                                    $newSN = $this->Serinumbers->addSN($dataSN);
                                    array_push($arr_new_SN, $newSN);
                                }
                            }
                        }
                    }
                    array_push($id_product, $check->id);
                }
                $updateOrder->provide_id = $request->provide_id == null ? $newProvide : $request->provide_id;
                $updateOrder->total += $product_total[$i];
                $updateOrder->product_code = $request->product_code;
                $updateOrder->created_at = $request->product_create === null ? Carbon::now() : $request->product_create;
                $updateOrder->total_tax = $total_import;
                $updateOrder->save();
            }
            // Xóa SN Không tồn tại
            $deleteSN = $this->Serinumbers->deleteSN($product_name, $request, $arr_new_SN, $request->order_id);
            foreach ($deleteSN as $SN) {
                $prod = Serinumbers::find($SN);
                if ($prod) {
                    $prod->delete();
                }
            }

            // Xóa sản phẩm không tồn tại trong array
            $arrProduct = ProductOrders::where('order_id', $request->order_id)->get();

            // Lưu danh sách product_id vào mảng
            $product_id_array = [];
            foreach ($arrProduct as $product) {
                $pro_id = $product->id;
                array_push($product_id_array, $pro_id);
            }

            // Kiểm tra xóa hết sản phẩm trong đơn nháp
            $deletePro = array_diff($product_id_array, $arr_new_product);
            if ($product_id === null) {
                $id_del = $deletePro;
            } else {
                $id_del = $product_id;
            }

            // Tìm phần tử không tồn tại trong danh sách order_id và xóa
            if ($deletePro === $id_del) {
                $remaining = $deletePro;
            } else {
                $remaining = array_diff($deletePro, $id_del);
            }

            // Xóa sản phẩm và Serialnumber của sản phẩm
            foreach ($remaining as $valu) {
                $prod = ProductOrders::where('id', $valu)->get();
                foreach ($prod as $item) {
                    Serinumbers::where('product_orderid', $item->id)->delete();
                    $item->delete();
                }
            }

            for ($i = 0; $i < count($product_name); $i++) {
                $dataProduct = [
                    'product_name' => $product_name[$i],
                    'product_trademark' => $product_trademark[$i],
                    'product_unit' => $product_unit[$i],
                    'product_qty' => $product_qty[$i],
                    'product_price' => $product_price[$i],
                    'product_tax' => $product_tax[$i],
                    'product_total' => $product_total[$i],
                    'provide_id' => $request->provide_id == null ? $newProvide : $request->provide_id,
                    'product_code' => $request->product_code,
                    'created_at' => $request->product_create === null ? Carbon::now() : $request->product_create
                ];
                $newP = $this->product->addProduct($dataProduct);
                $updateP = ProductOrders::where('id', $id_product[$i])->first();
                $updateP->product_id = $newP;
                $updateP->save();
                // Thêm id sản phẩm cho SN
                Serinumbers::where('product_orderid', $id_product[$i])->update([
                    'product_id' => $newP,
                    'seri_status' => 1
                ]);
            }
            $updateOrder->order_status = 1;
            $updateOrder->save();

            $debt = new DebtImport();
            $debt->provide_id = $request->provide_id == null ? $newProvide : $request->provide_id;
            $debt->user_id = Auth::user()->id;
            $debt->import_id = $updateOrder->id;
            $debt->total_import = $total_import;
            $debt->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
            $debt->date_start = $request->product_create === null ? Carbon::now() : $request->product_create;

            $startDate = Carbon::parse($request->product_create === null ? Carbon::now() : $request->product_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
            $daysToAdd = $debt->debt; // Số ngày cần thêm

            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

            // Định dạng ngày kết thúc theo ý muốn
            $endDateFormatted = $endDate->format('Y-m-d');

            $debt->date_end = $endDateFormatted;
            // Xử lí status debt
            $endDate = Carbon::parse($endDate);
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

            $debt->created_at = $updateOrder->created_at;
            $debt->save();
            return redirect()->route('insertProduct.index')->with('msg', 'Đơn hàng đã được duyệt');
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt trước đó');
        }
    }

    function calculateAllDays($startDate, $daysToAdd)
    {
        $createdDate = Carbon::parse($startDate);
        $currentDate = $createdDate->addDays($daysToAdd);

        return $currentDate->format('Y-m-d');
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

    // Hiển thị thông tin Provide theo ID
    public function show_provide(Request $requesst)
    {
        $data = $requesst->all();
        $provide = Provides::findOrFail($data['provides_id']);
        return $provide;
    }

    // Duyệt Đơn Hàng Nhanh
    public function addBill(Request $request)
    {
        $product_name = $request->product_name;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_tax = $request->product_tax;
        $product_price = str_replace(',', '', $request->product_price);
        $product_total = str_replace(',', '', $request->product_total);
        $total_import =  str_replace(',', '', $request->total_import);
        $total_price = str_replace(',', '', $request->total_price);
        $id_product = [];
        $dataProvide = [
            'provide_name' => $request->provide_id == null ? $request->provide_name_new : ($request->options == 2 ? $request->provide_name_new : $request->provide_name),
            'provide_represent' => $request->provide_id == null ? $request->provide_represent_new : ($request->options == 2 ? $request->provide_represent_new : $request->provide_represent),
            'provide_phone' => $request->provide_id == null ? $request->provide_phone_new : ($request->options == 2 ? $request->provide_phone_new : $request->provide_phone),
            'provide_email' => $request->provide_id == null ? $request->provide_email_new : ($request->options == 2 ? $request->provide_email_new : $request->provide_email),
            'provide_address' => $request->provide_id == null ? $request->provide_address_new : ($request->options == 2 ? $request->provide_address_new : $request->provide_address),
            'provide_code' => $request->provide_id == null ? $request->provide_code_new : ($request->options == 2 ? $request->provide_code_new : $request->provide_code),
            'debt' => $request->provide_debt == null ? 0 : $request->provide_debt,
            'provide_status' => 1
        ];
        if ($request['provide_id'] == null) {
            if (
                $request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null
            ) {
                $new = $this->provides->checkProvidesCode($request->provide_code_new, $dataProvide);
            }
        } else {
            $this->provides->updateProvides($dataProvide, $request['provide_id']);
        }

        $dataOrder = [
            'provide_id' => $request->provide_id == null ? $new :  $request['provide_id'],
            'users_id' => Auth::user()->id,
            'order_status' => 0,
            'product_code' =>  $request->product_code,
            'created_at' => $request->product_create === null ? Carbon::now() : $request->product_create,
            'total' => $total_price,
            'total_tax' => $request->total_import
        ];
        $order = $this->orders->addOrder($dataOrder);
        for ($i = 0; $i < count($product_name); $i++) {
            $data = [
                'product_name' => $product_name[$i],
                'product_unit' => $product_unit[$i],
                'product_trademark' => $product_trademark[$i],
                'product_qty' => $product_qty[$i],
                'product_tax' => $product_tax[$i],
                'product_price' => $product_price[$i],
                'order_id' => $order,
                'product_total' => $product_total[$i],
                'provide_id' => $request->provide_id == null ? $new :  $request['provide_id']
            ];
            $newProductOrder = $this->productOrder->addProductOrder($data);
            array_push($id_product, $newProductOrder);
            $product_SN = $request->{'product_SN' . $i};
            if ($product_SN != null) {
                for ($j = 0; $j < count($product_SN); $j++) {
                    if ($product_SN[$j] != null) {
                        $dataSN = [
                            'serinumber' => $product_SN[$j],
                            'product_orderid' => $newProductOrder,
                            'product_id' => 0,
                            'seri_status' => 0,
                            'products_id' => 0,
                            'order_id' => $order,
                            'check' => 0,
                            'export_seri' => 0
                        ];
                        $this->Serinumbers->addSN($dataSN);
                    }
                }
            }
        }

        // Update Product
        $updateOrder = Orders::find($order);
        if ($updateOrder->order_status == 0) {
            for ($i = 0; $i < count($product_name); $i++) {
                $data1 = [
                    'product_name' => $product_name[$i],
                    'product_unit' => $product_unit[$i],
                    'product_trademark' => $product_trademark[$i],
                    'product_qty' => $product_qty[$i],
                    'product_tax' => $product_tax[$i],
                    'product_price' => $product_price[$i],
                    'product_total' => $product_total[$i],
                    'provide_id' => $request->provide_id == null ? $new :  $request['provide_id'],
                    'product_code' => $request->product_code,
                    'created_at' => $request->product_create === null ? Carbon::now() : $request->product_create
                ];
                $pro = $this->product->addProduct($data1);
                $updateP = ProductOrders::where('id', $id_product[$i])->first();
                // $updateSN = Serinumbers::whereIn('product_orderid',$id_product[$i]);

                $updateP->product_id = $pro;
                $updateP->save();

                // Thêm id sản phẩm cho SN
                Serinumbers::where('product_orderid', $id_product[$i])->update([
                    'product_id' => $pro,
                    'seri_status' => 1
                ]);
            }

            $updateOrder->order_status = 1;
            $updateOrder->save();

            $debt = new DebtImport();
            $debt->provide_id = $request['provide_id'] == null ? $new : $request->provide_id;
            $debt->user_id = Auth::user()->id;
            $debt->import_id = $updateOrder->id;
            $debt->total_import = $total_import;
            $debt->debt = $request->provide_debt == null ? 0 : $request->provide_debt;

            $debt->date_start = $request->product_create === null ? Carbon::now() : $request->product_create;

            $startDate = Carbon::parse($request->product_create === null ? Carbon::now() : $request->product_create); // Chuyển đổi ngày bắt đầu thành đối tượng Carbon
            $daysToAdd = $debt->debt; // Số ngày cần thêm

            $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

            // Định dạng ngày kết thúc theo ý muốn
            $endDateFormatted = $endDate->format('Y-m-d');
            $debt->date_end = $endDateFormatted;

            // Xử lí status debt
            $endDate = Carbon::parse($endDate); // Chuyển đổi ngày kết thúc thành đối tượng Carbon

            $currentDate = Carbon::now(); // Lấy ngày hiện tại thành đối tượng Carbon

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

            $debt->created_at = $updateOrder->created_at;
            $debt->save();
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt trước đó');
        }
        return redirect()->route('insertProduct.index')->with('msg', 'Duyệt nhanh đơn hàng thành công');
    }

    // update provide AJAX
    public function update_provide(Request $request)
    {
        $data = $request->all();
        $data = [
            'provide_name' => $data['provide_name'],
            'provide_represent' => $data['provide_represent'],
            'provide_phone' => $data['provide_phone'],
            'provide_email' => $data['provide_email'],
            'provide_address' => $data['provide_address'],
            'provide_code' => $data['provide_code'],
            'debt' => $data['provide_debt']
        ];
        $this->provides->updateProvides($data, $request['provides_id']);
    }

    // Thêm hàng mới vào Order
    public function addBillEdit(Request $request)
    {
        $order = Orders::findOrFail($request->order_id);
        // Kiểm tra tình trạng 
        if ($order->order_status == 2 || $order->order_status == 1) {
            return redirect()->route('insertProduct.index')->with('warning', 'Thao tác không thành công !');
        }
        $dataProvide = [
            'provide_name' => $request->provide_id == null ? $request->provide_name_new : ($request->options == 2 ? $request->provide_name_new : $request->provide_name),
            'provide_represent' => $request->provide_id == null ? $request->provide_represent_new : ($request->options == 2 ? $request->provide_represent_new : $request->provide_represent),
            'provide_phone' => $request->provide_id == null ? $request->provide_phone_new : ($request->options == 2 ? $request->provide_phone_new : $request->provide_phone),
            'provide_address' => $request->provide_id == null ? $request->provide_address_new : ($request->options == 2 ? $request->provide_address_new  : $request->provide_address),
            'provide_email' => $request->provide_id == null ? $request->provide_email_new : ($request->options == 2 ? $request->provide_email_new : $request->provide_email),
            'provide_code' => $request->provide_id == null ? $request->provide_code_new : ($request->options == 2 ? $request->provide_code_new : $request->provide_code),
            'provide_status' => 1,
            'debt' => $request->provide_debt == null ? 0 : $request->provide_debt
        ];

        if ($request->provide_id == null) {
            if ($request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null) {
                $new_provide = $this->provides->checkProvidesCode($request->provide_code_new, $dataProvide);
            }
        } else {
            $this->provides->updateProvides($dataProvide, $request->provide_id);
        }

        $order->total = 0;
        if ($order->order_status != 1) {
            $product_id = $request->product_id;
            $product_name = $request->product_name;
            $product_unit = $request->product_unit;
            $product_trademark = $request->product_trademark;
            $product_qty = $request->product_qty;
            $product_tax = $request->product_tax;
            $product_price = str_replace(',', '', $request->product_price);
            $product_total = str_replace(',', '', $request->product_total);
            $total_tax = str_replace(',', '', $request->total_import);
            $arr_new_product = [];
            $arr_new_SN = [];
            for ($i = 0; $i < count($product_name); $i++) {
                $dataProductOrder = [
                    'product_name' => $product_name[$i],
                    'product_unit' => $product_unit[$i],
                    'product_trademark' => $product_trademark[$i],
                    'product_qty' => $product_qty[$i],
                    'product_tax' => $product_tax[$i],
                    'product_price' => $product_price[$i],
                    'product_total' => $product_total[$i],
                    'provide_id' => $order->provide_id,
                    'order_id' => $request->order_id
                ];

                // Kiểm tra sản phẩm đã tồn tại chưa
                $check = ProductOrders::where('id', isset($product_id[$i]) ? $product_id[$i] : "")->first();
                $product_SN = $request->{'product_SN' . $i};
                if ($check === null) {
                    // Thêm sản phẩm
                    $newProductOd = $this->productOrder->addProductOrder($dataProductOrder);
                    // Thêm Serialnumber
                    if ($product_SN) {
                        for ($y = 0; $y < count($product_SN); $y++) {
                            if ($product_SN[$y]) {
                                $dataSN = [
                                    'serinumber' => $product_SN[$y],
                                    'product_orderid' => $newProductOd,
                                    'product_id' => 0,
                                    'seri_status' => 0,
                                    'products_id' => 0,
                                    'order_id' => $order->id,
                                    'check' => 0,
                                    'export_seri' => 0
                                ];
                                $newSN = $this->Serinumbers->addSN($dataSN);
                                array_push($arr_new_SN, $newSN);
                            }
                        }
                    }
                    array_push($arr_new_product, $newProductOd);
                } else {
                    $this->productOrder->updateProductOrder($dataProductOrder, $check->id);
                    $id_SN = $request->{'productSN' . $i};
                    $product_SN = $request->{'product_SN' . $i};
                    if ($product_SN != null && $id_SN != null) {
                        for ($y = 0; $y < count($product_SN); $y++) {
                            if ($product_SN[$y]) {
                                $dataSN = [
                                    'serinumber' => $product_SN[$y],
                                ];
                                if (isset($id_SN[$y])) {
                                    $this->Serinumbers->updateSN($dataSN, $id_SN[$y]);
                                } else {
                                    $dataSN = [
                                        'serinumber' => $product_SN[$y],
                                        'product_orderid' => $check->id,
                                        'product_id' => 0,
                                        'seri_status' => 0,
                                        'products_id' => 0,
                                        'order_id' => $order->id,
                                        'check' => 0,
                                        'export_seri' => 0
                                    ];
                                    $newSN = $this->Serinumbers->addSN($dataSN);
                                    array_push($arr_new_SN, $newSN);
                                }
                            }
                        }
                    } else {
                        if ($product_SN != null) {
                            for ($y = 0; $y < count($product_SN); $y++) {
                                if ($product_SN[$y]) {
                                    $dataSN = [
                                        'serinumber' => $product_SN[$y],
                                        'product_orderid' => $check->id,
                                        'product_id' => 0,
                                        'seri_status' => 0,
                                        'products_id' => 0,
                                        'order_id' => $order->id,
                                        'check' => 0,
                                        'export_seri' => 0
                                    ];
                                    $newSN = $this->Serinumbers->addSN($dataSN);
                                    array_push($arr_new_SN, $newSN);
                                }
                            }
                        }
                    }
                }
                $order->provide_id = $request->provide_id == null ? $new_provide : $request->provide_id;
                $order->total += $product_total[$i];
                $order->product_code = $request->product_code;
                $order->created_at = $request->product_create === null ? Carbon::now() : $request->product_create;
                $order->total_tax = $total_tax;
                $order->save();
            }
            // Lấy ra tất cả sản phẩm theo id bảng order
            $arrProduct = ProductOrders::where('order_id', $request->order_id)->get();
            $deleteSN = $this->Serinumbers->deleteSN($product_name, $request, $arr_new_SN, $request->order_id);
            foreach ($deleteSN as $SN) {
                $prod = Serinumbers::find($SN);
                if ($prod) {
                    $prod->delete();
                }
            }

            $product_id_array = [];
            foreach ($arrProduct as $product) {
                $pro_id = $product->id;
                array_push($product_id_array, $pro_id);
            }

            // Kiểm tra xóa hết sản phẩm trong đơn nháp
            $deletePro = array_diff($product_id_array, $arr_new_product);
            if ($product_id === null) {
                $id_del = $deletePro;
            } else {
                $id_del = $product_id;
            }
            // Tìm phần tử không tồn tại trong danh sách order_id và xóa
            if ($deletePro === $id_del) {
                $remaining = $deletePro;
            } else {
                $remaining = array_diff($deletePro, $id_del);
            }
            // Duyệt qua tất cả sản phẩm không tồn tại trong danh sách và xóa
            foreach ($remaining as $valu) {
                $prod = ProductOrders::where('id', $valu)->get();
                foreach ($prod as $item) {
                    Serinumbers::where('product_orderid', $item->id)->delete();
                    $item->delete();
                }
            }
            return redirect()->route('insertProduct.index')->with('msg', 'Lưu đơn hàng thành công');
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt không thể chỉnh sưa');
        }
    }

    // Hủy đơn trong edit
    public function deleteBill(Request $request)
    {
        $check = false;
        $checkOrder = Orders::findOrFail($request->order_id);
        if ($checkOrder->order_status == 0) {
            $checkOrder->order_status = 2;
            $checkOrder->save();
            return redirect()->route('insertProduct.index')->with('msg', 'Hủy đơn hàng thành công');
        } else {
            $id_product = ProductOrders::where('order_id', $checkOrder->id)->get();
            foreach ($id_product as $va) {
                // Kiểm tra sản phẩm đã tạo đơn chưa

                $check_PExport = productExports::where('product_id', $va->product_id)->first();

                if ($check_PExport) {
                    // Kiểm tra sản phẩm đã bán ra chưa
                    $check_Exp = Exports::where('id', $check_PExport->export_id)->first();
                    // Sản phẩm đang báo giá
                    if ($check_Exp && $check_Exp->export_status == 1) {
                        $check = true;
                        return redirect()->route('insertProduct.index')->with('warning', 'Sản phẩm đã tồn tại trong đơn xuất hàng không thể hủy đơn');
                    }
                    // Sản phẩm đã bán ra
                    if ($check_Exp && $check_Exp->export_status == 2) {
                        $check = true;
                        return redirect()->route('insertProduct.index')->with('warning', 'Sản phẩm đã bán không thể hủy đơn');
                    }
                }
            }

            // Hủy đơn
            if ($check === false) {
                $debt = DebtImport::where('import_id', $checkOrder->id)
                    ->first();
                if ($debt) {
                    $checkOrder->order_status = 2;
                    $checkOrder->save();
                    $debt->delete();
                    Product::whereIn('id', $request->product_id)->delete();
                    return redirect()->route('insertProduct.index')->with('msg', 'Hủy đơn hàng thành công');
                }
            }
        }
    }

    // Xóa đơn hàng AJAX
    public function deleteOrder(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Orders::whereIn('id', $list)
                ->where('order_status', '=', 2)
                ->get();
            foreach ($listOrder as $or) {
                Serinumbers::where('order_id', $or->id)->delete();
                $or->delete();
            }
            // $listOrder->each->delete();
            session()->flash('msg', 'Xóa đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Xóa đơn hàng thành công', 'ids' => $list]);
        }
        return response()->json(['success' => false, 'msg' => 'Không tìm thấy đơn hàng cần xóa']);
    }

    // Hủy nhiểu đơn hàng
    public function cancelBill(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrders = Orders::whereIn('id', $list)->get();
            $lisst = [];
            $list = [];
            foreach ($listOrders as $listOrder) {
                array_push($list, $listOrder->id);
                if ($listOrder->order_status == 0) {
                    $listOrder->order_status = 2;
                    $listOrder->save();
                } else if ($listOrder->order_status == 1) {
                    $id_product = ProductOrders::where('order_id', $listOrder->id)->get();
                    foreach ($id_product as $va) {
                        $check_PExport = productExports::where('product_id', $va->product_id)->first();
                        if ($check_PExport) {
                            $check_Exp = Exports::where('id', $check_PExport->export_id)->first();
                            if ($check_Exp && $check_Exp->export_status != 0) {
                                array_push($lisst, $listOrder->id);
                            }
                        }
                    }
                }
            }

            $l = array_diff($list, $lisst);

            // Lấy danh sách các `id` của bản ghi có `debt_status` khác 1
            $id_delete = DebtImport::whereIn('import_id', $l)
                ->pluck('id')
                ->all();

            // Lấy danh sách order
            $id_order = DebtImport::whereIn('import_id', $l)
                ->pluck('import_id')
                ->all();

            // Lấy thông tin của các bản ghi cần xóa và lưu thông tin của các bản ghi này vào mảng $del
            $del = DebtImport::whereIn('debt_import.id', $id_delete)
                ->join('productorders', 'productorders.order_id', 'debt_import.import_id')
                ->join('product', 'product.id', 'productorders.product_id')
                ->pluck('product.id')
                ->all();

            // Xóa các bản ghi có `id` nằm trong mảng $id_delete
            DebtImport::whereIn('id', $id_delete)->delete();

            // Xóa các bản ghi có `id` nằm trong mảng $del
            Product::whereIn('id', $del)->delete();

            // Cập nhật trạng thái đơn hàng
            Orders::whereIn('id', $id_order)->update(
                ['order_status' => 2]
            );

            //Xóa Serialnumber 
            // Serinumbers::whereIn('order_id', $l)->delete();

            if (count($lisst) > 0) {
                session()->flash('warning', 'Đơn hàng ' . str_replace(['[', ']'], '', json_encode($lisst)) . ' đã tồn tại trong xuất hàng không thể hủy !');
            } else {
                session()->flash('msg', 'Hủy đơn hàng thành công !');
            }
            return response()->json(['success' => true, 'msg' => 'Hủy đơn hàng thành công', 'data' => $lisst]);
        }
        return response()->json(['success' => false, 'msg' => 'Not found']);
    }

    // Hiển thị sản phẩm
    public function showProduct(Request $request)
    {
        if (isset($request->id)) {
            $pro = Product::where('products_id', $request->id)->get();
            return $pro;
        }
    }

    // Thêm mới nhà cung cấp
    public function add_newProvide(Request $request)
    {
        $data = $request->all();
        $checkProvides = Provides::where('provide_code', $data['provide_code'])->first();
        if ($checkProvides === NULL) {
            $data = [
                'provide_name' => $data['provide_name'],
                'provide_represent' => $data['provide_represent'],
                'provide_phone' => $data['provide_phone'],
                'provide_email' => $data['provide_email'],
                'provide_status' => 1,
                'provide_address' => $data['provide_address'],
                'provide_code' => $data['provide_code'],
                'debt' => $data['provide_debt']
            ];
            $add_newProvide = $this->provides->addProvides($data);
            session()->flash('msg', 'Thêm mới nhà cung cấp thành công!');
            return response()->json(['success' => true, 'msg' => 'Thêm mới nhà cung cấp thành công !', 'data' => $add_newProvide]);
        } else {
            session()->flash('msg', 'Mã số thuế đã tồn tại!');
            return response()->json(['success' => false, 'msg' => 'Mã số thuế đã tồn tại !']);
        }
    }

    // Kiểm tra serial number đã tồn tại chưa
    public function checkSN(Request $request)
    {
        $data = $request->all();
        $result = $this->Serinumbers->checkSNS($data);
        return $result;
    }

    // Hiển thị UI chỉnh sửa đơn hàng đã duyệt
    public function updateBill(Request $request)
    {
        $order = Orders::findOrFail($request->order_id);
        if ($order->order_status == 1) {
            $provide_order = Provides::where('id', $order->provide_id)->get();
            $provide = Provides::all();
            $product_order = ProductOrders::with('getCodeProduct')->where('order_id', $order->id)->get();
            $productIds = array();
            foreach ($product_order as $value) {
                array_push($productIds, $value->id);
            }
            $debt_import = DebtImport::where('import_id', $order->id)->get();
            $title = 'Chỉnh sửa đơn nhập hàng';
            $serialnumber =  DB::table('serinumbers')
                ->join('productorders', 'serinumbers.product_orderid', '=', 'productorders.id')
                ->whereIn('productorders.id', $productIds)
                ->select('serinumbers.*')
                // ->select('serinumbers.*', 'productorders.id')
                ->get();
            return view('tables.order.updateBill', compact('serialnumber', 'debt_import', 'provide', 'order', 'product_order', 'provide_order', 'title'));
        } else {
            return redirect()->route('insertProduct.index')->with('warning', "Thao tác không được phép");
        }
    }

    // Chỉnh sửa đơn hàng đã duyệt
    public function updateBillEdit(Request $request)
    {
        if ($this->orders->checkExist($request->order_id) == 0) {
            $checkStatus = DebtImport::findOrFail($request->debtimport_id)->debt_status;
            if ($checkStatus == 1) {
                return redirect()->route('insertProduct.index')->with('warning', 'Công nợ đã thanh toán không thể chỉnh sửa');
            } else {
                $list_id = $request->product_id;
                $total_import =  str_replace(',', '', $request->total_import);
                $product_price =  str_replace(',', '', $request->product_price);
                $product_total = str_replace(',', '', $request->product_total);
                $total_price = str_replace(',', '', $request->total_price);

                $dataProvide = [
                    'provide_name' => $request->provide_id == null ? $request->provide_name_new : ($request->options == 2 ? $request->provide_name_new : $request->provide_name),
                    'provide_represent' => $request->provide_id == null ? $request->provide_represent_new : ($request->options == 2 ? $request->provide_represent_new : $request->provide_represent),
                    'provide_phone' => $request->provide_id == null ? $request->provide_phone_new : ($request->options == 2 ? $request->provide_phone_new : $request->provide_phone),
                    'provide_email' => $request->provide_id == null ? $request->provide_email_new : ($request->options == 2 ? $request->provide_email_new : $request->provide_email),
                    'provide_status' => 1,
                    'provide_address' => $request->provide_id == null ? $request->provide_address_new : ($request->options == 2 ? $request->provide_address_new : $request->provide_address),
                    'provide_code' => $request->provide_id == null ? $request->provide_code_new : ($request->options == 2 ? $request->provide_code_new : $request->provide_code),
                    'debt' => $request->provide_debt == null ? 0 : $request->provide_debt
                ];

                // Kiểm tra thông tin nhà cung cấp
                if ($request->provide_id == null) {
                    $add_newProvide = $this->provides->checkProvidesCode($request->provide_code_new, $dataProvide);
                } else {
                    $this->provides->updateProvides($dataProvide, $request->provide_id);
                }

                // Chỉnh sửa thông tin bảng order
                $dataOrder = [
                    'product_code' => $request->product_code,
                    'created_at' => $request->product_create === null ? Carbon::now() : $request->product_create,
                    'provide_id' => $request->provide_id == null ? $add_newProvide : $request->provide_id,
                    'total' => $total_import,
                    'total_tax' => $total_import
                ];
                $this->orders->updateOrder($dataOrder, $request->order_id);

                $getdate = Orders::find($request->order_id)->created_at;

                // Chỉnh sửa thông tin sản phẩm 
                for ($i = 0; $i < count($list_id); $i++) {
                    // update SN
                    $id_SN = $request->{'productSN' . $i};
                    $product_SN = $request->{'product_SN' . $i};
                    if ($product_SN != null && $id_SN != null) {
                        for ($y = 0; $y < count($product_SN); $y++) {
                            if ($product_SN[$y]) {
                                $dataSN = [
                                    'serinumber' => $product_SN[$y],
                                ];
                                if (isset($id_SN[$y])) {
                                    $this->Serinumbers->updateSN($dataSN, $id_SN[$y]);
                                }
                            }
                        }
                    }

                    $data = [
                        'product_name' => $request->product_name[$i],
                        'product_unit' => $request->product_unit[$i],
                        'product_trademark' => $request->product_trademark[$i],
                        'product_price' => $product_price[$i],
                        'product_total' => $product_total[$i],
                        'product_tax' => $request->product_tax[$i],
                        'provide_id' => $request->provide_id == null ? $add_newProvide : $request->provide_id
                    ];
                    $this->productOrder->updateProductOrderEdit($data, $list_id[$i]);

                    $f = ProductOrders::where('product_id', $list_id[$i])->first();
                    $getProductQty = productExports::selectRaw('sum(product_qty) as total_qty')
                        ->where('product_exports.product_id', $list_id[$i])
                        ->join('exports', 'product_exports.export_id', 'exports.id')
                        ->where('exports.export_status', 2)->first();

                    if ($getProductQty !== null) {
                        $data['product_total'] = ($request->product_qty[$i] - $getProductQty->total_qty) * $product_price[$i];
                    }
                    $data['product_code'] = $request->product_code;
                    $data['created_at'] = $request->product_create === null ? Carbon::now() : $request->product_create;
                    $this->product->updateProduct($data, $f->product_id);
                    //Cập nhật công nợ xuất
                    $productIds = $request->product_id;
                    $exports = Exports::leftJoin('product_exports', 'product_exports.export_id', 'exports.id')
                        ->leftJoin('product', 'product_exports.product_id', 'product.id')
                        ->select('exports.*')
                        ->where('exports.export_status', 2)
                        ->whereIn('product.id', $productIds)
                        ->get();
                    $productHistory = Product::whereIn('id', $productIds)->get();

                    if ($productHistory !== null) {
                        foreach ($productHistory as $productHis) {
                            // Cập nhật xuất hàng
                            $productExports = productExports::where('product_id', $productHis->id)->get();

                            foreach ($productExports as $productExport) {
                                $productExport->product_name = $productHis->product_name;
                                $productExport->product_unit = $productHis->product_unit;
                                $productExport->product_tax = $productHis->product_tax;
                                $productExport->save();

                                // Cập nhật lịch sử
                                $history = History::where('product_id', $productHis->id)->first();

                                if ($history !== null) { // Kiểm tra nếu $history không phải là null
                                    $total_export = ($productExport->product_qty * $productExport->product_price) + ($productExport->product_qty * $productExport->product_price * $productHis->product_tax) / 100;

                                    $history->export_total = $total_export;
                                    $history->export_unit = $productHis->product_unit;
                                    $history->save();
                                }
                            }
                        }
                    }

                    if ($exports !== null) {
                        foreach ($exports as $export) {
                            // Tính toán giá trị total_sales và total_import
                            $totalSales = 0;
                            $totalImport = 0;

                            foreach ($export->productExports as $productExport) {
                                $totalSales += $productExport->product_price * $productExport->product_qty;

                                // Lấy thông tin product từ product_id
                                $product = Product::find($productExport->product_id);
                                $totalImport += $product->product_price * $productExport->product_qty;
                            }

                            // Tính toán giá trị total_difference
                            $totalDifference = $totalSales - $totalImport - $export->transport_fee;

                            // Cập nhật bảng Debt
                            $debt = Debt::where('export_id', $export->id)->first();
                            $debt->total_import = $totalImport;
                            $debt->total_difference = $totalDifference;
                            $debt->save();
                        }
                    }
                }

                $startDate = Carbon::parse($request->product_create === null ? Carbon::now() : $request->product_create);
                $daysToAdd = $request->provide_debt;

                $endDate = $startDate->copy()->addDays($daysToAdd); // Thêm số ngày vào ngày bắt đầu để tính ngày kết thúc

                // Định dạng ngày kết thúc theo ý muốn
                $endDateFormatted = $endDate->format('Y-m-d');

                $endDate = Carbon::parse($endDate); // Chuyển đổi ngày kết thúc thành đối tượng Carbon

                $currentDate = Carbon::now(); // Lấy ngày hiện tại thành đối tượng Carbon

                $daysDiffss = $currentDate->diffInDays($endDate);

                if ($endDate < $currentDate) {
                    $daysDiff = -$daysDiffss;
                } else {
                    $daysDiff = $daysDiffss;
                }

                if ($request->provide_debt == 0) {
                    $debt_status = 4;
                } elseif ($daysDiff <= 3 && $daysDiff > 0) {
                    $debt_status = 2;
                } elseif ($daysDiff == 0) {
                    $debt_status = 5;
                } elseif ($daysDiff < 0) {
                    $debt_status = 0;
                } else {
                    $debt_status = 3;
                }

                // Chỉnh sửa công nợ
                $dataImport = [
                    'provide_id' => $request->provide_id == null ? $add_newProvide : $request->provide_id,
                    'total_import' => $total_import,
                    'debt' => $request->provide_debt == null ? 0 : $request->provide_debt,
                    'date_start' => $request->product_create === null ? Carbon::now() : $request->product_create,
                    'date_end' => $endDateFormatted,
                    'debt_status' => $debt_status,
                    'created_at' => $getdate
                ];
                $this->debtImport->updateDebtImport($dataImport, $request->order_id);

                foreach ($list_id as $value) {
                    $upPro = History::where('product_id', $value)->get();
                    foreach ($upPro as $va) {
                        if ($value == $va->product_id) {
                            $Pro = ProductOrders::where('product_id', $value)->first();
                            $va->product_name = $Pro->product_name;
                            $va->product_unit = $Pro->product_unit;
                            $va->price_import = $Pro->product_price;
                            $va->product_total = $Pro->product_total;
                            $va->import_code = $request->product_code;
                            $va->provide_id = $request->provide_id == null ? $add_newProvide : $request->provide_id;
                            $va->import_status = $debt_status;
                            $va->debt_import = $request->provide_debt == null ? 0 : $request->provide_debt;
                            $va->debt_import_end = $endDateFormatted;
                            $va->debt_import_start = $request->product_create === null ? Carbon::now() : $request->product_create;
                            $va->total_difference = ($va->price_export * $va->export_qty) - ($va->export_qty * $Pro->product_price) - $va->tranport_fee;
                            $va->save();
                        }
                    }
                }
                return redirect()->route('insertProduct.index')->with('msg', 'Chỉnh sửa đơn hàng thành công');
            }
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã hủy không thể chỉnh sửa');
        }
    }


    // Exprort Order
    public function export_order()
    {
        $data = Orders::select('id', 'product_code', 'provide_id', 'created_at', 'users_id', 'total_tax', 'order_status')
            ->with('getNameProvide')
            ->with('getNameUsers')
            ->get();
        foreach ($data as $da) {
            if ($da->getNameProvide && $da->getNameUsers) {
                $da->product_code = $da->product_code;
                $da->provide_id = $da->getNameProvide->provide_name;
                $da->created_at = $da->created_at->format('d-m-Y');
                $da->users_id = $da->getNameUsers->name;
                $da->total_tax = number_format($da->total_tax);
                if ($da->order_status == 0) {
                    $da->order_status = "Chờ duyệt";
                } elseif ($da->order_status == 1) {
                    $da->order_status = "Đã nhập hàng";
                } else {
                    $da->order_status = "Đã hủy";
                }
            }
            // Loại bỏ các cột không cần thiết
            unset($da->getNameProvide);
            unset($da->getNameUsers);
        }
        return response()->json(['success' => true, 'msg' => 'Xuất file thành công', 'data' => $data]);
    }

    // Xóa đơn đã hủy
    public function delBillCancel(Request $request)
    {
        $check = $this->orders->delBillCamcel($request->idBill);
        if ($check == 0) {
            session()->flash('msg', 'Xóa đơn hàng thành công!');
            return response()->json(['success' => true, 'redirect_url' => route('insertProduct.index'), 'msg' => 'Xóa đơn hàng thành công']);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // Duyệt nhiều đơn hàng
    public function accessBills(Request $request)
    {
        $da = $this->orders->accessBill($request->list_id);
        if ($da == 0) {
            session()->flash('msg', 'Duyệt đơn hàng thành công !');
            return response()->json(['success' => true, 'redirect_url' => route('insertProduct.index'), 'msg' => 'Duyệt đơn hàng thành công']);
        } else {
            session()->flash('warning', 'Thao tác không thành công !');
            return response()->json(['success' => true, 'redirect_url' => route('insertProduct.index'), 'warning' => 'Thao tác không thành công !']);
        }
    }
}
