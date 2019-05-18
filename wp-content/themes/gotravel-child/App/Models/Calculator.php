<?php
namespace App\Models;
//use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Woo;
use App\Models\ZohoHelpers\Product as ProductHelper;

class Calculator {
  
    private $P;
    public function __construct(ProductHelper $P) {      
      $this->P = $P;
    }

    public static function boatName($boat)
    {
        return str_replace(['speedboat','half-day','full-day'], ['Speedboat Trip (no stops)','Half Day Trip','Full Day Trip'], $boat);
    }

    /**
    * @param $boat string
    * @param $adults integer
    * @param $children integer
    * @return array
    */

    public function boatPrice($boat) {
      $prices = $this->P->findBoatPrices($boat->boat); 
      
      $people = $boat->adults + $boat->children;
      $basePrice = $this->boatBasePrice($boat->boat, $prices);

      $priceAdultsDiscount = $this->boatAdultsPrice($boat->boat, $boat->adults, $prices);

      $priceChildrenDiscount = 0;
      if (intval($boat->children) > 0) {
        $priceChildrenDiscount = $this->boatChildrenPrice($boat->boat, $boat->children, $prices);
      }
      
      $price = $priceAdultsDiscount+$priceChildrenDiscount;

      $priceBeforeDiscount = $basePrice * $people;
      $groupDiscount = $priceBeforeDiscount-$price;

       return [
           'status' => "valid",
           'boat' => $boat->boatName($boat->boat),
           'adults' => $boat->adults,
           'children' => $boat->children,
           'price' => $price,
           'priceChildren' => $basePrice*$boat->children,
           'discountChildren' => $priceBeforeDiscount - $priceChildrenDiscount,
           'priceAdults' => $basePrice*$boat->adults,
           'discountAdults' => $priceBeforeDiscount - $priceAdultsDiscount,
           'groupDiscount' => $groupDiscount ,
           'priceBeforeDiscount' => $priceBeforeDiscount
        ];
    }

  /**
   * boatBasePrice
   * @param $boat
   * @param $prices
   */
  public function boatBasePrice($boat, $prices) {
    $index = array_search(true, array_column($prices, 'isBase'));
    return intval($prices[$index]['price']);
  }

  /**
   * boatAdultsPrice
   * @param $boat
   * @param $adults
   * @param $prices
   */
  public function boatAdultsPrice($boat, $adults, $prices) {
    $index = array_search($boat.'-'.$adults, array_column($prices, 'sku'));
    return intval($prices[$index]['price']) * intval($adults);
  }

  /**
   * boatChildrenPrice
   * @param $boat
   * @param $children
   * @param $prices
   */
  public function boatChildrenPrice($boat, $children, $prices) {
    $index = array_search($boat.'-children', array_column($prices, 'sku'));
    return intval($prices[$index]['price']) * intval($children);
  }

    /**
    * tourPrice Calcula los precios de las paradas
    * @param array mood1 (y mood2)
    * @return array
    */
    public function tourPrice($mood1, $mood2 = null) {
        $price = 0;
        $price1 = $mood1->getPrice();
        $price = $price1['price'];
        $mood1PriceAdults = $price1['priceAdults'];
        $mood1PriceChildren = $price1['priceChildren'];
        $mood2PriceAdults = 0;
        $mood2PriceChildren = 0;

        //flyboard o ski
        $specialActivity = '';
        $specialActivityPrice = 0;
        $specialActivityPeople = 0;
        if ($mood1->isWaterSport()) {
            $specialActivity = $mood1->product['Special_Activity_Name'];;
            $specialActivityPeople = $mood1->specialActivityPeople;
            $specialActivityPrice = $price1['priceActivity'];
        }

        //mood 2
        $mood2Name = '';
        if ($mood2 !== null) {
            $mood2Name = $mood2->name;
            $price2 = $mood2->getPrice();
            
            $price += $price2['price'];
            $mood2PriceAdults = $price2['priceAdults'];
            $mood2PriceChildren = $price2['priceChildren'];
            if ($mood2->isWaterSport()) {
                $specialActivity = $mood2->waterSport;
                $specialActivityPeople = $mood2->specialActivityPeople;
                $specialActivityPrice = $price2['priceActivity'];
            }
        }

        return [
          'status' => "valid",
          'mood1' => $mood1->name,
          'mood1PriceAdults' => $mood1PriceAdults,
          'mood1PriceChildren' => $mood1PriceChildren,

          'mood2' => $mood2Name,
          'mood2PriceAdults' => $mood2PriceAdults,
          'mood2PriceChildren' => $mood2PriceChildren,

          'specialActivity' => "$specialActivity",
          'specialActivityPrice' => $specialActivityPrice,
          'specialActivityPeople' => $specialActivityPeople,

          'additionalConsiderations' => "$additionalConsiderations",
          'price' => $price
        ];
    }

    /**
    *
    *
    */
    public function calculatePrice($boat, $myTrip = null) {
        $boatPrice = $this->boatPrice($boat);
        // if has stops
        if ($boat->boat === HALF_DAY) {
          $tourPrice = $this->tourPrice($boat->mood1);
        } elseif ($boat->boat === FULL_DAY) {
            $tourPrice = self::tourPrice($boat->mood1, $boat->mood2);
        }

        $finalPrice = $boatPrice['price'];
        $priceAdults = $boatPrice['priceAdults'];
        $priceChildren = $boatPrice['priceChildren'];
        $priceSpecialActivity = 0;
        $estimatedIslandExpenses = $tourPrice['price'];;

        $payAdvance = $myTrip !== null? !$myTrip->payOnIsland: true;
        if ($payAdvance) {
            $finalPrice += $tourPrice['price'];
            $priceAdults += $tourPrice['mood1PriceAdults'] + $tourPrice['mood2PriceAdults'];
            $priceChildren += $tourPrice['mood1PriceChildren'] + $tourPrice['mood2PriceChildren'];
            //$priceSpecialActivity = $priceSpecialActivity;
            $estimatedIslandExpenses = 0;
        }

        //car
        $priceCar = 0;
        if ($myTrip !== null && $myTrip->car) {
            $priceCar = $this->P->find('car');
            $finalPrice += $priceCar['price'];
        }

        return [
           'boatDetail' => $boatPrice,
           'tourDetail' => $tourPrice,
           'priceAdults' => $priceAdults,
           'priceChildren' => $priceChildren,
           'priceSpecialActivity' => $priceSpecialActivity,
           'priceCar' => $priceCar['price'],
           'finalPrice' => $finalPrice,
           'estimatedIslandExpenses' => $estimatedIslandExpenses
        ];
    }
}
