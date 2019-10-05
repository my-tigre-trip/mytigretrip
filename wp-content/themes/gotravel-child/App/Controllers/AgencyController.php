<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;
use App\Models\Calculator;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Models\ZohoHelpers\TripFormmatter;
use App\Models\ZohoHelpers\Product;
use App\Helpers\Checkout as CheckoutHelper;
use App\Controllers\Controller;
use App\Utils\QueryHelper;


class AgencyController extends Controller {
 
  /**
   * @param $Blade a blade template engine instance
   * @param $AgencyHandler for manage agencies data
   */
  public function login($view, $WP) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $reject = true;
      if($reject) {
        echo $view->agencyLogin(['error' => 'Datos de ingreso incorrectos']);
      } else {
        $WP->redirectHome();
      }

    } else if($_SERVER['REQUEST_METHOD'] === 'GET') {
      echo $view->agencyLogin([]);
    }
  }


  /**
   * Private boat trips
   * @param Array $req $_GET query string
   * @param \App\Models\Wordpress to handle redirects
   * @param \App\Models\Calculator 
   * @todo use new TripCalculator instead of Calculator 
   * @todo use url queries
   */
  public function myTripContactInformation($req, $WP, $session, $calculator, $ZP) {
    $blade = new Blade(dirname(__DIR__, 1).'/Views', dirname(__DIR__, 1).'/Cache');
    $myTrip = QueryHelper::queryToMyTrip($req, $ZP);
    if ($myTrip === false) {
      $WP->redirectHome();
      //die();
    } else {
      $boat = QueryHelper::parseDuration($req)->duration;
      $myBoat = $myTrip->getBoat($boat);
      $price = $calculator->calculatePrice($myBoat, $myTrip);
      $notes = $myTrip->getNotes($myBoat, $price['tourDetail']['price']);
      $myTrip->setId();

      $schedule = '';
      if ($myBoat->boat === SPEEDBOAT || $myBoat->boat === FULL_DAY) {
        $schedule = 'full-day';
      } else {
        $schedule = $myBoat->mood1->schedule;
        if ($schedule === MORNING_ES) {
          $schedule = MORNING_CLASS;
        } else {
          $schedule = AFTERNOON_CLASS;
        }
      }

      return $blade->make('zoho-form', [
        'myTrip' => $myTrip,
        'myBoat' => $myBoat,
        'boatDetail' => $price['boatDetail'],
        'tourDetail' => $price['tourDetail'],
        'finalPrice' => $price['finalPrice'],
        'price' => $price,
        'notes' => $notes,
        'schedule' => $schedule
      ]);
    }
  }
}