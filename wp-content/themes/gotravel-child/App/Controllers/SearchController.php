<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;
use App\Utils\QueryHelper;

class SearchController {
	/**
	 * \App\Models\Wordpress $p the wordpress handler
	 * \App\Models\ZohoHelpers\Product $p the product handler
	 * \App\Models\TripCalculator price calculator
	 */
	public function __construct() {
   
  }
  
  /** 
  * Returns the trip search results or second option results
  */
  public function tripSearchPage($req, $product) {
    $found = [];
    //$blade = new Blade(dirname(__DIR__, 1).'/Views', dirname(__DIR__, 1).'/Cache');
    //$category = $req['type'] ? $req['type'] : 'recommended'; 
    $results = [];
    if ($this->validateRequest($req)) {
      //$results = $product->findResults($category, 'categoryId');
      
      if (isset($req['mood1'])) {  
        $results = $this->secondOptions($req['mood1'], $product);
        $results = $this->filterByDayAndMonth($req, $results);        
      } else {
        // find products returns array
        $results = $product->find('half-day', 'validIn', true);
        $results = $this->filterResults($req, $results);       
      }
      
    } else {
      // render error page
    }

    return $results;
    //return $blade->make('trip-search.main', ['results' => $results]);
  }
  
  /**
   * uses a valid request to find the proper results
   */
  public function filterResults($req, $results) {
    $filteredResults = [];
    $dayOfWeek = [
      'sunday' => 'Domingo',
      'monday' => 'Lunes',
      'tuesday' => 'Martes',
      'wednesday' => 'Miércoles',
      'thursday' => 'Jueves',
      'friday' => 'Viernes',
      'saturday' => 'Sábado'
    ];

    $months = [
      'January' => 'Enero',
      'February' => 'Febrero',
      'March' => 'Marzo',
      'April' => 'Abril',
      'May' => 'Mayo',
      'June' => 'Junio',
      'July' => 'Julio',
      'August' => 'Agosto',
      'September' => 'Septiembre',
      'October' => 'Octubre',
      'November' => 'Noviembre',
      'December' => 'Diciembre'
    ];
 
    // obtain filters
    $_duration = QueryHelper::parseDuration($req);
    $duration = $_duration->duration;
    $schedule = $_duration->schedule;

    // filters by date
    $time = strtotime($req['date']);
    $dow = date("l", $time);
    $month = date("F", $time);

    // translate schedule string
    if ($schedule === strtolower(MORNING)) {
      $schedule = MORNING_ES;
    } elseif ($schedule === strtolower(AFTERNOON)) {
      $schedule = AFTERNOON_ES;
    }

    foreach ($results as $result) {
      $isValid = true;      

      // schedule in half day
      if ($isValid && $duration !== 'full-day' && $result['schedule'] === $schedule) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      // Month
      if ($isValid && (count($result['month']) === 0 || in_array($months[$month], $result['month']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      // day of week
      if ($isValid && (count($result['dow']) === 0 || in_array($dayOfWeek[$req['dow']], $result['dow']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      if ($isValid) {
        $filteredResults[] = $result;
      }
    }

    return $filteredResults;
  }

  /**
   * the second option only filter day & month
   */
  public function filterByDayAndMonth($req, $results) {
    $filteredResults = [];
    $dayOfWeek = [
      'sunday' => 'Domingo',
      'monday' => 'Lunes',
      'tuesday' => 'Martes',
      'wednesday' => 'Miércoles',
      'thursday' => 'Jueves',
      'friday' => 'Viernes',
      'saturday' => 'Sábado'
    ];

    $months = [
      'January' => 'Enero',
      'February' => 'Febrero',
      'March' => 'Marzo',
      'April' => 'Abril',
      'May' => 'Mayo',
      'June' => 'Junio',
      'July' => 'Julio',
      'August' => 'Agosto',
      'September' => 'Septiembre',
      'October' => 'Octubre',
      'November' => 'Noviembre',
      'December' => 'Diciembre'
    ];

    // filters by date
    $time = strtotime($req['date']);
    $dow = date("l", $time);
    $month = date("F", $time);
    
    foreach ($results as $result) {
      $isValid = true;
      if ($isValid && (count($result['month']) === 0 || in_array($months[$month], $result['month']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      // day of week
      if ($isValid && (count($result['dow']) === 0 || in_array($dayOfWeek[$req['dow']], $result['dow']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      if ($isValid) {
        $filteredResults[] = $result;
      }
    }

    return $filteredResults;
  }

  public function secondOptions($mood1, $product) {
    $tour = $product->find($mood1);
    
    $results = [];
    foreach ($tour['secondOption'] as $option) {
      $results [] = $product->find($option);
    }
    
    return $results;
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

  /**
   * check if the query is valid
   */
  public function validateRequest($req) {
    // adults
    if (!isset($req['adults']) && intval($req['adults']) < 2) {
      return false;
    }
    //date
    if (!isset($req['date'])) {
      return false;
    }

    // duration
    if (!isset($req['duration'])) {
      return false;
    }

    return true;
  }
}