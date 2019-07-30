<?php

if(!function_exists('gotravel_mikado_hook_breadcrumbs_template')) {
	/**
	 * Hooks to after page title hook and outputs breadcrumbs template
	 */
	function gotravel_mikado_hook_breadcrumbs_template() {
		$enable_breadcrumbs_area = gotravel_mikado_breadcrumbs_area_enabled();
		$enable_social_share     = gotravel_mikado_social_share_enabled_in_breadcrumbs();
		$breadcrumbs_class       = $enable_social_share ? 'mkdf-grid-col-6' : 'mkdf-grid-col-6';

		$params = array(
			'enable_breadcrumbs_area' => $enable_breadcrumbs_area,
			'enable_social_share'     => $enable_social_share,
			'breadcrumbs_class'       => $breadcrumbs_class
		);

		echo gotravel_mikado_get_module_template_part('templates/breadcrumbs', 'breadcrumbs', '', $params);
	}

	add_action('gotravel_mikado_after_page_title', 'gotravel_mikado_hook_breadcrumbs_template');
}

if(!function_exists('gotravel_mikado_breadcrumbs_area_body_class')) {
	/**
	 * Adds utility classes for breadcrumbs area to body class
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function gotravel_mikado_breadcrumbs_area_body_class($classes) {
		$breadcrumbs_area_enabled = gotravel_mikado_breadcrumbs_area_enabled();

		if(!$breadcrumbs_area_enabled) {
			return $classes;
		}

		$id = gotravel_mikado_get_page_id();
		$breadcrumbs_text_size = gotravel_mikado_get_meta_field_intersect('breadcrumbs_text_size', $id);

		$classes[] = 'mkdf-breadcrumbs-area-enabled';

		if($breadcrumbs_text_size !== '') {
			$classes[] = 'mkdf-breadcrumbs-area-text-size-'.$breadcrumbs_text_size;
		}

		return $classes;
	}

	add_filter('body_class', 'gotravel_mikado_breadcrumbs_area_body_class');
}

if(!function_exists('gotravel_mikado_breadcrumbs_area_enabled')) {
	/**
	 * @return bool
	 */
	function gotravel_mikado_breadcrumbs_area_enabled() {
		$id = gotravel_mikado_get_page_id();

		return gotravel_mikado_get_meta_field_intersect('show_breadcrumbs_area', $id) === 'yes';
	}
}

if(!function_exists('gotravel_mikado_social_share_enabled_in_breadcrumbs')) {
	/**
	 * @return bool|mixed|void
	 */
	function gotravel_mikado_social_share_enabled_in_breadcrumbs() {
		return gotravel_mikado_options()->getOptionValue('breadcrumbs_enable_share') === 'yes';
	}
}