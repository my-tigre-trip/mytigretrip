<?php

namespace App\Models;

use App\Models\BaseTrip;
use App\Models\Calculator;

class HalfDay extends BaseTrip
{
    public function __construct()
    {
      //
        $this->boat = HALF_DAY;
        $this->boatName = parent::boatName($this->boat); 
    }
    /**
    * addTour
    * si es half day y mood 1 la agrega como tour y sobreescribe lo anterior
    * @param Tour $tour
    */
    public function addTour(Tour $tour)
    {
        if ($tour->boat === HALF_DAY && $tour->mood === '1') {
            $this->mood1 = $tour;
        }
    }  
}
