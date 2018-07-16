<?php

namespace App\Http\Controllers;

use App\Category;
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

        $data["user_detail"]   = $user_detail;
        $data["user"]          = $user;
        $data["order"]         = $order;
        $data["categoryMenu"]  = $categoryMenu;

        session()->put('order_no', $random);

        return view('payment')->with($data);
    }

    public function pay()
    {

        require (base_path('vendor/iyzico/iyzipay-php/IyzipayBootstrap.php'));
        \IyzipayBootstrap::init();
        $options = new \Iyzipay\Options();
        $options->setApiKey("SET-API-KEY");
        $options->setSecretKey("SET-SECRET-KEY");
        $options->setBaseUrl("SET-BASE-URL");
        $token = session('_token');
        $iyzico_request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $iyzico_request->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzico_request->setConversationId(session('order_no'));
        $iyzico_request->setToken($token);
        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($iyzico_request, $options);

        $order                   = [];
        $order['name']           = Auth::user()->name.' '.Auth::user()->surname;
        $order['address']        = Auth::user()->detail->address;
        $order['phone']          = Auth::user()->detail->phone;
        $order['m_phone']        = Auth::user()->detail->m_phone;
        $order['basket_id']      = session('active_basket_id');
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
