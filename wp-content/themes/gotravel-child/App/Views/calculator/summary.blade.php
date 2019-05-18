@php
$priceTitle = '';
if ($myTrip->payOnIsland) {
    $priceTitle = 'Subtotal';
} else {
    $priceTitle = 'Final Price';
}

@endphp
{{--var_dump($myTrip->payOnIsland)--}}
@if($myTrip->payOnIsland)
@include('calculator.summary-pay-island')
@else
@include('calculator.summary-pay-advance')
@endif

  <div class=" p-0 my-3">
    @include('calculator.notes')
  </div>
