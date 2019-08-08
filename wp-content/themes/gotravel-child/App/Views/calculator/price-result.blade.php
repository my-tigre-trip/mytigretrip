<div class="mtt-trip-details">
  <h4>Trip details</h4>
  <ul>
    <li>Date: {{$date}}</li>
    <li>Duration : {{$boatDetail['boat']}}</li>
    @if($tourDetail['mood1'] != '')
    <li>I´m in the Mood for {{$tourDetail['mood1']}}</li>
    @endif
    @if($tourDetail['mood2'] != '')
    <li>I´m also in the Mood for {{$tourDetail['mood2']}}</li>
    @endif
  </ul>
</div>
<table class="mtt-price">
   <tr>
   <td class="mtt-price-value">{{$price['priceAdults']}}</td>
   <td>{{$boatDetail['adults']}} Adults</td>
   </tr>
   @if($boatDetail['children'] > 0)
   <tr>
   <td class="mtt-price-value">{{$price['priceChildren']}}</td>
   <td>{{$boatDetail['children']}} Children</td>
   </tr>
   @endif
   @if($tourDetail['specialActivityPeople'] > 0)
     @php
       $count = $tourDetail['specialActivityPeople'] > 1? 'Classes':'Class';
     @endphp
   <tr>
   <td class="mtt-price-value">{{$tourDetail['specialActivityPrice']}}</td>
   <td>{{$tourDetail['specialActivityPeople']}} {{$tourDetail['specialActivity']}} {{$count}}</td>
   </tr>
   @endif

   @if($boatDetail['groupDiscount'] > 0)
   <tr class="mtt-group-discount">
   <td class="mtt-price-value">-{{$boatDetail['groupDiscount']}}</td>
   <td>Group Discount</td>
   </tr>
   @endif

   <tr class="mtt-total-price">
   <td class="mtt-price-value">{{$finalPrice}}</td>
   <td>Final Price</td>
   </tr>

</table>

<div class=" p-0 my-3">
  @include('calculator.price-result-notes')
</div>
