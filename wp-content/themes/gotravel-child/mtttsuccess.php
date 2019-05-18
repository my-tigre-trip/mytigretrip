<?php /* Template Name: MyTigreTrip Checkout */
session_start();
$myTrip = unserialize($_SESSION['myTrip']);



$goBack = home_url();
//var_dump($myTrip);
if ($myTrip !== false) {
    session_destroy();
} else {
    wp_redirect($goBack);
}

?>
<?php the_post(); ?>

<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
<?php  //get_template_part( 'slider' ); ?>

	<div class="mkdf-container">

		<div class="mkdf-container-inner clearfix">
      <div><?php the_content('my-trip-checkout'); ?></div>

      <div class="wpb_wrapper ">
        <div class="vc_col-sm-12 vc_col-md-6 mtt-tour-item">

        </div>
      </div>
      <div class="mtt-goback vc_col-12">
         <a href="<?php echo $goBack; ?>"><i class="fa fa-home"></i></a>
     </div>
		</div>

	</div>
<?php get_footer(); ?>
