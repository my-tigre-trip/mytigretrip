<div class="vc_col-sm-6">
<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>
@include('trip-search.people')
<div id="mtt-validator-messages" class="vc_col-12"></div>
  <div>
    <button type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">
      Check availability
    </button>
  </div>
</div>
<div class="vc_col-sm-6">
</div>
