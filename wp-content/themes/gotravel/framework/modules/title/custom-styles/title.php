<?php

if(!function_exists('gotravel_mikado_title_area_typography_style')) {

	/**
	 *
	 */
	function gotravel_mikado_title_area_typography_style() {

		$title_styles = array();

		if(gotravel_mikado_options()->getOptionValue('page_title_color') !== '') {
			$title_styles['color'] = gotravel_mikado_options()->getOptionValue('page_title_color');
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = gotravel_mikado_get_formatted_font_family(gotravel_mikado_options()->getOptionValue('page_title_google_fonts'));
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_fontsize') !== '') {
			$title_styles['font-size'] = gotravel_mikado_options()->getOptionValue('page_title_fontsize').'px';
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_lineheight') !== '') {
			$title_styles['line-height'] = gotravel_mikado_options()->getOptionValue('page_title_lineheight').'px';
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_texttransform') !== '') {
			$title_styles['text-transform'] = gotravel_mikado_options()->getOptionValue('page_title_texttransform');
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_fontstyle') !== '') {
			$title_styles['font-style'] = gotravel_mikado_options()->getOptionValue('page_title_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_fontweight') !== '') {
			$title_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('page_title_fontweight');
		}
		if(gotravel_mikado_options()->getOptionValue('page_title_letter_spacing') !== '') {
			$title_styles['letter-spacing'] = gotravel_mikado_options()->getOptionValue('page_title_letter_spacing').'px';
		}

		$title_selector = array(
			'.mkdf-title .mkdf-title-holder h1'
		);

		echo gotravel_mikado_dynamic_css($title_selector, $title_styles);


		$subtitle_styles = array();

		if(gotravel_mikado_options()->getOptionValue('page_subtitle_color') !== '') {
			$subtitle_styles['color'] = gotravel_mikado_options()->getOptionValue('page_subtitle_color');
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
			$subtitle_styles['font-family'] = gotravel_mikado_get_formatted_font_family(gotravel_mikado_options()->getOptionValue('page_subtitle_google_fonts'));
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_fontsize') !== '') {
			$subtitle_styles['font-size'] = gotravel_mikado_options()->getOptionValue('page_subtitle_fontsize').'px';
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_lineheight') !== '') {
			$subtitle_styles['line-height'] = gotravel_mikado_options()->getOptionValue('page_subtitle_lineheight').'px';
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_texttransform') !== '') {
			$subtitle_styles['text-transform'] = gotravel_mikado_options()->getOptionValue('page_subtitle_texttransform');
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
			$subtitle_styles['font-style'] = gotravel_mikado_options()->getOptionValue('page_subtitle_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_fontweight') !== '') {
			$subtitle_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('page_subtitle_fontweight');
		}
		if(gotravel_mikado_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
			$subtitle_styles['letter-spacing'] = gotravel_mikado_options()->getOptionValue('page_subtitle_letter_spacing').'px';
		}

		$subtitle_selector = array(
			'.mkdf-title .mkdf-title-holder .mkdf-subtitle'
		);

		echo gotravel_mikado_dynamic_css($subtitle_selector, $subtitle_styles);
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_title_area_typography_style');
}


