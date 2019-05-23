<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class SearchController {
	/**
	 * \App\Models\Wordpress $p the wordpress handler
	 * \App\Models\ZohoHelpers\Product $p the product handler
	 * \App\Models\TripCalculator price calculator
	 */
	public function __construct() {
   
  }
  
  /** 
  * Returns the trip search screen 
  */
  public function tripSearchPage($req, $WP, $calculator) {
    $blade = new Blade(dirname(__DIR__, 1).'/Views', dirname(__DIR__, 1).'/Cache');

    return $blade->make('trip-search.main', ['myTrip' => $myTrip, 'myBoat' => $myBoat]);
  }
    
  public function search($query, $products) {
    if(isset($query['stops'])) {
      $trip = null;
      // build the trip
      if ($trip->hasAvailableStop) {
        $results = $this->findStops();
        $this->calculatePrices($results, $query, $trip);	
      } else {
        // go to checkout
      }
    } else {
      $results = $this->findStops();
      $this->calculatePrices($results, $query);
    }
  }
  
  public function findStops($duration) {
    // find by duration
    // filter month 
    // filter day
    // filter children
    // response the results
  }

  public function calculatePrices($products, $query, $trip) {

  }
}