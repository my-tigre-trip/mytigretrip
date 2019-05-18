<?php
use MyTigreTrip\Translation;
use App\Models\Tour;
use App\Models\Session;
use App\Models\ZohoHelpers\Product as ZohoProduct;
use App\Models\ZohoHelpers\ZohoHandler;

ZohoHandler::getInstance()->auth();
$session = Session::getInstance();
$t = new Translation('calculator-en');
$tour = new Tour(basename(get_permalink()), ZohoProduct::getInstance());


global $wp;
$adults = 0;
$children = 0;
$currentTour = $tour;

$myTrip = $session->getMyTrip();
if ($myTrip !== false) {
  $tourBoat = $myTrip->getBoat($tour->boat);
  $adults = $tourBoat->adults;
  $children = $tourBoat->children;
  $specialActivityPeople = $tourBoat->specialActivityPeople;
}
  

$current_url = home_url(add_query_arg(array(), $wp->request));
$action = '';
$valid = true;
//var_dump($tour->category);
$goBack = getGoBackUrl($tour->category);

?>
	<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">

	<h5 class="mkdf-tour-booking-title">Plan your Tigre Trip with us today!</h5>
  <div id="mtt-validator-messages">
  @if($valid !== true)
      {{--
     @include('calculator.messages.'.$valid)
       --}}
  @elseif($valid === true)
  </div>

	<form id="mkdf-tour-booking-form" method="post" action="" class="mtt-form">
  
    @if(basename(get_permalink()) !== 'yacht-a-dramatic-entrance')    
      @include('calculator.snippets.form')
      @include('calculator.snippets.prices')
      @include('calculator.snippets.buttons')
    @else
      <p>Are you part of a group of 6 to 28 people?</p>
      <p>Then find out more about our Private Yacht Experiences!</p>
      @include('calculator.snippets.contact-us')
    @endif
  </form>
   @endif
	
</div>
