<?php

namespace App\Utils;

/**
 * handles the views to be sended via request
 */
class ViewRenderer {
    private $blade;
    private $session;

    /**
     * @param 
     */
    public function __construct($blade) {
      $this->blade = $blade;
    }

    public function price($session) {

    }
    
    public function summary($myTrip, $calculator) {
      
      $myBoat = $myTrip->lock;
      $price = $calculator->calculatePrice($myBoat, $myTrip);
      $notes = $myTrip->getNotes($myBoat, $price['tourDetail']['price']);
      return $this->blade->make('calculator.summary', ['myTrip' => $myTrip,
        'myBoat' => $myBoat,
        'boatDetail' => $price['boatDetail'],
        'tourDetail' => $price['tourDetail'],
        'finalPrice' => $price['finalPrice'],
        'price' => $price,
        'notes' => $notes
        ]).'';
    }

    public function agencyLogin($message) {
      return $this->blade->make('agency.login', $message);
    }
}