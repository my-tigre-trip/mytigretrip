<?php

namespace App\Controllers;

use App\Models\Tour;
use App\Models\MyTrip;
use App\Utils\QueryHelper;
use App\Controllers\Controller;

/**
 * wrapper of pricing functions
 */
class PriceController extends Controller{
  /**
  * handles the calculator requests
  * @param Array $req;
  * @param App\Models\Session $session
  * @param App\Models\ZohoHelpers\Product $zohoProduct
  * @param App\Models\Calculator $calculator
  */
  function calculatePrice($req, $session, $zohoProduct, $calculator) {
    $response = [];
    $adults = 0;
    $children = 0;
    $optional = false;
    $specialActivity = 0;

    if ($req['_token'] === $session->id()) {
      $tour = new Tour($req['tourSlug'], $zohoProduct);
      //$myTrip = $session->getMyTrip();
      $myTrip = QueryHelper::queryToMyTrip($_GET, $zohoProduct);
      #si no existe myTrip lo creamos
      if ($myTrip === false) {
        $myTrip = new MyTrip($session->id());
      }
      #verificamos si ya esta bloqueado
      if ($myTrip->lock !== null) {
        echo $this->jsonResponse([
          'valid' => false,
          'messages' => renderMessage('summary-stage')
        ]);
        die();
      }
      #transferimos todos los campos
      $myTripBoat = $myTrip->getBoat($tour->boat);
      
      if ( isset($req['adults'])) {
        $myTripBoat->adults = $req['adults'];
        $tour->adults = $req['adults'];
        $adults = $req['adults'];
      }
      
      if ( isset($req['children'])) {
        $children = intval($req['children']);
        $myTripBoat->children = $children;
        $tour->children = $children;
        
      }

      if (isset($req['specialActivityPeople']) && $req['specialActivityPeople'] > 0) {
        $myTripBoat->specialActivityPeople = $req['specialActivityPeople'];
        $tour->specialActivityPeople = $req['specialActivityPeople'];
        $specialActivity = $req['specialActivityPeople'];
      }

      if (isset($req['optional']) && $req['optional'] === 'yes') {
        $tour->optionalSelected = true;
        $optional = true;
      } else {
        $tour->optionalSelected = false;
      }
      #evaluamos el tipo de bote correspondiente al tour y lo asignamos
      // if two stops has optional or special activity will be error
      if (isset($req['mood1'])) {
        $mood1 = new Tour($req['mood1'], $zohoProduct);
        $mood1->adults = $adults;
        $mood1->children = intval($children);
        $mood1->optionalSelected = $optional;
        $mood1->specialActivityPeople = $specialActivity;
        // override the boat
        $mood1->boat = FULL_DAY;
        $myTrip->addTour($mood1);
      }

      if (isset($req['mood2'])) {
        $mood2 = new Tour($req['mood2'], $zohoProduct);
        $mood2->adults = $adults;
        $mood2->children = intval($children);
        $mood2->optionalSelected = $optional;
        $mood2->specialActivityPeople = $specialActivity;
        // override the boat
        $mood2->boat = FULL_DAY;
        $myTrip->addTour($mood2);
      }

      $myTrip->addTour($tour);
      
      //@todo Check if there are second options 
      $myTripBoat->setNextStep();
      $nextStep = $myTripBoat->nextStep;
      $myTrip->setBoat($myTripBoat);
      
      #check de mood2
      // if ($myTripBoat->boat === FULL_DAY && $tour->mood === '2' && $myTripBoat->mood1 === null) {
      //   $myTripBoat->mood2 = null;
      //   $myTrip->setBoat($myTripBoat);
      //   // $session->setMyTrip($myTrip);
      //   echo $this->jsonResponse([
      //     'valid' => false,
      //     'messages' => renderMessage(FULL_DAY)
      //   ]);
      //   die();
      // }
      #evaluamos el goto
      $lockCollision = false;

      if (isset($req['nextStep']) && $req['nextStep'] === 'true') {
        $response['redirect'] = true;
        if ($nextStep === 'my-trip') {
          $myTrip->lock = $myTripBoat;
        }
      }

      //nextStepText
      if ($nextStep === 'my-trip') {
        $response['nextStepText'] = 'This is my Trip';
      } else {
        $response['nextStepText'] = 'Select & Continue';
      }

      # don't use session
      // $session->setMyTrip($myTrip);
      # enviamos response    
      $response['valid'] = true;
      $response['nextStep'] = home_url().'/'.$nextStep.'?'.QueryHelper::myTripToQuery($myTrip, $tour->boat);
      $response['view'] = renderPriceResult($myTrip, $tour->boat, $calculator, $zohoProduct);
      echo $this->jsonResponse($response);
    } else {    
      http_response_code(500);
    }
  }

/**
  * @param Array $req;
  * @param App\Models\Session $session
  * @param App\Models\ZohoHelpers\Product $zohoProduct
  * @param App\Models\Calculator $calculator
  * @param App\Utils\ViewRenderer $view
  * @return response json response with a view or errors
*/
  function summary($req, $session, $zohoProduct, $calculator, $view) {  
    //$myTrip = $session->getMyTrip();
    $myTrip = QueryHelper::queryToMyTrip($req, $zohoProduct);
    $myBoat = $myTrip->lock ? $myTrip->lock : $myTrip->getBoat($req['duration']);
    $response = [  ];
    if($req['_token'] === $session->id()){
      $myTrip->stage = 'summary';
      if( isset($req['payOnIsland'])){
          $myTrip->payOnIsland = true;
          $response['payOnIsland'] = $myTrip->payOnIsland ;
      }else{
          $myTrip->payOnIsland = false;
      }

      if( isset( $req['car'] ) ){
          $myTrip->car = true;
          $response['car'] = $myTrip->car ;
      }else{
          $myTrip->car = false;
      }
      $myTrip->lock = $myBoat;

      $response['view'] = $view->summary($myTrip, $calculator);
      echo $this->jsonResponse($response);
    } else {
      echo $this->jsonResponse(['valid' => 'no-boat']);
    }
  } 
}

