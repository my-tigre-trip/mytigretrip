<?php
function whatIsMyTourType($tourId){

    $categories = wp_get_post_terms($tourId, 'tour-category');

    foreach($categories as $c){
        echo "<br> $c->slug";
    }
}
add_shortcode( 'mtt-que-tipo-soy', 'whatIsMyTourType' );

function isTourCategory($categorySlug, $tourId){
    $has = false;
    $categories = wp_get_post_terms($tourId, 'tour-category');

    foreach($categories as $c){
        if( $c->slug == $categorySlug ){
            $has = true;break;
        }
        //echo "<br> $c->slug";
    }
    return $has;
}
add_shortcode( 'mtt-que-tipo-soy', 'whatIsMyTourType' );

/**
 *
 */
function tourRedirection($atts = null ){
    wp_redirect( home_url() );
}
add_shortcode( 'mtt-redireccion', 'tourRedirection' );


function getTourPrice($id){
//    str_replace('$','',mkdf_tours_get_tour_price($tourId)) * $this->getPeople() ;
  return intval(str_replace(['$','USD'],'',mkdf_tours_get_tour_price($id)))  ;
}

/**
* getProductBySKU
*/

function getProductBySKU($sku)
{
    $product = null;
    if (function_exists('wc_get_product')) {
        //   echo $_SESSION['boat'].'-'.$_SESSION['adults'];
        $_product = wc_get_product_id_by_sku($sku);
        $_product = wc_get_product($_product);
        if ($_product !== null) {
            $product = $_product;
        }
        //    $price =  $_product->get_price();
    }
    return $product;
}
