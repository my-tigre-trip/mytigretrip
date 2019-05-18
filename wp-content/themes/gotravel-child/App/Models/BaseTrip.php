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
    //  private $mood2;
    public $payOnIsland = false;
    public $nextStep;

    public function __construct()
    {
        //silence
    }

    public static function boatName($boat)
    {
        return str_replace(['speedboat','half-day','full-day'], ['Speedboat Trip (no stops)','Half Day Trip','Full Day Trip'], $boat);
    }

    public function addTour(Tour $tour)
    {
        //override me
    }

    public function setNextStep()
    {
        $this->nextStep = 'my-trip'; // vamos al checkout
        //overrride me en full day
    }
}
