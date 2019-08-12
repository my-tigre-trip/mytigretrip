<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
require get_stylesheet_directory().'/languages/zoho-autocomplete.php';
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Models\Session;
use App\Models\Calculator;
use App\Models\Wordpress;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\Product;
use App\Models\ZohoHelpers\PrivateFormatter;
use App\Controllers\CheckoutController;
use App\Validators\Checkout as CheckoutValidator;
use App\Utils\QueryHelper;

$V = new CheckoutValidator();
$T = new Translator('es_AR');
$T->addLoader('array', new ArrayLoader());
$T->addResource('array', $zohoAutocomplete_es, 'es_AR');

$product = new Product();

$myTrip = QueryHelper::queryToMyTrip($_POST['checkout'], $product);
$zohoHandler = ZohoHandler::getInstance();
$zohoHandler->auth();


$calculator = new Calculator($product);
$formatter = new PrivateFormatter($_POST, $zohoHandler, $T, $product, $calculator, $myTrip);
# Get JSON as a string
//$json_str = file_get_contents('php://input');
# Get as an object
//$json_obj = json_decode($json_str);


$c = new CheckoutController();
$c->checkout($_POST, Wordpress::getInstance(), Session::getInstance(), $zohoHandler, $V, $T, $formatter);

die();