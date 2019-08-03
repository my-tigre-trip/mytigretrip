<?php
use App\Models\Wordpress;
use App\Models\Woo;
use App\Models\Session;
use App\Models\Calculator;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();

$c = new CheckoutController();
//renders the checkout page
echo $c->myTripContactInformation($_GET, Wordpress::getInstance(),
 Session::getInstance(), new Calculator(ZohoProduct::getInstance()),
 ZohoProduct::getInstance()
);