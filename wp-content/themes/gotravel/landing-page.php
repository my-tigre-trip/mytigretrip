<?php
/*
Template Name: Landing Page
*/
$mkdf_sidebar = gotravel_mikado_sidebar_layout();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * gotravel_mikado_header_meta hook
	 *
	 * @see gotravel_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable_meta() - hooked with 10
	 */
	do_action( 'gotravel_mikado_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( gotravel_mikado_options()->getOptionValue( 'smooth_page_transitions' ) == "yes" ) { ?>
	<div class="mkdf-smooth-transition-loader mkdf-mimic-ajax">
		<div class="mkdf-st-loader">
			<div class="mkdf-st-loader1">
				<?php echo gotravel_mikado_loading_spinners(); ?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="mkdf-wrapper">
	<div class="mkdf-wrapper-inner">
		<div class="mkdf-content">
			<div class="mkdf-content-inner">
				<?php gotravel_mikado_get_title(); ?>
				<?php get_template_part( 'slider' ); ?>
				<div class="mkdf-full-width">
					<div class="mkdf-full-width-inner">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="mkdf-grid-row-medium-gutter">
								<div <?php echo gotravel_mikado_get_content_sidebar_class(); ?>>
									<?php the_content(); ?>
								</div>
								<?php if ( ! in_array( $mkdf_sidebar, array( 'default', '' ) ) ) : ?>
									<div <?php echo gotravel_mikado_get_sidebar_holder_class(); ?>>
										<?php get_sidebar(); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>