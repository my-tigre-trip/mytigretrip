<?php
use App\Models\Wordpress;
use App\Models\Woo;
use App\Models\Session;
use App\Models\TripCalculator;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();
$search = new SearchController();
//renders the summary page with options form
echo $c->search(Wordpress::getInstance(), ZohoProduct::getInstance(), new TripCalculator(ZohoProduct::getInstance()));
