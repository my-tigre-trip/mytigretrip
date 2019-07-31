<?php

if(!function_exists('gotravel_mikado_breadcrumbs_area_custom_styles')) {
	function gotravel_mikado_breadcrumbs_area_custom_styles() {
		$styles              = array();
		$typography_styles   = array();
		$typography_selector = array(
			'.mkdf-breadcrumbs-area-holder .mkdf-breadcrumbs-holder a',
			'.mkdf-breadcrumbs-area-holder .mkdf-breadcrumbs-holder .mkdf-current',
			'.mkdf-breadcrumbs-area-holder .mkdf-breadcrumbs-holder .mkdf-delimiter',
			'.mkdf-breadcrumbs-area-holder .mkdf-social-share-holder .mkdf-icon-name'
		);

		$background_color = gotravel_mikado_options()->getOptionValue('breadcrumbs_area_background_color');

		if($background_color !== '') {
			$styles['background-color'] = $background_color;
		}

		$height = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('breadcrumbs_area_height'));

		if($height !== '') {
			$styles['height'] = $height.'px';
		}

		echo gotravel_mikado_dynamic_css('.mkdf-breadcrumbs-area-holder', $styles);

		$breadcrumbs_text_color = gotravel_mikado_options()->getOptionValue('breadcrumbs_text_color');

		if($breadcrumbs_text_color !== '') {
			$typography_styles['color'] = $breadcrumbs_text_color;

			echo gotravel_mikado_dynamic_css($typography_selector, $typography_styles);
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_breadcrumbs_area_custom_styles');
}