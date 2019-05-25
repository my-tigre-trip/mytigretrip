<?php 

namespace App\Models\ZohoHelpers;
use App\Models\ZohoHelpers\ZohoHandler;

class Product {
  public static function getInstance() {
    return new self();
  }  

  /**
   * fetch one or more products
   * @param $value String identifier of the product sku by default
   * @todo improve the foreach transforming all data only if match
   */
  public function findResults($value, $criteria = 'sku') {
    //$date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
    $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("($criteria:equals:$value)");
    $recordsArray = $bulkAPIResponse->getData();
    //$data = $recordsArray->getData();
    $tours = [];
    foreach  ($recordsArray as $d) {
      $data = $d->getData();
      if ($data[$criteria] === $value) {
        $tours[] = $data;        
      }
    }
    return $tours;                                            
  }


  /**
   * fetch one product
   * @param $value String identifier of the product sku by default
   * @todo improve the foreach transforming all data only if match
   */
  public function find($value, $criteria = 'sku') {
    //$date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
    $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("($criteria:equals:$value)");
    $recordsArray = $bulkAPIResponse->getData();
    //$data = $recordsArray->getData();
    $tour = null;
    foreach  ($recordsArray as $d) {
      $data = $d->getData();
      if ($data[$criteria] === $value) {
        $tour = $data;
        break;
      }
    }
    return $tour;                                            
  }

  public function findBoatPrices($boat) {
    try {
      $zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
      $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("(sku:equals:$boat)");
      $recordsArray = $bulkAPIResponse->getData();
    } catch (Exception $e) {
      return [];
    }
    foreach($recordsArray as $i => $r) {
      $recordsArray[$i] = $r->getData();
    }
    return $recordsArray;
  }

  public function response() {

  }

  private function filterEvents() {
    
  }
}