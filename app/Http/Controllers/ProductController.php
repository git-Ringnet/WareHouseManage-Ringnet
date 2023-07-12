<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provides;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

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
            $filters[] = ['product.total', $operator, $price_inven];
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

        $provide = Provides::all();
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

        //lấy tất cả products
        $products = $products = $this->products->getAllProduct($filters, $status, $products_name, $providearr, $unitarr, $taxarr, $keywords, $sortByArr);

        // Đơn vị tính
        $unit = Product::all();

        $title = 'Tồn kho';
        return view('tables.products.data', compact('products', 'string', 'provide', 'unit', 'sortType', 'title'));
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
        $products = Product::all();
        return response()->json(['success' => true, 'msg' => 'Xuất file thành công','data' => $products]);
    }


    // public function export()
    // {
    //     $products = Product::all();

    //     $filename = 'products.xls';
    //     $path = storage_path('app/' . $filename);

    //     $file = fopen($path, 'w');

    //     fputcsv($file, ['ID', 'Tên sản phẩm', 'Đơn vị tính', 'Tồn kho', 'Giá nhập', 'Thuế', 'Tổng tiền', 'Nhà cung cấp', 'Đang giao dịch']);


    //     foreach ($products as $product) {
    //         fputcsv($file, [
    //             $product->id,
    //             $product->product_name,
    //             $product->product_unit,
    //             $product->product_qty,
    //             $product->product_price,
    //             $product->tax,
    //             $product->total,
    //             $product->getNameProvide->provide_name,
    //             $product->product_trade,
    //         ]);
    //     }

    //     fclose($file);  

    //     return response()->download($path, $filename)->deleteFileAfterSend(true);
    // }
}
