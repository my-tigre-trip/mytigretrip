@extends('layout.form')
@push('javascript')
@include('scripts.mtt')
@include('scripts.zoho-validation')
@endpush
@php
 $schedule = '';
if ($myBoat->boat === SPEEDBOAT || $myBoat->boat === FULL_DAY) {
	$schedule = 'full-day';
} else {
	$schedule = $myBoat->mood1->schedule;
}//is not extending variables

$isAdmin = false;
if(is_user_logged_in() && current_user_can('administrator')) {
  $isAdmin = true;
}
@endphp
@section('content')
<div class="col-md-8 offset-md-1">
  <span class="anchor" id="formComplex"></span>
  <hr class="my-5">
<!-- -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9 col-sm-12 p-0">
			<div class="mtt-loading">
				<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
				<span class="sr-only">Loading...</span>
			</div>
			<div id="mtt-summary"></div>
		</div>
	</div>
</div>

<hr class="my-5">
	<form id="mtt-my-trip-form" method="post" >
		<input type="hidden" name="_token" value="<?php session_start(); echo session_id(); ?>" />
		@include('snippets.mtt-query-inputs')
		<h5 class="mtt-form-title"><?php esc_html_e('Observations', 'mtt'); ?></h5>
		<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>

		@if(isset($_GET['agencyContext']) && $_GET['agencyContext'] == 'true')
			<div class="custom-control custom-checkbox my-2">
				<input type="checkbox" class="form-control custom-control-input updateSummary" name="guide" id="guide" <?php if( $myTrip->guide ){  ?> checked <?php } ?> value="true">
				<label class="custom-control-label " for="guide">
				Include a guide (For agencies)
				<a class="text-success" data-toggle="modal" data-target="#guide">
				More info
				</a>  
				</label>
				<!-- Button trigger modal -->				
			</div>
		@endif

		@if($isAdmin && $myBoat->hasOptional() !== false)
			<div class="custom-control custom-checkbox my-2">
				<input class="form-control custom-control-input updateSummary" id="optional" name="optional" value="yes" type="checkbox"  >
				<label class="custom-control-label" for="optional" >{{$myBoat->hasOptional()}}</label>
			</div>
		@endif

		@if($isAdmin && $myBoat->hasActivity() !== false)
		<br>
		<div class="" >
		<label for="special-activity">People {{$myBoat->hasActivity()}}</label>
			<select name="specialActivityPeople" id="special-activity" required class="form-control updateSummary">
				<option value="0">-</option>
				<option value="1" >1</option>
				<option value="2" >2</option>
				<option value="3" >3</option>
				<option value="4" >4</option>
				<option value="5" >5</option>
			</select>
		</div>
		@endif

		@if($myBoat->boat !== 'speedboat')
			<div class="custom-control custom-checkbox my-2">
				<input type="checkbox" class="form-control custom-control-input updateSummary" name="payOnIsland" id="pay-on-island" <?php if( $myTrip->payOnIsland ){  ?> checked <?php } ?> value="yes">
				<label class="custom-control-label " for="pay-on-island">
				Please do not include my island expenses (lunch / alternative activities) in final price. I´d rather pay them myself the day of my trip.
				<a class="text-success" data-toggle="modal" data-target="#payOnIslandModal">
				More info
				</a>  
				</label>
				<!-- Button trigger modal -->				
			</div>
		@endif		

		<div class="custom-control custom-checkbox my-2">		
			<input class="form-control custom-control-input updateSummary @if( $myBoat->boat == FULL_DAY ) d-none @endif"
				id="car" name="car" value="yes" type="checkbox"
			    @if( $myTrip->car || $myBoat->boat == FULL_DAY ) checked @endif
          		@if( $myBoat->boat === FULL_DAY ) disabled @endif
			>
			@if( $myBoat->boat === FULL_DAY )
			<label for="car" class="custom-control-label" >Private car pick up & drop off to your hotel (Included in price)</label>
	  		@elseif($schedule === AFTERNOON)
			<label for="car" class="custom-control-label" >
			Include private car pick up & drop off to my hotel (charged separately)
			<a class="text-success" data-toggle="modal" data-target="#carAfternoonModal">
			More info
			</a> 
			</label>
			<!-- Button trigger modal -->
			 
			@else
      		<label for="car" class="custom-control-label" >Include private car pick up & drop off to my hotel (charged separately)</label>
		  	@endif
			<div class="mtt-optional-text">
			  	@if( $myTrip->boat !== FULL_DAY )
				<p class="mtt-show-with-car"></p>
				<p class="mtt-hide-with-car" ></p>
				@endif
			</div>
		</div>

		<div class="custom-control custom-checkbox my-2">
			<input class="custom-control-input" id="terms" name="terms" value="yes" type="checkbox" @if($isAdmin) checked @endif >
			<label class="custom-control-label" for="terms" >I accept the <a target="_blank" href="https://drive.google.com/open?id=1JuWXf0kvkrYssC4aFreelO4vYDDKZOHq" >Terms & Conditions</a></label>
		</div>

		<div class="form-row my-4" >
			<button id="mtt-get-my-trip" type="submit" class="btn btn-dark btn-mtt-checkout">Next!!</button>
			<button id="mtt-get-my-trip-disabled" class="btn btn-info btn-mtt-checkout">Next!!</button>
		</div>
	</form>
	@if($schedule !== FULL_DAY)
		@include('zoho-options-form.modals.car-afternoon')
	@endif
	@include('zoho-options-form.modals.pay-on-island')
</div>
@endsection
