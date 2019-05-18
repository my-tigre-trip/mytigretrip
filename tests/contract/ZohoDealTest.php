<?php
declare(strict_types=1);

namespace App\Tests\Checkout;

use PHPUnit\Framework\TestCase;
use App\Helpers\Session as SessionHelper;
use App\Helpers\Checkout as CheckoutHelper;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Models\Session;
use App\Models\Calculator;
use App\Models\Wordpress;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Models\ZohoHelpers\Product;
use App\Models\ZohoHelpers\PrivateFormatter;
use App\Controllers\CheckoutController;
use App\Validators\Checkout as CheckoutValidator;

require_once dirname(__DIR__, 2).'/wp-content/themes/gotravel-child/definitions.php';
require_once dirname(__DIR__, 1).'/secrets.php';

class ZohoDealTest extends TestCase {
  
  /**
   * @param ZCRMRecord created by the TripFormater
   * @return Array 
   */
  public function createDeal($payload) {

  }
  
  /**
   * @testdox should send a "Full day - 2 moods - 1 skiing - pay advance" trip and create a Deal well formatted
   * @group PrivateFormatter
   * @covers \App\Models\ZohoHelpers\PrivateFormatter::applyTransformations 
   */
  public function testFullDay_1() {
    require dirname(__DIR__, 2).'/wp-content/themes/gotravel-child/languages/zoho-autocomplete.php';
   
    $t = new Translator('es_AR');
    $t->addLoader('array', new ArrayLoader());
    $t->addResource('array', $zohoAutocomplete_es, 'es_AR');

    $zh = ZohoHandler::getInstance();
    // stub the findRequiredDeposit method - avoid to call directly the zoho Product
    $stubProduct = $this->createMock(Product::class);    
    $stubProduct->method('find')
         ->willReturn(['price' => '20']);
    
   // stub the calculatePrice method - avoid to call directly the zoho Product
    $stubCalculator = $this->createMock(Calculator::class);    
    $stubCalculator->method('calculatePrice')
         ->willReturn( [
            'finalPrice' => '200',
            'boatDetail' => [
                'groupDiscount' => '10',
                'priceBeforeDiscount' => '210',
                'estimatedIslandExpenses' => '0'                
                ]
         ]);

    $dummyTrip = new \stdClass;
    $dummyTrip->lock = 'locked trip';
    
    $payload = CheckoutHelper::mtt('2','1')->fullDay()->fullDaySchedule()
      ->stop(STOP_SKI) // mood1
      ->addStop(STOP_JUNCAL) // mood 2
      ->date('4','1','2025')
      ->contact('John', 'Doe', 'a@a.com', '+55551 1231', 'contact')
      ->altDate('saturday 32')
      ->notes('nothing')
      ->ticket("TEST00000001")
      ->pricing('1000','100','1100','0')
      ->car(INCLUDED, 'plaza italia', '09:00','10:00')
      ->menu('Vegetarian Meal')
      ->additional('1') // one person skiing
      ->payOnIsland()
      ->get();


    $F = new PrivateFormatter($payload, $zh, $t, $stubProduct, $stubCalculator, $dummyTrip);  
    // do your work!
    $F->setup();
    $recordDeal = $F->getZohoDealRecordFormat();
    $dealArray [] = $recordDeal;
    $dealIns = $zh->getModuleInstance('Deals');
    $bulkAPIResponseDeal = $dealIns->createRecords($dealArray);
    // $recordsArray - array of ZCRMRecord instances filled with required data for creation.
    $entityResponsesDeal = $bulkAPIResponseDeal->getEntityResponses();
    $responseData = $entityResponsesDeal[0];  
    $data = $responseData->getData();
    //get the id and then fetch the record
    $dataId = $data->getEntityId();
    $response = $dealIns->getRecord($dataId);
    $record = $response->getData();
    $record = $record->getData();

    #check the fields - in zoho format
    # "Preparativos"
    $this->assertEquals($record['Menu'], 'Menú Vegetariano');
    $this->assertEquals($record['Google_Cal_Salida'], '2025-01-04');
    # "Consultas- Escribir"
    $this->assertEquals($record['Notes_Comments'], 'nothing');
    # "Navegación" - defaults
    
    $this->assertEquals($record['salesChannel'], CHANNEL_WEB);  //camel case in the fure fo all          
    $this->assertEquals($record['Trip_Type'], PRIVATE_TRIP_ES);
    $this->assertEquals($record['Trip_Duration'], FULL_DAY_ES);
    $this->assertEquals($record['Schedule'], SCH_FULL_DAY_ES);       
    # "Pasajeros
    $this->assertEquals($record['Adults'], '2');
    $this->assertEquals($record['Children'], '1');
    $this->assertEquals($record['Additional_Considerations'], '1');
    $this->assertEquals($record['Mood_1'], STOP_SKI);
    $this->assertEquals($record['Mood_2'], STOP_JUNCAL);
    # "Punto de Encuentro"
    $this->assertEquals($record['Car'], INCLUDED_ES);
    $this->assertEquals($record['Tigre_Address'], SARTHOU);
    $this->assertEquals($record['Departure_Time'], '10:00');
    $this->assertEquals($record['Car_Pickup_Time'], '09:00');
    $this->assertEquals($record['Pickup_Address'], 'plaza italia');
    $this->assertEquals($record['Complete_Meeteng_Point'], NONE);
    # "Gastos Isla"
    $this->assertEquals($record['Pay_On_Island'], INCLUDED_IN_PRICE_ES);
    $this->assertEquals($record['Complete_Poi'], NONE);
    $this->assertEquals($record['Estimated_Island_Expenses'], '0');
    # "Precios USD
    $this->assertEquals($record['Final_Price'], '200');    
    $this->assertEquals($record['Price_List'], CHANNEL_WEB);
    // $this->assertEquals($record['Pay_Currency'], 'u$d');
    $this->assertEquals($record['Required_Deposit_USD'], '20');
    # "Contacto"
    $this->assertEquals($record['First_Name'], 'John');
    $this->assertEquals($record['Last_Name'], 'Doe');
    $this->assertEquals($record['E_Mail'], 'a@a.com');
    $this->assertEquals($record['Phone'], '+55551 1231');
    $this->assertEquals($record['Alternative_Contact_Information'], 'contact');
    $this->assertEquals($record['Complete_Contact'], NONE);
    # Zoho fields
    $this->assertEquals($record['Deal_Name'], '#TEST00000001 | John Doe');   
    $this->assertEquals($record['Stage'], STAGE_FORM_WEB_ES);           
    
    # not in view
    $this->assertEquals($record['Amount'], '200');    
    $this->assertEquals($record['Alternative_Dates'], 'saturday 32');  
    $this->assertEquals($record['Ticket_Number'], 'TEST00000001');
    $this->assertEquals($record['Price_Before_Discount'], '210');
    $this->assertEquals($record['Group_Discount'], '10');
    
    // deal owner
    // $this->assertEquals($record['emailStatus'], 'TODO');          
    // $this->assertEquals($valuesArray['estimatedOil'], TODO);
  }
}