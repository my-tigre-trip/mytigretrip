<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>
<input type="hidden" name="back" value="<?php echo $current_url;?>"/>

<input type="hidden" name="tourSlug" value="{{basename(get_permalink())}}"/>
<input type="hidden" name="_token" value="<?php session_start(); echo session_id(); ?>" />

@include('calculator.snippets.people')
@if($currentTour->isWaterSport())
<br>
<div class="" >
<label for="special-activity">People <?php echo $currentTour->waterSport == 'Ski'?'Waterskiing':'Flyboarding'; ?></label>
  <select name="specialActivityPeople" id="special-activity" required class="form-control">
    <option value="1" <?php echo $specialActivityPeople == 1? 'selected':'';?> >1</option>
    <option value="2" <?php echo $specialActivityPeople == 2? 'selected':'';?> >2</option>
    <option value="3" <?php echo $specialActivityPeople == 3? 'selected':'';?> >3</option>
    <option value="4" <?php echo $specialActivityPeople == 4? 'selected':'';?> >4</option>
    <option value="5" <?php echo $specialActivityPeople == 5? 'selected':'';?> >5</option>
  </select>
</div>
@endif
@include('calculator.snippets.additional-considerations')

@php
$action = '';
if (isset($_GET['action'])) {
  $action = 'add';
}
@endphp
<input type="hidden" name="action" value="{{$action}}" >


@if(isset($_GET['date']))
<input type="hidden" name="date" value="{{$_GET['date']}}" >
@endif

@if(isset($_GET['d']))
<input type="hidden" name="d" value="{{$_GET['d']}}" >
@endif

@if(isset($_GET['mood1']))
<input type="hidden" name="mood1" value="{{$_GET['mood1']}}" >
@endif

@if(isset($_GET['mood2']))
<input type="hidden" name="mood2" value="{{$_GET['mood2']}}" >
@endif

@if(isset($_GET['car']))
<input type="hidden" name="car" value="{{$_GET['car']}}" >
@endif

@if(isset($_GET['payOnIsland']))
<input type="hidden" name="payOnIsland" value="{{$_GET['payOnIsland']}}" >
@endif

@if(isset($_GET['duration']))
<input type="hidden" name="duration" value="{{$_GET['duration']}}" >
@endif

@if(isset($_GET['agency']))
<input type="hidden" name="agency" value="{{$_GET['agency']}}" >
@endif

@if(isset($_GET['agencyContext']))
<input type="hidden" name="agencyContext" value="{{$_GET['agencyContext']}}" >
@endif

@if(isset($_GET['guide']))
<input type="hidden" name="guide" value="{{$_GET['guide']}}" >
@endif