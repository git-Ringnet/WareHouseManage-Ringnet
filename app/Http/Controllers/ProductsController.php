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
    private $products;
    public function __construct()
    {
        $this->products = new Products();
    }

    public function index(Request $request)
    {
        //lấy tất cả id của products đưa vào mảng

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
            $sortType = 'asc';
        }

        $sortByArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        $filters = [];
        $status = [];
        $categoryarr = [];
        $string = array();
        $class = '';

        $id = 0;
        if (!empty($request->id)) {
            $id = $request->input('id');
            $idArray = explode(' ', $id);
            array_push($string, ['label' => 'ID', 'values' => $idArray, 'class' => 'id']);
        }
        $code = null;

        if (!empty($request->code)) {
            $code = $request->code;
        }
        $products_name = null;

        if (!empty($request->products_name)) {
            $products_name = $request->products_name;
        }



        // // Trạng thái
        // if (!empty($request->status)) {
        //     $statusValues = [1 => 'Active', 0 => 'Disable'];
        //     $status = $request->input('status', []);
        //     $statusLabels = array_map(function ($value) use ($statusValues) {
        //         return $statusValues[$value];
        //     }, $status);
        //     array_push($string, ['label' => 'Trạng thái', 'values' => $statusLabels, 'class' => 'status']);
        // }

        // // Tồn kho
        // if (!empty($request->comparison_operator) && !empty($request->quantity)) {
        //     $quantity = $request->input('quantity');
        //     $comparison_operator = $request->input('comparison_operator');
        //     array_push($filters, ['products.inventory', $comparison_operator, $quantity]);
        //     $inventoryArray = explode(' ', $quantity);
        //     array_push($string, ['label' => 'Tồn kho', 'values' =>$inventoryArray, 'class' => 'quantity']);
        // }

        // // Trị trung bình
        // if (!empty($request->avg_operator) && !empty($request->avg)) {
        //     $avg = $request->avg;
        //     $operator = $request->avg_operator;
        //     array_push($filters, ['products.price_avg', $operator, $avg]);
        //     $avgArray = explode(' ', $avg);
        //     array_push($string, ['label' => 'Trị trung bình', 'values' =>$avgArray, 'class' => 'avg']);
        // }
        // // Trị tồn kho
        // if (!empty($request->price_inven_operator) && !empty($request->price_inven)) {
        //     $price_inven = $request->price_inven;
        //     $operator = $request->price_inven_operator;
        //     $filters[] = ['products.price_inventory', $operator, $price_inven];
        //     $price_invenArray = explode(' ', $price_inven);
        //     array_push($string, ['label' => 'Trị tồn kho', 'values' =>$price_invenArray, 'class' => 'price_inven']);
        // }

        // dd($filters);
        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

        $categories = Category::all();
        $categoryarr = [];
        if (!empty($request->categoryarr)) {
            $categoryarr = $request->input('categoryarr', []);
            if (!empty($categoryarr)) {
                $selectedCategory = Category::whereIn('id', $categoryarr)->get();
                $selectedCategory = $selectedCategory->pluck('category_name')->toArray();
            }
            array_push($string, ['label' => 'Danh mục', 'values' => $selectedCategory, 'class' => 'category']);
        }
        // dd($string);
        //lấy tất cả products
        $products = $products = $this->products->getAllProducts($id,$code,$products_name,$categoryarr, $keywords, $sortByArr);

        //Lấy trademarks
        $trademarks = Products::all();
        
        //lấy tất cả id của products đưa vào mảng
        $productIds = array();
        foreach ($products as $value) {
            array_push($productIds, $value->id);
        }
        //lấy tất cả sản phẩm con theo sản phẩm lớn
        $product = DB::table('product')
            ->join('products', 'product.products_id', '=', 'products.id')
            ->whereIn('products.id', $productIds)
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
                'product.tax',
                'product.total',
                'products.id',
                'products.products_code'
            )
            ->select(
                'product.*',
                'products.products_code',
                DB::raw('SUM(product.product_qty * product.product_price) as total')
            )
            ->get();
        return view('tables.products.data', compact('products', 'categories', 'product', 'string','sortType','trademarks'));
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
        return view('tables.products.test', compact('products', 'provide'));
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
        return view('tables.products.edit_products', compact('products', 'cate'));
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

        $get_image = $request->file('products_img');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $get_name_image;
            $get_image->move('../public/dist/img', $new_image);
            $products->products_image = $name_image;
        } else {
            $products->products_image = $products->products_image;
        }

        $products->products_code = $request->get('products_code');
        $products->products_name = $request->get('products_name');
        $products->ID_category = $request->get('product_category');
        $products->products_trademark = $request->get('products_trademark');
        // $products->products_unit = $request->get('products_unit');
        $products->products_description = $request->get('products_description');
        $products->save();
        return redirect()->route('data.index');
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
    public function insertProducts()
    {
        $cate = Category::all();
        return view('tables.products.insertProducts', compact('cate'));
    }
    public function storeProducts(Request $request)
    {
        $products = new Products();
        $get_image = $request->file('products_img');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $get_name_image;
            $get_image->move('../public/dist/img', $new_image);
            $products->products_image = $name_image;
        } else {
            $products->products_image = "";
        }
        $products->products_code = $request->products_code;
        $products->products_name = $request->products_name;
        $products->ID_category = $request->product_category;
        $products->products_trademark = $request->products_trademark;
        // $products->products_unit = $request->products_unit;
        $products->products_description = $request->products_description;

        $products->save();
        return redirect()->route('data.index');
    }
}
