<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $active = auth()->id();
        $orders = DB::table('orders')
            ->join('baskets', 'orders.basket_id', '=', 'baskets.id')
            ->join('users', 'users.id', '=', 'baskets.user_id')
            ->select('orders.id', 'orders.order_price', 'orders.status')
            ->where('users.id', $active)
            ->orderByDesc('id')
            ->get();


        return view('orders', compact('orders','categoriesss'));
    }

    public function detail($id)
    {
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $order = Order::with('baskets.basket_products.product')->where('orders.id', $id)->firstOrFail();
        return view('order-detail', compact('order','categoriesss'));
    }
}
