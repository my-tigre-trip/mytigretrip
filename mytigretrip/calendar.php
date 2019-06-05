<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
use App\Controllers\CalendarController;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\CalendarHandler;

use App\Models\CalendarPrivate;

# validate schedule before all or full day

$schedule = ($_GET['schedule'] === MORNING_CLASS || $_GET['schedule'] === AFTERNOON_CLASS ) ? $_GET['schedule'] : FULL_DAY;

$ZC = new CalendarHandler();
ZohoHandler::getInstance()->auth();
$calendar = new CalendarPrivate($ZC, $schedule);
$events = $calendar->fetchEvents();
//$calendar->mapEvents();
//$events = $calendar->getProcessedEvents();
echo jsonResponse($events);

die();
// the following is deprecated

error_reporting(E_ERROR | E_PARSE);
//$t = new Translator('en_US');
//$t->addLoader('array', new ArrayLoader());
//$t->addResource('array', $zohoAutocomplete_en, 'en_US');
//$t->addResource('array', $zohoAutocomplete_es, 'es_AR');

//session_start();
// $myTrip = unserialize($_SESSION['myTrip']);
$response = [  ];
//if ($_POST['_token'] === session_id()) {
if (true) {    
 
  $date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
  $eventArray = [];
  $recordsArray = ZohoCalendar::fetchEvents();

  foreach ($recordsArray as $event) {
    $event = $event->getData($event); 
    $dateEvent = new DateTime($event['Start_DateTime']);
    //$dateEndEvent = new DateTime($event['End_DateTime']);
    
    $filtered = filterEvent($date, $dateEvent, $_GET['schedule'], $event);
    if ($filtered) {
      //  echo "$event[Event_Title] - $event[Start_DateTime] <br>";
        $response['data'][] = [           
           'start' => $event['Start_DateTime'],
           'end' => $event['End_DateTime'],           
           'status' => classifyReservationStatus($event),
           'schedule' => classifySchedule($event['Schedule']),
           'type' => classifyTripType($event),
           'people' => $event['People'],
           //'available' => isAvailable($event, $_GET['schedule']),
           'available' => false,
           
        ];
    }
  }
  echo jsonResponse($response);
}

/**
 * classifyReservationStatus
 */
function classifyReservationStatus($event) {

  if ($event['Block'])
    return CONFIRMED_CLASS;
  switch($event['Advance_Status']) {
    case NOT_PAID_ES:
      return NOT_CONFIRMED_CLASS;
      break;
    case PAID_ES:
      return CONFIRMED_CLASS;
      break;
    default:
      return '';
      break;  
  }
}

/**
 * classifyTripType
 * ahora no tiene sentido - pero por si cambian los textos
 */
function classifyTripType($event) {
  switch($event['Trip_Type']) {
    case GROUP_TRIP_ES:
      return GROUP_TRIP;
      break;
    case PRIVATE_TRIP_ES:
      return PRIVATE_TRIP;
      break;
    case YACHT_TRIP_ES:
      return YACHT_TRIP;
      break;  
    default:
      return PRIVATE_TRIP;
      break;  
  }
}

/**
 * classifySchedule
 * ahora no tiene sentido - pero por si cambian los textos
 */
function classifySchedule($eventSchedule) {
  $s = FULL_DAY_ES;
  
  switch($eventSchedule) {
    case MORNING_ES:
      $s = MORNING;
      break;
    case AFTERNOON_ES:
      $s = AFTERNOON;
      break;
    case FULL_DAY_ES:
      $s = FULL_DAY;
      break;
    default:
      $s = FULL_DAY;
      break;  
  }
  
  return $s;
}

/**
 * filterEvent
 * filtra eventos pasados y por schedule
 */
function filterEvent ($date, $start, $scheduleOption, $event = null) {
  
  // filter pasted events. todo: do it in zoho querying
  if ($start <= $date)  
    return false;
  
    // if it's "full-day" we do not filter the event
  if(!isset($scheduleOption) || $scheduleOption === FULL_DAY || !isset($event['Schedule']) )
    return true;
  // 
  //$option = isset($scheduleOption) ? $scheduleOption : FULL_DAY ; // fetch option
  $schedule  = classifySchedule($event['Schedule']); // the event option
  $scheduleOption = classifySchedule($scheduleOption); // the scheduleOption
  // filter by schedule
  if ($schedule === FULL_DAY || $scheduleOption === $schedule)
    return true;  

  return false;
}

/**
 * showOnlyFiltered
 * mostrar solo cuando esta disponible unicamente la opcion solicitada
 */
function isAvailable ($event, $option) {
  if($event['Advance_Status'] === PAID_ES || empty($event['Advance_Status']))
    return false;

  $scheduleOption = isset($option) ? $option : FULL_DAY;
  $schedule  = classifySchedule($event['Schedule']);

  if ($event['Block'] &&  ($option === $schedule))
    return false;
  //$schedule = empty($schedule) ? FULL_DAY : $schedule;
  //if ($schedule )
  return ($schedule !== FULL_DAY ) || ($schedule !== $option) ? true : false;
}