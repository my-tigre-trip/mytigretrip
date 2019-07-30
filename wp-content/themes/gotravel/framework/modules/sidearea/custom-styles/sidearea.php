<?php

if(!function_exists('gotravel_mikado_side_area_slide_from_right_type_style')) {

	function gotravel_mikado_side_area_slide_from_right_type_style() {

		if(gotravel_mikado_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if(gotravel_mikado_options()->getOptionValue('side_area_width') !== '' && gotravel_mikado_options()->getOptionValue('side_area_width') >= 30) {
				echo gotravel_mikado_dynamic_css('.mkdf-side-menu-slide-from-right .mkdf-side-menu', array(
					'right' => '-'.gotravel_mikado_options()->getOptionValue('side_area_width').'%',
					'width' => gotravel_mikado_options()->getOptionValue('side_area_width').'%'
				));
			}

			if(gotravel_mikado_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo gotravel_mikado_dynamic_css('.mkdf-side-menu-slide-from-right .mkdf-wrapper .mkdf-cover', array(
					'background-color' => gotravel_mikado_options()->getOptionValue('side_area_content_overlay_color')
				));
			}
			
			if(gotravel_mikado_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo gotravel_mikado_dynamic_css('.mkdf-side-menu-slide-from-right.mkdf-right-side-menu-opened .mkdf-wrapper .mkdf-cover', array(
					'opacity' => gotravel_mikado_options()->getOptionValue('side_area_content_overlay_opacity')
				));
			}
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_side_area_slide_from_right_type_style');
}

if(!function_exists('gotravel_mikado_side_area_icon_color_styles')) {

	function gotravel_mikado_side_area_icon_color_styles() {

		if(gotravel_mikado_options()->getOptionValue('side_area_icon_font_size') !== '') {

			echo gotravel_mikado_dynamic_css('a.mkdf-side-menu-button-opener', array(
				'font-size' => gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('side_area_icon_font_size')).'px'
			));

			if(gotravel_mikado_options()->getOptionValue('side_area_icon_font_size') > 30) {
				echo '@media only screen and (max-width: 480px) {
						a.mkdf-side-menu-button-opener {
						font-size: 30px;
						}
					}';
			}
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('a.mkdf-side-menu-button-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_icon_color')
			));
		}
		
		if(gotravel_mikado_options()->getOptionValue('side_area_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('a.mkdf-side-menu-button-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_icon_hover_color')
			));
		}
		
		if(gotravel_mikado_options()->getOptionValue('side_area_light_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-side-menu-button-opener,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-side-menu-button-opener,
			.mkdf-light-header .mkdf-top-bar .mkdf-side-menu-button-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_light_icon_color').' !important'
			));
		}
		
		if(gotravel_mikado_options()->getOptionValue('side_area_light_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-side-menu-button-opener:hover,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-side-menu-button-opener:hover,
			.mkdf-light-header .mkdf-top-bar .mkdf-side-menu-button-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_light_icon_hover_color').' !important'
			));
		}
		
		if(gotravel_mikado_options()->getOptionValue('side_area_dark_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-side-menu-button-opener,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-side-menu-button-opener,
			.mkdf-dark-header .mkdf-top-bar .mkdf-side-menu-button-opener', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_dark_icon_color').' !important'
			));
		}
		
		if(gotravel_mikado_options()->getOptionValue('side_area_dark_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-side-menu-button-opener:hover,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-side-menu-button-opener:hover,
			.mkdf-dark-header .mkdf-top-bar .mkdf-side-menu-button-opener:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_dark_icon_hover_color').' !important'
			));
		}
		
		if (gotravel_mikado_options()->getOptionValue('side_area_close_icon_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-side-menu a.mkdf-close-side-menu', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_close_icon_color')
			));
		}
		
		if (gotravel_mikado_options()->getOptionValue('side_area_close_icon_hover_color') !== '') {
			echo gotravel_mikado_dynamic_css('.mkdf-side-menu a.mkdf-close-side-menu:hover', array(
				'color' => gotravel_mikado_options()->getOptionValue('side_area_close_icon_hover_color')
			));
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_side_area_icon_color_styles');
}

if(!function_exists('gotravel_mikado_side_area_alignment')) {
	function gotravel_mikado_side_area_alignment() {
		if(gotravel_mikado_options()->getOptionValue('side_area_aligment')) {
			echo gotravel_mikado_dynamic_css('.mkdf-side-menu-slide-from-right .mkdf-side-menu, .mkdf-side-menu-slide-with-content .mkdf-side-menu, .mkdf-side-area-uncovered-from-content .mkdf-side-menu', array(
				'text-align' => gotravel_mikado_options()->getOptionValue('side_area_aligment')
			));
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_side_area_alignment');
}

if(!function_exists('gotravel_mikado_side_area_styles')) {
	function gotravel_mikado_side_area_styles() {
		$side_area_styles = array();

		if(gotravel_mikado_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = gotravel_mikado_options()->getOptionValue('side_area_background_color');
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('side_area_padding_top')).'px';
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('side_area_padding_right')).'px';
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('side_area_padding_bottom')).'px';
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('side_area_padding_left')).'px';
		}

		if(gotravel_mikado_options()->getOptionValue('side_area_bakground_image') !== '') {
			$side_area_styles['background-image'] = 'url('.gotravel_mikado_options()->getOptionValue('side_area_bakground_image').')';
			$side_area_styles['background-size']  = 'cover';
		}

		if(!empty($side_area_styles)) {
			echo gotravel_mikado_dynamic_css('.mkdf-side-menu', $side_area_styles);
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_side_area_styles');
}