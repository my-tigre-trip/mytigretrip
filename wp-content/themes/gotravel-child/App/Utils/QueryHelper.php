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

    if (isset($req['duration'])) {

    }
    
    if (isset($req['mood1'])) {
      $tour1 = new Tour($req['mood1'], $ZP);
      // people

      $myTrip->addTour($tour1);      
    }

    if (isset($req['mood2'])) {
      // should convert to full day
      $tour2 = new Tour($req['mood1'], $ZP);
      // people
      $myTrip->addTour($tour2);
    }
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

    if ($myBoat->specialActivity > 0) {
      $query[] = "specialActivity=$myBoat->specialActivity";
    }

    
    $query[] = 'mood1='.$myBoat->mood1->slug;

    // car
    if ($myTrip->car) {
      $query[] = 'car=true';
    }

    // poi
    if ($myTrip->payOnIsland) {
      $query[] = 'payOnIsland=true';
    }

    $query[] = 'duration='.$boat;
    
    return implode("&", $query);
  }
}