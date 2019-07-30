<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * @see gotravel_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable - hooked with 10
	 */
	do_action('gotravel_mikado_header_meta');
	
	wp_head(); ?>
</head>
<body <?php body_class();?>>
<?php gotravel_mikado_get_side_area(); ?>

<?php if(gotravel_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") { ?>
	<div class="mkdf-smooth-transition-loader mkdf-mimic-ajax">
		<div class="mkdf-st-loader">
			<div class="mkdf-st-loader1">
				<?php echo gotravel_mikado_loading_spinners(); ?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="mkdf-wrapper mkdf-404-page">
	<div class="mkdf-wrapper-inner">
		<?php gotravel_mikado_get_header(); ?>
		
		<?php if (gotravel_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
			<a id='mkdf-back-to-top'  href='#'>
                <span class="mkdf-icon-stack">
                     <?php echo gotravel_mikado_icon_collections()->renderIcon('lnr-chevron-up', 'linear_icons'); ?>
                </span>
				<span class="mkdf-back-to-top-inner">
                    <span class="mkdf-back-to-top-text"><?php esc_html_e('Top', 'gotravel'); ?></span>
                </span>
			</a>
		<?php } ?>
		<div class="mkdf-content" <?php gotravel_mikado_content_elem_style_attr(); ?>>
			<div class="mkdf-content-inner">
				<div class="mkdf-container">
					<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
					<div class="mkdf-container-inner">
						<div class="mkdf-page-not-found">
							<?php if(!gotravel_mikado_core_installed()) { ?>
								<h1><?php esc_html_e('404 Page Not Found', 'gotravel'); ?></h1>
								<p><?php esc_html_e( 'The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'gotravel' ); ?></p>
							<?php } ?>
							
							<?php if ( gotravel_mikado_options()->getOptionValue( '404_title' ) !== '' ) { ?>
								<h1><?php echo esc_html( gotravel_mikado_options()->getOptionValue( '404_title' ) ); ?></h1>
							<?php } ?>
							<?php if ( gotravel_mikado_options()->getOptionValue( '404_text' ) !== '' ) { ?>
								<p><?php echo esc_html( gotravel_mikado_options()->getOptionValue( '404_text' ) ); ?></p>
							<?php } ?>
							<?php
							$params = array();
							if ( gotravel_mikado_options()->getOptionValue( '404_back_to_home' ) !== '' ) {
								$params['text'] = gotravel_mikado_options()->getOptionValue( '404_back_to_home' );
							}
							$params['link']   = esc_url( home_url( '/' ) );
							$params['target'] = '_self';
							
							if(!empty($params['text'])) {
								echo gotravel_mikado_execute_shortcode( 'mkdf_button', $params );
							}
							?>
						</div>
					</div>
					<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>