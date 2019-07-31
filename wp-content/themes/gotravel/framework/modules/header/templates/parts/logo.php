<?php do_action('gotravel_mikado_before_site_logo'); ?>

	<div class="mkdf-logo-wrapper">
		<a href="<?php echo esc_url(home_url('/')); ?>" <?php gotravel_mikado_inline_style($logo_styles); ?>>
			<img <?php echo gotravel_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo', 'gotravel'); ?>"/>
			<?php if(!empty($logo_image_dark)) { ?>
				<img <?php echo gotravel_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo', 'gotravel'); ?>"/>
			<?php } ?>
			<?php if(!empty($logo_image_light)) { ?>
				<img <?php echo gotravel_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo', 'gotravel'); ?>"/>
			<?php } ?>
		</a>
	</div>

<?php do_action('gotravel_mikado_after_site_logo'); ?>