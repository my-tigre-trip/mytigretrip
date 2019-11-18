<?php
use App\Models\Wordpress;
use App\Models\Session;
use App\Models\Calculator;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\Agency;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();

$agency = null;
if( isset($_GET['agencyContext']) && $_GET['agencyContext'] === "true") {
  $agency = Agency::getInstance();
}

$calculator = new Calculator(ZohoProduct::getInstance(), $agency);

$c = new CheckoutController();
//renders the summary page with options form
$req = count($_POST) > 0 ? $_POST : $_GET;
echo $c->myTrip($req, Wordpress::getInstance(), Session::getInstance(), $calculator, ZohoProduct::getInstance());
