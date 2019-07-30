<?php
$mkdf_slider_shortcode = get_post_meta( gotravel_mikado_get_page_id(), 'mkdf_page_slider_meta', true );
$mkdf_slider_shortcode = apply_filters( 'gotravel_mikado_slider_shortcode', $mkdf_slider_shortcode );

if ( ! empty( $mkdf_slider_shortcode ) ) : ?>
	<div class="mkdf-slider">
		<div class="mkdf-slider-inner">
			<?php echo do_shortcode( wp_kses_post( $mkdf_slider_shortcode ) ); // XSS OK ?>
		</div>
	</div>
<?php endif; ?>