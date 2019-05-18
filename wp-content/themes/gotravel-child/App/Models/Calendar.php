<?php
namespace App\Models;

use DateTime;
use DateTimeZone;

abstract class Calendar {
    
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
    abstract protected function mapEvents(); 

    /**
     * 
     * @param  \App\Models\ZohoHelpers\CalendarHanlder $calendarHandler
     * @param String current trip schedule
     */
    public function __construct($calendarHandler, $schedule) {
        $this->calendarHandler = $calendarHandler; // this help us to mock or stub
        //$this->events = $this->calendarHandler->fetchEvents();
        $this->date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
        $this->schedule = $schedule;
    }

    /**
     * retrieve all the events for filtering.
     * @return Array the event data
     */
    public function fetchEvents() {       
        $this->events = $this->calendarHandler->fetchEvents(); 
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
     * @param String $eventId in group trips we need the id of the 'group' event
     * @param String $classes css clases
     * @param String $people how many people
     */
    public function setEventArray($eventId, $classes, $people = '') {
      return [
        'eventId' => $eventId,
        'classes' => $classes,
        'people' => $people
      ];
    }
}