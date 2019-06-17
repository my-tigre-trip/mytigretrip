	<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">

	<h5 class="mkdf-tour-booking-title">Plan your Tigre Trip with us today!</h5>
  

	<form id="mtt-trip-search-home" method="post" action="" class="mtt-form vc_col-12">
      @include('trip-search.form')
      {{-- @include('calculator.snippets.prices')
      @include('calculator.snippets.buttons') --}}    
  <div id="mtt-validator-messages" class="vc_col-12"></div>
  <div><button type="submit">Check availability</button></div>
  </form>
</div>