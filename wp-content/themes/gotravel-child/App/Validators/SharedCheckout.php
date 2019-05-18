<?php

namespace App\Validators;

class SharedCheckout extends Validator {
  public function __construct() {}
  /**
   * validates the request for shared checkout
   * @param Array $req $_POST request
   * @param App\Models\Session $session
   * @todo validate date formats
   */
  public function validate($req, $session) {
 
//  $response['status'] = 'error';
    $messages['status'] = 'valid';
    $break = false;

    $required = ['_token', 'firstName', 'lastName', 'day', 'month', 'year'];

    if(!$this->checkRequired($req, $required)) {
      return false;
    }    

    if (!$break && (empty($req['firstName']) || empty($req['lastName']))) {
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
    }

    if ($break) {
      return false;
    } else {
      return true;
    }
  }
}