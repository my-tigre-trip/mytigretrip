<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
require get_stylesheet_directory().'/languages/zoho-autocomplete.php';
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Models\Tour;
use App\Models\MyTrip;
use App\Models\Calculator;
use App\Models\Wordpress;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\Product;
use App\Models\ZohoHelpers\SharedFormatter;
use App\Controllers\CheckoutController;
use App\Validators\SharedCheckout as SharedValidator;

$V = new SharedValidator();
$T = new Translator('es_AR');
$T->addLoader('array', new ArrayLoader());
$T->addResource('array', $zohoAutocomplete_es, 'es_AR');

$zohoHandler = ZohoHandler::getInstance();
$zohoHandler->auth();

$product = new Product();
$calculator = new Calculator($product);
$formatter = new SharedFormatter($_POST, $zohoHandler, $T, $product, $calculator, null);
# Get JSON as a string
//$json_str = file_get_contents('php://input');
# Get as an object
//$json_obj = json_decode($json_str);


$c = new CheckoutController();
$c->checkoutShared($_POST, Wordpress::getInstance(), $zohoHandler, $V, $T, $formatter);

die();