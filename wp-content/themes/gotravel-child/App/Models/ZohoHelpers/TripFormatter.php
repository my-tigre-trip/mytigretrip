<?php

namespace App\Models\ZohoHelpers;

use DateTime;
use DateTimeZone;
/** 
 * formats the data for zoho request. Think as a parent class
 * to be used by propper trip type
 * 
 * format = 
 * 
*/
abstract class TripFormatter {

  // dependencies
  protected $zohoHandler;
  protected $translator;
  protected $req;
  protected $product;
  protected $calculator;
  protected $myTrip;

  protected $priceDetail;
  
  #zoho
  protected $dealName;
  protected $emailStatus;
  protected $stage;

  #reservation & contact  
  protected $ticketNumber;
  protected $firstName;
  protected $lastName;
  protected $phone;
  protected $alternativeContact;

  #pricing
  protected $requiredDepositUsd;
  protected $payCurrency;

  #date
  protected $dateCalendar;
  protected $alternativeDate;

  #trip
  protected $schedule;
  protected $tripDuration;
  protected $tripType;
  protected $salesChannel;


  #price logic should be moved internaly
  

  /**
   * @param Array $req $_POST request from checkout form
   * @param \App\Models\ZohoHelpers\ZohoHandler $zohoHandler
   * @param Symfony\Component\Translation\Translator $translator
   * @param \App\Models\ZohoHelpers\Product $product
   * @param \App\Models\Calculator $calculator
   * @param \App\Models\MyTrip $myTrip
   */
  public function __construct($req, $zohoHandler, $translator, $product, $calculator, $myTrip) {
    $this->req = json_decode(json_encode($req), FALSE);
    $this->zohoHandler = $zohoHandler;
    $this->translator = $translator;
    $this->product = $product;
    #we need price logic here not in form rendering
    $this->calculator = $calculator;
    $this->myTrip = $myTrip;
  }

  public function setup() {
    $this->setZohoApiNames(); // add the zoho apiName key
    $this->assignValues();
    $this->applyTransformations();
    $this->calculatePrice();
    $this->applyPriceTransformations();
  }

  /**
   * add a property name for zoho
   */
  abstract protected function setZohoApiNames();
  /**
   * Assign the post value. no transformations applied
   */
  abstract protected function assignValues();
   /**
   *  Assign transformed values
   */
  abstract protected function applyTransformations();
  /**
   *  Assign transformed values
   */
  abstract protected function applyPriceTransformations();

  /**
   *  Assign transformed values
   */
  abstract protected function calculatePrice();


  /**
   * prepares the data for zoho saving
   * @return ZohoRecord $data
   */
  public function getZohoDealRecordFormat() {
    $recordDeal = $this->zohoHandler->getRecordInstance('Deals');
    foreach($this as $value) {
      if(is_array($value) && array_key_exists('apiName', $value)) {       
        $v = !isset($value['value']) ? '' : $value['value']; // when value not setted send empty string
        $v = is_numeric($v) ? strval($v) : $v;        
        $recordDeal->setFieldValue($value['apiName'], $v);
      }
    }
    
    return $recordDeal;
  }

  /**
   * @return Array $array array with key (camel case) and value
   */
  public function toArray() {
    $values = [];
    foreach($this as $key => $value) {
      if(is_array($value) && array_key_exists('value', $value)) {        
        $values[$key] = $value['value'];
      }
    }    
    return $values;
  }

  // transformation
  public function setDealName() {
    $req = $this->req;
    return "#$req->ticketNumber | $req->firstName $req->lastName";
  }

  public function setGoogleDate() {
    // $date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    // $date->setDate(intval($this->req->year), intval($this->req->month), intval($this->req->day));
    // $date->setTime(0,0); 
    // return $date->format('Y-m-d');
    return $this->req->date;
  }

  public function findRequiredDeposit() {
    $requiredDeposit = $this->product->find('required-deposit');
    return $requiredDeposit['price'];
  }

  /**
   * @return String translated stop name
   */
  public function setStopSchedule() {
    $stop = '';
    $r = $this->req;
    $stop = $this->translator->trans($r->mood1);
    if($r->tripDuration === HALF_DAY && $r->schedule === MORNING) {
      if($r->mood1 !== STOP_DELTAVENTURA) {
        $stop .= ' '.MORNING_STOP;
      }
    } elseif($r->tripDuration === HALF_DAY && $r->schedule === AFTERNOON) {
      if($r->mood1 !== STOP_FLYBOARD && $r->mood1 !== STOP_SKI) {
        $stop .= ' '.AFTERNOON_STOP;
      }      
    }

    return $stop;
  }

  /**
   * meeting point
   * if car or full day then SARTHOU
   * @return String the meeting point
   */
  public function setTigreAddress() {
    $address = PEER_ES;
    $r = $this->req;
    if($r->tripDuration === FULL_DAY || $this->myTrip->car) {
      $address = SARTHOU;
    }
    return $address;
  }
}
