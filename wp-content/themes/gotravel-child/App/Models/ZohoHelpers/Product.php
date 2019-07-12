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

  public function findMockResults() {
    return \App\Helpers\Product::products();
  }


  /**
   * fetch one product/tour using products array $zohoProductsArray
   * @param $value String identifier of the product
   * @param $criteria sku by default
   * @param $multi if true return an array of occuerrences else return the firs occurence
   */
  public function find($value, $criteria = 'sku', $multi = false) {    
    // $zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
    // $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("($criteria:equals:$value)");
    // $recordsArray = $bulkAPIResponse->getData();    
    $tour = null;    
    $zohoProductsArray = $GLOBALS['zohoProductsArray']; // improve this
    //$zohoProductsArray = getZohoProductsArray();
    foreach ($zohoProductsArray as $product) {
      // $data = $d->getData();
      if ($product[$criteria] === $value) {
        if($multi) {
          $tour[] = $product;
        } else {          
          $tour = $product;
          break;
        }        
      }
    }
    return $tour;                                       
  }

  public function findBoatPrices($boat) {

    $boatPrices = [];    
    $zohoProductsArray = $GLOBALS['zohoProductsArray'];
    
    foreach($zohoProductsArray as $p) {
      if (strpos($p['sku'], $boat) !== false) {
        $boatPrices[] = $p;
      }      
    }
    return $boatPrices;
  }

  public function response() {

  }

  private function filterEvents() {
    
  }
}