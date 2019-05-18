<?php

namespace App\Helpers;
use App\Models\MyTrip;
use App\Models\Speedboat;
use App\Models\FullDay;
use App\Models\HalfDay;

/**
 * Session helper for mock in testing
 * when "locked" we should include locked in function name
 */
class Session {

  /**
   * 
   */
  public static function noValidSession() {
    return false;
  }

  public static function voidSession() {
    $myTrip = new MyTrip('1');
    return $myTrip;
  }

  public static function speedboatSession() {
    $myTrip = new MyTrip('1');
    $myTrip->lock = new Speedboat();
    return $myTrip;
  }

  public static function halfDaySession() {
    $myTrip = new MyTrip('1');
    $myTrip->lock = new HalfDay();
    return $myTrip;
  }

  public static function fullDaySession() {
    $myTrip = new MyTrip('1');
    $myTrip->lock = new FullDay();
    return $myTrip;
  }
}