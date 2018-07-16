<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\PaymentService;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            if (Cart::content()->count() == 0) {
                return redirect()->route('home');
            }
        }

        $data         = [];
        $categoryMenu = Category::orderBy('category_name', 'asc')->get();
        $user_detail  = Auth::user()->detail;
        $user         = Auth::user();
        $order        = Cart::total();
        $random       = rand(1, 10000);

        $data["user_detail"]  = $user_detail;
        $data["user"]         = $user;
        $data["order"]        = $order;
        $data["categoryMenu"] = $categoryMenu;

        session()->put('order_no', $random);


        $service = new PaymentService();
        $form                   = [];
        $form['sessionOrderNo'] = session('order_no');
        $form['orderPrice']     = $order;
        $form['basketID']       = session('active_basket_id');
        $form['route']          = 'pay';
        $form['userID']         = Auth::id();
        $form['name']           = Auth::user()->name;
        $form['surname']        = Auth::user()->surname;
        $form['phone']          = Auth::user()->detail->phone;
        $form['email']          = Auth::user()->email;
        $form['city']           = Auth::user()->detail->city;
        $form['country']        = Auth::user()->detail->country;
        $form['zipcode']        = Auth::user()->detail->zipcode;
        $form['address']        = Auth::user()->detail->address;

        $data['getFormContent'] = $service->IyzicoForm($form);
        $service->IyzicoForm($form);

        return view('payment')->with($data);
    }

    public function pay()
    {

        $token   = session('_token');
        $orderNo = session('order_no');

        $pay = new PaymentService();
        $pay->IyzicoRequest($orderNo, $token);

        $order                   = [];
        $order['name']           = Auth::user()->name.' '.Auth::user()->surname;
        $order['address']        = Auth::user()->detail->address;
        $order['phone']          = Auth::user()->detail->phone;
        $order['m_phone']        = Auth::user()->detail->m_phone;
        $order['basket_id']      = session('active_basket_id');
        $order['user_id']        = Auth::id();
        $order['installments']   = 1;
        $order['status']         = "Your order has been received";
        $order['payment_method'] = "Credit Cart";
        $order['order_price']    = Cart::total();
        $order['token']          = $token;
        $order['order_no']       = session('order_no');


        Order::create($order);
        Cart::destroy();
        session()->forget('active_basket_id');
        session()->forget('order_no');

        Session::flash("status", 2);

        return redirect()->route('orders');
    }
}
