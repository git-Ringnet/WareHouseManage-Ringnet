<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $products;
    private $orders;
    private $exports;

    public function __construct()
    {
        $this->products = new Products();
        $this->orders = new Orders();
        $this->exports = new Exports();
    }
    public function index()
    {
        $title = "Trang chủ";
        //Tổng
        $products = $this->products->allProducts();
        $totalProducts = count($products);
        //Sẵn hàng
        $productsStock = $this->products->productsStock();
        $totalProductsStock = count($productsStock);
        //Gần hết
        $products_near_end = $this->products->productsNearEnd();
        $products_near_end = count($products_near_end);
        //Hết hàng
        $productsEnd = $this->products->productsEnd();
        $productsEnd = count($productsEnd);
        //Tổng đơn nhập
        $orders = $this->orders->allOrders();
        $orders = count($orders);
        //Tổng đơn xuất
        $exports = $this->exports->allExports();
        $exports = count($exports);
        //Tổng đơn nhập
        $sumTotalOrders = $this->orders->sumTotalOrders();
        //Tổng đơn xuất
        $sumTotalExports = $this->exports->sumTotalExports();
        //Tổng đơn tồn kho
        $sumTotalInventory = $this->products->sumTotalInventory();
        return view('index', compact('title', 'totalProducts', 'products_near_end', 'totalProductsStock', 'productsEnd', 'orders', 'exports', 'sumTotalOrders', 'sumTotalExports','sumTotalInventory'));
    }
}
