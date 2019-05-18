@php
$isLuxury = null;
$isRanch = null;
if ($myBoat->boat !== 'speedboat') {
  $mainTour = $myBoat->mood1;
  $isLuxury = $mainTour->isLuxury();
  $isRanch = $mainTour->isRanch();
	$schedule = $mainTour->schedule;		
}

if ($myTrip->payOnIsland) {
  $estimatedIslandExpenses = $tourDetail['price'];
} else {
  $estimatedIslandExpenses = 0;
}

@endphp
<select id="mtt-include-car" style="display:none;" name="car">
	<option value="Included" @if($myTrip->car || $myBoat->boat === FULL_DAY ) selected @endif >Included</option>
	<option value="Not Included" @if(!$myTrip->car && $myBoat->boat !== FULL_DAY) selected  @endif> >Not Included</option>
	<option value="Included in Price">Included in  Price</option>
</select>

<input type="hidden" name="language" value="en">
<input id="mtt-ticket-number" type="hidden"   maxlength="255" name="ticketNumber" value="{{$myTrip->id}}"/>
<input id="mtt-adults" type="hidden"  name="adults" value="{{$myBoat->adults}}" />
<input id="mtt-children" type="hidden"  name="children" value="{{$myBoat->children}}"/>
<input id="mtt-water-sport" type="hidden"   maxlength="255" name="waterSport" value="{{$myBoat->specialActivityPeople}}" />
<input id="mtt-island-expenses" type="hidden"  name="payOnIsland" value="{{$myTrip->payOnIsland?'Not Included in Price':'Included in Price'}}" />

<input id="mtt-dayOfWeek" type="hidden"  name="weekDay" />
<!-- google calendarMM/dd/yyyy -->
<input id="mtt-google-calendar" type="hidden"  name="dateCalendar" />

<input type="hidden"  name="tripDuration" value="{{$myBoat->boat}}" />
<input id="mtt-mood-1" type="hidden" name="mood1" value="{{$myBoat->mood1->name}}" >
<input type="hidden"  name="schedule" value="{{$schedule}}" />
<input type="hidden"  name="tripType" value="{{PRIVATE_TRIP_ES}}" />

@if($myBoat->boat === FULL_DAY)
<input id="mtt-mood-2" type="hidden" name="mood2" value="{{$myBoat->mood2->name}}" >
@endif

<input id="mtt-estimated-island-expenses" type="hidden" maxlength="255" name="estimatedIslandExpenses" value="{{$estimatedIslandExpenses}}" />

<select  name="additionalConsiderations" style="display:none">
  <option value="-None-">-None-</option>
  @if($isRanch || $isLuxury )
  <option value="Lunch&#x20;&#x2b;&#x20;1&#x20;Activity" @if($isRanch && $mainTour->optionalSelected) selected @endif> >Lunch &#x2b; 1 Activity</option>
  <option value="Lunch&#x20;&#x2b;&#x20;2&#x20;Activities&#x20;&#x2b;&#x20;Tea" @if($isRanch && !$mainTour->optionalSelected)? selected @endif>Lunch &#x2b; 2 Activities &#x2b; Tea</option>
  <option value="Use&#x20;of&#x20;Lodge&acute;s&#x20;Facilities&#x20;Included" @if($isLuxury && $mainTour->optionalSelected)? selected @endif>Use of Lodge&acute;s Facilities Included</option>
  <option value="Use&#x20;of&#x20;Lodge&acute;s&#x20;Facilities&#x20;Not&#x20;Included" @if($isLuxury && !$mainTour->optionalSelected)? selected @endif>Use of Lodge&acute;s Facilities Not Included</option>
  @elseif($myBoat->boat !== 'speedboat' && $myBoat->mood1->isWaterSport() )
  <option value="{{$myBoat->mood1->specialActivityPeople}}" selected></option>
  @elseif($myBoat->mood2 !== null && $myBoat->mood2->isWaterSport() )
  <option value="{{$myBoat->mood2->specialActivityPeople}}" selected></option>
  @endif
</select>

<input id="mtt-final-price" type='hidden'   maxlength='255' name="amount" value="{{$finalPrice}}"/>
<input id="mtt-final-price" type='hidden'   maxlength='255' name="groupDiscount" value="{{$boatDetail['groupDiscount']}}"/>
<input id="mtt-final-price" type='hidden'   maxlength='255' name="priceBeforeDiscount" value="{{$finalPrice + $boatDetail['groupDiscount']}}"/>
