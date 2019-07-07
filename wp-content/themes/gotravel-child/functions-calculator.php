<?php
use MyTigreTrip\Translation;
use Jenssegers\Blade\Blade;
use App\Models\Calculator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use App\Models\ZohoHelpers\Product as ZohoProduct;

/*
* shortcode for calculator rendering, should use the Calculator Controller
*/
function renderCalculator()
{
    $blade = new Blade(__DIR__.'/App/Views', __DIR__.'/App/Cache');
    $calculator = new \App\Controllers\CalculatorController();
    $T = new Translation('calculator-en');
    $ZP = ZohoProduct::getInstance();
    $view = $calculator->calculator($_GET, $ZP, $T, $blade); 

    echo $view;
}

add_shortcode( 'calculadora', 'renderCalculator' );
//

function addBiggerGroupLink(){
	echo 'Are you part of a bigger group? Contact us for details our yatch tours!';
}



function getGoBackUrl($category)
{
    //  $category = $myTrip->myTourBoatCategory(get_the_ID());
      //echo 'category '.$category;
      $goBack = home_url().'/';

      switch ($category) {
        case 'speedboat-trip':
              $goBack .= '#boat-selection';
              break;
        case 'half-day-lunch':
              $goBack .= 'half-day-lunch-options';
              break;
        case 'half-day-stop':
              $goBack .= 'half-day-delta-experiences';
              break;
        case 'pre-built-tours':
              $goBack .= 'pre-built-tours';
              break;
        case 'build-your-own-tigre-trip-lunch':
              $goBack .= 'build-your-own-trip-lunch';
              break;
        case 'build-your-own-tigre-trip-stop':
              $goBack .= 'build-you-own-trip-add-stop';
              break;
        default:
              break;
    }
    return $goBack;
}

/**
* getCurrentTour
* @return Tour
*/
function getCurrentTour()
{
    $tourSlug = basename(get_permalink());
    $currentTour = getProductBySKU($tourSlug);
    $currentTour = new Tour($currentTour);
    return  $currentTour;
}

/**
* function validateCalculator()
*
* @return string  codigos de alertas/mensajes o true si es valido
*/
function validateCalculator($myTrip)
{
    $alert = '';
    if ($myTrip === false || $myTrip->boat === null) {
        $alert = 'no-boat';
    } /*elseif (isset($_SESSION['lockBoat'])) {
    //   $alert = 'calculator-stage';
  } */ elseif ($myTrip->stage === 'summary') {
        $alert = 'summary-stage';
    } else {
        return true;
    }

    return $alert;
}
