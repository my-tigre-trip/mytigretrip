<?php

namespace App\Validators;
use App\Utils\QueryHelper;

class Checkout extends Validator {
  public function __construct() {}
  /**
   * validates the request fot checkout
   * @param Array $req $_POST request
   * @deprecated App\Models\Session $session **
   * @todo validate date formats
   */
  public function validate($req) {   
    
    $messages['status'] = 'valid';
    $break = false;

    $required = ['_token', 'firstName', 'lastName', 'date'];

    if(!$this->checkRequired($req, $required)) {
      return false;
    }    

    if ($req['_token'] !== session_id()) {     
      $break = true;
      $this->sessionError();
    } elseif (!$break && (empty($req['firstName']) || empty($req['lastName']))) {
      $break = true;
      $this->nameError();
    } elseif (!$break && (empty($req['email']) || !filter_var($req['email'], FILTER_VALIDATE_EMAIL))) {
      $break = true;
      $this->emailError();
    } elseif (!$break && empty($req['date'])) { // revisar
      $break = true;
      $this->dateError();
    } elseif (!$break && !$this->validateAddress($req)) {  // check why is not valid
      $break = true;      
    }   

    if ($break) {
      return false;
    } else {
      return true;
    }
  }
}