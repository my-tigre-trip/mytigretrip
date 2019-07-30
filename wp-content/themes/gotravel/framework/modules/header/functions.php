<?php

if(!function_exists('gotravel_mikado_header_register_main_navigation')) {
	/**
	 * Registers main navigation
	 */
	function gotravel_mikado_header_register_main_navigation() {
		register_nav_menus(
			array(
				'main-navigation' => esc_html__('Main Navigation', 'gotravel')
			)
		);
	}

	add_action('after_setup_theme', 'gotravel_mikado_header_register_main_navigation');
}

if(!function_exists('gotravel_mikado_is_top_bar_enabled')) {
	function gotravel_mikado_is_top_bar_enabled() {
		$top_bar_enabled = gotravel_mikado_options()->getOptionValue('top_bar');

		return $top_bar_enabled;
	}
}

if(!function_exists('gotravel_mikado_get_top_bar_height')) {
	/**
	 * Returns top bar height
	 *
	 * @return bool|int|void
	 */
	function gotravel_mikado_get_top_bar_height() {
		if(gotravel_mikado_is_top_bar_enabled()) {
			return 36;
		}

		return 0;
	}
}

if(!function_exists('gotravel_mikado_get_sticky_header_height')) {
	/**
	 * Returns top sticky header height
	 *
	 * @return bool|int|void
	 */
	function gotravel_mikado_get_sticky_header_height() {
		//sticky menu height, needed only for sticky header on scroll up
		if(in_array(gotravel_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {
			$sticky_header_height = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('sticky_header_height'));

			return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
		}

		return 0;
	}
}

if(!function_exists('gotravel_mikado_get_sticky_header_height_of_complete_transparency')) {
	/**
	 * Returns top sticky header height it is fully transparent. used in anchor logic
	 *
	 * @return bool|int|void
	 */
	function gotravel_mikado_get_sticky_header_height_of_complete_transparency() {
		if(gotravel_mikado_options()->getOptionValue('sticky_header_transparency') === '0') {
			$stickyHeaderTransparent = gotravel_mikado_options()->getOptionValue('sticky_header_grid_background_color') !== '' &&
			                           gotravel_mikado_options()->getOptionValue('sticky_header_grid_transparency') === '0';
		} else {
			$stickyHeaderTransparent = gotravel_mikado_options()->getOptionValue('sticky_header_background_color') !== '' &&
			                           gotravel_mikado_options()->getOptionValue('sticky_header_transparency') === '0';
		}

		if($stickyHeaderTransparent) {
			return 0;
		} else {
			$sticky_header_height = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('sticky_header_height'));

			return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
		}
	}
}

if(!function_exists('gotravel_mikado_get_sticky_scroll_amount')) {
	/**
	 * Returns top sticky scroll amount
	 *
	 * @return bool|int|void
	 */
	function gotravel_mikado_get_sticky_scroll_amount() {

		//sticky menu scroll amount
		if(in_array(gotravel_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
			$sticky_scroll_amount = gotravel_mikado_filter_px(gotravel_mikado_get_meta_field_intersect('scroll_amount_for_sticky'));

			return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
		}

		return 0;
	}
}