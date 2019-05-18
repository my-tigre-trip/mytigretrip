<?php
namespace App\Models;

class Woo {
    public static function getInstance() {
        return new self();
      }

    public function findProduct($sku)
    {
        $product = null;
        if (function_exists('wc_get_product')) {
      //   echo $_SESSION['boat'].'-'.$_SESSION['adults'];
            $product = wc_get_product_id_by_sku($sku);
            $product = wc_get_product($product);
          //$price =  $_product->get_price();
        }
        return $product;
    }

    /**
    * getCategoryName
    * @param WC_Product
    * @return WP_Term or false
    */
    public static function getCategory($product)
    {
        $cat = $product->get_category_ids()[0];
        $c= '';
        if ($term = get_term_by( 'id', $cat, 'product_cat')) {
            $c = $term;
        }
        return $c;
    }

    /**
    * getTourBoat
    * determina el tipo de lancha a partir de la categoria de producto. los boat del
    * Calculator deben coincidir con los valores de retorno de esta funcion
    * @param $category string
    * @return string
    */
    public function getTourBoat($category)
    {
        $boat = '--';
        if (strpos($category->slug, 'speedboat') !== false) {
            $boat = 'speedboat';
        } elseif (strpos($category->slug, 'half-day') !== false) {
            $boat = 'half-day';
        } elseif (strpos($category->slug, 'pre-built') !== false ||
            strpos($category->slug, 'build-your-own') !== false) {
            $boat = 'full-day';
        }
        return $boat;
    }

    /**
    *
    *
    * @return integer 1, 2
    * @return string ''  speedboat
    */
    public static function getMood($category)
    {
        $mood = '';
        if (strpos($category->slug, 'half-day') !== false ||
           strpos($category->slug, 'pre-built-tours') !== false ||
            $category->slug === 'build-your-own-tigre-trip-lunch' 
        ) {
            $mood = 1;
        } elseif ($category->slug === 'build-your-own-tigre-trip-stop') {
            $mood = 2;
        } //elseif (strpos($category->slug, 'speedboat') !== false) {

        //}
        return $mood;
    }

    /**
    * boatBasePrice
    * calcula el precio base sin descuentos por persona
    * @param $boat string
    * @return float
    */
    public static function boatBasePrice($boat)
    {
        $price = self::findProduct($boat.'-2')->get_price();
        return $price;
    }

    /**
    * boatAdultsPrice
    * calcula el precio de adultos
    * @param $boat string
    * @param $adults integer
    * @return float
    */
    public static function boatAdultsPrice($boat, $adults)
    {
        $price = self::findProduct($boat.'-'.$adults)->get_price();
        return $price*$adults;
    }

    /**
    * boatChildrenPrice
    * calcula el precio de ninhos
    * @param $boat string
    * @param $children integer
    * @return float
    */
    public static function boatChildrenPrice($boat, $children)
    {
        $price = self::findProduct($boat.'-children')->get_price();
        return $price*$children;
    }
}
