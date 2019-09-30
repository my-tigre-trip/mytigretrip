<?php
namespace App\Models;

use DateTime;
use DateTimeZone;
use App\Utils\QueryHelper;
use App\Helpers\Calendar as CalendarMockData;

class Calendar {
    
    /** @var Object service for fetching events array*/
    protected $calendarHandler;
    /** @var DateTime the current day*/
    protected $date;
    /** @var Array the events*/
    protected $events;
    /** @var string the current trip schedule*/
    protected $schedule;
    /** @var Array $processedEvents */
    protected $processedEvents;
    # cases
    
    protected $filterCases;
    protected $classesCases;

    # classes
    protected $available = 'mtt-available';
    protected $notAvailable = 'mtt-not-available';
    protected $notConfirmed = 'mtt-not-confirmed';
    protected $shared = 'mtt-shared';
    
    
    /**
     * Creates a new array with  the processed events
     * each type of calendar filter as its own wish
     * @return Array filtered Events
     */
  //  abstract protected function mapEvents(); 

    /**
     * 
     * @param  \App\Models\ZohoHelpers\CalendarHanlder $calendarHandler
     * @param String current trip schedule
     */
    public function __construct($calendarHandler) {
        $this->calendarHandler = $calendarHandler; // this help us to mock or stub
        //$this->events = $this->calendarHandler->fetchEvents();
        //$this->date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
        //$this->schedule = $schedule;
    }

    /**
     * retrieve all the events for filtering.
     * @return Array the event data
     */
    public function fetchEvents() {     
        $this->events = $this->calendarHandler->fetchEvents();
        $eventsArray = [];
        foreach ($this->events as $i => $e) {
          $eventsArray[] = $e->getData();
          $eventsArray[$i]['Id'] = $e->getEntityId(); // atach event id
        }
        $this->events = $eventsArray;
    }

    /**
     * retrieve mock events
     * @return Array the event data
     */
    public function fetchMockEvents() {
      $this->events = CalendarMockData::calendarDataThisWeek();
  }

    public function getEvents() {
      return $this->events;
    }

    public function getProcessedEvents() {
      return $this->processedEvents;
    }

    /**
     * @param Array $eventDate an event
     * @return Boolean false if the event is a past day
     */
    public function isValidDate($event) {
      $e = new DateTime($event['Start_DateTime']);
      return $e > $this->date ? true : false ;
    }

    /**
     * create an array with data of one event 
     * 
     * group trip should group events by day and then assign a class for the available schedule
     * @param String $eventId in group trips we need the id of the 'group' event
     * @param String $classes css clases
     * @param String $people how many people
     */
    public function setEventArray($event, $classes) {
      return [
        'eventId' => $event['Id'],
        'classes' => $classes,
        'people' => $people,
        'date' => $event['Start_DateTime'],
        'schedule' => $event['Schedule'],
        'type' => $event['Trip_Type'],
        'availability' => '' // 
      ];
    }

    /**
     * just get if the day is available and returns an array:
     * [  'full-day' => NOT_AVAILABLE | AVAILABLE | ON_HOLD
     *    'half-day_morning' => NOT_AVAILABLE | AVAILABLE | ON_HOLD
     *    'half-day_afternoon' => NOT_AVAILABLE | AVAILABLE | ON_HOLD
     * ]
     */
    public function checkAvailabilityFullDay($date) {
      $dateEvents = $this->getEventsForDate($date);
      $available = true;
      $availability = H_FULL_DAY;
      if (!$this->isEmptyEventArray($dateEvents)) {
        $available = false;
        // if events exists there is still a hope the event/events is/are not confirmed yet 
        if($this->isFullDayOnHold($dateEvents) || $this->isHalfDayOnHold($dateEvents)) {
          return [
            'message' => 'There is a noy yet confirmed trip for this day. 
              Please send an email to agus@mytigretrip.com',
            'available' => $available,
            'availability' => ''
          ];
        } else { // todo  check status
          return [
            'message' => 'There is no availability for this day',
            'available' => $available,
            'availability' => ''
          ];
        }
      }

      // there is availability
      return [
        'message' => '',
        'available' => $available,
        'availability' => $availability
      ];
    }

    /**
     * if no availability in morning check if afternoon has and return a message
     */
    public function checkAvailabilityHalfDayMorning($date) {
      $dateEvents = $this->getEventsForDate($date);
      $available = true;
      // at this step we don't have idea for afternoon availability
      $availability = $dateEvents['afternoon'] === null ? H_AFTERNOON : '';
      if (!$this->isEmptyEventArray($dateEvents) && $dateEvents['morning'] !== null) {
        $available = false;
        // if events exists there is still a hope the event/events is/are not confirmed yet
        if($this->isMorningOnHold($dateEvents) && $dateEvents['afternoon'] !== null) {
          return [
            'message' => 'There is a noy yet confirmed trip for this day.
              Please send an email to agus@mytigretrip.com.',
            'available' => $available,
            'availability' => ''
          ];
        } elseif ($this->isMorningOnHold($dateEvents) && $dateEvents['afternoon'] === null) {
          return [
            'message' => 'There is a noy yet confirmed trip for this day.
              Please send an email to agus@mytigretrip.com. There is also a place in the afternoon',
            'available' => $available,
            'availability' => ''
          ];
        } elseif (!$this->isMorningOnHold($dateEvents) && $dateEvents['afternoon'] === null) {
          return [
            'message' => 'There is no availability for this day in thye morning but there is in the afternoon',
            'available' => $available,
            'availability' => ''
          ];
        } else { // todo  check status
          return [
            'message' => 'There is no availability for this day',
            'available' => $available,
            'availability' => ''
          ];
        }
      }
      // there is a place (or two)
      return [
        'message' => '',
        'available' => $available,
        'availability' => $availability
      ];
    }

    /**
     * if no availability in morning check if morning has and return a message
     */
    public function checkAvailabilityHalfDayAfternoon($date) {
      $dateEvents = $this->getEventsForDate($date);
      $available = true;
      $availability = $dateEvents['morning'] === null ? H_MORNING : '';

      if (!$this->isEmptyEventArray($dateEvents) && $dateEvents['afternoon'] !== null) {
        $available = false;
        // if events exists there is still a hope the event/events is/are not confirmed yet
        if($this->isAfternoonOnHold($dateEvents) && $dateEvents['morning'] !== null) {
          return [
            'message' => 'There is a noy yet confirmed trip for this day.
              Please send an email to agus@mytigretrip.com.',
            'available' => $available,
            'availability' => ''
          ];
        } elseif ($this->isAfternoonOnHold($dateEvents) && $dateEvents['morning'] === null) {
          return [
            'message' => 'There is a noy yet confirmed trip for this day.
              Please send an email to agus@mytigretrip.com. There is also a place in the morning',
            'available' => $available,
            'availability' => ''
          ];
        } elseif (!$this->isAfternoonOnHold($dateEvents) && $dateEvents['morning'] === null) {
          return [
            'message' => 'There is no availability for this day in the afternoon but there is in the morning',
            'available' => $available,
            'availability' => ''
          ];
        } else { // todo  check status
          return [
            'message' => 'There is no availability for this day',
            'available' => $available,
            'availability' => ''
          ];
        }
      }
      return [
        'message' => '',
        'available' => $available,
        'availability' => $availability
      ];
    }

    # Groupal trips 
    /**
     * if no availability in morning check if afternoon has and return a message
     */
    public function checkAvailabilityGroupMorning($req) {
      $date = $req['date'];
      $people = QueryHelper::getPeople($req);
      $dateEvents = $this->getEventsForDate($date);
      $available = true;
      // at this step we don't have idea for afternoon availability
      $availability = '';
      if (!$this->isEmptyEventArray($dateEvents) && $dateEvents['morning'] !== null) {
        // if it isn't  group and has no capacity
        if (!$this->groupAvailability($dateEvents['morning'], $people)) {          
          return [
            'message' => NOT_AVAILABLE_EN,
            'available' => false,
            'availability' => ''
          ];
        }
      }
      // there is a place (or two)
      return [
        'message' => '',
        'available' => $available,
        'availability' => $availability
      ];
    }

      /**
     * if no availability in afterno check if afternoon has and return a message
     */
    public function checkAvailabilityGroupAfternoon($req) {
      $date = $req['date'];
      $people = QueryHelper::getPeople($req);
      $dateEvents = $this->getEventsForDate($date);
      $available = true;
      // at this step we don't have idea for afternoon availability
      $availability = '';
      if (!$this->isEmptyEventArray($dateEvents) && $dateEvents['afternoon'] !== null) {
        // if it isn't  group and has no capacity
        if (!$this->groupAvailability($dateEvents['afternoon'], $people)) {          
          return [
            'message' => NOT_AVAILABLE_EN,
            'available' => false,
            'availability' => ''
          ];
        }
      }
      // there is a place (or two)
      return [
        'message' => '',
        'available' => $available,
        'availability' => $availability
      ];
    }

    /**
     * for half days. returns an array with the events for the required date.
     * sort by schedule
     */
    public function getEventsForDate ($date) {
      $morning = null;
      $afternoon = null;
      $fullDay = null;
      $result = [];

      foreach($this->events as $event) {
        if (strpos($event['Start_DateTime'], $date) !== false) {
          if ($event['Schedule'] === MORNING_ES) {
            $morning = $event;
          } elseif($event['Schedule'] === AFTERNOON_ES) {
            $afternoon = $event;
          } elseif($event['Schedule'] === FULL_DAY_ES) {
            $fullDay = $event;
          }
        }
      }

      return [
        'morning' => $morning,
        'afternoon' => $afternoon,
        'full-day' => $fullDay
      ]; 
    }

    public function isEmptyEventArray($eventsArray) {
      if($eventsArray['morning'] === null && $eventsArray['afternoon'] === null && $eventsArray['full-day'] === null) {
        return true;
      }
      return false;
    }
    
    /**
     * there is a hope if both  morning and afternoon are on hold /
     * morning is and afternoon null /
     * morning null and afternoon is
     */
    public function isHalfDayOnHold($eventsArray) {
      if ($this->isAfternoonOnHold($eventsArray) && $this->isAfternoonOnHold($eventsArray)) {
        return true;
      } else if($this->isMorningOnHold($eventsArray) && $eventsArray['afternoon'] === null) {
        return true;
      } else if ($this->isAfternoonOnHold($eventsArray) && $eventsArray['morning'] === null) {
        return true;
      } else {
        return false;
      }
    }

    public function isMorningOnHold($eventsArray) {
      return $eventsArray['morning'] !== null && $eventsArray['morning']['Advance_Status'] === ADVANCE_ON_HOLD_ES;
    }

    public function isAfternoonOnHold($eventsArray) {
      return $eventsArray['afternoon'] !== null && $eventsArray['afternoon']['Advance_Status'] === ADVANCE_ON_HOLD_ES;
    }

    public function isFullDayOnHold($eventsArray) {
      return $eventsArray['full-day'] !== null && $eventsArray['full-day']['Advance_Status'] === ADVANCE_ON_HOLD_ES;
    }

    public function groupAvailability($event, $people) {
      if ($event['Trip_Type'] === GROUP_TRIP_ES && ($people + $event['People'] <= 5) ) {
        return true;
      }

      return false;
    }


}