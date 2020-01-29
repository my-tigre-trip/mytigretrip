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
  
  #reorganization
  #confirmar salida
  protected $confirmedTrip;

  # seguimiento
  protected $dealTag;
  protected $tripType;
  protected $salesChannel;
  protected $tripDuration;
  protected $schedule;
  protected $ticketNumber;
  protected $language;

  # calendario y tipo de salida
  #trip
  protected $tripType;
  protected $salesChannel;
  protected $tripDuration;
  protected $schedule;
  protected $googleCalDate;
  protected $googleCalDateCopy;
  protected $alternativeDates;

  #agency
  protected $agency;
  protected $agencyCopy;
  protected $preconfirmedTrip;
  protected $operator;
  protected $newOperator;
  protected $paxFullName;
  protected $paxMobilePhone;
  protected $guideName;
  protected $newGuide;
  protected $guideNameCopy;
  protected $guideMobilePhone;
  protected $invoiceAfip;
  protected $invoiceUser;
  protected $invoiceData;

  # pedidos
  protected $notesAndComments;
  protected $showNotesAndComments;

  #info pax
  protected $firstName;
  protected $lastName;
  // protected $Contact_Name;
  protected $emailPax;
  protected $phone;
  protected $altContact;

  #Data paradas
  protected $adults;
  protected $children;
  protected $menu;
  protected $mood1;
  protected $mood2;
  protected $additionals;
  protected $mood2Copy;

  # gastos en isla
  protected $payOnIsland;
  protected $guideLunch;

  # Auto y punto de encuentro
  protected $isFullDay;
  protected $car;
  protected $carLeg;
  protected $addCar;
  protected $pickupTime;
  protected $pickupAddress;
  protected $departureTime;
  protected $tigreAddress;


  # precio
  protected $finalPrice;
  protected $feeMoney;
  protected $extraPrice;
  protected $carPrice;
  protected $islandExpenses;
  protected $guideExpenses;

  #gastos estimados
  protected $islandExpensesCopy;
  protected $guideExpensesCopy;

  # detalle precios y descuento
  protected $boatPrice;
  protected $adultPrice;
  protected $childrenPrice;
  protected $priceBeforeDiscount;
  protected $groupDiscount;

  # gastos de la salida
  protected $oil;

  # zoho
  protected $start;
  protected $end;
  protected $Amount;

  # mail automaticos
  protected $Deal_Name;
  protected $email;
  protected $Stage
 

  /**
   * @param Array $req $_POST request from checkout form
   * @param \App\Models\ZohoHelpers\ZohoHandler $zohoHandler
   * @param Symfony\Component\Translation\Translator $translator
   * @param \App\Models\ZohoHelpers\Product $product
   * @param \App\Models\Calculator $calculator
   * @param \App\Models\MyTrip $myTrip
   * @param \App\Models\Boat $myBoat
   */
  public function __construct($req, $zohoHandler, $translator, $product, $calculator, $myTrip, $myBoat) {
    $this->req = json_decode(json_encode($req), FALSE);
    $this->zohoHandler = $zohoHandler;
    $this->translator = $translator;
    $this->product = $product;
    #we need price logic here not in form rendering
    $this->calculator = $calculator;
    $this->myTrip = $myTrip;
    $this->myBoat = $myBoat;
  }

  public function setup() {
    $this->setZohoApiNames(); // add the zoho apiName key
    $this->assignValues();
    $this->applyTransformations();
    $this->calculatePrice();
    $this->applyPriceTransformations();
  }

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

    /**
   * add a property name for zoho
   */
  public function setZohoApiNames() {


    
  }
}
