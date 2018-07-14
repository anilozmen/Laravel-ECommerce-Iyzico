<?
require (base_path('vendor/iyzico/iyzipay-php/IyzipayBootstrap.php'));

\IyzipayBootstrap::init();

$options = new \Iyzipay\Options();
$options->setApiKey("SET-API-KEY");
$options->setSecretKey("SET-SECRET-KEY");
$options->setBaseUrl("SET-BASE-URL");


$user_id = auth()->user()->id;
$user_name=auth()->user()->name;
$user_surname=auth()->user()->surname;
$user_phone = auth()->user()->detail->phone;
$user_email = auth()->user()->email;
$user_createdat = date("Y-m-d H:i:s");
$user_address = auth()->user()->detail->address;
$user_city = auth()->user()->detail->city;
$user_country = auth()->user()->detail->country;
$user_zipcode= auth()->user()->detail->zipcode;
@$order_price = $order;


# create request class
$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
$request->setLocale(\Iyzipay\Model\Locale::EN);
$request->setConversationId(session('order_no'));
$request->setPrice($order_price);
$request->setPaidPrice($order_price);
$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setBasketId(session('active_basket_id'));
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
$request->setCallbackUrl(route('pay'));

$request->setEnabledInstallments(array(2, 3, 6, 9));


$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId($user_id);
$buyer->setName($user_name);
$buyer->setSurname($user_surname);
$buyer->setGsmNumber($user_phone);
$buyer->setEmail($user_email);
$buyer->setIdentityNumber("51117");
$buyer->setLastLoginDate(date("Y-m-d H:i:s"));
$buyer->setRegistrationDate($user_createdat);
$buyer->setRegistrationAddress($user_address);
$buyer->setIp($_SERVER["REMOTE_ADDR"]);
$buyer->setCity($user_city);
$buyer->setCountry($user_country);
$buyer->setZipCode($user_zipcode);
$request->setBuyer($buyer);

$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName($user_name);
$shippingAddress->setCity($user_city);
$shippingAddress->setCountry($user_country);
$shippingAddress->setAddress($user_address);
$shippingAddress->setZipCode($user_zipcode);
$request->setShippingAddress($shippingAddress);

$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName($user_name);
$billingAddress->setCity($user_city);
$billingAddress->setCountry($user_country);
$billingAddress->setAddress($user_address);
$billingAddress->setZipCode($user_zipcode);
$request->setBillingAddress($billingAddress);

$basketItems = array();
$firstBasketItem = new \Iyzipay\Model\BasketItem();
$firstBasketItem->setId(session('order_no'));
$firstBasketItem->setName("Binocular");
$firstBasketItem->setCategory1("Collectibles");
$firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
$firstBasketItem->setPrice($order_price);
$basketItems[0] = $firstBasketItem;
$request->setBasketItems($basketItems);

$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, $options);
$checkout_form = $checkoutFormInitialize->getCheckoutFormContent();
echo $checkout_form;

?>