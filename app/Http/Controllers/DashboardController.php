<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $products;
    private $orders;
    private $exports;

    public function __construct()
    {
        $this->products = new Product();
        $this->orders = new Orders();
        $this->exports = new Exports();
    }
    public function index()
    {
        $title = "Trang chủ";

        // Nhập hàng
        // Tất cả
        $orders = $this->orders->allNhaphang();
        $orders = count($orders);
        $getMinDateOrders = $this->orders->getMinDateOrders();




        return view('index', compact('title','orders','getMinDateOrders'));
    }
}
