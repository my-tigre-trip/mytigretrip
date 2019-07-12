<?php
require '../wp-load.php';
use App\Models\Calculator;
use App\Models\MyTrip;
use App\Models\Tour;
use App\Models\Session;
use App\Models\ZohoHelpers\Product as ZohoProduct;
// use App\Models\ZohoHelpers\ZohoHandler;
use App\Controllers\PriceController;

// ZohoHandler::getInstance()->auth();

$zp = ZohoProduct::getInstance();
$c = new Calculator($zp);
$pc = new PriceController();
$pc->calculatePrice($_GET, Session::getInstance(), $zp, $c);
