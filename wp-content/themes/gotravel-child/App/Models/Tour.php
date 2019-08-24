<?php

namespace App\Models;
use App\Models\Woo;

class Tour
{
  public $product;
  public $category;
  public $boat;
  public $mood; // 1 or 2

  public $id;
  public $slug;
  public $specialActivityPeople; //activity
  public $children;
  public $adults;
  public $price;
  public $name;

  public $waterSport;
  public $optional = null;
  public $optionalSelected;
  public $schedule;
  public $notCompatible;

  private $P; // Product zoho helper dependence
  private $translator;

  /**
   * @param $sku String product sku
   * @param $P App\Models\ZohoHelpers\Product
   */
  public function __construct($sku, $P)
  {
    $this->P = $P;
    
    if ($sku !== null) {     
      $this->optionalSelected = false; // luxury & ranch
      
      $this->product = $this->P->find($sku);
      $p = $this->product;

      $this->category = $p['categoryId'];
      $this->mood = $p['mood']; 
      $this->boat = $this->boat();
      $this->id = $product->id;
      $this->slug = $sku;
      $this->waterSport = $p['activityId'];      
      $this->price = $p['price'];
      $this->name = $p['name_en'];            
      $this->notCompatible =  $p['notCompatible'];           
      $this->optional =  $p['optionId'];
      $this->schedule =  $p['schedule'];          
    }
  }

    /**
    * get the tour price
    *
    */
    public function getPrice() {
      $p = $this->product;
      $price = $p['price'];
        $priceAdults = 0;
        $priceChildren = 0;
        $priceActivity = 0;

      if ($p['hasActivity']) {
        $priceActivity = $price * $this->specialActivityPeople ;
      } elseif (!empty($p['optionId'])) {
        if ($this->isRanch()) {
            $priceOptional = !$this->optionalSelected ? $p['optionPrice'] : 0;
        } else {
            $priceOptional = $this->optionalSelected ? $p['optionPrice'] : 0;
        }
            # chequear si esta seleccionada la opcion
            $priceAdults = ($price + $priceOptional) * $this->adults;
            $priceChildren = ($price + $priceOptional) * $this->children;
        } else {
            $priceAdults = $price * $this->adults;
            $priceChildren = $price * $this->children;
        }
        return [
            'priceAdults' => $priceAdults,
            'priceChildren' => $priceChildren,
            'priceActivity' => $priceActivity,
            'price' => $priceAdults + $priceChildren + $priceActivity
        ];
    }
  
  /**
   * @return String returns the boat based on category 
   **/  
  public function boat() {
    $boat = '';
    $cat = $this->category;
    if($cat === PRE_BUILT || $cat === BYO_STOP || $cat === BYO_LUNCH) {
      $boat = FULL_DAY;
    } elseif($cat === HALF_DAY_STOP || $cat === HALF_DAY_LUNCH) {
      $boat = HALF_DAY;
    } else {
      $boat = SPEEDBOAT;
    }

    return $boat;
  }    

  /**
   * 
   */
  public function hasOptional() {
    return (!empty( $this->product['optionId']) &&  $this->product['optionEnabled']);
  }

  public function isLuxury() {
    return $this->product['optionId'] === 'luxury';
  }

  public function isRanch() {
    return $this->product['optionId'] === 'ranch';
  }

    /*ski*/
  public function isSki() {
      return $this->waterSport !== null && !empty($this->waterSport) && $this->waterSport === 'Ski';
  }

    /*flyboard*/
  public function isFlyboard() {
    return $this->waterSport !== null && !empty($this->waterSport) && $this->waterSport === 'Flyboard';
  }

  /*flyboard*/
  public function isWaterSport() {
    return $this->product['hasActivity'];
  }

  public function isMorning() {
    return empty($this->schedule) 
      || strpos(strtolower($this->schedule), 'morning') !== false 
      || $this->schedule === MORNING_ES
      ;
  }

  public function isAfternoon() {
    return ( empty($this->schedule))
      || strpos(strtolower($this->schedule), 'afternoon') !== false
      || $this->schedule === AFTERNOON_ES
      ;
  }

  public function areChildrenAllowed() {
    return $this->product['allowChildren'];
  }

    public function isGroup() {
        #todo
    }
    public function isYacth() {
        #todo
    }
}
