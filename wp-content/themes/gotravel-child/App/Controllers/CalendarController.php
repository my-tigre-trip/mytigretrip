<?php 

namespace App\Models\ZohoHelpers;
use App\Models\ZohoHelpers\ZohoHandler;
use DateTime;
use DateTimeZone;
use App\Controllers\Controller;

class CalendarController extends Controller{
  /**
   * @todo implement querying for filtering past event, or filter by schedule (morning, afternoon)
   */
  public static function fetchEvents($query = null) {
    $date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $zcrmModuleIns = ZohoHandler::getModuleInstance('Events');
    $bulkAPIResponse = $zcrmModuleIns->getRecords();
    $recordsArray = $bulkAPIResponse->getData();
    return $recordsArray;                                            
  }

  /**
   * @return httpResponse the json with private checkout events
   * @param \App\Models\PrivateCalendar 
   */
  public function privateCalendar($calendar) {
    $events = $calendar->fetchEvents();
  }
}