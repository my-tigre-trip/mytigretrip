<?php

class MyTrip{
    public $id;
    public $session;
    public $stage;

    public $boat;
    public $adults;
    public $children;
    public $specialActivity;
  //  public $specialActivityName;

    //opciones de tour
    public $isSpeedBoatTour;
    public $halfStop;
    public $halfLunch;
    public $fullStop;
    public $fullLunch;
    public $preBuilt;

    //opcionales
    public $car;
    public $luxury;
    public $isLuxury;
    public $payOnIsland;
    public $ranch;
    public $isRanch;
    public $waterSport;

// precio
    public $price;
    public $boatPrice;
    public $boatPriceAdults;
    public $boatPriceChildren;
    public $boatPriceAdultsDiscount;
    public $boatPriceChildrenDiscount;
    public $waterSportPrice;
    public $tourPrice;
    public $tourPriceAdults;
    public $tourPriceChildren;
    public $carPrice;
    public $luxuryPrice;
    public $ranchPrice;
    public $currency;
    public $groupDiscount;
    public $isPriceValid;

    public $priceAdults;
    public $priceChildren;

    public $pricePerAdult;
    public $pricePerChildren;

    public $tourBoatCategories;

    //form
    public $firstName;
    public $lastName;
    public $contactEmail;
    public $contactPhone;
    public $contactOther;

    public $day;
    public $month;
    public $year;
    public $alternativeDates;
    public $pickUpAddress;
    public $timeOptions;

    public $sendTo;
    public $foodType;
    public $message;
    //ir a MyTrip o a elegir siguiente parada
    public $goto;

    public $finished;


    public function __construct($session)
    {
        $this->id = null;

        $this->session = $session;
        $this->stage = 'calculator';
        $this->boat = null;
        $this->adults = 0;
        $this->children = 0;
        $this->specialActivities = null;
      //  $this->specialActivityName = null;

        $this->isSpeedBoatTour = false;
        $this->halfStop = null;
        $this->halfLunch = null;
        $this->fullStop = null;
        $this->fullLunch = null;
        $this->preBuilt = null;

        $this->car = false;
        $this->luxury = false;
        $this->isLuxury = false;
        $this->payOnIsland = false;
        $this->isRanch = false;
        $this->ranch = false;
        $waterSport = '';

        $this->price = 0;
        $this->boatPrice = 0;
        $this->boatPriceAdults = 0;
        $this->boatPriceChildren = 0;
        $this->boatPriceAdultsDiscount = 0;
        $this->boatPriceChildrenDiscount = 0;
        $this->tourPrice = 0;
        $this->tourPriceAdults = 0;
        $this->tourPriceChildren = 0;
        $this->waterSportPrice = 0;

        $this->priceAdults = 0;
        $this->priceChildren = 0;
        $this->pricePerAdult = 0;
        $this->pricePerChildren = 0;
        //variable de valor agregado o descuento
        $this->carPrice = $this->getCarPrice();
        $this->ranchPrice = $this->getRanchPrice();
        $this->luxuryPrice = $this->getLuxuryPrice();
        $this->currency = 'USD';
        $this->groupDiscount = 0;
        $this->isPriceValid = false;


        $this->tourBoatCategories = [
            'non-stop-trip',
            'half-day-trip-lunch',
            'half-day-trip-stop',
            'pre-built-tours',
            'build-your-own-trip-lunch',
            'build-your-own-tigre-trip-stop'
        ];
        $this->goto = null;
        //form
        $this->firstName = '';
        $this->lastName = '';
        $this->contactEmail = '';
        $this->contactPhone = '';
        $this->contactOther = '';
        //
        $this->day = '';
        $this->month = '';
        $this->year = '';
        $this->alternativeDates = '';

        $this->pickUpAddress = '';
        $this->timeOptions = '';

        $this->sendTo = 'jmc.lemonpie@gmail.com';

        $this->foodType = '';
        $this->message = '';

        $this->finished = false;
    }

    public function assignTour($tour)
    {
        return new Tour($tour);
    }

    public function getPeople()
    {
        return $this->adults + $this->children;
    }

#imprimir calculadora

/**
 * nos da el html de detalle de precios
 */
    /*public function priceDetailHtml()
    {

        $this->calculatePrice();
        $tourPrice = $this->tourPrice;
        $priceHtml = '<ul>';
        $priceHtml .= '<li>'.$this->peopleDetailHtml().'</li>';
        $priceHtml .= '<li>'.$this->boatName()."  <span class=\"mtt-price\">$this->currency $this->boatPrice</span>".'</li>';

        if ($this->groupDiscount > 0) {
              $priceHtml .= $this->groupDiscountDetailHtml();
        }

        if ($this->boat !== 'speedboat') {
            $priceHtml .= '<li class="mtt-tour-detail">Stop/Lunch:  <span class="mtt-price">'.$this->currency.' '. $this->tourPrice.'</span><li>';
            $priceHtml .= $this->tourDetailHtml();
        }
        if ($this->car) {
            $priceHtml .= "<li> Private Car $this->currency  $this->carPrice</li>";
        }
        $priceHtml .= "<li class=\"mtt-total\"><span >TOTAL $this->currency  $this->price </span></li>";

        if ($this->payOnIsland) {

          $priceHtml .= "<li class=\"mtt-price-note\"><small>*You have chosen not to be charged for any food activity on the islands.
          It is VERY IMPORTANT that you remember to have cash to pay for your own expenses in Tigre.<em> Estimated Island Experience Cost: $this->currency $tourPrice
          -to be paid at your own expense on island)</em></small></li>";
        }
        $priceHtml .= '</ul>';

        return $priceHtml;
    }*/

/**
 * nos da el html de detalle de precios
 */
    public function peopleDetailHtml()
    {
        $people = $this->adults.' Adults';
        if ($this->children > 0) {
            $people .= " + $this->children Children";
        }

        if ($this->specialActivity !== null) {
            $people .= " ( $this->specialActivity $this->waterSport )";
        }
        return ' <span>'.$people.' </span> ';
    }

/**
 * boatName
 */
    public function boatName()
    {
        return str_replace(['speedboat','half-day','full-day'], ['Speedboat Trip (no stops)','Half Day Trip','Full Day Trip'], $this->boat);
    }

    /**
     * groupDiscountDetailHtml
     */
    public function groupDiscountDetailHtml()
    {
            $discountHtml = "<li class=\"mtt-group-discount\"> (Group Discount <span class=\"mtt-price\">$this->currency -$this->groupDiscount</span>)</li>";
            return $discountHtml;
    }



/**
 * tourDetailHtml
 */
public function tourDetailHtml(){
    $tourHtml = '';
    switch($this->boat){
        case 'speedboat':
        break;

        case 'half-day':
            $tourHtml .= '<li class="mtt-tour-detail">- ';
            if($this->halfLunch !== null){
              //  $tourHtml .= get_the_post_thumbnail( $this->halfLunch->id, array( 30, 30) ).' '.$this->halfLunch->name;
               $tourHtml .= $this->halfLunch->name;
            }elseif( $this->halfStop !== null ){
              //  $tourHtml .= get_the_post_thumbnail( $this->halfStop->id, array( 30, 30) ).' '.$this->halfStop->name;
              $tourHtml .= $this->halfStop->name;
            }
            $tourHtml .= '</li>';
        break;

        case 'full-day':
        $tourHtml .= '';
        if($this->preBuilt !== null){
           $tourHtml .= '<li class="mtt-tour-detail">- '.$this->preBuilt->name.'</li>';
       }elseif( $this->fullLunch !== null || $this->fullStop !== null  ){
           $tourHtml .= '<li class="mtt-tour-detail">-'.$this->fullLunch->name.'</li>';
           if( $this->fullStop !== null ){
             $tourHtml .= '<li class="mtt-tour-detail">-'.$this->fullStop->name.'</li>';
           }

       }
   $tourHtml .= '';
        break;

        default:
        break;
    }
    return $tourHtml;
}

    public function getCarPrice()
    {
        return $this->getPriceBySKU('car');
    }

    public function getLuxuryPrice()
    {
        return $this->getPriceBySKU('luxury');
    }

    public function getRanchPrice()
    {
        return $this->getPriceBySKU('ranch');
    }

/**
*
* Agrega al computo de precio el costo de lancha
**/
    public function calculateBoatPrice()
    {
        $price = 0;
        $groupDiscount = 0;
          //Precio Base
        $basePrice =  $this->getPriceBySKU($this->boat.'-2') ;
        $priceNoDiscount = 0;

        if ($this->adults > 1 && function_exists('wc_get_product')) {
            $price =  $this->getPriceBySKU($this->boat.'-'.$this->adults)  * $this->adults;

            if ($this->adults > 2) {
      //    $groupDiscount =   $basePrice * $this->adults;
                $groupDiscount = ($basePrice * $this->adults) - $price ;
            }
            $priceNoDiscount = $basePrice * $this->adults;
            $this->boatPriceAdults = $priceNoDiscount;
            $this->boatPriceAdultsDiscount = $price;

            if ($this->children > 0) {
                $childrenPrice = $this->getPriceBySKU($this->boat.'-children')*$this->children;
                $this->boatPriceChildrenDiscount = $childrenPrice;
                $this->boatPriceChildren = $basePrice*$this->children;
                $price +=  $childrenPrice;
                $childrenDiscount =   ($basePrice * $this->children) - $childrenPrice;
                $groupDiscount += $childrenDiscount;
                $priceNoDiscount += $basePrice * $this->children;
            }
       //sumamos precio de ninhos
        }
    //persistimos en el objeto
        $this->groupDiscount = $groupDiscount;
  //  $this->boatPrice = $price;
        $this->boatPrice = $priceNoDiscount;
  //  $this->price += $this->boatPrice;
    }


/**
* getPriceBySKU
*/

    public function getPriceBySKU($sku)
    {
        $price = 0;
        if (function_exists('wc_get_product')) {
        //   echo $_SESSION['boat'].'-'.$_SESSION['adults'];
            $_product = wc_get_product_id_by_sku($sku);
            $_product = wc_get_product($_product);
            $price =  $_product->get_price();
        }
        return $price;
    }


    /**
     * tourDetailHtml
     */
    public function calculateTourPrice()
    {
        $price = 0;
        switch ($this->boat) {
            case 'speedboat':
                $price = null;
                break;
            case 'half-day':
                if ($this->halfLunch !== null) {
                      $price = $this->halfLunch->getPrice();
                      $this->tourPriceAdults = $this->halfLunch->getPriceAdults();
                      $this->tourPriceChildren = $this->halfLunch->getPriceChildren();
                } elseif ($this->halfStop !== null) {
                    if ($this->halfStop->isWaterSport()) {
                        $this->waterSportPrice = $this->halfStop->getPriceWaterSport();
                    } else {
                        $price = $this->halfStop->getPrice();
                        $this->tourPriceAdults = $this->halfStop->getPriceAdults();
                        $this->tourPriceChildren = $this->halfStop->getPriceChildren();
                    }
                }
                break;
            case 'full-day':
                if ($this->preBuilt !== null) {
                    $price = $this->preBuilt->getPrice();
                    $this->tourPriceAdults = $this->preBuilt->getPriceAdults();
                    $this->tourPriceChildren = $this->preBuilt->getPriceChildren();
                } elseif ($this->fullLunch !== null || $this->fullStop !== null) {
                    $p1 = $this->fullLunch !== null? $this->fullLunch->getPrice():0;
                    $this->tourPriceAdults = $this->fullLunch->getPriceAdults();
                    $this->tourPriceChildren = $this->fullLunch->getPriceChildren();
              //  $p1 = $this->fullStop !== null? $this->fullStop->getPrice():0;
                    $p2 =  0;
                    if ($this->fullStop !== null && $this->fullStop->isWaterSport()) {
                         $this->waterSportPrice = $this->fullStop->getPriceWaterSport();
                    } elseif ($this->fullStop !== null) {
                        $p2 = $this->fullStop->getPrice();
                        $this->tourPriceAdults += $this->fullStop->getPriceAdults();
                        $this->tourPriceChildren += $this->fullStop->getPriceChildren();
                    }
                    $price = $p1 + $p2;
                }
                break;
            default:
                $price = null;
                break;
        }

        if ( $this->luxury) {
             $price +=  $this->luxuryPrice * $this->getPeople();
             $this->tourPriceAdults += $this->luxuryPrice * $this->adults;
        }
          //ranch elimine los metodos - chequear
        if ( $this->ranch) {
              $price +=  $this->ranchPrice * $this->getPeople();
              $this->tourPriceAdults += $this->ranchPrice * $this->adults;
              $this->tourPriceChildren += $this->ranchPrice * $this->children;
        }

        $this->tourPrice = $price;
    }

    public function calculatePrice()
    {
//  $this->price = 990;
         $this->price = 0;
         $this->calculateBoatPrice();
         $this->price = $this->boatPrice;
         $this->price -= $this->groupDiscount;
         $this->calculateTourPrice();

         //pagar en la isla
        if (!$this->payOnIsland) {
         //  echo 'gato '.$this->tourPrice;
             $this->price += $this->waterSportPrice;
             $this->price +=  $this->tourPrice;
            //Excepciones al precio del tour
            //luxury
        }
  //auto. esta incluido en full day
        if ($this->boat !== 'full-day' && $this->car) {
            $this->price +=  $this->carPrice;
        }

        $this->groupPrices();
  //validar precios
      //  $this->validateCalculator();


    }
    /**
    * adult aqnd children tour + boat price
    */
    public function groupPrices()
    {
        $mainTour = $this->mainTour();
        $additionalTour = $this->additionalTour();
      //  $proportionalDiscount = $this->groupDiscount/$this->getPeople();
        //precio de lancha
      //  $this->priceAdults = $this->boatPriceAdults - ($proportionalDiscount*$this->adults) ;
        $this->priceAdults = ($this->boatPriceAdults + $this->tourPriceAdults);
      //  $this->priceChildren =  $this->boatPriceChildren - ($proportionalDiscount*$this->children);
        $this->priceChildren = ($this->boatPriceChildren + $this->tourPriceChildren);

        //con descuentos aplicados
        $this->pricePerAdult = ($this->boatPriceAdultsDiscount + $this->tourPriceAdults)/$this->adults;
        if ($this->children > 0) {
            $this->pricePerChildren = ($this->boatPriceChildrenDiscount + $this->tourPriceChildren)/$this->children;
        }
        //si es lancha
        if ($mainTour != '') {
    //        $this->priceAdults += $mainTour->getPriceAdults();
        //    $this->priceChildren += $mainTour->getPriceChildren();
        }

        //precio caballos
        if ($this->isRanch) {
            if ($this->ranch) {
                $this->priceAdults += $this->ranchPrice * $this->adults ;
                $this->priceChildren += $this->ranchPrice * $this->children;
            }
        }

        if ($this->isLuxury) {
            if ($this->luxury) {
            //    $mainTourName .= ' (Including use of Lodge\'s facilities)';
                $this->priceAdults += $this->luxuryPrice * $this->adults;
            }
        }

        if ($additionalTour != '') {
      //      $this->priceAdults += $additionalTour->getPriceAdults();
      //      $this->priceChildren += $additionalTour->getPriceChildren();
        }
    }


/**
 * Determina que tipo de vista de tour es.  Paseo, almuerzo medio dia, prearmado, etc
 */
    public function myTourBoatCategory($tourId){
      $category = null;
      $categories = wp_get_post_terms($tourId, 'tour-category');

      foreach($categories as $c){

        if(   in_array( $c->slug , $this->tourBoatCategories )  ){
            $category = $c->slug;

            break;
        }
      }
      return $category;
    }


/**
* @todo $TourPageid reemplazar por categorias de woo
*/
    public function setTour($tour, $adults, $children, $people, $TourPageid)
    {
      //  $tour = new Tour($tour);
        $tour->people = $people;
        $tour->adults = $adults;
        $tour->children = $children;
        $category = $this->myTourBoatCategory($TourPageid);
      //  echo 'category '.$category;
        $this->goto = home_url().'/my-trip';

        switch ($category) {
            case 'non-stop-trip':
                break;
            case 'half-day-trip-lunch':
                $this->halfLunch = $tour;

                break;
            case 'half-day-trip-stop':
                 $this->halfStop = $tour;
                 $this->waterSport = $this->halfStop->waterSport;

                break;
            case 'pre-built-tours':
                $this->preBuilt = $tour;

                break;
            case 'build-your-own-trip-lunch':
                $this->fullLunch = $tour;
                $this->goto = home_url().'/build-you-own-trip-add-stop';
                break;
            case 'build-your-own-tigre-trip-stop':
                $this->fullStop = $tour;
                $this->waterSport = $this->fullStop->waterSport;
                break;

            default:
                break;
        }
    }

    /**
    * @todo  reemplazar por categorias de woo
    *  clearStoredTour() borra los datos almacenados de un tour.
    * para recalcularlos cada vez que va a 'calculte'
    * se aplica cuando se carga una pagina de tour
    */
    public function clearStoredTour($TourPageid)
    {
    //$tour = new Tour($tour);
        $category = $this->myTourBoatCategory($TourPageid);
        $this->halfLunch = null;
        $this->halfStop = null;
      //   $this->waterSport = $this->halfStop->waterSport;
        $this->preBuilt = null;
        $this->ranch = false;
        $this->luxury = false;
        $this->preBuilt = null;
        $this->fullStop = null;
        $this->specialActivity = 0;
        if ($category != 'build-your-own-tigre-trip-stop') {
             $this->fullLunch = null;
        }
    }

/**
* hasAdditionalTour
*
* si falta elegir un tour adicional
*/
    public function hasAdditionalTour()
    {
        $at = false;
        if ($this->boat == 'full-day' && $this->fullStop === null) {
            $at = true;
        }
        return $at;
    }

  /**
  *  validateCalculator
  */
    public function validateCalculator()
    {
        $valid = false;
        $errors = 0;
        $messages = [];
        //minimum adults
        if ($this->adults < 2) {
            $errors++;
            $messages['adults.min'] = '2 adults minimum';
        }
        //maximun people
        if ($this->getPeople() > 5) {
            $errors++;
            $messages['adults.max'] = 'maximum of 5 passengers on a single trip';
        }
        // ninhos no admitidos en luxury
        if ($this->isLuxury && $this->children > 0) {
            $errors++;
            $messages['luxury.children'] = 'Children not admitted in this trip';
        }

        if ($errors === 0) {
             $valid = true;
        }
        return [
          'valid' => $valid,
          'messages' => $messages,
        ];
    }

    public function validateFields()
    {
        $valid = false;
        $fields = ['firstName','lastName','contactEmail','contactPhone','day','month','year'];
        $errors = [];
        foreach ($fields as $field) {
            if (empty(trim($_POST[$field]))) {
                $errors[] = $field;
            }
        }
    //auto
        if ($this->car) {
            $fields = ['pickUpAddress','timeOptions'];
            foreach ($fields as $field) {
                if (empty(trim($_POST[$field]))) {
                    $errors[] = $field;
                }
            }
        }

        if (count($errors) == 0) {
         //si no hay errores damos como finalizado el pedido
            $this->finished = true;
            $valid = true;
        }
        return $valid == true ? true:$errors;
      //  return $;
    }

    /**
    *  saveTrip
    * guarda en la base de datos
    */
    public function saveTrip()
    {
          global $wpdb;
          //guardo en la DB
          $trip = $wpdb->insert('mtt_trips', ['trip' => '']);
          $this->id = str_pad($wpdb->insert_id, 8, '0', STR_PAD_LEFT);

          return $trip;
    }


    /**
     *  getMyTrip
     */
    public function getMyTrip()
    {
        global $wpdb;
        $send = $this->saveTrip();
        return $send;
    }

      /**
      * Muestra el detalle segun como desee pagar las paradas
      */
    public function priceDetail()
    {
      //  if ($this->payOnIsland) {
      //      return  $this->priceDetailPayOnIsland();
      //  } else {
            return  $this->priceDetailPayAdvance();
      //  }
    }

    public function priceBeforeDiscount()
    {
        return $this->price + $this->groupDiscount;
    }

    /**
    * Detalle de precios para pago anticipado incluyendo paradas
    */
    public function priceDetailPayAdvance()
    {
        $this->calculatePrice();

        /*
        //parada principal
        $mainTour = $this->mainTour();
        $additionalTour = $this->additionalTour();
        //precio de lancha
        $this->priceAdults = $this->boatPriceAdults;
        $this->priceChildren =  $this->boatPriceChildren;

        //si es lancha
        if ($mainTour != '') {
            $this->priceAdults += $mainTour->getPriceAdults();
            $this->priceChildren += $mainTour->getPriceChildren();
        }

        //precio caballos
        if ($this->isRanch) {
            if ($this->ranch) {
                $this->priceAdults += $this->ranchPrice * $this->adults ;
                $this->priceChildren += $this->ranchPrice * $this->children;
            }
        }

        if ($this->isLuxury) {
            if ($this->luxury) {
            //    $mainTourName .= ' (Including use of Lodge\'s facilities)';
                $this->priceAdults += $this->luxuryPrice * $this->adults;
            }
        }

        if ($additionalTour != '') {
            $this->priceAdults += $additionalTour->getPriceAdults();
            $this->priceChildren += $additionalTour->getPriceChildren();
        }
        */
        $priceTitle = '';
        if ($this->boat == 'full-day' && $this->fullStop === null && $this->preBuilt === null) {
            $priceTitle = 'Subtotal';
        } else {
            $priceTitle = 'Final Price';
        }

        $detail = "<p class=\"mtt-total-price\" >$priceTitle $this->currency $this->price</p>";

        $detail .= $this->tripDetails();

        $detail .= '<table class="mtt-price">';
        //auto
        if ($this->car) {
            $detail .= $this->rowDetail($this->carPrice, ' Private Car');
        }

        //adultos
        $detail .= $this->rowDetail($this->priceAdults, $this->adults.' Adults');
        //ninhos
        if ($this->children > 0) {
            $detail .= $this->rowDetail($this->priceChildren, $this->children. ' Children');
        }
        //ski/flyboard
        if ($this->specialActivity > 0) {
            $count = $this->specialActivity > 1? 'Classes':'Class';
            $detail .= $this->rowDetail($this->waterSportPrice, $this->specialActivity.' '.$this->waterSport.' '.$count);
        }

        if ($this->groupDiscount > 0) {
            $detail .= $this->rowDetail('-'.$this->groupDiscount, 'Group Discount', ' mtt-group-discount');
        }

        $detail .= $this->rowDetail($this->price, $priceTitle, ' mtt-total-price');
        $detail .= '</table>';
        //detalle de precio por persona
        //$detail .= $this->unitPrices();

        $detail .= $this->notes();

        return $detail;
    }
 /**
 * priceDetailPayOnIsland
 *
 */

    public function priceDetailPayOnIsland()
    {
        $this->calculatePrice();
        //precio de lancha
        $priceAdults = $this->boatPriceAdults;
        $priceChildren =  $this->boatPriceChildren;


        //si es lancha
        if ($mainTour != '') {
      //      $priceAdults += $mainTour->getPriceAdults();
        //    $priceChildren += $mainTour->getPriceChildren();
        }
        $priceTitle = 'Subtotal';
        $detail = "<p class=\"mtt-total-price\" >$priceTitle $this->currency $this->price</p>";

        $detail .= $this->tripDetails();
        $detail .= '<table class="mtt-price">';
        //auto
        if ($this->car) {
            $detail .= $this->rowDetail($this->carPrice, ' Private Car');
        }
        //adultos
        $detail .= $this->rowDetail($priceAdults, $this->adults.' Adults  Private Boat Trip /self-paid expenses');
        //ninhos
        if ($this->children > 0) {
            $detail .= $this->rowDetail($priceChildren, $this->children. ' Children  Private Boat Trip /self-paid expenses');
        }

        if ($this->groupDiscount > 0) {
            $detail .= $this->rowDetail('-'.$this->groupDiscount, 'Group Discount', ' mtt-group-discount');
        }

        $detail .= $this->rowDetail($this->price, $priceTitle. ' / no lunch or additional activities included*', ' mtt-total-price');
        $detail .= '</table>';

        $detail .= $this->notes();

        return $detail;
    }

    public function unitPrices()
    {
         $detail .= '<table class="mtt-price">';
       //auto
         $pricePerAdult = ($this->boatPriceAdultsDiscount + $this->tourPriceAdults)/$this->adults;

        //adultos
         $detail .= $this->rowDetail($pricePerAdult, 'Price per Adult');
      //ninhos
        if ($this->children > 0) {
            $pricePerChildren = ($this->boatPriceChildrenDiscount + $this->tourPriceChildren)/$this->children;
            $detail .= $this->rowDetail($pricePerChildren, 'Price per Children');
        }
      //ski/flyboard
        if ($this->specialActivity > 0) {
            $count = $this->specialActivity > 1? 'Classes':'Class';
            $detail .= $this->rowDetail($this->waterSportPrice/$this->specialActivity, 'Price per '.$this->waterSport.' '.$count);
        }

        if ($this->car) {
            $detail .= $this->rowDetail($this->carPrice, 'Private Car');
        }


        $detail .= '</table>';

        return $detail;
    }


    public function rowDetail($value, $detail, $class = '')
    {
        if ($class != null) {
            $class =" class=\"$class\" ";
        }
        $row  = "<tr $class >";
        $row .= "<td class=\"mtt-price-value\">$value</td>";
        $row .= "<td>$detail</td>";
        $row .= "</tr>";

        return $row;
    }

    public function notes()
    {
        $notes = '<div class="mtt-trip-notes">';

        if ($this->payOnIsland) {
            $price = $this->tourPrice + $this->waterSportPrice ;
            $notes .= '<p class="mtt-important">*You have chosen not to be charged for any food or activity
           on the islands and you will have to cover for this expenses yourself. ';
            $notes .= 'That is why it is VERY IMPORTANT that you remember to bring cash to our boat trip. ';
            $notes .= "Estimated Island Experience Cost -to be paid at your own expense on the day of your trip: <b>$this->currency $price</b></p>";
        }

        if ($this->specialActivity > 0) {
            $people = $this->specialActivity == 1?'person has':'persons have';
            $notes .= "<p>Note: $this->specialActivity $people decided to $this->waterSport</p>";
        }

        if ($this->isRanch) {
            if ($this->ranch) {
                $notes .= '<p>'.__('* 1 activity per person (and no tea) included', 'mtt').'</p>';
            } else {
                $notes .= '<p>'.__('* 2 activities per person and tea included', 'mtt').'</p>';
            }
        }

        if ($this->isLuxury) {
            if ($this->luxury) {
                $notes .= '<p>'.__('* Use of Lodge´s Facilities included', 'mtt').'</p>';
            } else {
                $notes .= '<p>'.__('* Use of Lodge´s Facilities NOT included', 'mtt').'</p>';
            }
        }

        if ($this->stage === 'summary') {
            if ($this->boat !== 'full-day' && $this->car) {
            $notes .= '<p>* Private pick up and drop off to and from hotel included.
             If you decide you´d like to stroll along Tigre after our boating adventure you can do so.
           </p>';
            }

          if ($this->boat !== 'full-day' && !$this->car) {
            $notes .= '<p>*Meet us at Tigre´s Public Pier -2 blocks from the Train Station. We´ll send directions shortly</p>';
            }

            if ($this->boat == 'full-day') {
            $notes .= '<p>* Private car to and from Tigre is included in price.</p>';
            }
        }
        $notes .= '</div>';
        return $notes;
    }
    /**
    * array de notes
    */
    public function getNotes()
    {
        $notes = [];
        if ($this->payOnIsland) {
            $price = $this->tourPrice + $this->waterSportPrice ;
            $note .= '<span class="text-danger">You have chosen not to be charged for any food or activity
           on the islands and you will have to cover for this expenses yourself.</span> ';
          //  $note .= 'That is why it is VERY IMPORTANT that you remember to bring cash to our boat trip. ';
          //-to be paid at your own expense on the day of your trip
            $note .= "<br><i>Estimated Island Experience Cost</i>: <b>$this->currency $price</b>";
            $notes [] = $note;
            $note = '';
        }

        if ($this->specialActivity > 0) {
            $people = $this->specialActivity == 1?'person has':'persons have';
            $notes[] = "$this->specialActivity $people decided to $this->waterSport";
        }
      //  $notes [] = print_r($this->mainTour());
        if ($this->mainTour()->optional == 'ranch') {
            if ($this->ranch) {
                $notes[] = '1 activity per person (and no tea) included';
            } else {
                $notes[] = '2 activities per person and tea included';
            }
        }

        if ($this->mainTour->optional == 'luxury') {
            if ($this->luxury) {
                $notes[] = 'Use of Lodge´s Facilities included';
            } else {
                $notes[] = 'Use of Lodge´s Facilities NOT included';
            }
        }

        if ($this->stage === 'summary') {
            if ($this->boat !== 'full-day' && $this->car) {
            $notes[] = 'Private pick up and drop off to and from hotel included.
             If you decide you´d like to stroll along Tigre after our boating adventure you can do so.';
            }

          if ($this->boat !== 'full-day' && !$this->car) {
            $notes[]= 'Meet us at Tigre´s Pier -2 blocks from the Train Station. We´ll send directions shortly';
            }

            if ($this->boat == 'full-day') {
            $notes[] = 'Private car to and from Tigre is included in price.';
            }
        }

        return $notes;
    }


    /**
     * mainTour
     */
    public function mainTour()
    {
        $tour = '';
        switch ($this->boat) {
            case 'speedboat':
                break;
            case 'half-day':
                if ($this->halfLunch !== null) {
                    $tour = $this->halfLunch;
                } elseif ($this->halfStop !== null) {
                  //  $tourHtml .= get_the_post_thumbnail( $this->halfStop->id, array( 30, 30) ).' '.$this->halfStop->name;
                    $tour = $this->halfStop;
                }
                break;
            case 'full-day':
                if ($this->preBuilt !== null) {
                    $tour = $this->preBuilt;
                } elseif ($this->fullLunch !== null) {
                    $tour = $this->fullLunch;
                }
                break;
            default:
                break;
        }
        return $tour;
    }

    /**
     * mainTour
     */
    public function additionalTour()
    {
        $tour = '';
        if ($this->boat == 'full-day' && $this->fullStop !== null) {
            $tour = $this->fullStop;
        }
        return $tour;
    }
}
