<?php
require '../wp-load.php';
use App\Models\Calculator;
use App\Models\MyTrip;
use App\Models\Tour;
use App\Models\Session;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\Agency;
// use App\Models\ZohoHelpers\ZohoHandler;
use App\Controllers\PriceController;

// ZohoHandler::getInstance()->auth();
$agency = null;
if( isset($_GET['agencyContext']) && $_GET['agencyContext'] === "true") {
  $agency = Agency::getInstance();
}

$zp = ZohoProduct::getInstance();
$c = new Calculator($zp, $agency);
$pc = new PriceController();
$pc->calculatePrice($_GET, Session::getInstance(), $zp, $c);
