<?php
require __DIR__.'/../vendor/autoload.php';
require '../wp-load.php';
require get_stylesheet_directory().'/languages/zoho-autocomplete.php';
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

$V = new CheckoutValidator();
$T = new Translator('es_AR');
$T->addLoader('array', new ArrayLoader());
$T->addResource('array', $zohoAutocomplete_es, 'es_AR');

$myTrip = Session::getInstance()->getMyTrip();
$zohoHandler = ZohoHandler::getInstance();
$zohoHandler->auth();

$product = new Product();
$calculator = new Calculator($product);
$formatter = new PrivateFormatter($_POST, $zohoHandler, $T, $product, $calculator, $myTrip);
# Get JSON as a string
//$json_str = file_get_contents('php://input');
# Get as an object
//$json_obj = json_decode($json_str);


$c = new CheckoutController();
$c->checkout($_POST, Wordpress::getInstance(), Session::getInstance(), $zohoHandler, $V, $T, $formatter);


die();

$dealIns = ZCRMModule::getInstance("Deals");
$bulkAPIResponseDeal = $dealIns->createRecords($dealArray);
// $recordsArray - array of ZCRMRecord instances filled with required data for creation.
$entityResponsesDeal = $bulkAPIResponseDeal->getEntityResponses();

foreach ($entityResponsesDeal as $entityResponse) {
  //
  $data = '';
  $data .= " Status:".$entityResponse->getStatus();
  $data .= " Message:".$entityResponse->getMessage();
  $data .= " Code:".$entityResponse->getCode();
  $createdRecordInstance = $entityResponse->getData();
  if("success"==$entityResponse->getStatus()) {
    $response['redirect'] = home_url().'/my-trip-checkout';
    $dealId =  $createdRecordInstance->getEntityId();
    $data .= " EntityID:".$createdRecordInstance->getEntityId();
    $data .= " moduleAPIName:".$createdRecordInstance->getModuleAPIName();
  } else {
      print_r($entityResponse);
  }
  $response['data'][] = $data;

  //print_r($entityResponse);
  $response['status'] = $entityResponse->getStatus();
}

echo jsonResponse($response);

$controller = new CheckoutController();

die();


/**
 * @todo hacer mas modular el script para deals
 * @todo organizar calculables
 * 
 **/
if ($_POST['_token'] === Session::id()) {


  
  validateRequiredFields();
  $recordDeal = ZohoHandler::getRecordInstance('Deals');

  $date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
  $date->setDate(intval($_POST['year']), intval($_POST['month']), intval($_POST['day']));
  $weekDay = $date->format('l');
  $month = $date->format('F');

  // configuramos horario
  $time = '';
  if (!$_POST['Car'] === INCLUDED) {
    $timeHour = date("H", strtotime($_POST['carPickupTime']));
    $timeMinute = date("i", strtotime($_POST['carPickupTime']));
  } else {    
    $timeHour = date("H", strtotime($_POST['departureTime']));
    $timeMinute = date("i", strtotime($_POST['departureTime']));
  }
  
  $date->setTime(intval($timeHour), intval($timeMinute));  
  $googleCal = $date->format('Y-m-d');
 
  
  // deal info data
  $recordDeal->setFieldValue("Source", SOURCE_WEB);
  $recordDeal->setFieldValue("Price_List", SOURCE_WEB);
  $recordDeal->setFieldValue("Stage", STAGE_FORM_WEB);
  $recordDeal->setFieldValue("Ticket_Number", "$_POST[ticketNumber]");
  $recordDeal->setFieldValue("Email_Status", PENDING); #check
  $recordDeal->setFieldValue("Trip_Type", $t->trans($_POST['tripType'])); #check

  // personal data
  $recordDeal->setFieldValue("First_Name", "$_POST[firstName]");
  $recordDeal->setFieldValue("Last_Name", "$_POST[lastName]");
  $recordDeal->setFieldValue("E_Mail", "$_POST[email]");
  $recordDeal->setFieldValue("Phone", "$_POST[phone]");
  $recordDeal->setFieldValue("Alternative_Contact_Information", "$_POST[alternativeContact]");
  
  // trip date
  $recordDeal->setFieldValue("Day", "$_POST[day]");
  $recordDeal->setFieldValue("Month", "$_POST[month]");
  $recordDeal->setFieldValue("Year", "$_POST[year]");
  // fecha
  $recordDeal->setFieldValue("Google_Cal_Salida", "$googleCal");
  $recordDeal->setFieldValue("Week_Day", "$weekDay");
  $recordDeal->setFieldValue("Alternative_Dates", "$_POST[alternativeDates]");

  if (!empty($_POST['alternativeDates'])) {
      $recordDeal->setFieldValue("Can_Change_Date", YES);
  } else {
      $recordDeal->setFieldValue("Can_Change_Date", NO);
  }

  $fullDay = $_POST['tripBoat'] === FULL_DAY ? true : false;  

  if ($fullDay) {    
    $recordDeal->setFieldValue("Schedule", FULL_DAY_ES);
  } else {
    $recordDeal->setFieldValue("Schedule", $t->trans($_POST["schedule"]));
}

  //trip Details
  $recordDeal->setFieldValue("Adults", "$_POST[adults]");
  $recordDeal->setFieldValue("Children", "$_POST[children]");

  $mood1 = $t->trans($_POST['mood1']);
  $mood2 = $t->trans($_POST['mood2']);
  $menu = $t->trans($_POST['specialMenuRequirements']);
  $additionalConsiderations = $t->trans($_POST['additionalConsiderations']);

  $recordDeal->setFieldValue("Trip_Duration", $t->trans($_POST['tripDuration']));//navegacion
  $recordDeal->setFieldValue("Mood_1", "$mood1");
  $recordDeal->setFieldValue("Mood_2", "$mood2");
  $recordDeal->setFieldValue("Additional_Considerations", $additionalConsiderations);
  $recordDeal->setFieldValue("Water_Sport", "$_POST[waterSport]");

// car
  $recordDeal->setFieldValue("Car", $t->trans($_POST["car"])); #check
  $recordDeal->setFieldValue("Departure_Time", "$_POST[departureTime]");
  $recordDeal->setFieldValue("Car_Pickup_Time", "$_POST[carPickupTime]");
  $recordDeal->setFieldValue("Pickup_Address", "$_POST[pickupAddress]");

  if (!$_POST['Car'] === INCLUDED) {
      $recordDeal->setFieldValue("Send_Map", true);
  } else {
      $recordDeal->setFieldValue("Send_Map", false);
  }

  // more info
  $recordDeal->setFieldValue("Menu", $menu);
  $recordDeal->setFieldValue("Notes_Comments", "$_POST[notesComents]");

  //prices
  $recordDeal->setFieldValue("Pay_On_Island", $t->trans($_POST['islandExpenses'])); #check
  //$recordDeal->setFieldValue("Self_Paid_Text", "$_POST[payOnIslandText]");
  $recordDeal->setFieldValue("Estimated_Island_Expenses", "$_POST[estimatedIslandExpenses]");
  $recordDeal->setFieldValue("Amount", "$_POST[amount]");
  $recordDeal->setFieldValue("Final_Price", "$_POST[amount]");
  //senha
  $recordDeal->setFieldValue("Advance_Status", NOT_PAID_ES); //estado senha
  $requiredDeposit = \App\Models\Woo::findProduct('required-deposit')->price;
  $recordDeal->setFieldValue("Required_Deposit_USD", "$requiredDeposit");
  $duePayment = intval($_POST['amount']) - $requiredDeposit;
  $recordDeal->setFieldValue("Due_Payment", "$duePayment");

  $recordDeal->setFieldValue("Group_Discount", "$_POST[groupDiscount]");
  $recordDeal->setFieldValue("Price_Before_Discount", "$_POST[priceBeforeDiscount]");
  $recordDeal->setFieldValue("Advance_Status_Yacht", NOT_PAID_ES);

//Autocomplete i/e

  $details = "$_POST[mood1] $_POST[mood2] | $_POST[adults] adults - $_POST[children] children";
  $dealName = "#$_POST[ticketNumber] - $_POST[firstName] $_POST[lastName]";
 //temporada 2
  $dressCode = $t->trans('smiles');
  if ($_POST['mood1'] == 'An Ecology Reserve' || $_POST['mood1'] == 'A Family Ranch') {
      $dressCode = $t->trans('dress_code_reserve').' '.$dressCode;
  }

  $recordDeal->setFieldValue("Deal_Name", "$_POST[firstName] $_POST[lastName] - $_POST[email]");

  $dealArray [] = $recordDeal;
  $dealId = '';
  //
  $response = [];
  
  $dealIns = ZCRMModule::getInstance("Deals");
  $bulkAPIResponseDeal= $dealIns->createRecords($dealArray);
  // $recordsArray - array of ZCRMRecord instances filled with required data for creation.
  $entityResponsesDeal = $bulkAPIResponseDeal->getEntityResponses();

  foreach ($entityResponsesDeal as $entityResponse) {
    //
    $data = '';
    $data .= " Status:".$entityResponse->getStatus();
    $data .= " Message:".$entityResponse->getMessage();
    $data .= " Code:".$entityResponse->getCode();
    $createdRecordInstance=$entityResponse->getData();
    if("success"==$entityResponse->getStatus()) {
      $response['redirect'] = home_url().'/my-trip-checkout';
      $dealId =  $createdRecordInstance->getEntityId();
      $data .= " EntityID:".$createdRecordInstance->getEntityId();
      $data .= " moduleAPIName:".$createdRecordInstance->getModuleAPIName();
    } else {
        print_r($entityResponse);
    }
    $response['data'][] = $data;

    //print_r($entityResponse);
    $response['status'] = $entityResponse->getStatus();
}
}

echo jsonResponse($response);