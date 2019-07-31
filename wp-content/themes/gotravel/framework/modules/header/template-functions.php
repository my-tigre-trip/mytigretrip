<?php

use GoTravel\Modules\Header\Lib\HeaderFactory;

if(!function_exists('gotravel_mikado_get_header')) {
	/**
	 * Loads header HTML based on header type option. Sets all necessary parameters for header
	 * and defines gotravel_mikado_header_type_parameters filter
	 */
	function gotravel_mikado_get_header() {

		//will be read from options
		$header_type     = gotravel_mikado_options()->getOptionValue('header_type');
		$header_behavior = gotravel_mikado_options()->getOptionValue('header_behaviour');

		if(HeaderFactory::getInstance()->validHeaderObject()) {
			$parameters = array(
				'hide_logo'                        => gotravel_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
				'show_sticky'                      => in_array($header_behavior, array(
					'sticky-header-on-scroll-up',
					'sticky-header-on-scroll-down-up'
				)) ? true : false,
				'show_fixed_wrapper'               => in_array($header_behavior, array('fixed-on-scroll')) ? true : false
			);

			$parameters = apply_filters('gotravel_mikado_header_type_parameters', $parameters, $header_type);

			HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
		}
	}
}

if(!function_exists('gotravel_mikado_get_header_top')) {
	/**
	 * Loads header top HTML and sets parameters for it
	 */
	function gotravel_mikado_get_header_top() {
		$params = array(
			'show_header_top'    => gotravel_mikado_is_top_bar_enabled() === 'yes' ? true : false,
			'top_bar_in_grid'    => gotravel_mikado_options()->getOptionValue('top_bar_in_grid') === 'yes' ? true : false
		);

		$params = apply_filters('gotravel_mikado_header_top_params', $params);

		gotravel_mikado_get_module_template_part('templates/parts/header-top', 'header', '', $params);
	}
}

if(!function_exists('gotravel_mikado_get_logo')) {
	/**
	 * Loads logo HTML
	 *
	 * @param $slug
	 */
	function gotravel_mikado_get_logo($slug = '') {

		$slug = $slug !== '' ? $slug : gotravel_mikado_options()->getOptionValue('header_type');

		if($slug == 'sticky') {
			$logo_image = gotravel_mikado_options()->getOptionValue('logo_image_sticky');
		} else {
			$logo_image = gotravel_mikado_options()->getOptionValue('logo_image');
		}

		$logo_image_dark  = gotravel_mikado_options()->getOptionValue('logo_image_dark');
		$logo_image_light = gotravel_mikado_options()->getOptionValue('logo_image_light');


		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = gotravel_mikado_get_image_dimensions($logo_image);

		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		$params = array(
			'logo_image'           => $logo_image,
			'logo_image_dark'      => $logo_image_dark,
			'logo_image_light'     => $logo_image_light,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		gotravel_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
	}
}

if(!function_exists('gotravel_mikado_get_main_menu')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function gotravel_mikado_get_main_menu($additional_class = 'mkdf-default-nav') {
		gotravel_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('gotravel_mikado_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function gotravel_mikado_get_sticky_menu($additional_class = 'mkdf-default-nav') {
		gotravel_mikado_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('gotravel_mikado_get_sticky_header')) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function gotravel_mikado_get_sticky_header() {

		$parameters = array(
			'hide_logo'             => gotravel_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
			'sticky_header_in_grid' => gotravel_mikado_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
		);

		gotravel_mikado_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
	}
}

if(!function_exists('gotravel_mikado_get_mobile_header')) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function gotravel_mikado_get_mobile_header() {
		if(gotravel_mikado_is_responsive_on()) {
			$header_type = gotravel_mikado_options()->getOptionValue('header_type');

			//this could be read from theme options
			$mobile_header_type = 'mobile-header';

			$parameters = array(
				'show_logo'              => gotravel_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
				'menu_opener_icon'       => gotravel_mikado_icon_collections()->getMobileMenuIcon(gotravel_mikado_options()->getOptionValue('mobile_icon_pack'), true),
				'show_navigation_opener' => has_nav_menu('main-navigation')
			);

			gotravel_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
		}
	}
}

if(!function_exists('gotravel_mikado_get_mobile_logo')) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 *
	 * @param string $slug
	 */
	function gotravel_mikado_get_mobile_logo($slug = '') {

		$slug = $slug !== '' ? $slug : gotravel_mikado_options()->getOptionValue('header_type');

		//check if mobile logo has been set and use that, else use normal logo
		if(gotravel_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
			$logo_image = gotravel_mikado_options()->getOptionValue('logo_image_mobile');
		} else {
			$logo_image = gotravel_mikado_options()->getOptionValue('logo_image');
		}

		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = gotravel_mikado_get_image_dimensions($logo_image);

		$logo_height          = '';
		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		//set parameters for logo
		$parameters = array(
			'logo_image'           => $logo_image,
			'logo_dimensions'      => $logo_dimensions,
			'logo_height'          => $logo_height,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		gotravel_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
	}
}

if(!function_exists('gotravel_mikado_get_mobile_nav')) {
	/**
	 * Loads mobile navigation HTML
	 */
	function gotravel_mikado_get_mobile_nav() {

		$slug = gotravel_mikado_options()->getOptionValue('header_type');

		gotravel_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
	}
}