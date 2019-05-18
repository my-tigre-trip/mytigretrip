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
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

require dirname(__DIR__, 3).'/definitions.php';


class MyTripPageTest extends TestCase
{
  protected $assignKeys = [];
  public static function setUpBeforeClass () {
    
  } 
  
  /**
   * 
   */
  // public function testAllPrivateFieldsIncluded() {

  // }

  /**
   * 
   */
  // public function testFieldsLoaded() {
      
  // }

  /**
   * @testdox should set the properly date format for zoho crm
   * @group PrivateFormatter
   * @covers  \App\Models\ZohoHelpers\PrivateFormatter::setGoogleDate
   */
  public function testSetGoogleDate() {
    $payload = CheckoutHelper::date('1', '1', '1980')->get();
    $c = new PrivateFormatter($payload, null, null, null);    
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
    $c = new PrivateFormatter($payload, null, null, null);    
    $formattedDealName = $c->setDealName();
    $this->assertEquals($formattedDealName, '#'.$payload['ticketNumber'].' | '.$payload['firstName'].' '.$payload['lastName']);
  }

  /**
   * @testdox should set the properly stop appendix string for morning or afternoon
   * @group PrivateFormatter
   * @covers \App\Models\ZohoHelpers\PrivateFormatter::setStopSchedule
   */
  public function testSetStopSchedule() {
    $a = include dirname(__DIR__, 3).'/languages/zoho-autocomplete.php';
    $t = new Translator('es_AR');
    $t->addLoader('array', new ArrayLoader());
    $t->addResource('array', $zohoAutocomplete_es, 'es_AR');

    //half day morning juncal
    $payload = CheckoutHelper::halfDay()->morning()->stop(STOP_JUNCAL)->get();
    $c = new PrivateFormatter($payload, null, $t, null);    
    $formattedStopName = $c->setStopSchedule();
    $this->assertEquals($formattedStopName, STOP_JUNCAL.' '.MORNING_STOP);

    //half day afternoon juncal
    $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_JUNCAL)->get();
    $c = new PrivateFormatter($payload, null, $t, null);    
    $formattedStopName = $c->setStopSchedule();
    $this->assertEquals($formattedStopName, STOP_JUNCAL.' '.AFTERNOON_STOP);

    // morning Deltaventura
    $payload = CheckoutHelper::halfDay()->morning()->stop(STOP_DELTAVENTURA)->get();
    $c = new PrivateFormatter($payload, null, $t, null);    
    $formattedStopName = $c->setStopSchedule();    
    $this->assertEquals($formattedStopName, STOP_DELTAVENTURA);

    // afternoon Flyboard
    $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_FLYBOARD)->get();
    $c = new PrivateFormatter($payload, null, $t, null);    
    $formattedStopName = $c->setStopSchedule();    
    $this->assertEquals($formattedStopName, STOP_FLYBOARD);

     // afternoon Esqui
     $payload = CheckoutHelper::halfDay()->afternoon()->stop(STOP_SKI)->get();
     $c = new PrivateFormatter($payload, null, $t, null);    
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
     $c = new PrivateFormatter($payload, null, null, null);    
     $c->assignValues();   
     $valuesArray = $c->toArray();

    #check the fields
  }

}