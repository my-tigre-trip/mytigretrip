<?php 

namespace App\Helpers;

class Calculator {
    public static function speedBoatPrice() {
        $boatPrice = [
            'status' => "valid",
            'boat' => 'Speedboat trip',
            'adults' => 2,
            'children' => 0,
            'price' => 100,
            'priceChildren' => 0,
            'discountChildren' => "60",
            'priceAdults' => 100,
            'discountAdults' => "40",
            'groupDiscount' => 0 ,
            'priceBeforeDiscount' => 0
        ];

        return [
            'boatDetail' => $boatPrice,
            'tourDetail' => [],
            'priceAdults' => 100,
            'priceChildren' => 0,
            'priceSpecialActivity' => 0,
            'priceCar' => 50,
            'finalPrice' => 100
        ];
    }
}