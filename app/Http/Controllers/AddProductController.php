<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductOrders;
use App\Models\Products;
use App\Models\Provides;
use App\Models\Serinumbers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Orders::orderByDesc('id')->get();
        $productIds = array();
        foreach ($order as $value) {
            array_push($productIds, $value->id);
        }
        $product =  DB::table('productorders')
            ->join('orders', 'productorders.order_id', '=', 'orders.id')
            ->whereIn('orders.id', $productIds)->get();
        return view('tables.order.insertProduct', compact('order', 'product'));
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
        $lastId = DB::table('productorders')->latest('id')->value('id');
        $last = ProductOrders::latest()->value('id');
        return view('tables.order.insert', compact('provide', 'products', 'lastId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Orders();
        $order->provide_id = $request['provide_id'];
        $order->users_id = 1;
        $order->order_status = 0;
        $order->save();
        $product_id = $request->product_id;
        $products_id = $request->products_id;
        $product_name = $request->product_name;
        $product_category = $request->product_category;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;
        $product_tax = $request->product_tax;
        $product_total = $request->product_total;
        for ($i = 0; $i < count($products_id); $i++) {
            $pro = new ProductOrders();
            $pro->product_id = $product_id[$i];
            $pro->products_id = $products_id[$i];
            $pro->product_name = $product_name[$i];
            $pro->product_category = $product_category[$i];
            $pro->product_unit = $product_unit[$i];
            $pro->product_trademark = $product_trademark[$i];
            $pro->product_qty = $product_qty[$i];
            $pro->product_price = $product_price[$i];
            $pro->order_id =  $order->id;
            $pro->product_tax =  $product_tax[$i];
            $pro->product_total = $product_total[$i];
            $pro->save();
            $product_SN = $request->{'product_SN' . $i};
            if (count($product_SN) > 1) {
                foreach ($product_SN as $seri_number) {
                    $Seri = new Serinumbers();
                    $Seri->product_id = $pro->id;
                    $Seri->serinumber = $seri_number;
                    $Seri->seri_status = 0;
                    $Seri->save();
                }
            } else {
                $Seri = new Serinumbers();
                $Seri->product_id = $pro->id;
                $Seri->serinumber = $request->{'product_SN' . $i}[0];
                $Seri->seri_status = 0;
                $Seri->save();
            }
        }
        return redirect()->route('insertProduct.index')->with('section', 'Đơn hàng đã được duyệt');
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
        $product_order = DB::table('productorders')->where('order_id', $order->id)->get(); 
        $productIds = array();
        foreach ($product_order as $value) {
            array_push($productIds, $value->id);
        }
        $seri =  DB::table('serinumbers')
        ->join('productorders', 'serinumbers.product_id', '=', 'productorders.id')
        ->whereIn('productorders.id', $productIds)->get();
        //  $product_order = ProductOrders::with('serinumbes')->where('product_id',$order->id)->get();
        // foreach ($product_order as $va){
        //     foreach ($va->serinumbes as $seri) {
        //         var_dump($seri);
        //     } die();
        // }
        return view('tables.order.edit', compact('provide', 'order', 'product_order', 'provide_order', 'lastId', 'products','seri'));
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
        if ($updateOrder->order_status == 0) {
            $product_id = $request->product_id;
            $products_id = $request->products_id;
            $product_name = $request->product_name;
            $product_category = $request->product_category;
            $product_unit = $request->product_unit;
            $product_trademark = $request->product_trademark;
            $product_qty = $request->product_qty;
            $product_price = $request->product_price;
            $product_tax = $request->product_tax;
            $product_total = $request->product_total;
            for ($i = 0; $i < count($product_name); $i++) {
                $check = Product::where('product_name', $product_name[$i])->where('product_category', $product_category[$i])->first();
                $serinumbers = Serinumbers::where('product_id', $product_id[$i])->get();
                $products = Products::where('id', $products_id[$i])->first();
                if ($check == NULL) {
                    $pro = new Product();
                    $pro->products_id = $products_id[$i];
                    $pro->product_name = $product_name[$i];
                    $pro->product_category = $product_category[$i];
                    $pro->product_unit = $product_unit[$i];
                    $pro->product_trademark = $product_trademark[$i];
                    $pro->product_qty = $product_qty[$i];
                    $pro->product_price = $product_price[$i];
                    $pro->tax = $product_tax[$i];
                    $pro->total = $product_total[$i];
                    $pro->save();
                    foreach ($serinumbers as $serinumber) {
                        $serinumber->product_id = $pro->id;
                        $serinumber->seri_status = 1;
                        $serinumber->save();
                    }
                    $products->inventory += $product_qty[$i];
                    $products->price_inventory += $product_total[$i];
                    $products->price_avg = ($products->price_inventory / $products->inventory); 
                    $products->update();
                } else {
                    $updateProduct = Product::findOrFail($check->id);
                    $updateProduct->product_qty += $product_qty[$i];
                    $updateProduct->save();
                    $serinumbers = Serinumbers::where('product_id', $product_id[$i])->get();
                    foreach ($serinumbers as $serinumber) {
                        $serinumber->product_id = $updateProduct->id;
                        $serinumber->seri_status = 1;
                        $serinumber->save();
                    }
                    $products->inventory += $product_qty[$i];
                    $products->price_inventory += $product_total[$i];
                    $products->price_avg = ($products->price_inventory / $products->inventory); 
                    $products->update();
                }
            }
            $updateOrder->order_status = 1;
            $updateOrder->save();
            return redirect()->route('insertProduct.index')->with('section', 'Đơn hàng đã được duyệt');
        } else {
            return redirect()->route('insertProduct.index')->with('section', 'Đơn hàng đã được duyệt');
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
        // Thêm sản phẩm vào bảng Orders
        $order = new Orders();
        $order->provide_id = $request['provide_id'];
        $order->users_id = 1;
        $order->order_status = 0;
        $order->save();
        // Lấy thông tin input 
        $product_id = $request->product_id;
        $products_id = $request->products_id;
        $product_name = $request->product_name;
        $product_category = $request->product_category;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;
        $product_tax = $request->product_tax;
        $product_total = $request->product_total;
        // duyệt qua mảng product
        for ($i = 0; $i < count($products_id); $i++) {
            // Thêm sản phẩm vào bảng ProductOrders
            $pro = new ProductOrders();
            $pro->product_id = $product_id[$i];
            $pro->products_id = $products_id[$i];
            $pro->product_name = $product_name[$i];
            $pro->product_category = $product_category[$i];
            $pro->product_unit = $product_unit[$i];
            $pro->product_trademark = $product_trademark[$i];
            $pro->product_qty = $product_qty[$i];
            $pro->product_price = $product_price[$i];
            $pro->order_id =  $order->id;
            $pro->product_tax = $product_tax[$i];
            $pro->product_total = $product_total[$i];
            $pro->save();
            // Tìm SN theo id sản phẩm
            $product_SN = $request->{'product_SN' . $i};
            // Kiểm tra só lượng SN
            if (count($product_SN) > 1) {
                foreach ($product_SN as $seri_number) {
                    $Seri = new Serinumbers();
                    $Seri->product_id = $pro->id;
                    $Seri->serinumber = $seri_number;
                    $Seri->seri_status = 0;
                    $Seri->save();
                }
            } else {
                $Seri = new Serinumbers();
                $Seri->product_id = $pro->id;
                $Seri->serinumber = $request->{'product_SN' . $i}[0];
                $Seri->seri_status = 0;
                $Seri->save();
            }
        }

        // update product
        $updateOrder = Orders::find($order->id);
        if ($updateOrder->order_status == 0) {
            $product_id = $request->product_id;
            $products_id = $request->products_id;
            $product_name = $request->product_name;
            $product_category = $request->product_category;
            $product_unit = $request->product_unit;
            $product_trademark = $request->product_trademark;
            $product_qty = $request->product_qty;
            $product_price = $request->product_price;
            $product_tax = $request->product_tax;
            $product_total = $request->product_total;
            for ($i = 0; $i < count($product_name); $i++) {
                $check = Product::where('product_name', $product_name[$i])->where('product_category', $product_category[$i])->first();
                $serinumbers = Serinumbers::where('product_id', $product_id[$i])->get();
                if ($check == NULL) {
                    $pro = new Product();
                    $pro->products_id = $products_id[$i];
                    $pro->product_name = $product_name[$i];
                    $pro->product_category = $product_category[$i];
                    $pro->product_unit = $product_unit[$i];
                    $pro->product_trademark = $product_trademark[$i];
                    $pro->product_qty = $product_qty[$i];
                    $pro->product_price = $product_price[$i];
                    $pro->product_tax = $product_tax[$i];
                    $pro->product_total = $product_total[$i];
                    $pro->save();
                    foreach ($serinumbers as $serinumber) {
                        $serinumber->product_id = $pro->id;
                        $serinumber->seri_status = 1;
                        $serinumber->save();
                    }
                } else {
                    $updateProduct = Product::findOrFail($check->id);
                    $updateProduct->product_qty += $product_qty[$i];
                    $updateProduct->save();
                    $serinumbers = Serinumbers::where('product_id', $product_id[$i])->get();
                    foreach ($serinumbers as $serinumber) {
                        $serinumber->product_id = $updateProduct->id;
                        $serinumber->seri_status = 1;
                        $serinumber->save();
                    }
                }
            }
            // update lại bảng 
            $updateOrder->order_status = 1;
            $updateOrder->save();
        } else {
            return redirect()->route('insertProduct.index')->with('section', 'Đơn hàng đã được duyệt');
        }
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
        $update_provide->save();
    }

    // Kiểm tra thêm đơn hàng
    public function addBillEdit(Request $request)
    {
        $order = Orders::findOrFail($request->order_id);
        $order->provide_id = $request->provide_id;
        $order->save();
        $product_id = $request->product_id;
        $products_id = $request->products_id;
        $product_name = $request->product_name;
        $product_category = $request->product_category;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;
        $product_tax = $request->product_tax;
        $product_total = $request->product_total;
        for ($i = 0; $i < count($product_id); $i++) {
            $check = ProductOrders::where('id', $product_id[$i])->first();
            if ($check == null) {
                $pro = new ProductOrders();
                $pro->product_id = $product_id[$i];
                $pro->products_id = $products_id[$i];
                $pro->product_name = $product_name[$i];
                $pro->product_category = $product_category[$i];
                $pro->product_unit = $product_unit[$i];
                $pro->product_trademark = $product_trademark[$i];
                $pro->product_qty = $product_qty[$i];
                $pro->product_price = $product_price[$i];
                $pro->order_id =  $request->order_id;
                $pro->product_tax = $product_tax[$i];
                $pro->product_total = $product_total[$i];
                $pro->save();
                $product_SN = $request->{'product_SN' . $i};
                if (count($product_SN) > 1) {
                    foreach ($product_SN as $seri_number) {
                        $Seri = new Serinumbers();
                        $Seri->product_id = $pro->id;
                        $Seri->serinumber = $seri_number;
                        $Seri->seri_status = 0;
                        $Seri->save();
                    }
                } else {
                    $Seri = new Serinumbers();
                    $Seri->product_id = $pro->id;
                    $Seri->serinumber = $request->{'product_SN' . $i}[0];
                    $Seri->seri_status = 0;
                    $Seri->save();
                }
            }else{
                $check->products_id = $products_id[$i];
                $check->product_name = $product_name[$i];
                $check->product_category = $product_category[$i];
                $check->product_unit = $product_unit[$i];
                $check->product_trademark = $product_trademark[$i];
                $check->product_qty = $product_qty[$i];
                $check->product_price = $product_price[$i];
                $check->product_tax = $product_tax[$i];
                $check->product_total = $product_total[$i];
                $check->save();
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
        // Tìm phần tử không tồn tại trong danh sách order_id
        // Lấy ra phần tử và update order_id là 0
        $remaining = array_diff($product_id_array, $product_id);
        foreach ($remaining as $valu) {
            $prod = ProductOrders::where('product_id', $valu)->get();
            foreach ($prod as $item) {
                $item->order_id = 0;
                $item->save();
            }
        }
        return redirect()->route('insertProduct.index')->with('section', 'Lưu đơn hàng thành công');
    }
}