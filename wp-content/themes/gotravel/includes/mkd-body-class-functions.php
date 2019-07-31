<?php

if(!function_exists('gotravel_mikado_boxed_class')) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function gotravel_mikado_boxed_class($classes) {

		//is boxed layout turned on?
		if(gotravel_mikado_options()->getOptionValue('boxed') == 'yes') {
			$classes[] = 'mkdf-boxed';
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_boxed_class');
}

if(!function_exists('gotravel_mikado_theme_version_class')) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function gotravel_mikado_theme_version_class($classes) {
		$current_theme = wp_get_theme();

		//is child theme activated?
		if($current_theme->parent()) {
			//add child theme version
			$classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

			//get parent theme
			$current_theme = $current_theme->parent();
		}

		if($current_theme->exists() && $current_theme->get('Version') != '') {
			$classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_theme_version_class');
}

if(!function_exists('gotravel_mikado_smooth_page_transitions_class')) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function gotravel_mikado_smooth_page_transitions_class($classes) {
		if(gotravel_mikado_options()->getOptionValue('smooth_page_transitions') == 'yes') {
			$classes[] = 'mkdf-smooth-page-transitions';
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_smooth_page_transitions_class');
}

if(!function_exists('gotravel_mikado_content_initial_width_body_class')) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function gotravel_mikado_content_initial_width_body_class($classes) {

		if(gotravel_mikado_options()->getOptionValue('initial_content_width')) {
			$classes[] = 'mkdf-'.gotravel_mikado_options()->getOptionValue('initial_content_width');
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_content_initial_width_body_class');
}

if(!function_exists('gotravel_mikado_content_top_margin_offset_class')) {
	/**
	 * Function that adds classes on body if top margin offset is set on your page
	 */
	function gotravel_mikado_content_top_margin_offset_class($classes) {
		$top_margin = get_post_meta(get_the_ID(), 'mkdf_page_top_margin_offset_meta', true);
		
		if($top_margin !== '') {
			$classes[] = 'mkdf-content-has-margin-offset';
		}
		
		return $classes;
	}
	
	add_filter('body_class', 'gotravel_mikado_content_top_margin_offset_class');
}