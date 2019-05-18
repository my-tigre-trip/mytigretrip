<?php

namespace App\Models\ZohoHelpers;

use DateTime;
use DateTimeZone;
use App\Models\ZohoHelpers\TripFormatter;
/** 
 * 
 * 
 * 
*/
class SharedFormatter extends TripFormatter{
  # "preparativos"
  protected $menu;
  // date calendar
  # "cambios de fecha"
  // alternative dates

  # "Consultas - EScribir"
  protected $notesComments;
  # "Navegacion"
  // $schedule;
  // $tripDuration;
  // $tripType;
  // $salesChannel;
  
  # "Pasajeros"
  protected $adults;
  protected $children;
  // pasajeros totales - avoid duplications
  protected $tripLanguage; // via query $req
  # "gastos en isla"
  // completar poi
  # "Punto de encuentro"
  protected $car;
  protected $departureTime;
  protected $tigreAddress;

  # "confirmacion de la reserva"
  protected $advanceStatus;
  // requiredDepositUsd
  # "Precios"
  protected $amount;
  protected $finalPrice;
  protected $priceList; 
  
  # "agradecimientos - escribir"
  // email
  // Telefono
  // Otros Contactos
  // Nombre
  // Apellido

  # "Zoho Fields"
  protected $boatType;
  // deal name
  //stage 

  //protected $estimatedOil;
  

  #complete - NONE value
  //protected $completeMeetingPoint;
  //protected $completePayOnIsland;
  //protected $CompleteContact;
  
  /**
   * add a property name for zoho
   */
  public function setZohoApiNames() {
    // zoho
    $this->dealName['apiName'] = 'Deal_Name';
    $this->emailStatus['apiName'] = 'Email_Status';
    $this->stage['apiName'] = 'Stage';

    // reservation
    $this->ticketNumber['apiName'] = 'Ticket_Number';    
    $this->firstName['apiName'] = 'First_Name';
    $this->lastName['apiName'] = 'Last_Name';
    $this->phone['apiName'] = 'Phone';
    $this->email['apiName'] = 'E_Mail';
    $this->alternativeContact['apiName'] = 'Alternative_Contact_Information';
    $this->adults['apiName'] = 'Adults';
    $this->children['apiName'] = 'Children';
    $this->dateCalendar['apiName'] = "Google_Cal_Salida"; # dateCalendar
    // $this->alternativeDates['apiName'] = "Alternative_Dates";  
    $this->menu['apiName'] = "Menu";
    $this->notesComments['apiName'] = "Notes_Comments";
    $this->additionalConsiderations['apiName'] = 'Additional_Considerations';

    // boat - stops
    $this->schedule['apiName'] = "Schedule";
    $this->tripDuration['apiName'] = "Trip_Duration";
    $this->tripType['apiName'] = "Trip_Type";
    $this->salesChannel['apiName'] = "salesChannel"; # naming updated
    
    // price
    $this->amount['apiName'] = 'Amount';
    $this->finalPrice['apiName'] = 'Final_Price';
    $this->priceBeforeDiscount['apiName'] = 'Price_Before_Discount';    
    $this->requiredDepositUsd['apiName'] = 'Required_Deposit_USD';
    $this->priceList['apiName'] = 'Price_List';
    $this->payCurrency['apiName'] = 'Pay_Currency';
    // car
    $this->car['apiName'] = 'Car';    
    $this->departureTime['apiName'] = 'Departure_Time';
    // $this->estimatedOil['apiName'] = 'Estimated_Oil'; #liters
    $this->tigreAddress['apiName'] = 'Tigre_Address';

    $this->boatType['apiName'] = 'Boat_Type';
    
    //completes
    // $this->completeMeetingPoint['apiName'] = 'Complete_Meeteng_Point';
    // $this->completePayOnIsland['apiName'] = 'Complete_Poi';
    // $this->CompleteContact['apiName'] = 'Complete_Contact';
  }

  /**
   * Assign the post value. no transformations applied
   */
  public function assignValues() {    
    $r = $this->req;
    // zoho
    
    $this->stage['value'] = STAGE_FORM_WEB_ES;
    // reservation
    $this->ticketNumber['value'] = $r->ticketNumber;
    $this->firstName['value'] = $r->firstName;
    $this->lastName['value'] =$r->lastName;
    $this->phone['value'] = $r->phone;
    $this->email['value'] = $r->email;
    $this->alternativeContact['value'] = $r->alternativeContact;
    $this->adults['value'] = $r->adults;
    $this->children['value'] = $r->children;
    // $this->alternativeDates['value'] =  $r->alternativeDates;    
    $this->notesComments['value'] = $r->notesComments;    

    // boat - stops  
    $this->tripType['value'] = GROUP_TRIP_ES;
    $this->salesChannel['value'] = CHANNEL_WEB;

    // pricing
    $this->priceList['value'] = CHANNEL_WEB;
    
    // car    
    $this->pickupAddress['value'] = $r->pickupAddress;
    //$this->carPickupTime['value'] = $r->carPickupTime;
    $this->departureTime['value'] = $r->departureTime;

    //completes
    $this->completeMeetingPoint['value'] = NONE;
    $this->completePayOnIsland['value'] = NONE;
    $this->CompleteContact['value'] = NONE;
  }

  public function calculatePrice() {
    //$this->priceDetail = $this->calculator->calculatePrice($this->myTrip->lock, $this->myTrip);
  }

  public function applyPriceTransformations() {
    $p = $this->priceDetail;
    // price
    $this->amount['value'] = $p['finalPrice'];
    $this->finalPrice['value'] = $p['finalPrice'];
    $this->groupDiscount['value'] = $p['boatDetail']['groupDiscount'];
    $this->priceBeforeDiscount['value'] = $p['boatDetail']['priceBeforeDiscount'];
    $this->estimatedIslandExpenses['value'] = $p['boatDetail']['estimatedIslandExpenses'];
  }

  /**
   * @todo check mood translation 
   */
  public function applyTransformations() {
   
    $r = $this->req;
    $t = $this->translator;
    // zoho
    $this->dealName['value'] = $this->setDealName();
    $this->emailStatus['value'] = 'Email_Status';    
    //reservation
    $this->menu['value'] = $t->trans($r->menu);
    $this->additionalConsiderations['value'] = $t->trans($r->additionalConsiderations);

    // date time    
    $this->dateCalendar['value'] = $this->setGoogleDate(); # dateCalendar
    $this->tripDuration['value'] = $t->trans($r->tripDuration);
    $this->schedule['value'] = $t->trans($r->schedule);
    
    // price    
    $this->requiredDepositUsd['value'] = $this->findRequiredDeposit();   

    // car
    $this->car['value'] = NOT_INCLUDED_ES;
    $this->tigreAddress['value'] = PEER_ES;
  }  
}
