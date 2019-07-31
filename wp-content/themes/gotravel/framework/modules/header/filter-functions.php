<?php

if(!function_exists('gotravel_mikado_top_header_class')) {
	function gotravel_mikado_top_header_class($classes) {
		$top_header = gotravel_mikado_options()->getOptionValue('top_bar');
		
		if($top_header === 'yes') {
			$classes[] = 'mkdf-top-header-enabled';
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'gotravel_mikado_top_header_class');
}

if(!function_exists('gotravel_mikado_header_class')) {
	/**
	 * Function that adds class to header based on theme options
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added header class
	 */
	function gotravel_mikado_header_class($classes) {
		$header_type = gotravel_mikado_get_meta_field_intersect('header_type', gotravel_mikado_get_page_id());

		$classes[] = 'mkdf-'.$header_type;

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_header_class');
}

if(!function_exists('gotravel_mikado_header_behaviour_class')) {
	/**
	 * Function that adds behaviour class to header based on theme options
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added behaviour class
	 */
	function gotravel_mikado_header_behaviour_class($classes) {

		$classes[] = 'mkdf-'.gotravel_mikado_options()->getOptionValue('header_behaviour');

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_header_behaviour_class');
}

if(!function_exists('gotravel_mikado_mobile_header_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function gotravel_mikado_mobile_header_class($classes) {
		$classes[] = 'mkdf-default-mobile-header';

		$classes[] = 'mkdf-sticky-up-mobile-header';

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_mobile_header_class');
}

if(!function_exists('gotravel_mikado_menu_dropdown_appearance')) {
	/**
	 * Function that adds menu dropdown appearance class to body tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added menu dropdown appearance class
	 */
	function gotravel_mikado_menu_dropdown_appearance($classes) {

		if(gotravel_mikado_options()->getOptionValue('menu_dropdown_appearance') !== 'default') {
			$classes[] = 'mkdf-'.gotravel_mikado_options()->getOptionValue('menu_dropdown_appearance');
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_menu_dropdown_appearance');
}

if(!function_exists('gotravel_mikado_header_skin_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function gotravel_mikado_header_skin_class($classes) {

		$id = gotravel_mikado_get_page_id();

		if(($meta_temp = get_post_meta($id, 'mkdf_header_style_meta', true)) !== '') {
			$classes[] = 'mkdf-'.$meta_temp;
		} else if(gotravel_mikado_options()->getOptionValue('header_style') !== '') {
			$classes[] = 'mkdf-'.gotravel_mikado_options()->getOptionValue('header_style');
		}

		return $classes;

	}

	add_filter('body_class', 'gotravel_mikado_header_skin_class');

}

if(!function_exists('gotravel_mikado_header_scroll_style_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function gotravel_mikado_header_scroll_style_class($classes) {

		if(gotravel_mikado_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes') {
			$classes[] = 'mkdf-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'gotravel_mikado_header_scroll_style_class');

}

if(!function_exists('gotravel_mikado_header_global_js_var')) {
	/**
	 * @param $global_variables
	 *
	 * @return mixed
	 */
	function gotravel_mikado_header_global_js_var($global_variables) {

		$global_variables['mkdfTopBarHeight']                   = gotravel_mikado_get_top_bar_height();
		$global_variables['mkdfStickyHeaderHeight']             = gotravel_mikado_get_sticky_header_height();
		$global_variables['mkdfStickyHeaderTransparencyHeight'] = gotravel_mikado_get_sticky_header_height_of_complete_transparency();

		return $global_variables;
	}

	add_filter('gotravel_mikado_js_global_variables', 'gotravel_mikado_header_global_js_var');
}

if(!function_exists('gotravel_mikado_header_per_page_js_var')) {
	/**
	 * @param $perPageVars
	 *
	 * @return mixed
	 */
	function gotravel_mikado_header_per_page_js_var($perPageVars) {
		$id = gotravel_mikado_get_page_id();

		$perPageVars['mkdfStickyScrollAmount']           = gotravel_mikado_get_sticky_scroll_amount();
		$perPageVars['mkdfStickyScrollAmountFullScreen'] = get_post_meta($id, 'mkdf_scroll_amount_for_sticky_fullscreen_meta', true) === 'yes';

		return $perPageVars;
	}

	add_filter('gotravel_mikado_per_page_js_vars', 'gotravel_mikado_header_per_page_js_var');
}