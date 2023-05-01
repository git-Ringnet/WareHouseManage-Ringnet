<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Details;
use App\Models\Product;
use App\Models\Products;
use App\Models\Provides;
use App\Models\Serinumbers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $category = Category::all();
        return view('tables.data', compact('products', 'category'));
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
        $data = $request->all();
        var_dump($data);
        die();
        $product_name = $request->product_name;
        $product_provide = $request->product_provide;
        $product_category = $request->product_category;
        $product_trademark = $request->product_trademark;
        $product_qty = $request->product_qty;
        $product_price = $request->product_price;

        for ($i = 0; $i < count($product_name); $i++) {
            $pro = new Product();
            $pro->products_id = $request->get('product_id');
            $pro->product_name = $product_name[$i];
            $pro->product_category = $product_category[$i];
            $pro->product_trademark = $product_trademark[$i];
            $pro->product_qty = $product_qty[$i];
            $pro->product_price = $product_price[$i];
            $pro->save();
            $detail = new Details();
            $detail->product_id = $pro->id;
            $detail->provide_id = $product_provide[$i];
            $detail->save();

            $product_SN = $request->{'product_SN' . $i};
            if (count($product_SN) > 1) {
                foreach ($product_SN as $seri_number) {
                    $Seri = new Serinumbers();
                    $Seri->product_id = $pro->id;
                    $Seri->serinumber = $seri_number;
                    $Seri->save();
                }
            } else {
                $Seri = new Serinumbers();
                $Seri->product_id = $pro->id;
                $Seri->serinumber = $request->{'product_SN' . $i}[0];
                $Seri->save();
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::findOrFail($id);
        $provide = Provides::all();
        return view('tables.test', compact('products', 'provide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Products::findOrFail($id);
        $cate = Category::all();
        return view('tables.edit_products', compact('products', 'cate'));
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
        $products = Products::findOrFail($id);
        $products->products_image = $request->get('products_img');
        $products->products_code = $request->get('products_code');
        $products->products_name = $request->get('products_name');
        $products->ID_category = $request->get('product_category');
        $products->products_trademark = $request->get('products_trademark');
        $products->products_unit = $request->get('products_unit');
        $products->products_description = $request->get('products_description');
        $products->save();
        $products = Products::all();
        return view('tables.data', compact('products'));
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
    public function edit_ajax(Request $request)
    {
        $data = $request->all();
        $products = Products::findOrFail($data['product_id']);
        $products->ID_category = $data['category_id'];
        $products->save();
    }
    public function show_ajax(Request $request)
    {
        $data = $request->all();
        $product = DB::table('product')->where('products_id', $data['product_id'])->get();
        return $product;
    }
}
