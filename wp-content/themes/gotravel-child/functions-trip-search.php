<?php 
use Jenssegers\Blade\Blade;

function renderTripSearchForm() {
    $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
   // $myTrip = unserialize($_SESSION['myTrip']);
    echo $blade->make('trip-search.main', ['req' => $_GET ]);
}

add_shortcode( 'trip-search-form', 'renderTripSearchForm' );