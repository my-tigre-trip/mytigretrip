<?php

namespace App\Models;

use App\Models\Speedboat;
use App\Models\HalfDay;
use App\Models\FullDay;
use App\Models\Woo;

//use Illuminate\Database\Eloquent\Model as Eloquent;

class MyTrip {
    protected $table = 'mtt_trips';

  //  protected $primaryId = 'id';

  /*  protected $fillable = [
      'session','status', 'language',
      'first_name', 'last_name', 'email', 'phone', 'other_contact',
      //trips
      'boat','adults','children', 'special_activity' ,'mood_1', 'mood_2',
      //car

      //price
      'final_price', 'price_before_discount', 'group_discount','adults_discount',
      'children_discount','currency','tour_price','boat_price',
      //discount
      'coupon_code'
    ];*/

    protected $sessionId;
    protected $speedboat;
    protected $fullDay;
    protected $halfDay;

    public $car;
    //public $priceCar; //Calculator task
    public $payOnIsland;
    //protected $discountCode;
    public $lock; //
    //public $stage;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
        $this->lock = null;
        $this->speedboat = new Speedboat();
        $this->halfDay = new HalfDay();
        $this->fullDay = new FullDay();
        //$this->priceCar = Woo::findProduct('car')->price;
    }

    public function addTour(Tour $tour)
    {
        if ($tour->boat === 'speedboat') {
           //
        } elseif ($tour->boat === 'half-day') {
            $this->halfDay->addTour($tour);
        } elseif ($tour->boat === 'full-day') {
            $this->fullDay->addTour($tour);
        }
    }

    public function getBoat($boat)
    {
        $b = null;
        if ($boat === 'speedboat') {
            $b = $this->speedboat;
        } elseif ($boat === 'half-day') {
            $b = $this->halfDay;
        } elseif ($boat === 'full-day') {
            $b = $this->fullDay;
        }
        return $b;
    }

    public function setBoat($boat)
    {
        if ($boat->boat === 'speedboat') {
            $this->speedboat = $boat;
        } elseif ($boat->boat === 'half-day') {
            $this->halfDay = $boat;
        } elseif ($boat->boat === 'full-day') {
            $this->fullDay = $boat;
        }
    }

    public function calculatePrice($boat)
    {
      //  return $this->price($boat, 2, 3, []);
    } 

    /**
    *  saveTrip
    * guarda en la base de datos
    */
    public function save()
    {
          global $wpdb;
          //guardo en la DB
          $trip = $wpdb->insert('mtt_trips', ['trip' => '']);
          $this->id = str_pad($wpdb->insert_id, 8, '0', STR_PAD_LEFT);

          return $trip;
    }

    /**
    * array de notes
    */
    public function getNotes($myBoat, $tourPrice)
    {
        $notes = [];

        if ($this->payOnIsland) {
            //By your request, any island expenses (lunch / alternative activities) are not included in price.
            // Please remember that you will have to cover this expenses yourself on the day of the trip.
            $note .= '<span class="text-danger">By your request, any island expenses (lunch / alternative activities) are not included in price.
            Please remember that you will have to cover this expenses yourself on the day of the trip.</span> ';
          //  $note .= 'That is why it is VERY IMPORTANT that you remember to bring cash to our boat trip. ';
          //-to be paid at your own expense on the day of your trip
            $note .= "<br><i>Estimated Island Experience Cost</i>: <b>USD $tourPrice</b>";
            $notes [] = $note;
            $note = '';
        }

        if ($myBoat->mood1->specialActivityPeople > 0 || $myBoat->mood2->specialActivityPeople > 0) {
            $people = $myBoat->specialActivityPeople == 1?'class':'classes';
            $sport = !empty($myBoat->mood1->isWaterSport()) ? $myBoat->mood1->product['Special_Activity_Name'] : $myBoat->mood2->product['Special_Activity_Name'];
            $notes[] = "$myBoat->specialActivityPeople $sport $people";
        }
      //  $notes [] = print_r($this->mainTour());
        if ($myBoat->boat === 'full-day' && $myBoat->mood1->isRanch()) {
            if ($myBoat->mood1->optionalSelected) {
                $notes[] = '1 activity per person (and no tea) included';
            } else {
                $notes[] = '2 activities per person and tea included';
            }
        }

        if ($myBoat->boat === 'full-day' && $myBoat->mood1->isLuxury()) {
            if ($myBoat->mood1->optionalSelected) {
                $notes[] = 'Use of Lodge´s Facilities included';
            } else {
                $notes[] = 'Use of Lodge´s Facilities NOT included';
            }
        }

        if ($this->lock !== null) {
            if ($myBoat->boat !== 'full-day' && $this->car) {
            $notes[] = 'Private pick up and drop off to and from hotel included.
             If you decide you´d like to stroll along Tigre after our boating adventure you can do so.';
            }

          if ($myBoat->boat !== 'full-day' && !$this->car) {
            $notes[]= 'Meet us at Tigre´s Pier -2 blocks from the Train Station. We´ll send directions shortly';
            }

            if ($myBoat->boat == 'full-day') {
            $notes[] = 'Private car to and from Tigre is included in price.';
            }
        }

        return $notes;
    }

    /**
     * sets both in boat and tour
     */
    public function setPeople($req) {
      // adults
      if (isset($req['adults'])) {
        // full
        $this->fullDay->adults = $req['adults'];
        if (isset($this->fullDay->mood1)) {
          $this->fullDay->mood1->adults = $req['adults'];
        }

        if (isset($this->fullDay->mood2)) {
          $this->fullDay->mood2->adults = $req['adults'];
        }
        // half
        $this->halfDay->adults = $req['adults'];
        if (isset($this->halfDay->mood1)) {
          $this->halfDay->mood1->adults = $req['adults'];
        }
      }
      
      // children
      if (isset($req['children'])) {
        $this->fullDay->children = $req['children'];
        if (isset($this->fullDay->mood1)) {
          $this->fullDay->mood1->children = $req['children'];
        }

        if (isset($this->fullDay->mood2)) {
          $this->fullDay->mood2->children = $req['children'];
        }

        $this->halfDay->children = $req['children'];
        if (isset($this->halfDay->mood1)) {
          $this->halfDay->mood1->children = $req['children'];
        }
      }

      if (isset($req['specialActivityPeople'])) {
        $this->fullDay->specialActivityPeople = $req['specialActivityPeople'];
        $this->halfDay->specialActivityPeople = $req['specialActivityPeople'];
      }
    }
}
