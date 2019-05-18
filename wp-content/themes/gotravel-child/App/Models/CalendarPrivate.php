<?php

namespace App\Models;
use App\Models\Calendar;

class CalendarPrivate extends Calendar {
  public function __construct($calendarHandler, $schedule) {
    parent::__construct($calendarHandler, $schedule);

  }

  /**
   * use when current schedule is morning
   */
  public function processMorning($event) {
     if ($event['Schedule'] === MORNING_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);
    } elseif($event['Schedule'] === AFTERNOON_ES) {
      // filtered. it means "available" 
    } elseif($event['Schedule'] === SCH_FULL_DAY_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);
    }   
  }

  /**
   * use when current schedule is afternoon
   */
  public function processAfternoon($event) {
    if ($event['Schedule'] === MORNING_ES) {
      // filtered. it means "available" 
    } elseif($event['Schedule'] === AFTERNOON_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);      
    } elseif($event['Schedule'] === SCH_FULL_DAY_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);
    }
  }
  
  /**
   * use when current schedule is full day
   */
  public function processFullDay($event) {
    if ($event['Schedule'] === MORNING_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);      
    } elseif($event['Schedule'] === AFTERNOON_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);      
    } elseif($event['Schedule'] === SCH_FULL_DAY_ES) {
      $this->processedEvents[] = $this->setEventArray($event['Id'], $this->notAvailable);
    }
  }

  public function mapEvents() {
    foreach ($this->events as $event) {
      if ($this->isValidDate($event)) {
        if($this->schedule === MORNING_CLASS) {
          $this->processMorning($event);
        } elseif ($this->schedule === AFTERNOON_CLASS) {
          $this->processAfternoon($event);
        } elseif($this->schedule === FULL_DAY_CLASS) {
          $this->processFullDay($event);
        }
      }
    }
  }
}