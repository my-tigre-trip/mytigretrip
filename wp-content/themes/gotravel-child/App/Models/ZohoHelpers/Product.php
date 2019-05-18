<?php 

namespace App\Models\ZohoHelpers;
use App\Models\ZohoHelpers\ZohoHandler;
use DateTime;
use DateTimeZone;

class Product {
  public static function getInstance() {
    return new self();
  }  

  /**
   * @param $sku String identifier of the product
   */
  public function find($sku) {
    //$date = new DateTime('', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
    $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("(sku:equals:$sku)");
    $recordsArray = $bulkAPIResponse->getData();
    //$data = $recordsArray->getData();
    $tour = null;
    foreach  ($recordsArray as $d) {
      $data = $d->getData();
      if ($data['sku'] === $sku) {
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