<?php

namespace App\Helpers;

class MyTrip {
  
  public static $payload = [];
  /**
   * @param String $adults
   * @param String $children
   * @return Array self
   */
  
  public static function mtt($adults, $children) {
    //$p = self::$payload;
    self::$payload['adults'] = $adults;
    self::$payload['children'] = $children;
    
    return new self;
  }
  #ticket chainable
  public static function ticket($ticket) { self::$payload['ticketNumber'] = $ticket; return new self; }
  #trip duration chainable
  public static function fullDay() { self::$payload['tripDuration'] = FULL_DAY; return new self; }
  public static function halfDay() { self::$payload['tripDuration'] = HALF_DAY; return new self; }
  public static function speedBoat() { self::$payload['tripDuration'] = SPEEDBOAT; return new self; }

  #schedule chainable
  public static function morning() { self::$payload['schedule'] = MORNING; return new self; }
  public static function afternoon() { self::$payload['schedule'] = AFTERNOON; return new self; }
  public static function fullDaySchedule() { self::$payload['schedule'] = FULL_DAY; return new self; }

  #stops chainable
  public static function stop($stop) { self::$payload['mood1'] = $stop; return new self; }
  public static function addStop($stop) { self::$payload['mood2'] = $stop; return new self; }

  #date chainable
  public static function date($day, $month, $year) {
    self::$payload['day'] = $day;
    self::$payload['month'] = $month;
    self::$payload['year'] = $year;
    return new self; 
  }
  public static function altDate($altDate) { self::$payload['alternativeDates'] = $altDate; return new self; }

  #passenger contact info chainable
  /**
   * @param String $firstName
   * @param String $lastName    
   * @param String $email
   * @param String $phone
   * @param String $otherContact
   */
  public static function contact($firstName = '', $lastName = '', $email = '', $phone = '', $alternativeContact = '') { 
    self::$payload['firstName'] = $firstName; 
    self::$payload['lastName'] = $lastName; 
    self::$payload['email'] = $email; 
    self::$payload['phone'] = $phone; 
    self::$payload['alternativeContact'] = $alternativeContact; 

    return new self;
  }

  #more info chainable
  public static function notes($notes) { self::$payload['notesComments'] = $notes; return new self; }

  /**
   * @return Array $payload
   */
  public static function get() {
    return self::$payload;
  }
  public static function getSpeedBoatPayload() {
    
  }

  /**
   * @param String $adults
   * @param String $children
   * @param String $mood1
   * @param String $day
   * @param String $month
   * @param String $year
   */
  public static function getHalDayMorningPayload($adults, $children, $mood1, $day, $month, $year) {
    return self::createPayload($adults, $children, $mood1, '', $day, $month, $year, HALF_DAY, MORNING);
  }

  /**
   * @param String $adults
   * @param String $children
   * @param String $mood1
   * @param String $day
   * @param String $month
   * @param String $year
   */
  public static function getHalDayAfternoonPayload($adults, $children, $mood1, $day, $month, $year) {
    return self::createPayload($adults, $children, $mood1, '', $day, $month, $year, HALF_DAY, AFTERNOON);
  }

}