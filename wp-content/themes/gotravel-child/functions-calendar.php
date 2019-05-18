<?php
use Jenssegers\Blade\Blade;
//use Symfony\Component\Translation\Translator;
//use Symfony\Component\Translation\Loader\ArrayLoader;
error_reporting(E_ERROR | E_PARSE);


function renderCalendar()
{
  echo "hello";
}

function getCalendarData()
{
  $response = [ ];
  if (true) {    
 
    ZCRMRestClient::initialize();
    $oAuthClient = ZohoOAuth::getClientInstance();
    $refreshToken = ZOHO_REFRESH_TOKEN;
    //
    // ZOHO_REFRESH_TOKEN
    $userIdentifier = "mytigretrip@gmail.com";
    $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$userIdentifier);
    
    //
    $date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $zcrmModuleIns = ZCRMModule::getInstance("Events");  
    $bulkAPIResponse = $zcrmModuleIns->getRecords();
    $recordsArray = $bulkAPIResponse->getData();   
    $eventArray = [];
  
    foreach ($recordsArray as $event) {
      $event = $event->getData($event); 
      $dateEvent = new DateTime($event['Start_DateTime']);
      $dateEndEvent = new DateTime($event['End_DateTime']);
      //$allDay = new DateTime($event['All_day']);
      $filtered = filterEvent($date, $dateEvent, $dateEndEvent, $event);
      if ($filtered) {
        //  echo "$event[Event_Title] - $event[Start_DateTime] <br>";
          $response['data'][] = [
             //'event' => utf8_encode($event['Event_Title']),
             'start' => $event['Start_DateTime'],
             'end' => $event['End_DateTime'],
             'status' => classifyEvents($event),
             'time' => classifyTime($event)
          ];
      }
    }
  //  print_r($bulkAPIResponse);
    echo jsonResponse($response);
  }
}
//Helpers




//session_start();
//$myTrip = unserialize($_SESSION['myTrip']);

//if ($_POST['_token'] === session_id()) {




/**
 * events : Airbnb,
 */
function classifyEvents($event) {
  $eventName = utf8_encode($event['Event_Title']);
  $status = 'mtt-not-available';

  if (strpos(strtolower($eventName), 'mtt not confirmed') !== false) {
    $status = 'not-confirmed';
  } elseif (strpos(strtolower($eventName), 'airbnb') !== false ) {
    $status = 'airbnb'; 
  } 

  return $status;
}

function classifyTime($event) {
  $dateEventStart = new DateTime($event['Start_DateTime']);
  $dateEventEnd = new DateTime($event['End_DateTime']);
  $startH = intval($dateEventStart->format('G'));
  $endH = intval($dateEventEnd->format('G'));
  $status = '';
  
  if(($endH - $startH) > 6) {
    $status = 'mtt-full-day';
  } elseif ($endH < 15 ) {
    $status = 'mtt-morning';
  } elseif($endH >= 15 ) {
    $status = 'mtt-evening';
  }
  //echo "START $startH - END: $endH - STATUS : $status || ";
  return $status;
}

function filterEvent ($date, $start, $end, $event = null) {
  if ($start > $date) {
    if(isset($_GET['schedule']) && !empty($_GET['schedule'])) {    
      //echo $_GET['schedule'];
      $time = classifyTime($event);
      //echo "<br> $time";
      return ($time === ('mtt-'.$_GET['schedule'])) ? true : false;
    }
    return true;
  } else {
    return false;
  }
}