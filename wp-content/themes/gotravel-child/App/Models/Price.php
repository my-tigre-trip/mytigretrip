<?php

namespace App\Models;

/**
 * a price result container
 */
class Price {
    // boat
    public $boatName;
    public $adults;
    public $children;
    public $priceBoat;
    public $priceBoatChildren;
    public $priceBoatAdults;
    public $discountAdults;
    public $discountChildren; 
    public $groupDiscount;
    public $priceBeforeDiscount;
    // 
    // public
    // finals
    public $car;
    public $priceAdults;
    public $priceChildren;
    public $priceActivity; // sky - flyboard may differ from people
    public $estimatedIslandExpenses;
    public $finalprice;

    public function __construct() {

    }
}