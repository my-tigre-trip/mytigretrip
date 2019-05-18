<?php

namespace App\Validators;

class Checkout extends Validator {
  public function __construct() {}
  /**
   * validates the request fot checkout
   * @param Array $req $_POST request
   * @param App\Models\Session $session
   * @todo validate date formats
   */
  public function validate($req, $session) {
   
    $myTrip = $session->getMyTrip();
    //$myBoat = $myTrip->lock;
//  $response['status'] = 'error';
    $messages['status'] = 'valid';
    $break = false;

    $required = ['_token', 'firstName', 'lastName', 'day', 'month', 'year'];

    if(!$this->checkRequired($req, $required)) {
      return false;
    }    

    if ($req['_token'] !== $session->id()) {     
      $break = true;
      $this->sessionError();
    } elseif (!$break && (empty($req['firstName']) || empty($req['lastName']))) {
      $break = true;
      $this->nameError();
    } elseif (!$break && (empty($req['email']) || !filter_var($req['email'], FILTER_VALIDATE_EMAIL))) {
      $break = true;
      $this->emailError();
    } elseif (!$break && empty($req['day'])) { // revisar
      $break = true;
      $this->dateError();
    } elseif (!$break && empty($req['month'])) { // revisar
      $break = true;
      $this->dateError();
    } elseif (!$break && empty($req['year'])) { // revisar
      $break = true;
      $this->dateError();
    } elseif (!$break && !$this->validateAddress($req, $myTrip)) {  // check why is not valid
      $break = true;      
    }   

    if ($break) {
      return false;
    } else {
      return true;
    }
  }
}