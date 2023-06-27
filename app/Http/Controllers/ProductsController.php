<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Details;
use App\Models\Product;
use App\Models\productExports;
use App\Models\Products;
use App\Models\Provides;
use App\Models\Serinumbers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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
            $sortType = 'desc';
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
            $idArray = explode(',.@', $id);
            array_push($string, ['label' => 'ID:', 'values' => $idArray, 'class' => 'id']);
        }
        $code = null;

        if (!empty($request->code)) {
            $code = $request->code;
            $codeArr = explode(',.@', $code);
            array_push($string, ['label' => 'Mã sản phẩm:', 'values' => $codeArr, 'class' => 'code']);
        }
        $products_name = null;

        if (!empty($request->products_name)) {
            $products_name = $request->products_name;
            $products_namearr = explode(',.@', $products_name);
            array_push($string, ['label' => 'Tên sản phẩm:', 'values' => $products_namearr, 'class' => 'products_name']);
        }

        // // Tồn kho
        if (!empty($request->comparison_operator) && !empty($request->quantity)) {
            $quantity = $request->input('quantity');
            $comparison_operator = $request->input('comparison_operator');
            $filters[] = ['products.inventory', $comparison_operator, $quantity];
            $inventoryArray = explode(',.@', $quantity);
            array_push($string, ['label' => 'Tồn kho ' . $comparison_operator, 'values' => $inventoryArray, 'class' => 'quantity']);
        }
        // var_dump($request->comparison_operator);
        // // Trị trung bình
        if (!empty($request->avg_operator) && !empty($request->avg)) {
            $avg = $request->avg;
            $operator = $request->avg_operator;
            array_push($filters, ['products.price_avg', $operator, $avg]);
            $avgArray = explode(',.@', $avg);
            array_push($string, ['label' => 'Trị trung bình ' . $operator, 'values' => $avgArray, 'class' => 'avg']);
        }
        // // Trị tồn kho
        if (!empty($request->price_inven_operator) && !empty($request->price_inven)) {
            $price_inven = $request->price_inven;
            $operator = $request->price_inven_operator;
            $filters[] = ['products.price_inventory', $operator, $price_inven];
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

        $categoryarr = [];
        if (!empty($request->categoryarr)) {
            $categoryarr = $request->input('categoryarr', []);
            array_push($string, ['label' => 'Danh mục:', 'values' => $categoryarr, 'class' => 'category']);
        }
        // Thương hiệu
        $trademarkarr = [];
        if (!empty($request->trademarkarr)) {
            $trademarkarr = $request->input('trademarkarr', []);
            array_push($string, ['label' => 'Thương hiệu:', 'values' => $trademarkarr, 'class' => 'trademark']);
        }
        // dd($string);
        //lấy tất cả products
        $products = $products = $this->products->getAllProducts($filters, $status, $code, $products_name, $categoryarr, $trademarkarr, $keywords, $sortByArr);

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
            ->join('serinumbers', 'serinumbers.product_id', 'product.id')
            ->whereIn('products.id', $productIds)
            ->groupBy(
                'product.id',
                'product.products_id',
                'product.product_name',
                'product.product_category',
                'product.product_trademark',
                'product.product_unit',
                'product_qty',
                'product.product_orderid',
                'product.product_price',
                'product.created_at',
                'product.updated_at',
                'product.tax',
                'product.total',
                'product.provide_id',
                'products.id',
                'products.products_code'
            )
            ->select(
                'product.*',
                'products.products_code',
                DB::raw('SUM(product.product_qty * product.product_price) as total'),
                DB::raw('SUM(CASE WHEN serinumbers.seri_status = 2 THEN 1 ELSE 0 END) as trading')
            )
            ->get();

        $title = 'Sản phẩm';
        return view('tables.products.data', compact('products', 'product', 'string', 'sortType', 'trademarks', 'title'));
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
        $title = 'Sản phẩm';
        return view('tables.products.test', compact('products', 'provide', 'title'));
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
        $title = 'Chỉnh sửa sản phẩm';
        // $listProduct = Product::with('getSerinumbers')->where('products_id', $products->id)->paginate(8);
        $listProduct = Product::with(['getNameProducts', 'getNameProvide', 'getSerinumbers'])
            ->select('product.*', DB::raw('SUM(CASE WHEN serinumbers.seri_status = 2 THEN 1 ELSE 0 END) as countSerial'))
            ->leftJoin('serinumbers', 'product.id', '=', 'serinumbers.product_id')
            ->leftJoin('products', 'product.products_id', '=', 'products.id')
            ->leftJoin('provides', 'product.provide_id', '=', 'provides.id')
            ->where('product.products_id', $products->id)
            ->groupBy(
                'product.id',
                'product.products_id',
                'product.product_name',
                'product.product_category',
                'product.product_unit',
                'product.product_trademark',
                'product.product_qty',
                'product.product_price',
                'product.tax',
                'product.total',
                'product.provide_id',
                'product.product_orderid',
                'product.created_at',
                'product.updated_at'
            )
            ->paginate(8);
        return view('tables.products.edit_products', compact('products', 'cate', 'title', 'listProduct'))->with('msg', 'Chỉnh sửa sản phẩm thành công!!');
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
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $extension = $get_image->getClientOriginalExtension();
            $new_image = $name_image . '.' . $extension;
            $get_image->move('../public/dist/img', $new_image);
            $products->products_image =  $new_image;
        } else {
            $products->products_image = "";
        }

        $products->products_code = $request->get('products_code');
        $products->products_name = $request->get('products_name');
        $products->ID_category = $request->get('product_category');
        $products->products_trademark = $request->get('products_trademark');
        // $products->products_unit = $request->get('products_unit');
        $products->products_description = $request->get('products_description');
        $products->save();
        return redirect()->route('data.index')->with('msg', 'Chỉnh sửa sản phẩm thành công!');
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
        $title = 'Thêm sản phẩm';
        return view('tables.products.insertProducts', compact('cate', 'title'))->with('msg', 'Thêm sản phẩm thành công!');
    }
    public function storeProducts(Request $request)
    {
        $checkProducts = Products::where('products_code', $request->products_code)->first();
        if ($checkProducts) {
            return redirect()->route('data.index')->with('msg', 'Mã sản phẩm đã tồn tại !');
        } else {
            $products = new Products();
            $get_image = $request->file('products_img');
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $extension = $get_image->getClientOriginalExtension();
                $new_image = $name_image . '.' . $extension;
                $get_image->move('../public/dist/img', $new_image);
                $products->products_image = $new_image;
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
            return redirect()->route('data.index')->with('msg', 'Thêm sản phẩm thành công!');
        }
    }

    // Xóa sản phẩm cha AJAX
    public function deleteProducts(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $check = Products::whereIn('id', $list)->get();
            $hasProductWithInventory = false;
            foreach ($check as $value) {
                if ($value->inventory == 0) {
                    $value->delete();
                } else {
                    $hasProductWithInventory = true;
                }
            }
            if ($hasProductWithInventory) {
                session()->flash('warning', 'Còn sản phẩm con');
                return response()->json(['success' => false, 'msg' => 'Còn sản phẩm con']);
            }
            session()->flash('msg', 'Xóa sản phẩm thành công');
            return response()->json(['success' => true, 'msg' => 'Xóa danh sách sản phẩm thành công', 'ids' => $list]);
        }
        session()->flash('warning', 'Không tìm thấy sản phẩm cần xóa');
        return response()->json(['success' => false, 'msg' => 'Không tìm thấy sản phẩm cần xóa']);
    }


    // Sửa sản phẩm con
    public function editProduct($id)
    {
        $pro = Product::findOrFail($id);
        $select = Products::all();
        $title = 'Chỉnh sửa sản phẩm';
        return view('tables.products.editproduct', compact('pro', 'select', 'title'))->with('msg', 'Chỉnh sửa sản phẩm thành công!');
    }
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_type;
        $product->product_unit = $request->product_unit;
        $product->product_trademark = $request->product_trademark;
        $product->product_price = $request->product_price;
        $product->tax = $request->product_tax;
        $product->total = ($request->product_price * $product->product_qty);
        $product->save();

        // Recalculate average price and inventory
        $updatePrice = Product::where('products_id', $product->products_id)->get();
        $relatedProduct = Products::findOrFail($product->products_id);
        $relatedProduct->price_inventory = 0;
        foreach ($updatePrice as $up) {
            $relatedProduct->price_inventory += $up->total;
            $relatedProduct->price_avg = ($relatedProduct->price_inventory / $relatedProduct->inventory);
        }
        $relatedProduct->save();

        return redirect()->route('data.index')->with('msg', 'Chỉnh sửa sản phẩm thành công!');
    }

    // Xóa sản phẩm con
    public function delete_product($id)
    {
        $del = Product::where('id', $id)->first();
        $current_id = $del->products_id;
        // $check = Serinumbers::where('product_id', $del->id)->get();
        $check = productExports::where('product_id', $del->id)->get();
        // $block = false;
        // if ($check->isEmpty()) {
        //     $block = true;
        // }
        if ($check === null) {
            Serinumbers::where('product_id', $del->id)
                ->where('seri_status', 1)
                ->delete();
            $del->delete();
            $updatePrice = Product::where('products_id', $current_id)->get();
            $relatedProduct = Products::findOrFail($current_id);
            $relatedProduct->price_inventory = 0;
            $relatedProduct->inventory = 0;
            foreach ($updatePrice as $up) {
                $relatedProduct->inventory += $up->product_qty;
                $relatedProduct->price_inventory += $up->total;
                $relatedProduct->price_avg = ($relatedProduct->price_inventory / $relatedProduct->inventory);
            }
            $relatedProduct->save();
            return redirect()->route('data.index')->with('msg', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->route('data.index')->with('warning', 'Sản phẩm còn tồn tại trong đơn xuất hàng!');
        }
    }

    //  Import data to products
    public function import_products(Request $request)
    {
        $jsonData = $request->all();
        foreach ($jsonData as $row) {
            $existingProduct = Products::where('products_code', $row['Products_code'])
                ->where('products_name', $row['Products_name'])
                ->where('ID_category', $row['ID_category'])
                ->where('products_trademark', $row['Products_trademark'])
                ->where('products_description', $row['Products_description'])
                ->first();
            if (!$existingProduct) {
                $products = new Products();
                $products->products_code = $row['Products_code'];
                $products->products_name = $row['Products_name'];
                $products->ID_category = $row['ID_category'];
                $products->products_trademark = $row['Products_trademark'];
                $products->products_description = $row['Products_description'];
                $products->save();
            }
        }
        session()->flash('msg', 'Import thành công!');
        return response()->json(['message' => 'Import thành công!']);
    }

    public function checkProducts_code(Request $request)
    {
        $data = $request->input('products_code');
        $check = Products::where('products_code', $data)->first();
        if ($check === null) {
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => true, 'msg' => "Mã sản phẩm đã tồn tại"]);
        }
    }

    public function export_products()
    {
        $filename = 'export.csv';
        $filePath = storage_path('app/' . $filename);

        // Retrieve data from the table
        $data = Products::all();

        // Open the file in write mode
        $file = fopen($filePath, 'w,encoding=UTF-8');
        // Write the headers to the CSV file
        fputcsv($file, ['ID', 'Mã sản phẩm', 'Tên sản phẩm', 'Danh mục', 'Thương hiệu', 'Tồn kho', 'Trị trung bình', 'Trị tồn kho']);

        // Write the data rows to the CSV file
        Products::chunk(500, function ($data) use ($file) {
            // Write the data rows to the CSV file
            foreach ($data as $row) {
                // Write the row data to the CSV file
                fputcsv($file, [
                    $row->id,
                    $row->products_code,
                    $row->products_name,
                    $row->ID_category,
                    $row->products_trademark,
                    $row->inventory,
                    $row->price_avg,
                    $row->price_inventory,
                ]);
        
                // Write child rows if any
                $child = $row->getProducts;
                foreach ($child as $value) {
                    fputcsv($file, [
                        $row->id . '-' . $value->id,
                        $value->product_name,
                        $value->product_category,
                        $value->product_unit,
                        $value->product_trademark,
                        $value->product_qty,
                        $value->product_price,
                    ]);
                }
            }
        });

        // Close the file
        fclose($file);

        // Return the CSV file as a download response
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }
}
