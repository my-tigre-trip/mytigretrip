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

$isGroup = isset($_GET['type']) && $_GET['type'] === GROUP_CLASS;
if($isGroup) {
  $response = $calendarController->availabilityGroup($calendar, $_GET);
} else {
  $response = $calendarController->availability($calendar, $_GET);
}


echo $response;
die();