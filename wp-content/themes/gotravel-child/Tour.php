<?php

class Tour
{

    public $product;
    public $id;
    public $slug;
    public $people;
    public $children;
    public $adults;
    public $price;
    public $name;
    //----------

    public $waterSport;
    public $optional;


    public function __construct($product)
    {
        $product = $product;
        $this->id = $product->id;
        $this->slug = $product->get_sku();
        //$this->people = $people;
        $this->price = $product->price ;
        $this->name = $product->name;

        $this->waterSport = $product->get_attribute('waterSport');
        $this->optional =  $product->get_attribute('optional');

        $this->people = 0;
        $this->children = 0;
        $this->adults = 0;
    }


    public function getPrice()
    {
        $price = 0;
        if ($this->isWaterSport()) {
            $price = $this->price * $this->people ;
        } else {
            $price = $this->price * ($this->adults + $this->children );
        }
        return $price;
    }
/**
*
* Precio adulto sin ski/flyboard
*/
    public function getPriceAdults()
    {
        $price = 0;
        if (!$this->isWaterSport()) {
            $price = $this->price * $this->adults ;
        }

        return $price;
    }
    /**
    *
    * Precio ninhos sin ski/flyboard
    */
    public function getPriceChildren()
    {
        $price = 0;
        if (!$this->isWaterSport()) {
            $price = $this->price * $this->children ;
        }

        return $price;
    }

    /**
    *
    * Precio  ski/flyboard
    */
    public function getPriceWaterSport()
    {
        $price = 0;
        if ($this->isSki() || $this->isFlyboard()) {
            $price = $this->price * $this->people ;
        }
        return $price;
    }

    public function isLuxury()
    {
        return $this->optional == 'luxury'?true:false;
    }

    public function isRanch()
    {
        return $this->optional == 'ranch'?true:false;
    }

  /*ski*/
    public function isSki()
    {
        return $this->waterSport == 'Ski'?true:false;
    }

      /*flyboard*/
    public function isFlyboard()
    {
        return $this->waterSport == 'Flyboard'?true:false;
    }

    /*flyboard*/
    public function isWaterSport()
    {
        return ($this->isSki() || $this->isFlyboard() )?true:false;
    }

    /*flyboard*/
    public function whichWaterSport()
    {
        $sport = '';
        return $sport;
    }
}
