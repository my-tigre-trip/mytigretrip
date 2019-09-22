<?php 

namespace App\Controllers;
use App\Models\ZohoHelpers\ZohoHandler;
use DateTime;
use DateTimeZone;
use App\Controllers\Controller;
use App\Helpers\Calendar as CalendarMockData;

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

  /**
   * @return httpResponse the json with availabiliy for one day
   * @param App\Models\ZohoHelper\CalendarHandler $ZC
   * @param String $date  eg 2017-05-18
   * @param String $duration [full-day, half-day_morning, half-day_afternoon]
   */
  public function availability($ZC, $req) {
    $ZC->fetchMockEvents();
    $events = $ZC->getEvents();
    $message = '';
    $available = true;
    $availability = '';
    // if the frontend receives a available true should redirect
    // otherwise should print a message
    switch($req['duration']) {
      case FULL_DAY:
        $date = $ZC->checkAvailabilityFullDay($req['date']);
        $message = $date['message'];
        $available = $date['available'];
        $availability = $date['availability'];
        break;
      case 'half-day_morning':
        $date = $ZC->checkAvailabilityHalfDayMorning($req['date']);
        $message = $date['message'];
        $available = $date['available'];
        $availability = $date['availability'];
        break;
      case 'half-day_afternoon':
        $date = $ZC->checkAvailabilityHalfDayAfternoon($req['date']);
        $message = $date['message'];
        $available = $date['available'];
        $availability = $date['availability'];
        break;
      default:
        $available = false;
        $message = 'Wrong Data';
    }

    $redirect = null;
    if ($available) {
      //Convert the date string into a unix timestamp
      //Get the day of the week using PHP's date function.      
      $dow = date("l", strtotime($req['date']));
      $query = [
        'date' => $req['date'],
        'd' => $availability,
        'duration' => $req['duration'],
        'adults' => $req['adults'],
        'children' => $req['children']
      ];
      $redirect = home_url().'/trip-search/?'.http_build_query($query);
    }
    
    return $this->jsonResponse([
      'message' => $message,
      'available' => $available,
      'availability' => $availability,
      'redirect' => $redirect
    ]);
  }
}