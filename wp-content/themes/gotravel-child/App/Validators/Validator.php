<?php

namespace App\Validators;

abstract class Validator {

  public $messages;

  /**
   * validates the reques
   * @param Array $req $_POST request
   */
  abstract public function validate($req, $session);

  /**
   * returns false if some required field is missing in request
   * @param Array $req
   * @param Array $required
   */
  public function checkRequired($req, $required) {
    foreach($required as $r) {
      if (!isset($req[$r])) {
        $this->sessionError();
        return false;
      }
    }
    return true;
  }

  public function getMessages() {
    return $this->messages;
  }

  public function sessionError() {
    $this->messages['status'] = 'error';
    $this->messages['message'] = 'Not valid or expired session';
  }

  public function nameError() {
    $this->messages['status'] = 'error';
    $this->messages['message'] = 'First name and last name are required';
  }

  public function emailError() {
    $this->messages['status'] = 'error';
    $this->messages['message'] = 'E-mail is empty or not valid';
  }

  public function dateError() {
    $this->messages['status'] = 'error';
    $this->messages['message'] = 'email is empty or no valid';
  }

  public function addressError() {
    $this->messages['status'] = 'error';
    $this->messages['message'] = 'pick up address is required';
  }

  # Validations
  /**
   * the pickup address is only required when the car is selected or in full day trip
   */
  public function validateAddress($req, $myTrip) {
    if (!isset($req['pickupAddress'])) {
      //$this->sessionError();
      //return false;
    }
    $myBoat = $myTrip->lock;
    if(($myTrip->car || $myBoat->boat === 'full-day') && empty($req['pickupAddress'])) {
      $this->addressError();
      return false;
    }
    
    return true;
  }
}