<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
use App\Controllers\CalendarController;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\CalendarHandler;


$ZC = new CalendarHandler();
ZohoHandler::getInstance()->auth();
$calendar = new CalendarController($ZC, $schedule);
$response = $calendar->availability($ZC, $_GET);
echo $response;
die();