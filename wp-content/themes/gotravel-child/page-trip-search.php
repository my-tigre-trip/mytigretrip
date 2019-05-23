<?php
use App\Models\Wordpress;
use App\Models\Calculator;
use App\Controllers\SearchController;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

//ZohoHandler::getInstance()->auth();
$c = new SearchController();
//renders the trip seach page
echo $c->tripSearchPage($_GET, Wordpress::getInstance(), new Calculator(ZohoProduct::getInstance()));
