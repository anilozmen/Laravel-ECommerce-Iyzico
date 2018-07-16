<?php

namespace App\Services;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Options;
use Iyzipay\Request\RetrieveCheckoutFormRequest;
use Iyzipay\Model\CheckoutForm;

class PaymentService extends IyzipayBootstrap
{
    // Iyzico Options
    public $IOptions;

    // Pay
    public $IRequest;

    // CheckOut
    public $ICheckOut;

    // IyzicoForm

    public $IForm;

    // Shipping Address
    public $IShipping;

    // Buyer
    public $IBuyer;

    // Billing Address
    public $IBilling;

    // First Basket Items
    public $FBasketItems;

    // CheckOut Form Initialize
    public $checkoutFormInitialize;

    public function __construct()
    {
        $this->IyzicoOptions();
        $this->IyzicoForm($form = null);
        $this->IyzicoRequest();
    }

    private function IyzicoOptions()
    {
        $this->IOptions = new Options();
        $this->IOptions->setApiKey("SET-API-KEY");
        $this->IOptions->setSecretKey("SET-SECRET-KEY");
        $this->IOptions->setBaseUrl("SET-BASE-URL");
    }


    public function IyzicoForm(array $form = null)
    {
        # create request class
        $this->IForm = new CreateCheckoutFormInitializeRequest();
        $this->IForm->setLocale(Locale::EN);
        $this->IForm->setConversationId($form['sessionOrderNo']);
        $this->IForm->setPrice($form['orderPrice']);
        $this->IForm->setPaidPrice($form['orderPrice']);
        $this->IForm->setCurrency(Currency::TL);
        $this->IForm->setBasketId($form['basketID']);
        $this->IForm->setPaymentGroup(PaymentGroup::PRODUCT);
        $this->IForm->setCallbackUrl(route('pay'));
        $this->IForm->setEnabledInstallments(array(2, 3, 6, 9));


        $this->IBuyer = new Buyer();
        $this->IBuyer->setId($form['userID']);
        $this->IBuyer->setName($form['name']);
        $this->IBuyer->setSurname($form['surname']);
        $this->IBuyer->setGsmNumber($form['phone']);
        $this->IBuyer->setEmail($form['email']);
        $this->IBuyer->setIdentityNumber("51117");
        $this->IBuyer->setLastLoginDate(date("Y-m-d H:i:s"));
        $this->IBuyer->setRegistrationDate(date("Y-m-d H:i:s"));
        $this->IBuyer->setRegistrationAddress($form['address']);
        $this->IBuyer->setIp($_SERVER["REMOTE_ADDR"]);
        $this->IBuyer->setCity($form['city']);
        $this->IBuyer->setCountry($form['country']);
        $this->IBuyer->setZipCode($form['zipcode']);
        $this->IForm->setBuyer($this->IBuyer);


        $this->IShipping = new Address();
        $this->IShipping->setContactName($form['name']);
        $this->IShipping->setCity($form['city']);
        $this->IShipping->setCountry($form['country']);
        $this->IShipping->setAddress($form['address']);
        $this->IShipping->setZipCode($form['zipcode']);
        $this->IForm->setShippingAddress($this->IShipping);


        $this->IBilling = new Address();
        $this->IBilling->setContactName($form['name']);
        $this->IBilling->setCity($form['city']);
        $this->IBilling->setCountry($form['country']);
        $this->IBilling->setAddress($form['address']);
        $this->IBilling->setZipCode($form['zipcode']);
        $this->IForm->setBillingAddress($this->IBilling);


        $basketItems = array();
        $this->FBasketItems = new BasketItem();
        $this->FBasketItems->setId($form['sessionOrderNo']);
        $this->FBasketItems->setName("Binocular");
        $this->FBasketItems->setCategory1("Collectibles");
        $this->FBasketItems->setItemType(BasketItemType::PHYSICAL);
        $this->FBasketItems->setPrice($form['orderPrice']);
        $basketItems[0] = $this->FBasketItems;
        $this->IForm->setBasketItems($basketItems);

        $this->checkoutFormInitialize = new CheckoutFormInitialize();
        $getFormContent = $this->checkoutFormInitialize::create($this->IForm, $this->IOptions)->getCheckoutFormContent();
        return $getFormContent;

    }


    public function IyzicoRequest($sessionOrderNo = null, $token = null)
    {
        $this->IRequest = new RetrieveCheckoutFormRequest();
        $this->IRequest->setLocale(Locale::TR);
        $this->IRequest->setConversationId($sessionOrderNo);
        $this->IRequest->setToken($token);

        $this->ICheckOut = new CheckoutForm();
        $this->ICheckOut::retrieve($this->IRequest, $this->IOptions);
    }
}