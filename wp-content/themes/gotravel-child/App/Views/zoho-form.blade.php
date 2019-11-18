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

        <div class="collapse" id="collapseExample" id="mtt-summary">@include('calculator.summary')</div>
      </div>
    </div>
    <div class="my-2">
      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">#Review Trip Details +</a>
    </div>

  </div>
  <hr class="my-5">
  <p>Please complete the following information</p>
  <form id="mtt-checkout-form" action="/mytigretrip/checkout.php" method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory()' accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{session_id()}}"  />
  @include('snippets.mtt-query-inputs-checkout')
  @include('zoho-form.agency')
  <div class="form-row mt-4">
    @include('zoho-form.personal-data')
  </div>
  <hr class="my-3">  
  <div class="form-row mt-4 mttTimeDependent">
    @include('zoho-form.date-fields')
  </div>
  <hr class="my-3">
  <div class="form-row mt-4 mttTimeDependent">
    @include('zoho-form.car-pickup-fields')
  </div>
  <hr class="my-3">
  <div class="form-row mt-4">
    @include('zoho-form.more-info')
  </div>
 <hr class="my-3">
   @include('zoho-form.hidden-fields')
  <div class="form-row my-4">
    <button id="mtt-book-my-trip" class="btn btn-dark btn-mtt-checkout  mx-auto" type="submit"  name="book">Book Now!!</button>
  </div>
</form>
</div>

<div class="col-md-4">
</div>
@endsection

@push('javascript')
<script type="text/javascript">
$(document).ready(function() {
  $("#mtt-book-my-trip").click(function(e){
    e.preventDefault();
    checkoutRequest();
  });

  // evento pick con scoll

  if ($("#mttTimeSelector").length > 0) {
  // $(".mttTimeDependent").hide()
  }

  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
