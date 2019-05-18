<?php /* Template Name: MyTigreTrip Discounts */
$goBack = home_url();
//var_dump($myTrip);
if (!isset($_POST['discount_token'])) {
      //wp_redirect($goBack);
} else {

}

?>
<?php the_post(); ?>

<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
<?php  //get_template_part( 'slider' ); ?>

	<div class="mkdf-container">

		<div class="mkdf-container-inner clearfix">
      <div><?php the_content('my-trip-checkout'); ?></div>
      <!--
      <div class="wpb_wrapper mkdf-tour-booking-form-holder mkdf-boxed-widget">
        <div class="vc_col-sm-12 vc_col-md-6 mtt-tour-item">

          <form class="" action="" method="post">
            <div class="vc_col-sm-12 vc_col-md-6">
              <label for="ticket_number" class="d-none" style="display:none">Ticket ID</label>
              <input type="text" class="form-control" id="ticket_number" placeholder="Ticket ID*" name="ticketNumber"  required>

            </div>
            <div class="vc_col-sm-12 vc_col-md-6">
              <label for="email" class="d-none" style="display:none">E-mail</label>
              <input type="text" class="form-control" id="email" placeholder="Email *" name="email"  required>

            </div>

            <div class="vc_col-sm-12">

              <div class="mtt-calculator-buttons">
                <button id="calculate" type="submit" class="mtt-button mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid mtt-get-price mtt-button">Calculate</button>
              </div>

            </div>
          </form>
        </div>
      </div>
      -->
      <div class="mtt-goback vc_col-12">
         <a href="<?php echo $goBack; ?>"><i class="fa fa-home"></i></a>
     </div>
		</div>

	</div>
<?php get_footer(); ?>
