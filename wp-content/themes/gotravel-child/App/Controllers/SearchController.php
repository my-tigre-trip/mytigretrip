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
        if ($this->isSecondOptionAvailable($req)) {
          $results = $this->secondOptions($req['mood1'], $product);
          $results = $this->filterByDayAndMonth($req, $results);
        }   
             
      } else {
        // find products returns array
        $duration = QueryHelper::parseDuration($req);        
        $results = $product->find($duration->duration, 'validIn', true);
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
      'Sunday' => 'Domingo',
      'Monday' => 'Lunes',
      'Tuesday' => 'Martes',
      'Wednesday' => 'Miércoles',
      'Thursday' => 'Jueves',
      'Friday' => 'Viernes',
      'Saturday' => 'Sábado'
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

    // temporal
    $monthsEn = [
      'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
      'September', 'October', 'November', 'December'
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

    // only matters if it's a group trip
    $typeGroup = isset($req['type']) && $req['type']; 

    foreach ($results as $result) {
      $isValid = true;      
      // check group or private
      if ($typeGroup) {
        if($result['Tipo_de_Salida'] === GROUP_TRIP_ES) {
          $isValid = true;
        } else {
          $isValid = false;
        }
      }
      

      // schedule in half day
      if ($isValid && $duration !== FULL_DAY && $result['schedule'] === $schedule) {
        $isValid = true;
      } elseif($duration === FULL_DAY && $result['schedule'] !== AFTERNOON_ES) {
        $isValid = true; // full day first option is only morning or full day 
      }else {
        $isValid = false;
      }

      // Month
      if ($isValid && (count($result['month']) === 0 || in_array($month, $result['month']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      // day of week
      if ($isValid && (count($result['dow']) === 0 || in_array($dayOfWeek[$dow], $result['dow']))) {
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
      'Sunday' => 'Domingo',
      'Monday' => 'Lunes',
      'Tuesday' => 'Martes',
      'Wednesday' => 'Miércoles',
      'Thursday' => 'Jueves',
      'Friday' => 'Viernes',
      'Saturday' => 'Sábado'
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

    // temporal
    $monthsEn = [
      'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
      'September', 'October', 'November', 'December'
    ];

    // filters by date
    $time = strtotime($req['date']);
    $dow = date("l", $time);
    $month = date("F", $time);
    
    foreach ($results as $result) {
      $isValid = true;
      if ($isValid && (count($result['month']) === 0 || in_array($month, $result['month']))) {
        $isValid = true;
      } else {
        $isValid = false;
      }

      // day of week
      if ($isValid && (count($result['dow']) === 0 || in_array($dayOfWeek[$dow], $result['dow']))) {
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
      $results [] = $product->find($option, 'internal_name');
    }
    
    return $results;
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

  /**
   * according the d hash in req evaluates if there is availability for another trip option in day
   */
  public function isSecondOptionAvailable($req) {
    $duration = QueryHelper::parseDuration($req);
    // the hashes;
    $afternoon = md5(AFTERNOON_CLASS);
    $morning = md5(MORNING_CLASS);
    $fullDay = md5(FULL_DAY);

    if ($duration->duration === FULL_DAY && $req['d'] === $fullDay) {
      return true;
    } else if($duration->schedule === MORNING_CLASS) {
      // if afternoon or full day are available
      if($req['d'] === $afternoon || $req['d'] === $fullDay) {
        return true;
      }

    } else if($duration->schedule === AFTERNOON_CLASS) {
      // if afternoon or full day are available
      if($req['d'] === $morning || $req['d'] === $fullDay) {
        return true;
      }
    }

    return false;
  }

}