<?php 

namespace App\Models\ZohoHelpers;
use App\Models\ZohoHelpers\ZohoHandler;

class Agency {
  public static function getInstance() {
    return new self();
  }  

  /**
   * fetch one agency/tour using agencys array $zohoAgenciesArray
   * @param $value String identifier of the agency
   * @param $criteria sku by default
   * @param $multi if true return an array of occuerrences else return the firs occurence
   */
  public function find($value, $criteria = 'username', $multi = false) {       
    $ag = null;    
    $zohoAgenciesArray = $GLOBALS['zohoAgenciesArray']; // improve this
    
    foreach ($zohoAgenciesArray as $agency) {
      // $data = $d->getData();
      if ($agency[$criteria] === $value) {
        if($multi) {
          $ag[] = $agency;
        } else {          
          $ag = $agency;
          break;
        }        
      }
    }
    return $ag;                                       
  }

  public function findBoatPrices($boat) {

    $boatPrices = [];    
    $zohoAgenciesArray = $GLOBALS['zohoAgenciesArray'];
    
    foreach($zohoAgenciesArray as $p) {
      if (strpos($p['sku'], $boat) !== false) {
        $boatPrices[] = $p;
      }      
    }
    return $boatPrices;
  }

}