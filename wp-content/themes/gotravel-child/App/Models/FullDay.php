<?php

namespace App\Models;

use App\Models\BaseTrip;

class FullDay extends BaseTrip
{
  public $mood2;

  public function __construct()
  {
    //
    $this->boat = 'full-day';
    $this->boatName = $this->boatName($this->boat);
  }

  /**
  * addTour
  * si es half day y mood 1 la agrega como tour y sobreescribe lo anterior
  * @param Tour $tour
  */
  public function addTour(Tour $tour)
  {
      if ($tour->boat === 'full-day' && $tour->mood === '1') {
          $this->mood1 = $tour;
      } elseif ($tour->boat === 'full-day' && $tour->mood === '2') {
          $this->mood2 = $tour;
      }
  }

  /**
   * 
   */
  public function setNextStep()
  {
    if ($this->mood1->category === 'pre-built-tours') {
      $this->nextStep = 'my-trip';
    } elseif ($this->mood1->mood === '1' && $this->mood2 === null) {
      $this->nextStep = 'build-you-own-trip-add-stop';
    } elseif ($this->mood2->mood === '2' && $this->mood1 === null) {
      $this->nextStep = 'build-your-own-tigre-trip-lunch';
    } else {
      $this->nextStep = 'my-trip'; // vamos al checkout
    }     
  }
}
