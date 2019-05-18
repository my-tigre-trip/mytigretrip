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
