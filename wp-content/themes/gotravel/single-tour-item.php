<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
<?php get_template_part( 'slider' ); ?>
	<div class="mkdf-container">
		<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner clearfix">
			<?php mkdf_tours_get_single_tour_item(); ?>
		</div>
		<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>