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

  public function findBoatPrices($boat, $a, $guide = false) {

    $boatPrices = [];    
    $zohoAgenciesArray = $GLOBALS['zohoAgenciesArray'];
    
    // find the agency by ID
    $agency = $zohoAgenciesArray[$a];
    // return array of prices
    $prices = null;

    if($guide) {
      switch ($boat) {
        case 'half-day':
          $prices = [
            // half day guide
            $this->mockPriceArray($agency, 'half_day_2_g', true),
            $this->mockPriceArray($agency, 'half_day_3_g', false),
            $this->mockPriceArray($agency, 'half_day_4_g', false),
            $this->mockPriceArray($agency, 'half_day_5_g', false),
            $this->mockPriceArray($agency, 'half_day_children_g', false)
          ];
          break;
        case 'full-day':
         $prices = [        
            // full day      
            $this->mockPriceArray($agency, 'full_day_2_g', true),
            $this->mockPriceArray($agency, 'full_day_3_g', false),
            $this->mockPriceArray($agency, 'full_day_4_g', false),
            $this->mockPriceArray($agency, 'full_day_5_g', false),
            $this->mockPriceArray($agency, 'full_day_children_g', false)
          ];
          break;
        default:
          break;
      }      
    } else {
      switch ($boat) {
        case 'half-day':
          $prices = [
            // half day guide
            $this->mockPriceArray($agency, 'half_day_2', true),
            $this->mockPriceArray($agency, 'half_day_3', false),
            $this->mockPriceArray($agency, 'half_day_4', false),
            $this->mockPriceArray($agency, 'half_day_5', false),
            $this->mockPriceArray($agency, 'half_day_children', false)
          ];
          break;
        case 'full-day':
         $prices = [        
            // full day      
            $this->mockPriceArray($agency, 'full_day_2', true),
            $this->mockPriceArray($agency, 'full_day_3', false),
            $this->mockPriceArray($agency, 'full_day_4', false),
            $this->mockPriceArray($agency, 'full_day_5', false),
            $this->mockPriceArray($agency, 'full_day_children', false)
          ];
          break;
        default:
          break;
      }
    }

    return $prices;
  }

    // foreach($zohoAgenciesArray as $p) {
    //   if (strpos($p['sku'], $boat) !== false) {
    //     $boatPrices[] = $p;
    //   }      
    // }
    // return $boatPrices;

  public function mockPriceArray($array, $key, $isBase) {
    $sku = str_replace('_g', '', $key);
    return [
      'isBase' => $isBase,
      'sku' => str_replace('_', '-', $sku),
      'price' => $array[$key]
    ];
  }
}