@php
use MyTigreTrip\Translation;
$t = new Translation('contact-form-en');
@endphp
@extends('layout.form')
@push('javascript')
@include('scripts.mtt')
@endpush
@section('content')
<div class="col-md-8 offset-md-1">
  <span class="anchor" id="formComplex"></span>
  <hr class="my-5">


  <!-- form complex example -->
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-9 col-sm-12 pt-1">

        <div class="collapse" id="collapseExample" id="mtt-summary">
            {{-- @include('calculator.summary') --}}
        </div>
      </div>
    </div>
    <div class="my-2">
      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">#Review Trip Details +</a>
    </div>

  </div>
  <hr class="my-5">
  <p>Please complete the following information</p>
  <form id="mtt-checkout-form" accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{session_id()}}"  />
  <input type="hidden" value="{{$_GET['adults']}}" name="adults" >
  @include('zoho-form.zoho-fields')
  <div class="form-row mt-4">
    @include('zoho-form.personal-data')
  </div>
  <hr class="my-3">  
  <div class="form-row mt-4 mttTimeDependent">
    @include('zoho-form.shared-date-fields')
   
  </div>
  


  <hr class="my-3">
  <div class="form-row mt-4">
    @include('zoho-form.more-info')
  </div>
 <hr class="my-3">
   {{-- @include('zoho-form.hidden-fields') --}}
   
  <div class="form-row my-4">
    <button id="mtt-book-my-shared-trip" class="btn btn-dark btn-mtt-checkout  mx-auto" type="submit"  name="book">Book Now!!</button>
  </div>
</form>
</div>

<div class="col-md-4">
</div>
@endsection

@push('javascript')
<script type="text/javascript">
$(document).ready(function(){
  $("#mtt-book-my-shared-trip").click(function(e){
    e.preventDefault();
    checkoutSharedRequest();
  });
  
  @if($myBoat->boat === 'speedboat')
    //$(".multiDatePicker").hide();
    
    calendarRequest("morning", "#datepickerMorning");
    calendarRequest("afternoon","#datepickerAfternoon");   

    toogleCalendars($('input[name="schedule"]').val());        
    //multi calendar handler
    $("select[name=mttTimeSelector]").change(function(e) {  
      var val = $(this).val();  
      toogleCalendars(val);     
    });
    
  @else
    calendarRequest($('meta[name="schedule"]').attr("value"));
  @endif

  // evento pick con scoll

if ($("#mttTimeSelector").length > 0) {
 // $(".mttTimeDependent").hide()
}

$('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
