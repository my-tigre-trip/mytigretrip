<?php
use MyTigreTrip\Translation;

session_start();
function price_calculator_shortcode($atts)
{
    $t = new Translation('calculator-en');
    global $wp;
    $tourSlug = basename(get_permalink());
    $currentTour = getProductBySKU($tourSlug);
    $currentTour = new Tour($currentTour);

//print_r($currentTour);
    $myTrip = unserialize($_SESSION['myTrip']);
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $action = '';

    if ($myTrip->boat !== null ) {
        if ( $myTrip->stage === 'calculator' ) {
            $myTrip->clearStoredTour(get_the_ID());
        }

        $_SESSION['myTrip'] =  serialize($myTrip);
        $showAlert = false;
        $adults = $myTrip->adults;
        $children =  $myTrip->children;

        $action = $myTrip->goto;

        $nextButton = 'This is my Trip!';
        if (isTourCategory('build-your-own-trip-lunch', get_the_ID())) {
            $nextButton = 'Select & Continue!';
        }


        $hidePeople = false;
        if (isTourCategory('build-your-own-tigre-trip-stop', get_the_ID())) {
            $hidePeople = true;
        }

        //print_r($myTrip);
    //echo "GOTO $action";
        $category = $myTrip->myTourBoatCategory(get_the_ID());
    //  echo 'category '.$category;
        $goBack = home_url().'/';

        switch ($category) {
            case 'non-stop-trip':
                $goBack .= '#boat-selection';
                break;
            case 'half-day-trip-lunch':
                $goBack .= 'half-day-lunch-options';
                break;
            case 'half-day-trip-stop':
                $goBack .= 'half-day-delta-experiences';
                break;
            case 'pre-built-tours':
                $goBack .= 'full-day-tour';
                break;
            case 'build-your-own-trip-lunch':
                $goBack .= 'build-your-own-trip-lunch';
                break;
            case 'build-your-own-tigre-trip-stop':
                $goBack .= 'build-you-own-trip-add-stop';
                break;

            default:
                break;
    }


    } else {
        $showAlert = true;
    }
    $isLuxury = $currentTour->optional == 'luxury'?true:false;
    $isRanch = $currentTour->optional == 'ranch'?true:false;

	?>
	<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">
    <p><?php echo $myTrip->stage; ?></p>
	<h5 class="mkdf-tour-booking-title"><?php esc_html_e('Plan your Tigre Trip with us today!', 'mikado-tours'); ?></h5>
  <?php //echo $isLuxury == true ?'*<small>Children NOT allowed</small>' :''  ;
  if ($myTrip->stage === 'summary') :   ?>

    <p><?php echo $t->mtt('summary-stage') ?></p>
    <a class="back-to-checkout" href="<?php echo home_url().'/my-trip' ?>">Go to checkout!!</a>
    <hr>
    <a class="clear-option" href="<?php echo home_url().'/clear-option' ?>"> Clear My Tigre Trip and start again</a>
<?php elseif(!$showAlert):  ?>
	<form id="mkdf-tour-booking-form" method="post" action="" class="mtt-form">
		<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>
		<input type="hidden" name="back" value="<?php echo $current_url;?>"/>
		<input type="hidden" name="tour-price" value="<?php echo mkdf_tours_get_tour_price(get_the_ID());?>"/>
		<input type="hidden" name="tour-title" value="<?php echo get_the_title();?>"/>
		<input type="hidden" name="tour-id" value="<?php echo esc_attr(get_the_ID()); ?>"/>
		<input type="hidden" name="tour-slug" value="<?php echo basename(get_permalink()); ?>"/>
		<input type="hidden" name="_token" value="<?php session_start(); echo session_id(); ?>" />


  <?php if(!$hidePeople):  ?>
		<div class="" >
		<label for="adults">Adults </label>
			<select name="adults" id="adults" class="form-control">
				<option > </option>
				<option value="2" <?php echo $myTrip->adults == 2? 'selected':'';?> >2</option>
				<option value="3" <?php echo $myTrip->adults == 3? 'selected':'';?> >3</option>
				<option value="4" <?php echo $myTrip->adults == 4? 'selected':'';?> >4</option>
        <option value="5" <?php echo $myTrip->adults == 5? 'selected':'';?> >5</option>
			</select>
		</div>

    <?php //if (!$isLuxury) : ?>
		<div class="" >
    <?php if (!$isLuxury) : ?>
		<label for="children"><div class="tooltip">Children<span class="tooltiptext">Paying children are more than 2 and under 10 years of age.</span></div></label>
    <?php else:  ?>
      <label for="children"><div class="tooltip">Children<span class="tooltiptext">This Mood is not suggested for children</span></div></label>
    <?php endif;  ?>
			<select name="children" id="children" <?php echo $isLuxury? 'disabled':'' ;?> class="form-control" >
				<option value="0" <?php echo ($myTrip->children == '0' || $isLuxury )? 'selected':'';?> >0</option>
				<option value="1" <?php echo $myTrip->children == '1'? 'selected':'';?> >1</option>
				<option value="2" <?php echo $myTrip->children == '2'? 'selected':'';?> >2</option>
				<option value="3" <?php echo $myTrip->children == '3'? 'selected':'';?> >3</option>
			</select>

		</div>

  <?php else: // si es add stop oculto los select de gente  ?>

    <input id="children" type="hidden" name="children" value="<?php echo empty($myTrip->children)?0:$myTrip->children;?>"/>
    <input id="adults" type="hidden" name="adults" value="<?php echo $myTrip->adults;?>"/>
    <?php endif;  ?>

		<?php
    if (!empty($currentTour->waterSport)) : ?>
		<div class="" >
		<label for="special-activity">People <?php echo $currentTour->waterSport == 'Ski'?'Waterskiing':'Flyboarding'; ?></label>
			<select name="special-activity" id="special-activity" required class="form-control">
				<option value="1" <?php echo $myTrip->specialActivity == 1? 'selected':'';?> >1</option>
				<option value="2" <?php echo $myTrip->specialActivity == 2? 'selected':'';?> >2</option>
				<option value="3" <?php echo $myTrip->specialActivity == 3? 'selected':'';?> >3</option>
				<option value="4" <?php echo $myTrip->specialActivity == 4? 'selected':'';?> >4</option>
        <option value="5" <?php echo $myTrip->specialActivity == 5? 'selected':'';?> >5</option>
			</select>
		</div>
		<?php endif; ?>

    <?php if ($isLuxury) :?>
		<div class="mtt-optional">
			<input class="update-calculator" id="luxury" name="luxury" value="yes" type="checkbox" <?php if( $myTrip->luxury ){  ?> checked <?php } ?> >
      <input name="isLuxury" value="yes" type="hidden"  />
			<label for="luxury" >I´d like to make use of Lodge´s facilities (swimming pool, pedal boats)</label>
		</div>
		<?php endif; ?>
    <?php if( $isRanch ): ?>
		<div class="mtt-optional">
			<input class="update-calculator" id="ranch" name="ranch" value="yes" type="checkbox" <?php if( $myTrip->ranch ){  ?> checked <?php } ?> >
      <input  name="isRanch" value="yes" type="hidden" />
      <label for="ranch" >I´d rather have lunch, participate on one activity and skip tea.</label>
		</div>
		<?php endif; ?>

    <div class="mtt-loading mtt-loading-calculator">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>
		<div id="booking-validation-messages-holder"></div>
		<div id="mtt-price" >
			<div id="mtt-price-detail"></div>
			<div id="mtt-messages"></div>
      <div id="mtt-large-group-message"></div>
		</div>



		<?php //var_dump($myTrip) ; ?>
		<div class="mtt-calculator-buttons">

      <button id="calculate" type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">Calculate</button>
      <a aria-hidden="select this option" id="next-step" class="mtt-select-option" href="##"><button id="next-step-button"  type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button"><?php echo $nextButton; ?></button>
      </a>
    </div>
    <div class="mtt-goback vc_col-12">
       <a aria-hidden="go back" class="left" href="<?php echo $goBack; ?>"><i class="fa fa-arrow-circle-o-left"></i></a>
    </div>
		<div>
      <?php if( false ):  ?>
			<a  href="<?php echo home_url() ?>/clear-option/"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
			<?php endif; ?>
		</div>
  <?php else: //  alert
    $message = $t->mtt('no-boat-selected');
    ?>
    <p><?php echo $message ?></p>
    <a class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid  mtt-button" href="<?php echo home_url(); ?>#boat-selection">Designe My Tigre Trip</a>
  <?php endif; // fin alert ?>
	</form>

	<!-- <button><i class="fa fa-chevron-left" aria-hidden="true"></i></button> -->

</div>
	<?php

}#fin shortcode

add_shortcode( 'calculadoraDepr', 'price_calculator_shortcode' );


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
