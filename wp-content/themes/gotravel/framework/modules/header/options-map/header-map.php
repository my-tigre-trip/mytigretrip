<?php

if(!function_exists('gotravel_mikado_header_options_map')) {

	function gotravel_mikado_header_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_header_page',
				'title' => esc_html__('Header', 'gotravel'),
				'icon'  => 'fa fa-header'
			)
		);

		$panel_header = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_header_page',
				'name'  => 'panel_header',
				'title' => esc_html__('Header', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'radiogroup',
				'name'          => 'header_type',
				'default_value' => 'header-standard',
				'label'         => esc_html__('Choose Header Type', 'gotravel'),
				'description'   => esc_html__('Select the type of header you would like to use', 'gotravel'),
				'options'       => array(
					'header-standard' => array(
						'image' => 'http://demo.redux.io/wp-content/plugins/redux-framework/ReduxCore/assets/img/2cl.png'
					)
				),
				'args'          => array(
					'use_images'  => true,
					'hide_labels' => true,
					'dependence'  => true,
					'show'        => array(
						'header-standard' => '#mkdf_panel_header_standard,#mkdf_header_behaviour,#mkdf_panel_fixed_header,#mkdf_panel_sticky_header,#mkdf_panel_main_menu',
					),
					'hide'        => array(
						'header-standard' => '',
					)
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'          => $panel_header,
				'type'            => 'select',
				'name'            => 'header_behaviour',
				'default_value'   => 'fixed-on-scroll',
				'label'           => esc_html__('Choose Header behaviour', 'gotravel'),
				'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'gotravel'),
				'options'         => array(
					'no-behavior'                     => esc_html__('No Behavior', 'gotravel'),
					'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'gotravel'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'gotravel'),
					'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'gotravel')
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => array(),
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						'sticky-header-on-scroll-up'      => '#mkdf_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#mkdf_panel_sticky_header',
						'fixed-on-scroll'                 => '#mkdf_panel_fixed_header'
					),
					'hide'       => array(
						'sticky-header-on-scroll-up'      => '#mkdf_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#mkdf_panel_fixed_header',
						'fixed-on-scroll'                 => '#mkdf_panel_sticky_header',
						'no-behavior'                     => '#mkdf_panel_fixed_header, #mkdf_panel_fixed_header, #mkdf_panel_sticky_header'
					)
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Top Bar', 'gotravel'),
				'description'   => esc_html__('Enabling this option will show top bar area', 'gotravel'),
				'parent'        => $panel_header,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_top_bar_container"
				)
			)
		);

		$top_bar_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'top_bar_container',
			'parent'          => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Top Bar in Grid', 'gotravel'),
				'description'   => esc_html__('Set top bar content to be in grid', 'gotravel'),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_top_bar_in_grid_container"
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'        => 'top_bar_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'gotravel'),
			'description' => esc_html__('Set background color for top bar', 'gotravel'),
			'parent'      => $top_bar_container
		));

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'select',
				'name'          => 'header_style',
				'default_value' => '',
				'label'         => esc_html__('Header Skin', 'gotravel'),
				'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'gotravel'),
				'options'       => array(
					''             => esc_html__('Default', 'gotravel'),
					'light-header' => esc_html__('Light', 'gotravel'),
					'dark-header'  => esc_html__('Dark', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'yesno',
				'name'          => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Header Style on Scroll', 'gotravel'),
				'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'gotravel'),
			)
		);

		$panel_header_standard = gotravel_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_standard',
				'title'           => esc_html__('Header Standard', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name'   => 'menu_area_title',
				'title'  => esc_html__('Menu Area', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_standard',
				'label'         => esc_html__('Background Color', 'gotravel'),
				'description'   => esc_html__('Set background color for header', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Background Transparency', 'gotravel'),
				'description'   => esc_html__('Set background transparency for header', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'color',
				'name'          => 'menu_background_color_header_standard',
				'label'         => esc_html__('Menu Background Color', 'gotravel'),
				'description'   => esc_html__('Set background color for menu area', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Height', 'gotravel'),
				'description'   => esc_html__('Enter header height (default is 88px)', 'gotravel'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$panel_sticky_header = gotravel_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Sticky Header', 'gotravel'),
				'name'            => 'panel_sticky_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values'   => array(
					'fixed-on-scroll',
					'no-behavior'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'scroll_amount_for_sticky',
				'type'        => 'text',
				'label'       => esc_html__('Scroll Amount for Sticky', 'gotravel'),
				'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height)', 'gotravel'),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'sticky_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Sticky Header in grid', 'gotravel'),
				'description'   => esc_html__('Set sticky header content to be in grid', 'gotravel'),
				'parent'        => $panel_sticky_header,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_sticky_header_in_grid_container"
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'        => 'sticky_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'gotravel'),
			'description' => esc_html__('Set background color for sticky header', 'gotravel'),
			'parent'      => $panel_sticky_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'sticky_header_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Sticky Header Transparency', 'gotravel'),
			'description' => esc_html__('Enter transparency for sticky header (value from 0 to 1)', 'gotravel'),
			'parent'      => $panel_sticky_header,
			'args'        => array(
				'col_width' => 1
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'sticky_header_height',
			'type'        => 'text',
			'label'       => esc_html__('Sticky Header Height', 'gotravel'),
			'description' => esc_html__('Enter height for sticky header (default is 60px)', 'gotravel'),
			'parent'      => $panel_sticky_header,
			'args'        => array(
				'col_width' => 2,
				'suffix'    => 'px'
			)
		));

		$group_sticky_header_menu = gotravel_mikado_add_admin_group(array(
			'title'       => esc_html__('Sticky Header Menu', 'gotravel'),
			'name'        => 'group_sticky_header_menu',
			'parent'      => $panel_sticky_header,
			'description' => esc_html__('Define styles for sticky menu items', 'gotravel'),
		));

		$row1_sticky_header_menu = gotravel_mikado_add_admin_row(array(
			'name'   => 'row1',
			'parent' => $group_sticky_header_menu
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'sticky_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'gotravel'),
			'parent'      => $row1_sticky_header_menu
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'sticky_hovercolor',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Color', 'gotravel'),
			'parent'      => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = gotravel_mikado_add_admin_row(array(
			'name'   => 'row2',
			'parent' => $group_sticky_header_menu
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'sticky_google_fonts',
				'type'          => 'fontsimple',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'default_value' => '-1',
				'parent'        => $row2_sticky_header_menu,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_fontsize',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_lineheight',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_texttransform',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'default_value' => '',
				'options'       => gotravel_mikado_get_text_transform_array(),
				'parent'        => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = gotravel_mikado_add_admin_row(array(
			'name'   => 'row3',
			'parent' => $group_sticky_header_menu
		));

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_letterspacing',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'default_value' => '',
				'parent'        => $row3_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$panel_fixed_header = gotravel_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Fixed Header', 'gotravel'),
				'name'            => 'panel_fixed_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values'   => array(
					'sticky-header-on-scroll-up',
					'sticky-header-on-scroll-down-up',
					'no-behavior'
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'fixed_header_background_color',
			'type'          => 'color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'gotravel'),
			'description'   => esc_html__('Set background color for fixed header', 'gotravel'),
			'parent'        => $panel_fixed_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'fixed_header_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Header Transparency', 'gotravel'),
			'description' => esc_html__('Enter transparency for fixed header (value from 0 to 1)', 'gotravel'),
			'parent'      => $panel_fixed_header,
			'args'        => array(
				'col_width' => 1
			)
		));

		$panel_main_menu = gotravel_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Main Menu', 'gotravel'),
				'name'            => 'panel_main_menu',
				'page'            => '_header_page'
			)
		);

		gotravel_mikado_add_admin_section_title(
			array(
				'parent' => $panel_main_menu,
				'name'   => 'main_menu_area_title',
				'title'  => esc_html__('Main Menu General Settings', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_main_menu,
				'type'          => 'select',
				'name'          => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label'         => esc_html__('Main Dropdown Menu Appearance', 'gotravel'),
				'description'   => esc_html__('Choose appearance for dropdown menu', 'gotravel'),
				'options'       => array(
					'dropdown-default'           => esc_html__('Default', 'gotravel'),
					'dropdown-slide-from-bottom' => esc_html__('Slide From Bottom', 'gotravel'),
					'dropdown-slide-from-top'    => esc_html__('Slide From Top', 'gotravel'),
					'dropdown-animate-height'    => esc_html__('Animate Height', 'gotravel'),
					'dropdown-slide-from-left'   => esc_html__('Slide From Left', 'gotravel')
				)
			)
		);

		$first_level_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'first_level_group',
				'title'       => esc_html__('1st Level Menu', 'gotravel'),
				'description' => esc_html__('Define styles for 1st level in Top Navigation Menu', 'gotravel')
			)
		);

		$first_level_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Active Text Color', 'gotravel'),
			)
		);

		$first_level_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'colorsimple',
				'name'          => 'menu_light_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Light Menu Hover Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'colorsimple',
				'name'          => 'menu_light_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Light Menu Active Text Color', 'gotravel'),
			)
		);

		$first_level_row4 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row4',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row4,
				'type'          => 'colorsimple',
				'name'          => 'menu_dark_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Dark Menu Hover Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row4,
				'type'          => 'colorsimple',
				'name'          => 'menu_dark_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Dark Menu Active Text Color', 'gotravel'),
			)
		);

		$first_level_row5 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row5',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'fontsimple',
				'name'          => 'menu_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'textsimple',
				'name'          => 'menu_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'textsimple',
				'name'          => 'menu_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_row6 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row6',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'textsimple',
				'name'          => 'menu_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$second_level_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'second_level_group',
				'title'       => esc_html__('2nd Level Menu', 'gotravel'),
				'description' => esc_html__('Define styles for 2nd level in Top Navigation Menu', 'gotravel')
			)
		);

		$second_level_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'gotravel')
			)
		);

		$second_level_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$second_level_wide_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'second_level_wide_group',
				'title'       => esc_html__('2nd Level Wide Menu', 'gotravel'),
				'description' => esc_html__('Define styles for 2nd level in Wide Menu', 'gotravel')
			)
		);

		$second_level_wide_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row1'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'gotravel')
			)
		);

		$second_level_wide_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_wide_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_wide_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$third_level_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'third_level_group',
				'title'       => esc_html__('3nd Level Menu', 'gotravel'),
				'description' => esc_html__('Define styles for 3nd level in Top Navigation Menu', 'gotravel')
			)
		);

		$third_level_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row1'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_color_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'gotravel')
			)
		);

		$third_level_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_fontsize_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_lineheight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontstyle_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontweight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_letterspacing_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_texttransform_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);


		/***********************************************************/
		$third_level_wide_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'third_level_wide_group',
				'title'       => esc_html__('3rd Level Wide Menu', 'gotravel'),
				'description' => esc_html__('Define styles for 3rd level in Wide Menu', 'gotravel')
			)
		);

		$third_level_wide_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row1'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_color_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'gotravel')
			)
		);

		$third_level_wide_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_wide_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_fontsize_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_lineheight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_wide_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontstyle_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontweight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_letterspacing_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_texttransform_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$panel_mobile_header = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Mobile Header', 'gotravel'),
			'name'  => 'panel_mobile_header',
			'page'  => '_header_page'
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Header Height', 'gotravel'),
			'description' => esc_html__('Enter height for mobile header in pixels', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Header Background Color', 'gotravel'),
			'description' => esc_html__('Choose color for mobile header', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Menu Background Color', 'gotravel'),
			'description' => esc_html__('Choose color for mobile menu', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_separator_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Menu Item Separator Color', 'gotravel'),
			'description' => esc_html__('Choose color for mobile menu horizontal separators', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'gotravel'),
			'description' => esc_html__('Define logo height for screen size smaller than 1000px', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'gotravel'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'color',
			'label'       => esc_html__('Navigation Text Color', 'gotravel'),
			'description' => esc_html__('Define color for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Navigation Hover/Active Color', 'gotravel'),
			'description' => esc_html__('Define hover/active color for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_font_family',
			'type'        => 'font',
			'label'       => esc_html__('Navigation Font Family', 'gotravel'),
			'description' => esc_html__('Define font family for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'text',
			'label'       => esc_html__('Navigation Font Size', 'gotravel'),
			'description' => esc_html__('Define font size for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'text',
			'label'       => esc_html__('Navigation Line Height', 'gotravel'),
			'description' => esc_html__('Define line height for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Text Transform', 'gotravel'),
			'description' => esc_html__('Define text transform for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'options'     => gotravel_mikado_get_text_transform_array(true)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Font Style', 'gotravel'),
			'description' => esc_html__('Define font style for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'options'     => gotravel_mikado_get_font_style_array(true)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Font Weight', 'gotravel'),
			'description' => esc_html__('Define font weight for mobile navigation text', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'options'     => gotravel_mikado_get_font_weight_array(true)
		));

		gotravel_mikado_add_admin_section_title(array(
			'name'   => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title'  => esc_html__('Mobile Menu Opener', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'mobile_icon_pack',
			'type'          => 'select',
			'label'         => esc_html__('Mobile Navigation Icon Pack', 'gotravel'),
			'default_value' => 'font_awesome',
			'description'   => esc_html__('Choose icon pack for mobile navigation icon', 'gotravel'),
			'parent'        => $panel_mobile_header,
			'options'       => gotravel_mikado_icon_collections()->getIconCollectionsExclude(array(
				'linea_icons',
				'simple_line_icons'
			))
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'gotravel'),
			'description' => esc_html__('Choose color for icon header', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'gotravel'),
			'description' => esc_html__('Choose hover color for mobile navigation icon ', 'gotravel'),
			'parent'      => $panel_mobile_header
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_size',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Icon size', 'gotravel'),
			'description' => esc_html__('Choose size for mobile navigation icon ', 'gotravel'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_header_options_map', 3);

}