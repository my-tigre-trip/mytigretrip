<?php

if(!function_exists('gotravel_mikado_search_options_map')) {

	function gotravel_mikado_search_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__('Search', 'gotravel'),
				'icon'  => 'fa fa-search'
			)
		);

		$search_panel = gotravel_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'gotravel'),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen-search',
				'label'         => esc_html__('Select Search Type', 'gotravel'),
				'description'   => esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with transparent header)", 'gotravel'),
				'options'       => array(
					'fullscreen-search' => esc_html__('Fullscreen Search', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_awesome',
				'label'         => esc_html__('Search Icon Pack', 'gotravel'),
				'description'   => esc_html__('Choose icon pack for search icon', 'gotravel'),
				'options'       => gotravel_mikado_icon_collections()->getIconCollectionsExclude(array(
					'linea_icons',
					'simple_line_icons'
				))
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name' => 'fullscreen_search_background_image',
			'type' => 'image',
			'parent' => $search_panel,
			'label' => esc_html__('Full Screen Search Background Image', 'gotravel'),
			'description' => esc_html__('Choose full screen search background image', 'gotravel')
		));


		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__('Search area in grid', 'gotravel'),
				'description'   => esc_html__('Set search area to be in grid', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__('Initial Search Icon in Header', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__('Icon Size', 'gotravel'),
				'description'   => esc_html__('Set size for icon', 'gotravel'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$search_icon_color_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Colors', 'gotravel'),
				'description' => esc_html__('Define color style for icon', 'gotravel'),
				'name'        => 'search_icon_color_group'
			)
		);

		$search_icon_color_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__('Color', 'gotravel')
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__('Hover Color', 'gotravel')
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_color',
				'label'  => esc_html__('Light Header Icon Color', 'gotravel')
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_hover_color',
				'label'  => esc_html__('Light Header Icon Hover Color', 'gotravel')
			)
		);

		$search_icon_color_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_color',
				'label'  => esc_html__('Dark Header Icon Color', 'gotravel')
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_hover_color',
				'label'  => esc_html__('Dark Header Icon Hover Color', 'gotravel')
			)
		);


		$search_icon_background_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Background Style', 'gotravel'),
				'description' => esc_html__('Define background style for icon', 'gotravel'),
				'name'        => 'search_icon_background_group'
			)
		);

		$search_icon_background_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_icon_background_group,
				'name'   => 'search_icon_background_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_hover_color',
				'default_value' => '',
				'label'         => esc_html__('Background Hover Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Search Icon Text', 'gotravel'),
				'description'   => esc_html__("Enable this option to show 'Search' text next to search icon in header", 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_search_icon_text_container'
				)
			)
		);

		$enable_search_icon_text_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);

		$enable_search_icon_text_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__('Search Icon Text', 'gotravel'),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__('Define Style for Search Icon Text', 'gotravel')
			)
		);

		$enable_search_icon_text_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color',
				'label'         => esc_html__('Text Color', 'gotravel'),
				'default_value' => ''
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color_hover',
				'label'         => esc_html__('Text Hover Color', 'gotravel'),
				'default_value' => ''
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_fontsize',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_lineheight',
				'label'         => esc_html__('Line Height', 'gotravel'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$enable_search_icon_text_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_texttransform',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'default_value' => '',
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__('Font Family', 'gotravel'),
				'default_value' => '-1',
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontstyle',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'default_value' => '',
				'options'       => gotravel_mikado_get_font_style_array(),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontweight',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'default_value' => '',
				'options'       => gotravel_mikado_get_font_weight_array(),
			)
		);

		$enable_search_icon_text_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letterspacing',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_icon_spacing_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Spacing', 'gotravel'),
				'description' => esc_html__('Define padding and margins for Search icon', 'gotravel'),
				'name'        => 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_icon_spacing_group,
				'name'   => 'search_icon_spacing_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_left',
				'default_value' => '',
				'label'         => esc_html__('Padding Left', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_right',
				'default_value' => '',
				'label'         => esc_html__('Padding Right', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_left',
				'default_value' => '',
				'label'         => esc_html__('Margin Left', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_right',
				'default_value' => '',
				'label'         => esc_html__('Margin Right', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'search_form_title',
				'title'  => esc_html__('Search Bar', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'color',
				'name'          => 'search_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'gotravel'),
				'description'   => esc_html__('Choose a background color for Select search bar', 'gotravel')
			)
		);

		$search_input_text_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Input Text', 'gotravel'),
				'description' => esc_html__('Define style for search text', 'gotravel'),
				'name'        => 'search_input_text_group'
			)
		);

		$search_input_text_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_input_text_group,
				'name'   => 'search_input_text_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_text_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_text_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$search_input_text_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_input_text_group,
				'name'   => 'search_input_text_row2'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array(),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'textsimple',
				'name'          => 'search_text_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_label_text_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Label Text', 'gotravel'),
				'description' => esc_html__('Define style for search label text', 'gotravel'),
				'name'        => 'search_label_text_group'
			)
		);

		$search_label_text_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_label_text_group,
				'name'   => 'search_label_text_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_label_text_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_label_text_fontsize',
				'label'         => esc_html__('Font Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_texttransform',
				'label'         => esc_html__('Text Transform', 'gotravel'),
				'options'       => gotravel_mikado_get_text_transform_array()
			)
		);

		$search_label_text_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_label_text_group,
				'name'   => 'search_label_text_row2',
				'next'   => true
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_label_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_fontstyle',
				'label'         => esc_html__('Font Style', 'gotravel'),
				'options'       => gotravel_mikado_get_font_style_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_fontweight',
				'label'         => esc_html__('Font Weight', 'gotravel'),
				'options'       => gotravel_mikado_get_font_weight_array()
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'textsimple',
				'name'          => 'search_label_text_letterspacing',
				'label'         => esc_html__('Letter Spacing', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_icon_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Icon', 'gotravel'),
				'description' => esc_html__('Define style for search icon', 'gotravel'),
				'name'        => 'search_icon_group'
			)
		);

		$search_icon_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_icon_group,
				'name'   => 'search_icon_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_color',
				'label'         => esc_html__('Icon Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_hover_color',
				'label'         => esc_html__('Icon Hover Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_size',
				'label'         => esc_html__('Icon Size', 'gotravel'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_bottom_border_group = gotravel_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Bottom Border', 'gotravel'),
				'description' => esc_html__('Define style for Search text input bottom border (for Fullscreen search type)', 'gotravel'),
				'name'        => 'search_bottom_border_group'
			)
		);

		$search_bottom_border_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $search_bottom_border_group,
				'name'   => 'search_icon_row'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_bottom_border_row,
				'type'          => 'colorsimple',
				'name'          => 'search_border_color',
				'label'         => esc_html__('Border Color', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $search_bottom_border_row,
				'type'          => 'colorsimple',
				'name'          => 'search_border_focus_color',
				'label'         => esc_html__('Border Focus Color', 'gotravel')
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_search_options_map', 6);
}