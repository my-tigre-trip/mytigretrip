<?php

if(!function_exists('gotravel_mikado_header_top_bar_styles')) {
	/**
	 * Generates styles for header top bar
	 */
	function gotravel_mikado_header_top_bar_styles() {
		$background_color = gotravel_mikado_options()->getOptionValue('top_bar_background_color');
		
		$top_bar_styles   = array();
		if($background_color !== '') {
			$top_bar_styles['background-color'] = $background_color;
		}
		
		$top_bar_selectors = array(
			'.mkdf-top-bar',
			'.mkdf-top-header-enabled .mkdf-page-header .mkdf-menu-area:before'
		);

		echo gotravel_mikado_dynamic_css($top_bar_selectors, $top_bar_styles);
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_header_top_bar_styles');
}

if(!function_exists('gotravel_mikado_header_standard_menu_area_styles')) {
	/**
	 * Generates styles for header standard menu
	 */
	function gotravel_mikado_header_standard_menu_area_styles() {
		global $gotravel_mikado_options;

		$menu_area_header_standard_styles = array();

		if($gotravel_mikado_options['menu_area_background_color_header_standard'] !== '') {
			$menu_area_background_color        = $gotravel_mikado_options['menu_area_background_color_header_standard'];
			$menu_area_background_transparency = 1;

			if($gotravel_mikado_options['menu_area_background_transparency_header_standard'] !== '') {
				$menu_area_background_transparency = $gotravel_mikado_options['menu_area_background_transparency_header_standard'];
			}

			$menu_area_header_standard_styles['background-color'] = gotravel_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
		}

		if($gotravel_mikado_options['menu_area_height_header_standard'] !== '') {
			$max_height = intval(gotravel_mikado_filter_px($gotravel_mikado_options['menu_area_height_header_standard'])).'px';
			echo gotravel_mikado_dynamic_css('.mkdf-header-standard .mkdf-page-header .mkdf-logo-wrapper a', array('max-height' => $max_height));

			$menu_area_header_standard_styles['height'] = gotravel_mikado_filter_px($gotravel_mikado_options['menu_area_height_header_standard']).'px';
		}

		echo gotravel_mikado_dynamic_css('.mkdf-page-header .mkdf-menu-area', $menu_area_header_standard_styles);
		
		$menu_background_color = $gotravel_mikado_options['menu_background_color_header_standard'];
		if(!empty($menu_background_color)) {
			$menu_styles['background-color'] = $menu_background_color;
			$menu_selector = array(
				'.mkdf-page-header .mkdf-menu-area .mkdf-grid'
			);
			
			echo gotravel_mikado_dynamic_css($menu_selector, $menu_styles);
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_header_standard_menu_area_styles');
}

if(!function_exists('gotravel_mikado_sticky_header_styles')) {
	/**
	 * Generates styles for sticky haeder
	 */
	function gotravel_mikado_sticky_header_styles() {
		global $gotravel_mikado_options;

		if($gotravel_mikado_options['sticky_header_background_color'] !== '') {

			$sticky_header_background_color              = $gotravel_mikado_options['sticky_header_background_color'];
			$sticky_header_background_color_transparency = 1;

			if($gotravel_mikado_options['sticky_header_transparency'] !== '') {
				$sticky_header_background_color_transparency = $gotravel_mikado_options['sticky_header_transparency'];
			}

			echo gotravel_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-sticky-holder', array('background-color' => gotravel_mikado_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
		}

		if($gotravel_mikado_options['sticky_header_height'] !== '') {
			$max_height = intval(gotravel_mikado_filter_px($gotravel_mikado_options['sticky_header_height'])).'px';

			echo gotravel_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header', array('height' => $gotravel_mikado_options['sticky_header_height'].'px'));
			echo gotravel_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-logo-wrapper a', array('max-height' => $max_height));
		}

		$sticky_menu_item_styles = array();
		if($gotravel_mikado_options['sticky_color'] !== '') {
			$sticky_menu_item_styles['color'] = $gotravel_mikado_options['sticky_color'];
		}
		if($gotravel_mikado_options['sticky_google_fonts'] !== '-1') {
			$sticky_menu_item_styles['font-family'] = gotravel_mikado_get_formatted_font_family($gotravel_mikado_options['sticky_google_fonts']);
		}
		if($gotravel_mikado_options['sticky_fontsize'] !== '') {
			$sticky_menu_item_styles['font-size'] = $gotravel_mikado_options['sticky_fontsize'].'px';
		}
		if($gotravel_mikado_options['sticky_lineheight'] !== '') {
			$sticky_menu_item_styles['line-height'] = $gotravel_mikado_options['sticky_lineheight'].'px';
		}
		if($gotravel_mikado_options['sticky_texttransform'] !== '') {
			$sticky_menu_item_styles['text-transform'] = $gotravel_mikado_options['sticky_texttransform'];
		}
		if($gotravel_mikado_options['sticky_fontstyle'] !== '') {
			$sticky_menu_item_styles['font-style'] = $gotravel_mikado_options['sticky_fontstyle'];
		}
		if($gotravel_mikado_options['sticky_fontweight'] !== '') {
			$sticky_menu_item_styles['font-weight'] = $gotravel_mikado_options['sticky_fontweight'];
		}
		if($gotravel_mikado_options['sticky_letterspacing'] !== '') {
			$sticky_menu_item_styles['letter-spacing'] = $gotravel_mikado_options['sticky_letterspacing'].'px';
		}

		$sticky_menu_item_selector = array(
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li > a'
		);

		echo gotravel_mikado_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

		$sticky_menu_item_hover_styles = array();
		if($gotravel_mikado_options['sticky_hovercolor'] !== '') {
			$sticky_menu_item_hover_styles['color'] = $gotravel_mikado_options['sticky_hovercolor'];
		}

		$sticky_menu_item_hover_selector = array(
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li:hover > a',
			'.mkdf-main-menu.mkdf-sticky-nav > ul > li.mkdf-active-item > a'
		);

		echo gotravel_mikado_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_sticky_header_styles');
}

if(!function_exists('gotravel_mikado_fixed_header_styles')) {
	/**
	 * Generates styles for fixed haeder
	 */
	function gotravel_mikado_fixed_header_styles() {
		global $gotravel_mikado_options;

		if($gotravel_mikado_options['fixed_header_background_color'] !== '') {

			$fixed_header_background_color              = $gotravel_mikado_options['fixed_header_background_color'];
			$fixed_header_background_color_transparency = 1;

			if($gotravel_mikado_options['fixed_header_transparency'] !== '') {
				$fixed_header_background_color_transparency = $gotravel_mikado_options['fixed_header_transparency'];
			}

			echo gotravel_mikado_dynamic_css('.mkdf-header-standard .mkdf-fixed-wrapper.fixed .mkdf-menu-area',
				array('background-color' => gotravel_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
		}
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_fixed_header_styles');
}

if(!function_exists('gotravel_mikado_main_menu_styles')) {
	/**
	 * Generates styles for main menu
	 */
	function gotravel_mikado_main_menu_styles() {
		global $gotravel_mikado_options;

		if($gotravel_mikado_options['menu_color'] !== '' || $gotravel_mikado_options['menu_fontsize'] != '' || $gotravel_mikado_options['menu_fontstyle'] !== '' || $gotravel_mikado_options['menu_fontweight'] !== '' || $gotravel_mikado_options['menu_texttransform'] !== '' || $gotravel_mikado_options['menu_letterspacing'] !== '' || $gotravel_mikado_options['menu_google_fonts'] != "-1") { ?>
			.mkdf-main-menu > ul > li > a {
			<?php if($gotravel_mikado_options['menu_color']) { ?> color: <?php echo esc_attr($gotravel_mikado_options['menu_color']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['menu_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $gotravel_mikado_options['menu_google_fonts'])); ?>', sans-serif;
			<?php } ?>
			<?php if($gotravel_mikado_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($gotravel_mikado_options['menu_fontsize']); ?>px; <?php } ?>
			<?php if($gotravel_mikado_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($gotravel_mikado_options['menu_fontstyle']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($gotravel_mikado_options['menu_fontweight']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($gotravel_mikado_options['menu_texttransform']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($gotravel_mikado_options['menu_letterspacing']); ?>px; <?php } ?>
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_hovercolor'] !== '') { ?>
			.mkdf-main-menu > ul > li > a:hover {
			color: <?php echo esc_attr($gotravel_mikado_options['menu_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_activecolor'] !== '') { ?>
			.mkdf-main-menu > ul > li.mkdf-active-item > a {
			color: <?php echo esc_attr($gotravel_mikado_options['menu_activecolor']); ?>;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_light_hovercolor'] !== '') { ?>
			.light .mkdf-main-menu > ul > li:hover > a {
			color: <?php echo esc_attr($gotravel_mikado_options['menu_light_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_light_activecolor'] !== '') { ?>
			.light .mkdf-main-menu > ul > li.mkdf-active-item > a{
			color: <?php echo esc_attr($gotravel_mikado_options['menu_light_activecolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_dark_hovercolor'] !== '') { ?>
			.dark .mkdf-main-menu > ul > li:hover > a{
			color: <?php echo esc_attr($gotravel_mikado_options['menu_dark_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_dark_activecolor'] !== '') { ?>
			.dark .mkdf-main-menu > ul > li.mkdf-active-item > a{
			color: <?php echo esc_attr($gotravel_mikado_options['menu_dark_activecolor']); ?>;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['menu_lineheight'] != "") { ?>
			.mkdf-main-menu > ul > li > a span.item_inner{
			line-height: <?php echo esc_attr($gotravel_mikado_options['menu_lineheight']); ?>px;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['dropdown_color'] !== '' || $gotravel_mikado_options['dropdown_fontsize'] !== '' || $gotravel_mikado_options['dropdown_lineheight'] !== '' || $gotravel_mikado_options['dropdown_fontstyle'] !== '' || $gotravel_mikado_options['dropdown_fontweight'] !== '' || $gotravel_mikado_options['dropdown_google_fonts'] != "-1" || $gotravel_mikado_options['dropdown_texttransform'] !== '' || $gotravel_mikado_options['dropdown_letterspacing'] !== '') { ?>
			.mkdf-drop-down .second .inner > ul > li > a {
			<?php if(!empty($gotravel_mikado_options['dropdown_color'])) { ?> color: <?php echo esc_attr($gotravel_mikado_options['dropdown_color']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $gotravel_mikado_options['dropdown_google_fonts'])); ?>', sans-serif !important;
			<?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontsize']); ?>px; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($gotravel_mikado_options['dropdown_lineheight']); ?>px; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontstyle']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontweight']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($gotravel_mikado_options['dropdown_texttransform']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($gotravel_mikado_options['dropdown_letterspacing']); ?>px;  <?php } ?>
			}
		<?php } ?>

		<?php if(!empty($gotravel_mikado_options['dropdown_hovercolor'])) { ?>
			.mkdf-drop-down .second .inner > ul > li > a:hover,
			.mkdf-drop-down .second .inner > ul > li.current-menu-ancestor > a,
			.mkdf-drop-down .second .inner > ul > li.current-menu-item > a {
			color: <?php echo esc_attr($gotravel_mikado_options['dropdown_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['dropdown_wide_color'] !== '' || $gotravel_mikado_options['dropdown_wide_fontsize'] !== '' || $gotravel_mikado_options['dropdown_wide_lineheight'] !== '' || $gotravel_mikado_options['dropdown_wide_fontstyle'] !== '' || $gotravel_mikado_options['dropdown_wide_fontweight'] !== '' || $gotravel_mikado_options['dropdown_wide_google_fonts'] !== "-1" || $gotravel_mikado_options['dropdown_wide_texttransform'] !== '' || $gotravel_mikado_options['dropdown_wide_letterspacing'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner > ul > li > a{
			<?php if($gotravel_mikado_options['dropdown_wide_color'] !== '') { ?> color: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_color']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_google_fonts'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $gotravel_mikado_options['dropdown_wide_google_fonts'])); ?>', sans-serif !important;
			<?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontsize']); ?>px; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_lineheight']); ?>px; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontstyle']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontweight']); ?>; <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_texttransform']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_letterspacing']); ?>px;  <?php } ?>
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['dropdown_wide_hovercolor'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner > ul > li > a:hover,
			.mkdf-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a,
			.mkdf-drop-down .wide .second .inner > ul > li.current-menu-item > a {
			color: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_hovercolor']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['dropdown_color_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_fontsize_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_lineheight_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_fontstyle_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_fontweight_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_google_fonts_thirdlvl'] != "-1" || $gotravel_mikado_options['dropdown_texttransform_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_letterspacing_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .second .inner ul li ul li a {
			<?php if($gotravel_mikado_options['dropdown_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($gotravel_mikado_options['dropdown_color_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_google_fonts_thirdlvl'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $gotravel_mikado_options['dropdown_google_fonts_thirdlvl'])); ?>', sans-serif;
			<?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontsize_thirdlvl']); ?>px;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($gotravel_mikado_options['dropdown_lineheight_thirdlvl']); ?>px;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontstyle_thirdlvl']); ?>;   <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($gotravel_mikado_options['dropdown_fontweight_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($gotravel_mikado_options['dropdown_texttransform_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($gotravel_mikado_options['dropdown_letterspacing_thirdlvl']); ?>px;  <?php } ?>
			}
		<?php } ?>
		<?php if($gotravel_mikado_options['dropdown_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .second .inner ul li ul li a:hover,
			.mkdf-drop-down .second .inner ul li ul li.current-menu-ancestor > a,
			.mkdf-drop-down .second .inner ul li ul li.current-menu-item > a {
			color: <?php echo esc_attr($gotravel_mikado_options['dropdown_hovercolor_thirdlvl']); ?> !important;
			}
		<?php } ?>

		<?php if($gotravel_mikado_options['dropdown_wide_color_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_fontsize_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_lineheight_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_fontstyle_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_fontweight_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_google_fonts_thirdlvl'] != "-1" || $gotravel_mikado_options['dropdown_wide_texttransform_thirdlvl'] !== '' || $gotravel_mikado_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner ul li ul li a {
			<?php if($gotravel_mikado_options['dropdown_wide_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_color_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_google_fonts_thirdlvl'] != "-1") { ?>
				font-family: '<?php echo esc_attr(str_replace('+', ' ', $gotravel_mikado_options['dropdown_wide_google_fonts_thirdlvl'])); ?>', sans-serif;
			<?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontsize_thirdlvl']); ?>px;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_lineheight_thirdlvl']); ?>px;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontstyle_thirdlvl']); ?>;   <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_fontweight_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_texttransform_thirdlvl']); ?>;  <?php } ?>
			<?php if($gotravel_mikado_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_letterspacing_thirdlvl']); ?>px;  <?php } ?>
			}
		<?php } ?>
		<?php if($gotravel_mikado_options['dropdown_wide_hovercolor_thirdlvl'] !== '') { ?>
			.mkdf-drop-down .wide .second .inner ul li ul li a:hover,
			.mkdf-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a,
			.mkdf-drop-down .wide .second .inner ul li ul li.current-menu-item > a{
			color: <?php echo esc_attr($gotravel_mikado_options['dropdown_wide_hovercolor_thirdlvl']); ?> !important;
			}
		<?php }
	}

	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_main_menu_styles');
}