<?php

require '../wp-load.php';
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\Product as ZohoProduct;

$c = new CheckoutController();
$c->getTheTrip($_POST, ZohoProduct::getInstance());
