<div class="py-2 w-100"></div>
<label for="mtt-pickme-extra" class="">Pick Up time - from BA City</label>
<select id="mtt-pickme-extra"  class="form-control " name="carPickupTime">
  <option value="9.10 am">9.10 am</option>
  <option value="9.40 am">9.40 am</option>
  <option value="10.10 am">10.10 am</option>
</select>
@include('zoho-form.snippets.driving-distance')
<div class="py-2 w-100"></div>
@if($myBoat->boat === 'full-day')
<label for="mtt-pick-time">Boat departure time - from Tigre's Pier:</label>
<!--<small class="text-info"><?php// $t->mtt('pick-up-time')?>. <?php// $t->mtt('pick-up-time-info');?></small>-->
<select class="form-control" name="departureTime">
  <option value="10 am">10 am</option>
  <option value="10.30 am">10.30 am</option>
  <option value="11 am">11 am</option>
</select>

@elseif ($myBoat->boat !== 'full-day' && $myTrip->car)
<label for="mtt-pick-time" >Boat departure time - from Tigre's Pier: </label>
<select id="timeOptions" class="form-control" name="departureTime">
  @if($myBoat->boat === 'speedboat' || $myBoat->mood1->isMorning())
  <option value="9.10 am">9.10 am</option>
  <option value="9.40 am">9.40 am</option>
  <option value="10.10 am">10.10 am</option>
  @endif
  @if($myBoat->boat === 'speedboat' || $myBoat->mood1->isAfternoon())
  <option class="mtt-pickme" value="3 pm">3 pm</option>
  <option class="mtt-pickme" value="3.30 pm">3.30 pm</option>
  @endif
</select>
@endif
<!-- p class="mtt-show-with-pick"><small class="text-info"> Please remember, our boat trip will start at 3 pm from Tigre´s Public Pier. We will meet you there!</small></p> -->
