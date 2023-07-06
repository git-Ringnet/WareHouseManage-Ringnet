<?php

namespace App\Http\Controllers;

use App\Models\DebtImport;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Models\Products;
use App\Models\Provides;
use App\Models\Serinumbers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $orders;
    public function __construct()
    {
        $this->orders = new Orders();
    }
    public function index(Request $request)
    {
        $string = array();
        $filters = [];
        $status = [];
        $provide_name = [];
        //Mã đơn
        if (!empty($request->id)) {
            $id = $request->id;
            array_push($filters, ['orders.id', '=', $id]);
            $nameArr = explode(',.@', $id);
            array_push($string, ['label' => 'Mã đơn hàng:', 'values' => $nameArr, 'class' => 'id']);
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

        $productIds = array();
        $order = Orders::orderByDesc('id')->get();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
        $orders = $this->orders->getAllOrders($filters, $status, $provide_namearr, $name, $date, $keywords, $sortBy, $sortType);
        $product = ProductOrders::with('getCodeProduct')
            ->join('orders', 'productorders.order_id', '=', 'orders.id')
            ->whereIn('orders.id', $productIds)
            ->get();
        $ordersNameAndProvide = Orders::leftjoin('provides', 'orders.provide_id', '=', 'provides.id')
            ->leftjoin('users', 'orders.users_id', '=', 'users.id')->get();
        $title = 'Nhập hàng';
        return view('tables.order.insertProduct', compact('orders', 'product', 'sortType', 'string', 'ordersNameAndProvide', 'provides', 'title'));
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
        $new_provide = new Provides();
        if ($request['provide_id'] == null) {
            if (
                $request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null &&
                $request->provide_represent_new != null && $request->provide_email_new != null && $request->provide_phone_new != null
            ) {
                $new_provide->provide_name = $request->provide_name_new;
                $new_provide->provide_represent = $request->provide_represent_new;
                $new_provide->provide_phone = $request->provide_phone_new;
                $new_provide->provide_email = $request->provide_email_new;
                $new_provide->provide_address = $request->provide_address_new;
                $new_provide->provide_code = $request->provide_code_new;
                $new_provide->provide_status = 1;
                $new_provide->debt = $request->debt;
                $new_provide->save();
            }
        } else {
            $update_provide = Provides::findOrFail($request['provide_id']);
            $update_provide->provide_name = $request->provide_name;
            $update_provide->provide_represent = $request->provide_represent;
            $update_provide->provide_phone = $request->provide_phone;
            $update_provide->provide_email = $request->provide_email;
            $update_provide->provide_address = $request->provide_address;
            $update_provide->provide_code = $request->provide_code;
            $update_provide->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
            $update_provide->save();
        }
        $product_name = $request->product_name;
        $product_unit = $request->product_unit;
        $product_qty = $request->product_qty;
        $product_tax = $request->product_tax;
        $product_price = str_replace(',', '', $request->product_price);
        $product_total = str_replace(',', '', $request->product_total);
        $order = new Orders();

        for ($i = 0; $i < count($product_name); $i++) {
            $order->provide_id = $new_provide->id != null ? $new_provide->id :  $request['provide_id'];
            $order->users_id = Auth::user()->id;
            $order->order_status = 0;
            $order->product_code = $request->product_code;
            $order->created_at = $request->product_create;
            $order->total += $product_total[$i];
            $order->save();

            $newProductOrder = new ProductOrders();
            $newProductOrder->product_name = $product_name[$i];
            $newProductOrder->product_unit = $product_unit[$i];
            $newProductOrder->product_qty = $product_qty[$i];
            $newProductOrder->product_price = $product_price[$i];
            $newProductOrder->order_id =  $order->id;
            $newProductOrder->product_tax =  $product_tax[$i];
            $newProductOrder->product_total = $product_total[$i];
            $newProductOrder->provide_id = $order->provide_id;
            $newProductOrder->save();
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
        $lastId = DB::table('productorders')->latest('id')->value('id');
        $product_order = ProductOrders::with('getCodeProduct')->where('order_id', $order->id)->get();
        $productIds = array();
        foreach ($product_order as $value) {
            array_push($productIds, $value->id);
        }
        $seri =  DB::table('serinumbers')
            ->join('productorders', 'serinumbers.order_id', '=', 'productorders.id')
            ->whereIn('productorders.id', $productIds)
            ->select('serinumbers.*', 'productorders.id')
            ->get();
        $title = 'Chi tiết đơn nhập hàng';

        return view('tables.order.edit', compact('provide', 'order', 'product_order', 'provide_order', 'lastId', 'products', 'seri', 'title'));
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
        $update_provide = Provides::findOrFail($request->provide_id);
        $update_provide->provide_name = $request->provide_name;
        $update_provide->provide_represent = $request->provide_represent;
        $update_provide->provide_phone = $request->provide_phone;
        $update_provide->provide_email = $request->provide_email;
        $update_provide->provide_address = $request->provide_address;
        $update_provide->provide_code = $request->provide_code;
        $update_provide->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
        $update_provide->save();
    
        $updateOrder = Orders::find($id);
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
        // Kiểm tra tình trạng 
        if ($updateOrder->order_status == 2) {
            return redirect()->route('insertProduct.index')->with('msg', 'Đơn hàng đã hủy không thể chỉnh sửa');
        }
        $updateOrder->total = 0;
        if ($updateOrder->order_status == 0) {
            for ($i = 0; $i < count($product_name); $i++) {
                // Kiểm tra sản phẩm đã tồn tại chưa
                $check = ProductOrders::where('id', isset($product_id[$i]) ? $product_id[$i] : "")->first();
                if ($check === null) {
                    $newProductOd = new ProductOrders();
                    $newProductOd->product_name = $product_name[$i];
                    $newProductOd->product_unit = $product_unit[$i];
                    $newProductOd->product_trademark = $product_trademark[$i];
                    $newProductOd->product_qty = $product_qty[$i];
                    $newProductOd->product_price = $product_price[$i];
                    $newProductOd->order_id =  $updateOrder->id;
                    $newProductOd->product_tax = $product_tax[$i];
                    $newProductOd->product_total = $product_total[$i];
                    $newProductOd->provide_id = $updateOrder->provide_id;
                    $newProductOd->save();
                    $newProductOd->product_id = $newProductOd->id;
                    $newProductOd->save();
                    array_push($arr_new_product, $newProductOd->id);
                } else {
                    $check->product_name = $product_name[$i];
                    $check->product_unit = $product_unit[$i];
                    $check->product_trademark = $product_trademark[$i];
                    $check->product_qty = $product_qty[$i];
                    $check->product_price = $product_price[$i];
                    $check->product_tax = $product_tax[$i];
                    $check->product_total = $product_total[$i];
                    $check->order_id = $request->order_id;
                    $check->save();
                }
                $updateOrder->provide_id = $request->provide_id;
                $updateOrder->total += $product_total[$i];
                $updateOrder->product_code = $request->product_code;
                $updateOrder->created_at = $request->product_create;
                $updateOrder->save();
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
            foreach ($remaining as $valu) {
                $prod = ProductOrders::where('product_id', $valu)->get();
                foreach ($prod as $item) {
                    $item->delete();
                }
            }

            for ($i = 0; $i < count($product_name); $i++) {
                $newP = new Product();
                $newP->product_name = $product_name[$i];
                $newP->product_notes = $product_trademark[$i];
                $newP->product_unit = $product_unit[$i];
                $newP->product_qty = $product_qty[$i];
                $newP->product_price = $product_price[$i];
                $newP->tax = $product_tax[$i];
                $newP->total = $product_total[$i];
                $newP->provide_id = $updateOrder->id;
                $newP->save();
            }

            $updateOrder->order_status = 1;
            $updateOrder->save();

            $debt = new DebtImport();
            $debt->provide_id = $updateOrder->provide_id;
            $debt->user_id = Auth::user()->id;
            $debt->import_id = $updateOrder->id;
            $debt->total_import = $total_import;
            $debt->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
            $debt->debt_status = 0;
            $debt->created_at = $updateOrder->created_at;
            $debt->save();
            return redirect()->route('insertProduct.index')->with('msg', 'Đơn hàng đã được duyệt');
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt trước đó');
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
        $new_provide = new Provides();
        if ($request['provide_id'] == null) {
            if (
                $request->provide_name_new != null && $request->provide_address_new != null && $request->provide_code_new != null &&
                $request->provide_represent_new != null && $request->provide_email_new != null && $request->provide_phone_new != null
            ) {
                $new_provide->provide_name = $request->provide_name_new;
                $new_provide->provide_represent = $request->provide_represent_new;
                $new_provide->provide_phone = $request->provide_phone_new;
                $new_provide->provide_email = $request->provide_email_new;
                $new_provide->provide_address = $request->provide_address_new;
                $new_provide->provide_code = $request->provide_code_new;
                $new_provide->provide_status = 1;
                $new_provide->save();
            }
        } else {
            $update_provide = Provides::findOrFail($request['provide_id']);
            $update_provide->provide_name = $request->provide_name;
            $update_provide->provide_represent = $request->provide_represent;
            $update_provide->provide_phone = $request->provide_phone;
            $update_provide->provide_email = $request->provide_email;
            $update_provide->provide_address = $request->provide_address;
            $update_provide->provide_code = $request->provide_code;
            $update_provide->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
            $update_provide->save();
        }

        $product_name = $request->product_name;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_tax = $request->product_tax;
        $product_price = str_replace(',', '', $request->product_price);
        $product_total = str_replace(',', '', $request->product_total);
        $order = new Orders();
        for ($i = 0; $i < count($product_name); $i++) {
            $order->provide_id = $new_provide->id != null ? $new_provide->id :  $request['provide_id'];
            $order->users_id = Auth::user()->id;
            $order->order_status = 0;
            $order->product_code = $request->product_code;
            $order->created_at = $request->product_create;
            $order->total += $product_total[$i];
            $order->save();

            $newProductOrder = new ProductOrders();
            $newProductOrder->product_name = $product_name[$i];
            $newProductOrder->product_unit = $product_unit[$i];
            $newProductOrder->product_trademark = $product_trademark[$i];
            $newProductOrder->product_qty = $product_qty[$i];
            $newProductOrder->product_price = $product_price[$i];
            $newProductOrder->order_id =  $order->id;
            $newProductOrder->product_tax =  $product_tax[$i];
            $newProductOrder->product_total = $product_total[$i];
            $newProductOrder->provide_id = $order->provide_id;
            $newProductOrder->save();
        }

        // Update Product
        $updateOrder = Orders::find($order->id);
        if ($updateOrder->order_status == 0) {
            $product_name = $request->product_name;
            $product_unit = $request->product_unit;
            $product_trademark = $request->product_trademark;
            $product_qty = $request->product_qty;
            $product_tax = $request->product_tax;
            $product_price = str_replace(',', '', $request->product_price);
            $product_total = str_replace(',', '', $request->product_total);

            for ($i = 0; $i < count($product_name); $i++) {
                $pro = new Product();
                $pro->product_name = $product_name[$i];
                $pro->product_unit = $product_unit[$i];
                $pro->product_notes = $product_trademark[$i];
                $pro->product_qty = $product_qty[$i];
                $pro->product_price = $product_price[$i];
                $pro->tax = $product_tax[$i];
                $pro->total = $product_total[$i];
                $pro->provide_id = $updateOrder->provide_id;
                $pro->save();
            }
            $updateOrder->order_status = 1;
            $updateOrder->save();
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt trước đó');
        }

        return redirect()->route('insertProduct.index')->with('msg', 'Duyệt nhanh đơn hàng thành công');
    }

    // update provide AJAX
    public function update_provide(Request $request)
    {
        // Lấy thông tin input
        $data = $request->all();
        // Tìm Provide theo id đã gửi
        $update_provide = Provides::findOrFail($data['provides_id']);
        // Cập nhật thông tin 
        $update_provide->provide_name = $data['provide_name'];
        $update_provide->provide_represent = $data['provide_represent'];
        $update_provide->provide_phone = $data['provide_phone'];
        $update_provide->provide_email = $data['provide_email'];
        $update_provide->provide_address = $data['provide_address'];
        $update_provide->provide_code = $data['provide_code'];
        $update_provide->debt = $data['debt'];
        $update_provide->save();
    }

    // Thêm hàng mới vào Order
    public function addBillEdit(Request $request)
    {
        $update_provide = Provides::findOrFail($request->provide_id);
        $update_provide->provide_name = $request->provide_name;
        $update_provide->provide_represent = $request->provide_represent;
        $update_provide->provide_phone = $request->provide_phone;
        $update_provide->provide_email = $request->provide_email;
        $update_provide->provide_address = $request->provide_address;
        $update_provide->provide_code = $request->provide_code;
        $update_provide->debt = $request->provide_debt == null ? 0 : $request->provide_debt;
        $update_provide->save();


        $order = Orders::findOrFail($request->order_id);
        // Kiểm tra tình trạng 
        if ($order->order_status == 2) {
            return redirect()->route('insertProduct.index')->with('msg', 'Đơn hàng đã hủy không thể chỉnh sửa');
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
            $arr_new_product = [];
            for ($i = 0; $i < count($product_name); $i++) {
                // Kiểm tra sản phẩm đã tồn tại chưa
                $check = ProductOrders::where('id', isset($product_id[$i]) ? $product_id[$i] : "")->first();
                if ($check === null) {
                    $newProductOd = new ProductOrders();
                    $newProductOd->product_name = $product_name[$i];
                    $newProductOd->product_unit = $product_unit[$i];
                    $newProductOd->product_trademark = $product_trademark[$i];
                    $newProductOd->product_qty = $product_qty[$i];
                    $newProductOd->product_price = $product_price[$i];
                    $newProductOd->order_id =  $request->order_id;
                    $newProductOd->product_tax = $product_tax[$i];
                    $newProductOd->product_total = $product_total[$i];
                    $newProductOd->provide_id = $order->provide_id;
                    $newProductOd->save();
                    array_push($arr_new_product, $newProductOd->id);
                } else {
                    $check->product_name = $product_name[$i];
                    $check->product_unit = $product_unit[$i];
                    $check->product_trademark = $product_trademark[$i];
                    $check->product_qty = $product_qty[$i];
                    $check->product_price = $product_price[$i];
                    $check->product_tax = $product_tax[$i];
                    $check->product_total = $product_total[$i];
                    $check->order_id = $request->order_id;
                    $check->save();
                }
                $order->provide_id = $request->provide_id;
                $order->total += $product_total[$i];
                $order->product_code = $request->product_code;
                $order->created_at = $request->product_create;
                $order->save();
            }

            // Lấy ra tất cả sản phẩm theo id bảng order
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

            foreach ($remaining as $valu) {
                $prod = ProductOrders::where('id', $valu)->get();
                foreach ($prod as $item) {
                    $item->delete();
                }
            }
            return redirect()->route('insertProduct.index')->with('msg', 'Lưu đơn hàng thành công');
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Đơn hàng đã được duyệt không thể chỉnh sưa');
        }
    }

    // Hủy đơn
    public function deleteBill(Request $request)
    {
        $data = $request->all();
        $dele = Orders::findOrFail($data['order_id']);
        if ($dele->order_status != 1) {
            $dele->order_status = 2;
            $dele->save();
            $del_SN = Serinumbers::where('check', $dele->id)->get();
            if ($del_SN->count() > 1) {
                foreach ($del_SN as $d) {
                    $d->delete();
                }
            } elseif ($del_SN->count() == 1) {
                $del_SN->first()->delete();
            }
        } else {
            return redirect()->route('insertProduct.index')->with('warning', 'Sản phẩm đã được duyệt không thể hủy');
        }
        return redirect()->route('insertProduct.index')->with('msg', 'Đã hủy đơn');
    }

    // Xóa đơn hàng AJAX
    public function deleteOrder(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Orders::whereIn('id', $list)->get();
            foreach ($listOrder as $l) {
                if ($l->order_status == 0) {
                    Serinumbers::where('check', $l->id)->delete();
                }
            }
            $listOrder->each->delete();
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
            $listOrder = Orders::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                if ($value->users_id == Auth::user()->id || Auth::user()->id == 1) {
                    if ($value->order_status != 1) {
                        $value->order_status = 2;
                        $value->save();
                        $del_SN = Serinumbers::where('check', $value->id)->get();
                        if ($del_SN->count() > 1) {
                            foreach ($del_SN as $d) {
                                $d->delete();
                            }
                        } elseif ($del_SN->count() == 1) {
                            $del_SN->first()->delete();
                        }
                    }
                }
            }
            session()->flash('msg', 'Hủy đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Hủy Đơn Hàng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }

    // Duyệt nhiều đơn hàng
    public function confirmBill(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Orders::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                if ($value->order_status == 0) {
                    $product = ProductOrders::where('order_id', $value->id)->get();
                }
            }
            session()->flash('msg', 'Hủy đơn hàng thành công');
            return response()->json(['success' => true, 'msg' => 'Hủy Đơn Hàng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
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
            $add_newProvide = new Provides();
            $add_newProvide->provide_name = $data['provide_name'];
            $add_newProvide->provide_represent = $data['provide_represent'];
            $add_newProvide->provide_phone = $data['provide_phone'];
            $add_newProvide->provide_email = $data['provide_email'];
            $add_newProvide->provide_status = 1;
            $add_newProvide->provide_address = $data['provide_address'];
            $add_newProvide->provide_code = $data['provide_code'];
            $add_newProvide->debt = $data['debt'];
            $add_newProvide->save();
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
        $listSN = $request->input('listSN');
        $products_id = $request->input('products_id');
        $existingSN = [];
        $check = Serinumbers::whereIn('products_id', $products_id)
            ->whereIN('serinumber', $listSN)
            // ->where('seri_status',)
            ->first();
        if (!$check) {
            return response()->json(['success' => true, 'msg' => 'Thêm sản phẩm thành công!']);
        } else {
            $existingSN[] = $check->serinumber;
            return response()->json(['success' => false, 'msg' => 'Serial number đã tồn tại', 'existingSN' => $existingSN]);
        }
    }
}
