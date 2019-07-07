<?php

/*** Child Theme Function  ***/

function gotravel_mikado_child_theme_enqueue_scripts() {

	$parent_style = 'gotravel_mikado_modules';
	if(is_front_page()) {
		wp_enqueue_script( 'mtt-utils', get_stylesheet_directory_uri() . '/js/utils.js', array ( 'jquery' ), rand(111,9999), true);
	}
	
	wp_enqueue_script( 'mytigretrip', get_stylesheet_directory_uri() . '/mytigretrip.js', array ( 'jquery' ), rand(111,9999), true);
	wp_enqueue_style('mytigretrip-css', get_stylesheet_directory_uri() . '/style.css', array($parent_style), rand(111,9999), 'all');
	wp_enqueue_style('datepicker', get_stylesheet_directory_uri() . '/css/datepicker.min.css', array($parent_style), rand(111,9999), 'all');
}

add_action( 'wp_enqueue_scripts', 'gotravel_mikado_child_theme_enqueue_scripts' );

function theme_js() {

}

// fix vc
function change_frontend_editor_iframe_url($url) {
    return str_replace("http://", "https://", $url);
}
add_filter('vc_frontend_editor_iframe_url', 'change_frontend_editor_iframe_url');


//----
include('definitions.php');
include('bootstrap.php');
//require_once('MyTrip.php');
//require_once('Tour.php');
require_once('Translation.php');
include('functions-calculator.php');
include('functions-trip-search.php');
include('functions-jose.php');
include('functions-info-section.php');
include('functions-tour-options.php');
//include('functions-contact-form.php');
//include('functions-contact-zoho.php');
include('functions-zoho-form.php');
include('functions-api.php');

// products array file
$folder = __DIR__.'/zoho-products';
$files = scandir($folder, SCANDIR_SORT_DESCENDING);
$newest_file = $folder.'/'.$files[0];
//global $zohoProductsArray;
include($newest_file);
global $zohoProductsArray;
$zohoProductsArray = $zohoProductsArray;