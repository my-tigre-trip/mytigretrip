<?php

namespace App\Controllerrs;

class SearchController {
	/**
	 * \App\Models\Wordpress $p the wordpress handler
	 * \App\Models\ZohoHelpers\Product $p the product handler
	 * \App\Models\TripCalculator price calculator
	 */
	public function __construct($W, $P, $C, $view) {
    $this->W = $W;
    $this->P = $P;
    $this->C = $C;
    $this->view = $view;
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