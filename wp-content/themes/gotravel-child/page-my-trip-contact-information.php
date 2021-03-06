<?php
use App\Models\Wordpress;
use App\Models\Woo;
use App\Models\Session;
use App\Models\Calculator;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\Agency;

// ZohoHandler::getInstance()->auth();

$c = new CheckoutController();
//renders the checkout page

$agency = null;
$foundAgency = null;
if( isset($_GET['agencyContext']) && $_GET['agencyContext'] === "true") {
  $agency = Agency::getInstance();
  $foundAgency = $agency->find($_GET['agency'], 'ID');
}

$calculator = new Calculator(ZohoProduct::getInstance(), $agency);

echo $c->myTripContactInformation($_GET, Wordpress::getInstance(), Session::getInstance(), $calculator,
 ZohoProduct::getInstance(), $foundAgency
);