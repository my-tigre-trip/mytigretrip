<?php
namespace App\Models;
use App\Models\Calculator;
use App\Models\Tour;

class BaseTrip
{
    public $boat;
    public $boatName;
    public $adults;
    public $children;
    public $specialActivityPeople;

    public $waterSport;
    public $options;

    public $mood1;
    // public $mood2;

    public $payOnIsland = false;
    public $nextStep;

    public function __construct()
    {
        //silence
    }

    public static function boatName($boat) {
        return str_replace(['speedboat','half-day','full-day'], ['Speedboat Trip (no stops)','Half Day Trip','Full Day Trip'], $boat);
    }

    public function addTour(Tour $tour, $mood = 1) {
        //override me
    }

    public function setNextStep() {
      if ($this->mood1 !== null && $this->mood2 === null) {
        $this->nextStep = 'add-stop';
      } else {
        $this->nextStep = 'my-trip'; // vamos al checkout
      //overrride me en full day
      }
    }

    public function hasOptional() {
      if ($this->mood1->hasOptional()) {
        return $this->mood1->product['optionLabel_en'];
      } 
      
      if ($this->mood2 !== null && $this->mood2->hasOptional()) {
        return $this->mood2->product['optionLabel_en'];
      }
      
      return false;
    }

    public function hasActivity() {
      if ($this->mood1->hasActivity()) {
        return $this->mood1->product['Special_Activity_Name'];
      } 
      
      if ($this->mood2 !== null && $this->mood2->hasActivity()) {
        return $this->mood2->product['Special_Activity_Name'];
      }
      
      return false;
    }
}
