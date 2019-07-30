<?php do_action('gotravel_mikado_before_mobile_logo'); ?>

	<div class="mkdf-mobile-logo-wrapper">
		<a href="<?php echo esc_url(home_url('/')); ?>" <?php gotravel_mikado_inline_style($logo_styles); ?>>
			<img <?php echo gotravel_mikado_get_inline_attrs($logo_dimensions_attr); ?> src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile logo', 'gotravel'); ?>"/>
		</a>
	</div>

<?php do_action('gotravel_mikado_after_mobile_logo'); ?>