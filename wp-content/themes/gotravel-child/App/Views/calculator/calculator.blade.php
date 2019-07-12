	<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">

	<h5 class="mkdf-tour-booking-title">Plan your Tigre Trip with us today!</h5>
  <div id="mtt-validator-messages">
  @if($valid !== true)

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
