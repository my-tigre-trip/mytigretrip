<?php

if(!function_exists('gotravel_mikado_search_body_class')) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function gotravel_mikado_search_body_class($classes) {

		if(is_active_widget(false, false, 'mkd_search_opener')) {

			$classes[] = 'mkdf-'.gotravel_mikado_options()->getOptionValue('search_type');

			if(gotravel_mikado_options()->getOptionValue('search_type') == 'fullscreen-search') {

				$is_fullscreen_bg_image_set = gotravel_mikado_options()->getOptionValue('fullscreen_search_background_image') !== '';

				if($is_fullscreen_bg_image_set) {
					$classes[] = 'mkdf-fullscreen-search-with-bg-image';
				}

				$classes[] = 'mkdf-search-fade';
			}
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_search_body_class');
}

if(!function_exists('gotravel_mikado_get_search')) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function gotravel_mikado_get_search() {
		if(gotravel_mikado_active_widget(false, false, 'mkd_search_opener')) {
			gotravel_mikado_load_search_template();
		}
	}
}

if(!function_exists('gotravel_mikado_load_search_template')) {
	/**
	 * Loads HTML template with parameters
	 */
	function gotravel_mikado_load_search_template() {
		global $gotravel_mikado_IconCollections;

		$search_type = gotravel_mikado_options()->getOptionValue('search_type');

		$search_icon       = '';
		if(gotravel_mikado_options()->getOptionValue('search_icon_pack') !== '') {
			$search_icon       = $gotravel_mikado_IconCollections->getSearchIcon(gotravel_mikado_options()->getOptionValue('search_icon_pack'), true);
		}

		$parameters = array(
			'search_in_grid'    => gotravel_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'       => $search_icon,
		);

		gotravel_mikado_get_module_template_part('templates/types/'.$search_type, 'search', '', $parameters);
	}
}