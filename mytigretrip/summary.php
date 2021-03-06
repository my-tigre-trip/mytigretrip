<?php

require '../wp-load.php';
use App\Models\Calculator;
use App\Models\MyTrip;
use App\Models\Tour;
use App\Models\Session;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\Agency;
use App\Controllers\PriceController;
use Jenssegers\Blade\Blade;
use App\Utils\ViewRenderer;
use App\Models\ZohoHelpers\ZohoHandler;

// ZohoHandler::getInstance()->auth(); // requesting authorization

$zp = ZohoProduct::getInstance();
// ZohoHandler::getInstance()->auth();
$agency = null;
if( isset($_GET['agencyContext']) && $_GET['agencyContext'] === "true") {
  $agency = Agency::getInstance();
}

$c = new Calculator($zp, $agency);
$pc = new PriceController();
$blade = new Blade(dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/App/Views', dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/App/Cache');
$view = new ViewRenderer($blade, $session);
$pc->summary($_GET, Session::getInstance(), $zp, $c, $view);
