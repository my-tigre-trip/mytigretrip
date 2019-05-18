<?php
require 'wp-load.php';
session_start();
//echo session_id();


//global $wp_session;
//print_r($_POST);

if( isset($_SESSION['boat']) && isset( $_POST['adults'] ) ){

        //si ya esta listo para hacer checkout
    if( isset( $_POST['select-tour'] )  && $_POST['select-tour']  == 'form' ){
            $_SESSION['storedTour'] = [  $_POST['tour-price']  , $_POST['tour-title'] ];
            wp_redirect( home_url().'/my-trip' );
            echo 'gfdg';
    }else{
        wp_redirect( $_POST['back']);
    }

    //Si es full day y ya eligio lunch entonces guardamos el lunch y lo llevamos a elegir una parada
	if( $_SESSION['boat'] == 'full-day' && isset( $_POST['select-tour'] )  && $_POST['select-tour']  == 'select'  ){
        $_SESSION['storedTour'] = [  $_POST['tour-price']  , $_POST['tour-title'] ];

        wp_redirect( home_url().'/build-you-own-trip-add-stop' );
    }

    //si esta declarado
    
    if( isTourCategory('water-sports',$_POST['tour-id'] )  ){
        $_SESSION['waterSports'] = intval($_POST['water-sports']);
    }
    //si está declarado auto
    if( isset( $_POST['car'] )  ){
        $_SESSION['car'] = getCarPrice();
    }

    if( isset( $_POST['pay-island'] )  ){
        $_SESSION['pay-island'] = '1';
    }
    //si está declarado luxury
    if( isset( $_POST['luxury'] )  ){
        //$_SESSION['luxury'] = getLuxuryPrice();
    }


    $_SESSION['adults'] = $_POST['adults'];
    $_SESSION['children'] = $_POST['children'];
    //print_r($_SESSION);




}else{
	// usar luego esc para idioma
//	$_SESSION['message']['calculator']['error'] = 'Debe seleccionar la cantidad de adultos';
}
