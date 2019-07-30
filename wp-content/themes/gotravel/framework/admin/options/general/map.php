<?php

if(!function_exists('gotravel_mikado_general_options_map')) {
	/**
	 * General options page
	 */
	function gotravel_mikado_general_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__('General', 'gotravel'),
				'icon'  => 'fa fa-institution'
			)
		);

		$panel_logo = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_logo',
				'title' => esc_html__('Branding', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__('Hide Logo', 'gotravel'),
				'description'   => esc_html__('Enabling this option will hide logo image', 'gotravel'),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#mkdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Default', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Dark', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label'         => esc_html__('Logo Image - Light', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label'         => esc_html__('Logo Image - Sticky', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Mobile', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		$panel_design_style = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__('Appearance', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose a default Google font for your site', 'gotravel'),
				'parent'        => $panel_design_style
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Additional Google Fonts', 'gotravel'),
				'description'   => '',
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_additional_google_fonts_container"
				)
			)
		);

		$additional_google_fonts_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose additional Google font for your site', 'gotravel'),
				'parent'        => $additional_google_fonts_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose additional Google font for your site', 'gotravel'),
				'parent'        => $additional_google_fonts_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose additional Google font for your site', 'gotravel'),
				'parent'        => $additional_google_fonts_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose additional Google font for your site', 'gotravel'),
				'parent'        => $additional_google_fonts_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'description'   => esc_html__('Choose additional Google font for your site', 'gotravel'),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'name' => 'google_font_weight',
				'type' => 'checkboxgroup',
				'default_value' => '',
				'label' => esc_html__('Google Fonts Style & Weight', 'gotravel'),
				'description' => esc_html__('Choose a default Google font weights for your site. Impact on page load time', 'gotravel'),
				'parent' => $panel_design_style,
				'options' => array(
					'100'       => esc_html__('100 Thin', 'gotravel'),
					'100italic' => esc_html__('100 Thin Italic', 'gotravel'),
					'200'       => esc_html__('200 Extra-Light', 'gotravel'),
					'200italic' => esc_html__('200 Extra-Light Italic', 'gotravel'),
					'300'       => esc_html__('300 Light', 'gotravel'),
					'300italic' => esc_html__('300 Light Italic', 'gotravel'),
					'400'       => esc_html__('400 Regular', 'gotravel'),
					'400italic' => esc_html__('400 Regular Italic', 'gotravel'),
					'500'       => esc_html__('500 Medium', 'gotravel'),
					'500italic' => esc_html__('500 Medium Italic', 'gotravel'),
					'600'       => esc_html__('600 Semi-Bold', 'gotravel'),
					'600italic' => esc_html__('600 Semi-Bold Italic', 'gotravel'),
					'700'       => esc_html__('700 Bold', 'gotravel'),
					'700italic' => esc_html__('700 Bold Italic', 'gotravel'),
					'800'       => esc_html__('800 Extra-Bold', 'gotravel'),
					'800italic' => esc_html__('800 Extra-Bold Italic', 'gotravel'),
					'900'       => esc_html__('900 Ultra-Bold', 'gotravel'),
					'900italic' => esc_html__('900 Ultra-Bold Italic', 'gotravel')
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'name' => 'google_font_subset',
				'type' => 'checkboxgroup',
				'default_value' => '',
				'label' => esc_html__('Google Fonts Subset', 'gotravel'),
				'description' => esc_html__('Choose a default Google font subsets for your site', 'gotravel'),
				'parent' => $panel_design_style,
				'options' => array(
					'latin' => esc_html__('Latin', 'gotravel'),
					'latin-ext' => esc_html__('Latin Extended', 'gotravel'),
					'cyrillic' => esc_html__('Cyrillic', 'gotravel'),
					'cyrillic-ext' => esc_html__('Cyrillic Extended', 'gotravel'),
					'greek' => esc_html__('Greek', 'gotravel'),
					'greek-ext' => esc_html__('Greek Extended', 'gotravel'),
					'vietnamese' => esc_html__('Vietnamese', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__('First Main Color', 'gotravel'),
				'description' => esc_html__('Choose the most dominant theme color. Default color is #e83f53', 'gotravel'),
				'parent'      => $panel_design_style
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__('Page Background Color', 'gotravel'),
				'description' => esc_html__('Choose the background color for page content. Default color is #ffffff', 'gotravel'),
				'parent'      => $panel_design_style
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__('Text Selection Color', 'gotravel'),
				'description' => esc_html__('Choose the color users see when selecting text', 'gotravel'),
				'parent'      => $panel_design_style
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Boxed Layout', 'gotravel'),
				'description'   => '',
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_boxed_container"
				)
			)
		);

		$boxed_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'boxed_container',
				'hidden_property' => 'boxed',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color_in_box',
				'type'        => 'color',
				'label'       => esc_html__('Page Background Color', 'gotravel'),
				'description' => esc_html__('Choose the page background color outside box.', 'gotravel'),
				'parent'      => $boxed_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'boxed_background_image',
				'type'        => 'image',
				'label'       => esc_html__('Background Image', 'gotravel'),
				'description' => esc_html__('Choose an image to be displayed in background', 'gotravel'),
				'parent'      => $boxed_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'boxed_pattern_background_image',
				'type'        => 'image',
				'label'       => esc_html__('Background Pattern', 'gotravel'),
				'description' => esc_html__('Choose an image to be used as background pattern', 'gotravel'),
				'parent'      => $boxed_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'boxed_background_image_attachment',
				'type'          => 'select',
				'default_value' => 'fixed',
				'label'         => esc_html__('Background Image Attachment', 'gotravel'),
				'description'   => esc_html__('Choose background image attachment', 'gotravel'),
				'parent'        => $boxed_container,
				'options'       => array(
					'fixed'  => esc_html__('Fixed', 'gotravel'),
					'scroll' => esc_html__('Scroll', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => 'grid-1300',
				'label'         => esc_html__('Initial Width of Content', 'gotravel'),
				'description'   => esc_html__('Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'gotravel'),
				'parent'        => $panel_design_style,
				'options'       => array(
					"grid-1300" => "1300px",
					"grid-1200" => "1200px",
					"grid-1100" => "1100px",
					"grid-1000" => "1000px",
					"grid-800"  => "800px"
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'preload_pattern_image',
				'type'        => 'image',
				'label'       => esc_html__('Preload Pattern Image', 'gotravel'),
				'description' => esc_html__('Choose preload pattern image to be displayed until images are loaded', 'gotravel'),
				'parent'      => $panel_design_style
			)
		);

		$panel_settings = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__('Behavior', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Smooth Page Transitions', 'gotravel'),
				'description'   => esc_html__('Enabling this option will perform a smooth transition between pages when clicking on links.', 'gotravel'),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_page_transitions_container"
				)
			)
		);

		$page_transitions_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__('Page Loader Background Color', 'gotravel'),
				'parent' => $page_transitions_container
			)
		);

		$group_pt_spinner_animation = gotravel_mikado_add_admin_group(array(
			'name'        => 'group_pt_spinner_animation',
			'title'       => esc_html__('Loader Style', 'gotravel'),
			'description' => esc_html__('Define styles for loader spinner animation', 'gotravel'),
			'parent'      => $page_transitions_container
		));

		$row_pt_spinner_animation = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_pt_spinner_animation',
			'parent' => $group_pt_spinner_animation
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectsimple',
			'name'          => 'smooth_pt_spinner_type',
			'default_value' => '',
			'label'         => esc_html__('Spinner Type', 'gotravel'),
			'parent'        => $row_pt_spinner_animation,
			'options'       => array(
				"pulse"                 => esc_html__("Pulse", 'gotravel'),
				"double_pulse"          => esc_html__("Double Pulse", 'gotravel'),
				"cube"                  => esc_html__("Cube", 'gotravel'),
				"rotating_cubes"        => esc_html__("Rotating Cubes", 'gotravel'),
				"stripes"               => esc_html__("Stripes", 'gotravel'),
				"wave"                  => esc_html__("Wave", 'gotravel'),
				"two_rotating_circles"  => esc_html__("2 Rotating Circles", 'gotravel'),
				"five_rotating_circles" => esc_html__("5 Rotating Circles", 'gotravel'),
				"atom"                  => esc_html__("Atom", 'gotravel'),
				"clock"                 => esc_html__("Clock", 'gotravel'),
				"mitosis"               => esc_html__("Mitosis", 'gotravel'),
				"lines"                 => esc_html__("Lines", 'gotravel'),
				"fussion"               => esc_html__("Fussion", 'gotravel'),
				"wave_circles"          => esc_html__("Wave Circles", 'gotravel'),
				"pulse_circles"         => esc_html__("Pulse Circles", 'gotravel')
			)
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'smooth_pt_spinner_color',
			'default_value' => '',
			'label'         => esc_html__('Spinner Color', 'gotravel'),
			'parent'        => $row_pt_spinner_animation
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Show "Back To Top Button"', 'gotravel'),
				'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'gotravel'),
				'parent'        => $panel_settings
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Responsiveness', 'gotravel'),
				'description'   => esc_html__('Enabling this option will make all pages responsive', 'gotravel'),
				'parent'        => $panel_settings
			)
		);

		$panel_custom_code = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__('Custom Code', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'custom_css',
				'type'        => 'textarea',
				'label'       => esc_html__('Custom CSS', 'gotravel'),
				'description' => esc_html__('Enter your custom CSS here', 'gotravel'),
				'parent'      => $panel_custom_code
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__('Custom JS', 'gotravel'),
				'description' => esc_html__('Enter your custom Javascript here', 'gotravel'),
				'parent'      => $panel_custom_code
			)
		);

		$panel_google_api = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__('Google API', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__('Google Maps Api Key', 'gotravel'),
				'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'gotravel'),
				'parent'      => $panel_google_api
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_general_options_map', 1);
}