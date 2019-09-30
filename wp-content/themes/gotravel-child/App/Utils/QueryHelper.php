<?php

namespace App\Utils;

use App\Models\MyTrip;
use App\Models\Tour;

class QueryHelper {
  /**
   * split duration and schedule from query
   * @param $_GET
   * @return Object
   */
  public static function parseDuration($req) {
    $d = null;
    if (isset($req['duration'])) {
      $d = new \stdClass();
      $_duration = explode('_', $req['duration']);
    
      $d->duration = $_duration[0];
      $d->schedule = $_duration[1];
    } 
    
    return $d;
  }

  /**
   * converts url query to MyTrip´Object
   */
  public function queryToMyTrip($req, $ZP) {
    session_start();
    $myTrip = new MyTrip(session_id());

    #buscar el tour
    if (isset($req['tourSlug'])) {
      $tourSlug = new Tour($req['tourSlug'], $ZP);
      $myTrip->addTour($tourSlug);
    }

    $duration = '';
    if (isset($req['duration'])) {
      $duration = self::parseDuration($req);
      $myTrip->duration = $duration->duration;
      $myTrip->schedule = $duration->schedule;
    }
    
    if (isset($req['mood1'])) {
      $tour1 = new Tour($req['mood1'], $ZP);
      // people
      if ($myTrip->duration === FULL_DAY) {
        $tour1->boat = FULL_DAY;
      }
      $myTrip->addTour($tour1, 1);      
    }

    if (isset($req['mood2'])) {
      // should convert to full day
      $tour2 = new Tour($req['mood2'], $ZP);
      // people
      $myTrip->addTour($tour2, 2);
    }
    
    $myTrip->setOptional($req);
    // people
    $myTrip->setPeople($req);
    
    #car
    if (isset($req['car'])) {
      $myTrip->car = true;
    }
    #payOnIsland
    if (isset($req['payOnIsland'])) {
      $myTrip->payOnIsland = true;
    }

    if (isset($req['date'])) {
      $myTrip->date = $req['date'];
    }

    if (isset($req['d'])) {
      $myTrip->d = $req['d'];
    }

    return $myTrip;
  }

  /**
   * converts myTrip object to query (boat option needed)
   * @param MyTrip trip object
   */
  public function myTripToQuery($myTrip, $boat) {
    $query = [];
    $myBoat = $myTrip->getBoat($boat);
    
    $query[] = "adults=$myBoat->adults";
    
    if ($myBoat->children > 0) {
      $query[] = "children=$myBoat->children";
    }

    if ($myBoat->specialActivityPeople > 0) {
      $query[] = "specialActivityPeople=$myBoat->specialActivityPeople";
    }

    $query[] = 'mood1='.$myBoat->mood1->slug;
    if ($myBoat->mood2 !== null) {
      $query[] = 'mood2='.$myBoat->mood2->slug;
    }

    // optional
    $o1 = $myBoat->mood1->hasOptional() && $myBoat->mood1->optionalSelected;
    $o2 = isset($myBoat->mood2) && $myBoat->mood2->hasOptional() && $myBoat->mood2->optionalSelected;
    if ($o1 || $o2) {
      $query[] = 'optional=yes';
    }

    // car
    if ($myTrip->car) {
      $query[] = 'car=yes';
    }

    // poi
    if ($myTrip->payOnIsland) {
      $query[] = 'payOnIsland=yes';
    }

    $query[] = 'duration='.$myTrip->duration.'_'.$myTrip->schedule;
    
    if ($myTrip->date) {
      $query[] = "date=$myTrip->date";
    }

    if ($myTrip->d) {
      $query[] = "d=$myTrip->d";
    }

    return implode("&", $query);
  }

  /**
   * use it only if the date is available
   * the valid is a pair hex number string with base64
   */
  public function encryptValidDate() {    
    $bytes = random_bytes(20);
    $codeHex = bin2hex($bytes);
    $codeDec = hexdec($codeHex);
    $codeDec = (int) $codeDec;

    // if not pair sum 1
    if ($codeDec % 2 !== 0) {
      $codeDec++;
      $codeHex = dechex($codeDec);
    }    

    return $codeHex;
  }

  public function isValidDateHash($hash) {
    $codeDec = hexdec($codeHex);
    $codeDec = (int) $codeDec;
    return $codeDec % 2 === 0;
  }

  public static function formatDate($req) {
    
  }

  public function getPeople($req) {
    return $req['adults'] + $req['children'];
  }
}