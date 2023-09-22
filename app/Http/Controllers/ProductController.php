<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provides;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $products;
    public function __construct()
    {
        $this->products = new Product();
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
            $sortType = 'desc';
        }

        $sortByArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        $filters = [];
        $status = [];
        $providearr = [];
        $string = array();
        $class = '';
        //Hóa đơn vào
        if (!empty($request->hdv)) {
            $hdv = $request->hdv;
            array_push($filters, ['product_code', 'like', '%' . $hdv . '%']);
            $nameArr = explode(',.@', $hdv);
            array_push($string, ['label' => 'Hóa đơn vào:', 'values' => $nameArr, 'class' => 'hdv']);
        }

        // Tên sản phẩm
        $products_name = null;
        if (!empty($request->products_name)) {
            $products_name = $request->products_name;
            $products_namearr = explode(',.@', $products_name);
            array_push($string, ['label' => 'Tên sản phẩm:', 'values' => $products_namearr, 'class' => 'products_name']);
        }

        // // Số lượng
        if (!empty($request->comparison_operator) && !empty($request->quantity)) {
            $quantity = $request->input('quantity');
            $comparison_operator = $request->input('comparison_operator');
            $filters[] = ['product.product_qty', $comparison_operator, $quantity];
            $inventoryArray = explode(',.@', $quantity);
            array_push($string, ['label' => 'Số lượng ' . $comparison_operator, 'values' => $inventoryArray, 'class' => 'quantity']);
        }
        // // Đang giao dịch
        if (!empty($request->trade_operator) && !empty($request->trade)) {
            $trade = $request->input('trade');
            $trade_operator = $request->input('trade_operator');
            $filters[] = ['product.product_trade', $trade_operator, $trade];
            $inventoryArray = explode(',.@', $trade);
            array_push($string, ['label' => 'Đang giao dịch ' . $trade_operator, 'values' => $inventoryArray, 'class' => 'trade']);
        }

        // // Đơn giá nhập
        if (!empty($request->avg_operator) && !empty($request->avg)) {
            $avg = $request->avg;
            $operator = $request->avg_operator;
            array_push($filters, ['product.product_price', $operator, $avg]);
            $avgArray = explode(',.@', $avg);
            array_push($string, ['label' => 'Đơn giá nhập ' . $operator, 'values' => $avgArray, 'class' => 'avg']);
        }
        // Trị tồn kho
        if (!empty($request->price_inven_operator) && !empty($request->price_inven)) {
            $price_inven = $request->price_inven;
            $operator = $request->price_inven_operator;
            $filters[] = ['product.product_total', $operator, $price_inven];
            $price_invenArray = explode(',.@', $price_inven);
            array_push($string, ['label' => 'Trị tồn kho ' . $operator, 'values' => $price_invenArray, 'class' => 'price_inven']);
        }


        //Status
        if (!empty($request->status)) {
            $statusValues = ['0' => 'Hết hàng', '1' => 'Gần hết', '2' => 'Sẵn hàng'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Trạng thái:', 'values' => $statusLabels, 'class' => 'status']);
        }

        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }

        // $provide = Provides::all();
        $providearr = [];
        if (!empty($request->providearr)) {
            $providearr = $request->input('providearr', []);
            array_push($string, ['label' => 'Nhà cung cấp:', 'values' => $providearr, 'class' => 'provide']);
        }
        // Đơn vị tính
        $unitarr = [];
        if (!empty($request->unitarr)) {
            $unitarr = $request->input('unitarr', []);
            array_push($string, ['label' => 'Đơn vị tính:', 'values' => $unitarr, 'class' => 'unit']);
        }
        // Thuế
        $taxarr = [];
        if (!empty($request->taxarr)) {
            $taxarr = $request->input('taxarr', []);
            array_push($string, ['label' => 'Thuế:', 'values' => $taxarr, 'class' => 'tax']);
        }   
        $perPage = $request->input('perPageinput',25); 
        $provide = Product::leftJoin('provides', 'provides.id', '=', 'product.provide_id')->where('product.product_qty','>',0)->get();
        //lấy tất cả products
        $products = $products = $this->products->getAllProduct($filters,$perPage, $status, $products_name, $providearr, $unitarr, $taxarr, $keywords, $sortByArr);

        // Đơn vị tính
        $unit = Product::where('product.product_qty','>',0)->get();

        $title = 'Tồn kho';

        $product_order = Product::all();
        $productIds = array();
        foreach ($product_order as $value) {
            array_push($productIds, $value->id);
        }
        $serialnumber =  DB::table('serinumbers')
        ->join('product', 'serinumbers.product_id', '=', 'product.id')
        ->whereIn('product.id', $productIds)
        ->where('seri_status', 1)
        ->select('serinumbers.*')
        // ->select('serinumbers.*', 'productorders.id')
        ->get();

        
        return view('tables.products.data', compact('serialnumber','products','perPage', 'string', 'provide', 'unit', 'sortType', 'title'));
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
        //
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
        //
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
        //
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

    public function export()
    {
        $products = Product::select('id', 'product_name', 'provide_id','product_unit', 'product_qty', 'product_trade','product_price', 'product_total', 'product_tax','product_code','product_trademark' )
            ->where('product_qty', '>', 0)
            ->with('getNameProvide')
            ->get();
        foreach ($products as $product) {
            if ($product->getNameProvide) {
                $product->provide_id = $product->getNameProvide->provide_name;
                $product->product_trade = $product->product_trade == null ? 0 : $product->product_trade;
                $product->product_price = fmod($product->product_price, 2) > 0 ? number_format($product->product_price,2,'.',',') : number_format($product->product_price);
                $product->product_total = number_format($product->product_total);
                if($product->product_qty < 6){
                    $product->product_trademark = "Gần hết";
                }else{
                    $product->product_trademark = "Sẵn hàng";
                }
            }
            unset($product->getNameProvide);
        }
        return response()->json(['success' => true, 'msg' => 'Xuất file thành công', 'data' => $products]);
    }
}
