<?php
declare(strict_types=1);

namespace App\Tests\Checkout;

use PHPUnit\Framework\TestCase;
use App\Helpers\Session as SessionHelper;
use App\Helpers\Checkout as CheckoutHelper;
use App\Models\Session;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\PrivateFormatter;
use App\Models\ZohoHelpers\Product;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

require_once dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/definitions.php';


class PrivateFormatterTest extends TestCase
{
  protected $apiNames = [];
  protected $assignKeys = [
    'ticketNumber', 'firstName', 'lastName', 'phone', 'email', 'alternativeContact',
    'adults', 'children', 'alternativeDates', 'notesComments', 'tripType', 'salesChannel',
    'pickupAddress', 'carPickupTime', 'departureTime'
  ];
  protected $transformationKeys = [];
  public static function setUpBeforeClass () {
    
  }
  
  /**
   * @testdox should set the properly date format for zoho crm
   * @group PrivateFormatter
   * @covers  \App\Models\ZohoHelpers\PrivateFormatter::setGoogleDate
   */
  public function testSetGoogleDate() {
    $payload = CheckoutHelper::date('1', '1', '1980')->get();
    $c = new PrivateFormatter($payload, null, null, null, null, null);    
    $formattedDateName = $c->setGoogleDate();
    $this->assertEquals($formattedDateName, '1980-01-01');
  }

  /**
   * @testdox should set the properly deal name
   * @group PrivateFormatter
   * @covers  \App\Models\ZohoHelpers\PrivateFormatter::setDealName
   */
  public function testDealName() {
    $payload = CheckoutHelper::contact('John', 'Doe')->ticket('00001')->get();
    $c = new PrivateFormatter($payload, null, null, null, null, null);    
    $formattedDealName = $c->setDealName();
    $this->assertEquals($formattedDealName, '#'.$payload['ticketNumber'].' | '.$payload['firstName'].' '.$payload['lastName']);
  }

  /**
   * @testdox should set the properly stop appendix string for morning or afternoon
   * @group PrivateFormatter
   * @covers \App\Models\ZohoHelpers\PrivateFormatter::setStopSchedule
   */
  public function testSetStopSchedule() {
    require dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/languages/zoho-autocomplete.php';
    $t = new Translator('es_AR');
    $t->addLoader('array', new ArrayLoader());
    $t->addResource('array', $zohoAutocomplete_es, 'es_AR');
    
    //half day morning juncal
    $payload = CheckoutHelper::halfDay()->morning()->stop(STOP_JUNCAL)->get();
    $c = new PrivateFormatter($payload, null, $t, null, null, null);    
    $formattedStopName = $c->setStopSchedule();
    $this->assertEquals($formattedStopName, STOP_JUNCAL.' '.MORNING_STOP);

    //half day afternoon juncal
    $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_JUNCAL)->get();
    $c = new PrivateFormatter($payload, null, $t, null, null, null);    
    $formattedStopName = $c->setStopSchedule();
    $this->assertEquals($formattedStopName, STOP_JUNCAL.' '.AFTERNOON_STOP);

    // morning Deltaventura
    $payload = CheckoutHelper::halfDay()->morning()->stop(STOP_DELTAVENTURA)->get();
    $c = new PrivateFormatter($payload, null, $t, null, null, null);    
    $formattedStopName = $c->setStopSchedule();    
    $this->assertEquals($formattedStopName, STOP_DELTAVENTURA);

    // afternoon Flyboard
    $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_FLYBOARD)->get();
    $c = new PrivateFormatter($payload, null, $t, null, null, null);    
    $formattedStopName = $c->setStopSchedule();    
    $this->assertEquals($formattedStopName, STOP_FLYBOARD);

    // afternoon Esqui
    $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_SKI)->get();
    $c = new PrivateFormatter($payload, null, $t, null, null, null);    
    $formattedStopName = $c->setStopSchedule();    
    $this->assertEquals($formattedStopName, STOP_SKI);
  }
 
  /**
   * @testdox should set the properly asigned values
   * @group PrivateFormatter
   * @covers \App\Models\ZohoHelpers\PrivateFormatter::assignValues
   * @todo remove pricing from here
   */
  public function testAssignedValues(){
    $payload = CheckoutHelper::mtt('2','1')->halfDay()->afternoon()->stop(STOP_SKI)
      ->contact('John', 'Doe', 'a@a.com', '+55551 1231', 'contacr')
      ->altDate('saturday 32')
      ->notes('nothing')
      ->ticket('00000001')
      ->pricing('1000','100','1100','0')
      ->car(INCLUDED, 'plaza italia', '09:00','10:00')
      ->get();
    $c = new PrivateFormatter($payload, null, null, null, null, null);    
    $c->assignValues();   
    $valuesArray = $c->toArray();
    
    #check the fields
    $this->assertEquals($valuesArray['stage'], STAGE_FORM_WEB_ES);
    $this->assertEquals($valuesArray['ticketNumber'], '00000001');
    $this->assertEquals($valuesArray['firstName'], 'John');
    $this->assertEquals($valuesArray['lastName'], 'Doe');
    $this->assertEquals($valuesArray['phone'], '+55551 1231');
    $this->assertEquals($valuesArray['email'], 'a@a.com');
    $this->assertEquals($valuesArray['alternativeContact'],'contacr');
    $this->assertEquals($valuesArray['adults'],'2');
    $this->assertEquals($valuesArray['children'],'1');
    $this->assertEquals($valuesArray['alternativeDates'],'saturday 32');
    $this->assertEquals($valuesArray['notesComments'],'nothing');
    $this->assertEquals($valuesArray['tripType'], PRIVATE_TRIP_ES);
    $this->assertEquals($valuesArray['salesChannel'], CHANNEL_WEB);
    $this->assertEquals($valuesArray['pickupAddress'],'plaza italia');
    $this->assertEquals($valuesArray['carPickupTime'],'09:00');
    $this->assertEquals($valuesArray['departureTime'],'10:00');
  }

  /**
   * @testdox should set the properly transformed values
   * @group PrivateFormatter
   * @covers \App\Models\ZohoHelpers\PrivateFormatter::applyTransformations 
   */
  public function testTransformedValues() {
    require dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/languages/zoho-autocomplete.php';
   
    $t = new Translator('es_AR');
    $t->addLoader('array', new ArrayLoader());
    $t->addResource('array', $zohoAutocomplete_es, 'es_AR');

    $zh = ZohoHandler::getInstance();
    // stub the findRequiredDeposit method - avoid to call directly the zoho Product
    $stubProduct = $this->createMock(Product::class);    
    $stubProduct->method('find')
         ->willReturn( array(
           'price' => '20'
          ));


    $payload = CheckoutHelper::mtt('2','1')->fullDay()->fullDaySchedule()
      ->stop(STOP_SKI) // mood1
      ->addStop(STOP_JUNCAL) // mood 2
      ->date('4','1','2025')
      ->contact('John', 'Doe', 'a@a.com', '+55551 1231', 'contacr')
      ->altDate('saturday 32')
      ->notes('nothing')
      ->ticket('00000001')
      ->pricing('1000','100','1100','0')
      ->car(INCLUDED, 'plaza italia', '09:00','10:00')
      ->menu('Vegetarian Meal')
      ->additional('Lunch + 1 Activity')
      ->payOnIsland()
      ->get();
    $c = new PrivateFormatter($payload, $zh, $t, $stubProduct, null, null);    
    $c->applyTransformations();   
    $valuesArray = $c->toArray();
    
    #check the fields
    $this->assertEquals($valuesArray['dealName'], '#00000001 | John Doe');
    
    $this->assertEquals($valuesArray['menu'], 'Menú Vegetariano');
    $this->assertEquals($valuesArray['additionalConsiderations'], 'Almuerzo + 1 Actividad');
    $this->assertEquals($valuesArray['dateCalendar'], '2025-01-04');
    $this->assertEquals($valuesArray['schedule'], SCH_FULL_DAY_ES);
    $this->assertEquals($valuesArray['tripDuration'], FULL_DAY_ES);
    $this->assertEquals($valuesArray['mood1'], STOP_SKI);
    $this->assertEquals($valuesArray['mood2'], STOP_JUNCAL);
    $this->assertEquals($valuesArray['payOnIsland'], INCLUDED_IN_PRICE_ES);
    $this->assertEquals($valuesArray['requiredDepositUsd'], '20');
    
    $this->assertEquals($valuesArray['car'], INCLUDED_ES);
    $this->assertEquals($valuesArray['tigreAddress'], SARTHOU);

    // $this->assertEquals($valuesArray['emailStatus'], 'TODO');      
    // $this->assertEquals($valuesArray['estimatedOil'], CHANNEL_WEB);
  }



}