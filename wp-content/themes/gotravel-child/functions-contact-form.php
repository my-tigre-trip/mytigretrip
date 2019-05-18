<?php
function contact_form_shortcode($atts){
	$myTrip = unserialize($_SESSION['myTrip']);
	//$myTrip->isLuxury();
	//$myTrip->isRanch();
	//$_SESSION['myTrip']
?>
<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">
	<h5 class="mkdf-tour-booking-title"><?php esc_html_e('My Tigre Trip Summary', 'mtt'); ?></h5>
	<div class="mtt-loading">
			<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
			<span class="sr-only">Loading...</span>
	</div>
	<div id="mtt-summary"></div>



	<form id="mtt-my-trip-form" method="post" >
		<input type="hidden" name="_token" value="<?php session_start(); echo session_id(); ?>" />
		<h5 class="mtt-form-title"><?php esc_html_e('Final Details', 'mtt'); ?></h5>
		<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>
		<?php if($myTrip->boat !== 'speedboat'):?>
		<div class="mtt-optional">
			<input  class="updateSummary" id="pay-on-island" name="pay-on-island" value="yes" type="checkbox" <?php if( $myTrip->payOnIsland ){  ?> checked <?php } ?> >
			<label for="pay-on-island" >I do not want to pay for my island expenses in advance. I´d rather pay them myself the day of my trip.</label>
		</div>
	<?php endif; ?>

		<div class="mtt-optional">
			<input class="updateSummary" id="car" name="car" value="yes" type="checkbox"
			    <?php if( $myTrip->car || $myTrip->boat == 'full-day' ){  ?> checked <?php } ?>
          <?php if( $myTrip->boat == 'full-day' ){  ?> disabled <?php } ?>
					>
			<?php if( $myTrip->boat == 'full-day' ):  ?>
			<label for="car" >Private car pick up & drop off to your hotel (Included in price)</label>
	  	<?php else: ?>
      <label for="car" >Include private car pick up & drop off to my hotel (additional <?php echo $myTrip->currency.' '. $myTrip->carPrice; ?>)</label>
		  <?php endif; ?>
			<div class="mtt-optional-text">
			  <?php if( $myTrip->boat !== 'full-day' ):  ?>
				<p class="mtt-show-with-car"><?php // echo __(' If you want to discover mainland Tigre, we will arrange different car and boat timetables') ?></p>

				<p class="mtt-hide-with-car" ><?php // echo __('Meet us at Tigre´s Public Pier -2 blocks from the Train Station. We´ll send directions shortly') ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="mtt-checkbox">
			<input id="terms" name="terms" value="yes" type="checkbox"  >
			<label for="terms" >I accept the <a target="_blank" href="https://drive.google.com/open?id=1JuWXf0kvkrYssC4aFreelO4vYDDKZOHq" >Terms & Conditions</a></label>
		</div>

		<div>
				<button id="mtt-get-my-trip" type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">BOOK NOW!!</button>
				<button id="mtt-get-my-trip-disabled" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">BOOK NOW!!</button>
		</div>
	</form>



</div>

<?php

}#fin shortcode

add_shortcode( 'formulario_contacto', 'contact_form_shortcode' );


function showRanchOptional($tourId){
	return $tourId == 3725 ? true:false;
}

function showLuxuryOptional($tourId){
	return $tourId == 4? true:false;
}
