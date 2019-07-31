<?php

if(!function_exists('gotravel_mikado_get_footer_classes')) {
	/**
	 * Return all footer classes
	 *
	 * @param $page_id
	 *
	 * @return string|void
	 */
	function gotravel_mikado_get_footer_classes($page_id) {

		$footer_classes       = '';
		$footer_classes_array = array('mkdf-page-footer');

		//is uncovering footer option set in theme options?
		if(gotravel_mikado_options()->getOptionValue('uncovering_footer') == 'yes') {
			$footer_classes_array[] = 'mkdf-footer-uncover';
		}

		if(get_post_meta($page_id, 'mkdf_disable_footer_meta', true) == 'yes') {
			$footer_classes_array[] = 'mkdf-disable-footer';
		}

		//is some class added to footer classes array?
		if(is_array($footer_classes_array) && count($footer_classes_array)) {
			//concat all classes and prefix it with class attribute
			$footer_classes = esc_attr(implode(' ', $footer_classes_array));
		}

		return $footer_classes;
	}
}

if(!function_exists('gotravel_mikado_footer_top_classes')) {
	/**
	 * Return classes for footer top
	 *
	 * @return string
	 */
	function gotravel_mikado_footer_top_classes() {

		$footer_top_classes = array();

		if(gotravel_mikado_options()->getOptionValue('footer_in_grid') != 'yes') {
			$footer_top_classes[] = 'mkdf-footer-top-full';
		}

		//footer aligment
		if(gotravel_mikado_options()->getOptionValue('footer_top_columns_alignment') != '') {
			$footer_top_classes[] = 'mkdf-footer-top-aligment-'.gotravel_mikado_options()->getOptionValue('footer_top_columns_alignment');
		}
		
		return implode(' ', $footer_top_classes);
	}
}