<div class="mtt-calculator-buttons">
  <input id="lockTrip" type="hidden" name="lock" value="">

  <button id="calculate" type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">Calculate</button>
  <button id="next-step-button"  type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button"></button>
</div>
<div class="mtt-goback vc_col-12">
  <a aria-hidden="go back" class="left" href="<?php echo e($goBack); ?>"><i class="fa fa-arrow-circle-o-left"></i></a>
</div>
<div>
<?php if( false ):  ?>
	<a  href="<?php echo home_url() ?>/clear-option/"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
<?php endif; ?>
</div>