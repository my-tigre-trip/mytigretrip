<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
use App\Controllers\CalendarController;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\CalendarHandler;
use App\Models\Calendar;



ZohoHandler::getInstance()->auth();
$ZC = new CalendarHandler(); // fetch zoho
$calendar = new Calendar($ZC); // calendar worker
$calendarController = new CalendarController(); // controller
$response = $calendarController->availability($calendar, $_GET);
echo $response;
die();