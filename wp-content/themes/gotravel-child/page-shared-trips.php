<?php
use App\Models\Wordpress;
use App\Models\Woo;
use App\Models\Calculator;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();

$c = new CheckoutController();
//renders the shared boat checkout
echo $c->myTripGroupContactInformation($_GET, Wordpress::getInstance(), new Calculator(ZohoProduct::getInstance()));
