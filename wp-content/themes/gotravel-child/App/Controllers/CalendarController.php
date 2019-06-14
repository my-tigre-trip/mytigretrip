<?php 

namespace App\Controllers;
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

  /**
   * @return httpResponse the json with availabiliy for one day
   * @param App\Models\ZohoHelper\CalendarHandler $ZC
   * @param String $date  eg 2017-05-18
   * @param String $duration [full-day, half-day_morning, half-day_afternoon]
   */
  public function availability($ZC, $req) {
    $message = '';
    $available = true;
    // if the frontend receives a available true should redirect
    // otherwise should print a message
    switch($req['duration']) {
      case FULL_DAY:
        //check availabilityFullDay($date)
        if(!false) {
          $message = 'There is no availability for this day';
          $available = false;
        }
        break;
      case 'half-day_morning':
        //check availabilityHalfDayMorning($date)
        if(!false) {
          $message = 'There is available trips only in the afternoon for this day';
          $available = false;
        }
        break;
      case 'half-day_afternoon':
        //check availabilityHalfDayAfternoon($date)
        if(!false) {
          $message = 'There is available trips only in the morning for this day';
          $available = false;
        }
        break;
      default:
        $available = false;
        $message = 'Wrong Data';
    }    
    
    return $this->jsonResponse(['message' => $message, 'available' => $available]);
  }
}