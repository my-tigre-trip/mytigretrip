<?php

if(!function_exists('gotravel_mikado_search_opener_icon_size')) {

	function gotravel_mikado_search_opener_icon_size() {

		if(gotravel_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener', array(
				'font-size' => gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('header_search_icon_size')).'px'
			));
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_opener_icon_size');

}

if(!function_exists('gotravel_mikado_search_opener_icon_colors')) {

	function gotravel_mikado_search_opener_icon_colors() {

		if(gotravel_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if(gotravel_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if(gotravel_mikado_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_light_search_icon_color').' !important'
			));
		}

		if(gotravel_mikado_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_light_search_icon_hover_color').' !important'
			));
		}

		if(gotravel_mikado_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_dark_search_icon_color').' !important'
			));
		}
		if(gotravel_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('header_dark_search_icon_hover_color').' !important'
			));
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_opener_icon_colors');

}

if(!function_exists('gotravel_mikado_search_opener_icon_background_colors')) {

	function gotravel_mikado_search_opener_icon_background_colors() {

		if(gotravel_mikado_options()->getOptionValue('search_icon_background_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener', array(
				'background-color' => gotravel_mikado_options()->getOptionValue('search_icon_background_color')
			));
		}

		if(gotravel_mikado_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'background-color' => gotravel_mikado_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_opener_icon_background_colors');
}

if(!function_exists('gotravel_mikado_search_opener_text_styles')) {

	function gotravel_mikado_search_opener_text_styles() {
		$text_styles = array();

		if(gotravel_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = gotravel_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_icon_text_fontsize')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_icon_text_lineheight')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = gotravel_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = gotravel_mikado_get_formatted_font_family(gotravel_mikado_options()->getOptionValue('search_icon_text_google_fonts')).', sans-serif';
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = gotravel_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if(!empty($text_styles)) {
			echo gotravel_mikado_dynamic_css('.mkdf-search-icon-text', $text_styles);
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => gotravel_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_opener_text_styles');
}

if(!function_exists('gotravel_mikado_search_opener_spacing')) {

	function gotravel_mikado_search_opener_spacing() {
		$spacing_styles = array();

		if(gotravel_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_padding_left')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_padding_right')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_margin_left')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_margin_right')).'px';
		}

		if(!empty($spacing_styles)) {
			echo gotravel_mikado_dynamic_css('.mkdf-search-opener', $spacing_styles);
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_opener_spacing');
}

if(!function_exists('gotravel_mikado_search_bar_background')) {

	function gotravel_mikado_search_bar_background() {

		if(gotravel_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-search-fade .mkdf-fullscreen-search-holder .mkdf-fullscreen-search-table, .mkdf-fullscreen-search-overlay', array(
				'background-color' => gotravel_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_bar_background');
}

if(!function_exists('gotravel_mikado_search_text_styles')) {

	function gotravel_mikado_search_text_styles() {
		$text_styles = array();

		if(gotravel_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = gotravel_mikado_options()->getOptionValue('search_text_color');
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_text_fontsize')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = gotravel_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = gotravel_mikado_get_formatted_font_family(gotravel_mikado_options()->getOptionValue('search_text_google_fonts')).', sans-serif';
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = gotravel_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if(gotravel_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo gotravel_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-field', $text_styles);
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_text_styles');
}

if(!function_exists('gotravel_mikado_search_label_styles')) {

	function gotravel_mikado_search_label_styles() {
		$text_styles = array();

		if(gotravel_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = gotravel_mikado_options()->getOptionValue('search_label_text_color');
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_label_text_fontsize')).'px';
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = gotravel_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = gotravel_mikado_get_formatted_font_family(gotravel_mikado_options()->getOptionValue('search_label_text_google_fonts')).', sans-serif';
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = gotravel_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if(gotravel_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_label_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo gotravel_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-label', $text_styles);
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_label_styles');
}

if(!function_exists('gotravel_mikado_search_icon_styles')) {

	function gotravel_mikado_search_icon_styles() {

		if(gotravel_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'color' => gotravel_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if(gotravel_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'font-size' => gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('search_icon_size')).'px'
			));
		}

	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_search_icon_styles');
}

if(!function_exists('gotravel_mikado_fullscreen_search_styles')) {
	/**
	 * Outputs styles for full screen search
	 */
	function gotravel_mikado_fullscreen_search_styles() {
		$bg_image = gotravel_mikado_options()->getOptionValue('fullscreen_search_background_image');
		$selector = '.mkdf-fullscreen-search-holder';
		$styles   = array();

		if(!$bg_image) {
			return;
		}

		$styles['background-image'] = 'url('.$bg_image.')';

		echo gotravel_mikado_dynamic_css($selector, $styles);
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_fullscreen_search_styles');
}
