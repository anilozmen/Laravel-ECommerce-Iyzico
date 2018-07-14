<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $orders = Order::with('baskets')->orderByDesc('id')->paginate(8);
        return view('admin.orders',compact('orders','categoriesss'));
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
        $status = [
          "Your Order Received" => "Your Order Received",
          "Shipped" => "Shipped ",
          "Order Complete" => "Order Complete"
        ];
        $orders = Order::find($id);
        $categoriesss = Category::orderBy('category_name','asc')->get();
        return view('admin.orders-edit', compact('orders','status','categoriesss'));
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

        $input = $request->all();
        $orders = Order::find($id);
        $orders->update($input);

        return redirect("/admin-orders");
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
        $orders = Order::destroy($id);
        return redirect("/admin-orders");
    }
}
