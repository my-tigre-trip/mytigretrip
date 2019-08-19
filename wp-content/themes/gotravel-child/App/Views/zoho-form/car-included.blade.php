@if($myBoat->boat === FULL_DAY ||  $myBoat->mood1->schedule === MORNING_ES)
  @include('zoho-form.snippets.morning-schedule')
@else
  @include('zoho-form.snippets.not-morning-schedule')
@endif

<div class="mt-2 w-100"></div>
<label for="mtt-pickup-address" >Pick Up Adress - from BA City*:</label><br>
<textarea class="form-control" id="mtt-pickup-address" name="pickupAddress" maxlength='2000' required></textarea>

@push('javascript')
<script type="text/javascript">
var carPickupTime = {
  "10 am":["9.10 am"],
  "10.30 am":["9.40 am"],
  "11 am":["10.10 am"],
  "3 pm": ["10 am", "10.30 am", "11 am", "11.30 am",
      "12 pm", "12.30 pm", "13 pm", "13.30 pm", "14.10 pm"],
  "3.30 pm": ["10 am", "10.30 am", "11 am", "11.30 am",
      "12 pm", "12.30 pm", "13 pm", "13.30 pm","14 pm", "14.30 pm", "14.40 pm"]
}

var departureTimeMorning = {
  "9.10 am":["10 am"],
  "9.40 am":["10.30 am"],
  "10.10 am":["11 am"]
}


function setCarPickUpTime() {
  var list = $('select[name="departureTime"]');
  var time = list.val();
  //time = time ? time : list.first().next().val();
  //limpiamos carPickupTime
  $('select[name="carPickupTime"] option').remove();

  console.log('departureTime selected '+time);
  var options = carPickupTime[time];
  //console.log('Nr pick up options '+options.length);
  for(var i = 0; i < options.length; i++){
    var selected = (i+1) == options.length? 'selected': '';
    var addOption = '<option value="'+options[i]+'" '+selected+' >'+options[i]+'</option>';
    console.log('pick up option: '+options[i]);
    $('select[name="carPickupTime"]').append(addOption);
  }
}

function setBoatDepartureTime() {
  var list = $('select[name="carPickupTime"]');
  var time = list.val();
  //time = time ? time : list.first().next().val();
  //limpiamos carPickupTime
  $('select[name="departureTime"] option').remove();

  console.log('departureTime selected '+time);
  var options = departureTimeMorning[time];
  console.log('Nr pick up options '+options.length);
  for(var i = 0; i < options.length; i++){
    var selected = (i+1) == options.length? 'selected': '';
    var addOption = '<option value="'+options[i]+'" '+selected+' >'+options[i]+'</option>';
    console.log('pick up option: '+options[i]);
    $('select[name="departureTime"]').append(addOption);
  }
}

$(document).ready(function(){
  if ($('meta[name="schedule"]').attr("value") === 'morning')
  {
    
    setBoatDepartureTime();
    $('select[name="carPickupTime"]').change(function(){
      setBoatDepartureTime();
    });
  } else {
    //setCarPickUpTime();
    $('select[name="departureTime"]').change(function(){
      setCarPickUpTime()
    });
  }
   
});
</script>
@endpush
