<label for="mtt-pick-time" >Boat departure time - from Tigre's Pier: </label>
<select id="timeOptions" class="form-control" name="departureTime"> 
@if($myBoat->boat === 'speedboat' || $myBoat->mood1->isMorning())
  <option value="10.30 am">10.30 am</option>
  <option value="11 am">11 am</option>
@endif
@if($myBoat->boat === 'speedboat' || $myBoat->mood1->isAfternoon())  
  <option class="mtt-pickme" value="3 pm">3 pm</option>
  <option class="mtt-pickme" value="3.30 pm">3.30 pm</option>
@endif
</select>
