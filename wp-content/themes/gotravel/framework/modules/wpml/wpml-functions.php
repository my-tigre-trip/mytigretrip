<?php

if(!function_exists('gotravel_mikado_disable_wpml_css')) {
	function gotravel_mikado_disable_wpml_css() {
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
	}

	add_action('after_setup_theme', 'gotravel_mikado_disable_wpml_css');
}