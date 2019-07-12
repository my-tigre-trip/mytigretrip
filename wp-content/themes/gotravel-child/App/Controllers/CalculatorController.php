<?php

namespace App\Controllers;

use App\Models\Tour;
use App\Utils\QueryHelper;

/**
 * handle the calculator snnipet (the shortcode) rendering
 */
class CalculatorController {
  /**
   * renders the calculator
   * @param $req the query string
   * @param \App\Models\ZohoHelpers\Product $ZP
   * @param \MyTigreTrip\Translation $T
   * @param $blade a Blade template engine instance
   */
  public function calculator($req, $ZP, $T, $B) {
    #validate query
    $tour = new Tour(basename(get_permalink()), $ZP);

    return $B->make('calculator.calculator', [
        'myTrip' => null,
        'adults' => $req['adults'],
        'children' => $req['children'],
        'specialActivityPeople' => $req['specialActivityPeople'],
        'tourBoat' => QueryHelper::parseDuration($req)->duration,
        'goBack' => home_url().'/?'.$_SERVER['QUERY_STRING'],
        'tour' => $tour,
        'currentTour' => $tour, // backward compatibility
        'valid' => true // backward compatibility
      ]);
  }

}