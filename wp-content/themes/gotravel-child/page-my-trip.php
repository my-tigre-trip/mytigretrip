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
//renders the summary page with options form
$req = count($_POST) > 0 ? $_POST : $_GET;
echo $c->myTrip($req, Wordpress::getInstance(), Session::getInstance(), new Calculator(ZohoProduct::getInstance()), ZohoProduct::getInstance());
