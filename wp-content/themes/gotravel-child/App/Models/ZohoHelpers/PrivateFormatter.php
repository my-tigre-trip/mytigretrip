<?php

namespace App\Models\ZohoHelpers;

use DateTime;
use DateTimeZone;
use App\Models\ZohoHelpers\TripFormatter;
/** 
 * formats the data for zoho request. Think as a parent class
 * to be used by propper trip type
 * 
 * format = 
 * 
*/
class PrivateFormatter extends TripFormatter{

  protected $adults;
  protected $children;
  
  protected $menu;
  protected $notesComments;  
  protected $additionalConsiderations;

  protected $mood1;
  protected $mood2;

  #pricing
  protected $amount;
  protected $finalPrice;
  protected $groupDiscount;
  protected $priceBeforeDiscount;
  protected $estimatedIslandExpenses;
  protected $payOnIsland;
  protected $priceList;

  #car 
  protected $car;
  protected $pickupAddress;
  protected $carPickupTime;
  protected $departureTime;
  protected $estimatedOil;
  protected $tigreAddress;

  #complete - NONE value
  protected $completeMeetingPoint;
  protected $completePayOnIsland;
  protected $CompleteContact;
  
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
    $this->alternativeDates['apiName'] = "Alternative_Dates";    
    $this->menu['apiName'] = "Menu";
    $this->notesComments['apiName'] = "Notes_Comments";
    $this->additionalConsiderations['apiName'] = 'Additional_Considerations';

    // boat - stops
    $this->schedule['apiName'] = "Schedule";
    $this->tripDuration['apiName'] = "Trip_Duration";
    $this->tripType['apiName'] = "Trip_Type";
    $this->salesChannel['apiName'] = "salesChannel"; # naming updated
    $this->mood1['apiName'] = 'Mood_1';
    $this->mood2['apiName'] = 'Mood_2';
    // price
    $this->amount['apiName'] = 'Amount';
    $this->finalPrice['apiName'] = 'Final_Price';
    $this->groupDiscount['apiName'] = 'Group_Discount';
    $this->priceBeforeDiscount['apiName'] = 'Price_Before_Discount';
    $this->estimatedIslandExpenses['apiName'] = 'Estimated_Island_Expenses';
    $this->payOnIsland['apiName'] = 'Pay_On_Island';
    $this->requiredDepositUsd['apiName'] = 'Required_Deposit_USD';
    $this->priceList['apiName'] = 'Price_List';
    $this->payCurrency['apiName'] = 'Pay_Currency';
    // car
    $this->car['apiName'] = 'Car';
    $this->pickupAddress['apiName'] = 'Pickup_Address';
    $this->carPickupTime['apiName'] = 'Car_Pickup_Time'; # pickupTime
    $this->departureTime['apiName'] = 'Departure_Time';
    $this->estimatedOil['apiName'] = 'Estimated_Oil'; #liters
    $this->tigreAddress['apiName'] = 'Tigre_Address';
    
    //completes
    $this->completeMeetingPoint['apiName'] = 'Complete_Meeteng_Point';
    $this->completePayOnIsland['apiName'] = 'Complete_Poi';
    $this->CompleteContact['apiName'] = 'Complete_Contact';
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
    $this->alternativeDates['value'] =  $r->alternativeDates;    
    $this->notesComments['value'] = $r->notesComments;    

    // boat - stops  
    $this->tripType['value'] = PRIVATE_TRIP_ES;
    $this->salesChannel['value'] = CHANNEL_WEB;

    // pricing
    $this->priceList['value'] = CHANNEL_WEB;
    $this->payCurrency['value'] = DOLAR;
    
    // car    
    $this->pickupAddress['value'] = $r->pickupAddress;
    $this->carPickupTime['value'] = $r->carPickupTime;
    $this->departureTime['value'] = $r->departureTime;

    //completes
    $this->completeMeetingPoint['value'] = NONE;
    $this->completePayOnIsland['value'] = NONE;
    $this->CompleteContact['value'] = NONE;
  }

  public function calculatePrice() {    
    $this->priceDetail = $this->calculator->calculatePrice($this->myBoat, $this->myTrip);
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

    // boat - stops
    // transform schedule in a common function
    if ($r->schedule !== FULL_DAY) {
      $this->schedule['value'] = $t->trans($r->schedule);
    } else {
      $this->schedule['value'] = SCH_FULL_DAY_ES;
    }
    
    $this->tripDuration['value'] = $t->trans($r->tripDuration); 

    // traducidos en front ? @todo
    $this->mood1['value'] = $this->setStopSchedule();
    $this->mood2['value'] = $t->trans($r->mood2);
    // price
    $this->payOnIsland['value'] = $t->trans($r->payOnIsland);
    $this->requiredDepositUsd['value'] = $this->findRequiredDeposit();
    $this->estimatedOil['value'] = 'TODO';

    // car
    $this->car['value'] = $t->trans($r->car);
    $this->tigreAddress['value'] = $this->setTigreAddress();
  }  
}
