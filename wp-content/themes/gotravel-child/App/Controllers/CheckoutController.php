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


class CheckoutController extends Controller {
  /**
   * renders the /my-trip view
   * @todo use VieRenderer and blade as dependece
   */
  public function myTrip($req, $WP, $session, $calculator, $ZP) {
    
    $blade = new Blade(dirname(__DIR__, 1).'/Views', dirname(__DIR__, 1).'/Cache');
    // $myTrip = $session->getMyTrip();
    $myTrip = QueryHelper::queryToMyTrip($req, $ZP);

    if (isset($req['order'])) {
      $myTrip->generateOrder($req['order'], CheckoutHelper::getInstance());
    } elseif ($myTrip === false || $myTrip->lock === null) {
        //$WP->redirectHome();
        //return false;
        // die();        
    }
    
    $myBoat = $myTrip->lock ? $myTrip->lock : $myTrip->getBoat($req['duration']);
    $price = $calculator->calculatePrice($myBoat, $myTrip);

    return $blade->make('zoho-options-form', ['myTrip' => $myTrip, 'myBoat' => $myBoat]);
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

  /**
   * Shared boat view controller This works without session. Uses URL query
   * required keys: adults, children, type=shared
   * @param Array $req $_GET query string
   * @param \App\Models\Wordpress to handle redirects
   * @param \App\Models\Calculator 
   * @todo use new TripCalculator instead of Calculator 
   */
  public function myTripGroupContactInformation($req, $WP, $calculator) {
    #validate query
    $blade = new Blade(dirname(__DIR__, 1).'/Views', dirname(__DIR__, 1).'/Cache');
    // $myTrip = $session->getMyTrip();
    // if ($myTrip === false) {
    //   $WP->redirectHome();
    //   //die();
    // } else {
    //   $myBoat = $myTrip->lock;
     // $price = $calculator->calculatePrice($myBoat, $myTrip);
    //  $notes = $myTrip->getNotes($myBoat, $price['tourDetail']['price']);
      return $blade->make('zoho-form-shared', ['myTrip' => $myTrip,
        'myBoat' => $myBoat,
        'boatDetail' => $price['boatDetail'],
        'tourDetail' => $price['tourDetail'],
        'finalPrice' => $price['finalPrice'],
        'price' => $price,
        'notes' => $notes
      ]);
   // }
  }


  /**
   * handles the checkout via zoho and redirect. Session Free !!!!
   * @param $req stdClass post request data
   * @param $session Session
   * @param $zohoHandler ZohoHandler
   * @param $validator CheckoutValidator
   * @param $translator Translator
   * @param $formatter PrivateFormatter
   */
  public function checkout($req, $WP, $session, $zohoHandler, $validator, $translator, $formatter) {
    $response = [];
    if ($validator->validate($req)) {
      $formatter->setup();
      $recordDeal = $formatter->getZohoDealRecordFormat();
      $dealArray [] = $recordDeal;

      $dealIns = $zohoHandler->getModuleInstance('Deals');
      $bulkAPIResponseDeal = $dealIns->createRecords($dealArray);
      // $recordsArray - array of ZCRMRecord instances filled with required data for creation.
      $entityResponsesDeal = $bulkAPIResponseDeal->getEntityResponses();
      $responseData = $entityResponsesDeal[0]; //the created record
      $responseData;
      $response['status'] = $responseData->getStatus();
      $response['redirect'] = $WP->getHomeUrl().'/my-trip-checkout';
      # log
    } else {
      $response = $validator->getMessages();
    }    
    
    echo $this->jsonResponse($response); 
  }

  /**
   * handles the shared checkout via zoho and redirect
   * @param $req stdClass post request data
   * @param $zohoHandler ZohoHandler
   * @param $validator CheckoutSharedValidator
   * @param $translator Translator
   * @param $formatter GroupFormatter
   */
  public function checkoutShared($req, $WP, $zohoHandler, $validator, $translator, $formatter) {
    $response = [];
    if ($validator->validate($req, null)) {
      $formatter->setup();
      $recordDeal = $formatter->getZohoDealRecordFormat();
      $dealArray [] = $recordDeal;

      $dealIns = $zohoHandler->getModuleInstance('Deals');
      $bulkAPIResponseDeal = $dealIns->createRecords($dealArray);
      // $recordsArray - array of ZCRMRecord instances filled with required data for creation.
      $entityResponsesDeal = $bulkAPIResponseDeal->getEntityResponses();
      $responseData = $entityResponsesDeal[0]; //the created record
      $responseData;
      $response['status'] = $responseData->getStatus();
      $response['redirect'] = $WP->getHomeUrl().'/my-trip-checkout';
      # log
    } else {
      $response = $validator->getMessages();
    }    
    
    echo $this->jsonResponse($response); 
  }

  /**
  *
  */
  function getTheTrip($req, $ZP) {
    session_start();
    $myTrip = QueryHelper::queryToMyTrip($req, $ZP);
    $response = [];

    if ($req['_token'] === session_id()) {
      //  $valid = $myTrip->validateFields();
      //zoho hace una validacion
      $valid = true;
      if ($valid === true) {
        // improve saving mtt
        $myTrip->save();
        
        $boat = QueryHelper::parseDuration($req)->duration;
        $query = QueryHelper::myTripToQuery($myTrip, $boat);
        //completada la primera parte pasamos al formulario de contacto
        $response = [
          'errors' => false,
          'redirect' => home_url().'/my-trip-contact-information/?'.$query
        ];
      } else {
          $response = ['errors' => $valid ];
      }

      echo $this->jsonResponse($response); 
    }    
  }
}