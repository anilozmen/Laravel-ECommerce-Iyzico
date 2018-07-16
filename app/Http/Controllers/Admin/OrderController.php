<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        $categoryMenu = Category::orderBy('category_name','asc')->get();
        $orders = Order::with('baskets')->orderByDesc('id')->paginate(8);
        return view('admin.orders',compact('orders','categoryMenu'));
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
        $categoryMenu = Category::orderBy('category_name','asc')->get();
        return view('admin.orders-edit', compact('orders','status','categoryMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request0
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $data = ['status' => $request->status];
        $orders = Order::find($id);
        $orders->update($data);

        Session::flash("status", 1);
        return redirect()->route('admin-orders.index');
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
        return redirect()->route('admin-orders.index');
    }
}
