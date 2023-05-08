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
        $order = Orders::all();
        return view('tables.order.insertProduct', compact('order'));
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
        return view('tables.order.insert', compact('provide', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $da = $request->all();
        $order = new Orders();
        $order->provide_id = $request['provide_id'];
        $order->users_id = 1;
        $order->order_status = 0;
        $order->save();
        $products_id = $request->product_id;
        $product_name = $request->product_name;
        $product_category = $request->product_category;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;

        for ($i = 0; $i < count($products_id); $i++) {
            $pro = new ProductOrders();
            $pro->products_id = $products_id[$i];
            $pro->product_name = $product_name[$i];
            $pro->product_category = $product_category[$i];
            $pro->product_unit = $product_unit[$i];
            $pro->product_trademark = $product_trademark[$i];
            $pro->product_qty = $product_qty[$i];
            $pro->product_price = $product_price[$i];
            $pro->order_id =  $order->id;
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
        $product_order = DB::table('productorders')->where('order_id', $order->id)->get();
        $provide_order = Provides::where('id', $order->provide_id)->get();
        return view('tables.order.edit', compact('order', 'product_order', 'provide_order'));
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
        $data = $request->all();
        $updateOrder = Orders::find($id);
        $updateOrder->order_status = 1;
        $updateOrder->save();
        $products_id = $request->product_id;
        $product_name = $request->product_name;
        $product_category = $request->product_category;
        $product_unit = $request->product_unit;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;
        for ($i = 0; $i < count($product_name); $i++) {
            $check = Product::where('product_name', $product_name[$i])->where('product_category', $product_category[$i])->first();
            if ($check == NULL) {
                $pro = new Product();
                $pro->products_id = $products_id[$i];
                $pro->product_name = $product_name[$i];
                $pro->product_category = $product_category[$i];
                $pro->product_unit = $product_unit[$i];
                $pro->product_trademark = $product_trademark[$i];
                $pro->product_qty = $product_qty[$i];
                $pro->product_price = $product_price[$i];
                $pro->save();

                // foreach ($serinumbers as $serinumber) {
                //     $serinumber->product_id = $pro->id;
                //     $serinumber->seri_status = 1;
                //     $serinumber->save();
                // }   
            } else {
                $updateProduct = Product::findOrFail($check->id);
                $updateProduct->product_qty += $product_qty[$i];
                $updateProduct->save();
                // $serinumbers = Serinumbers::where('product_id', $products_id[$i])->get();
                // foreach ($serinumbers as $serinumber) {
                //     $serinumber->product_id = $updateProduct->id;
                //     $serinumber->seri_status = 1;
                //     $serinumber->save();
                // }
            }
            $serinumbers = Serinumbers::where('product_id', $products_id[$i])->get();
            foreach ($serinumbers as $serinumber) {
                if ($pro->wasRecentlyCreated) {
                    $serinumber->product_id = $pro->id;
                } else {
                    $serinumber->product_id = $updateProduct->id;
                }
                $serinumber->seri_status = 1;
                $serinumber->save();
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
        //
    }
    public function show_provide(Request $requesst)
    {
        $data = $requesst->all();
        $provide = Provides::findOrFail($data['provides_id']);
        return $provide;
    }
}
