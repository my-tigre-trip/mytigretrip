<?php

if(!function_exists('gotravel_mikado_title_options_map')) {

	function gotravel_mikado_title_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_title_page',
				'title' => esc_html__('Title', 'gotravel'),
				'icon'  => 'fa fa-list-alt'
			)
		);

		$panel_title = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title',
				'title' => esc_html__('Title Settings', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'show_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Show Title Area', 'gotravel'),
				'description'   => esc_html__('This option will enable/disable Title Area', 'gotravel'),
				'parent'        => $panel_title,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_show_title_area_container"
				)
			)
		);

		$show_title_area_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_title,
				'name'            => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'hide_title_text',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Hide Title Text', 'gotravel'),
				'description'   => esc_html__('This option will enable/disable Title Text', 'gotravel'),
				'parent'        => $panel_title,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#mkdf_show_title_text_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$show_title_text_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_title,
				'name'            => 'show_title_text_container',
				'hidden_property' => 'hide_title_text',
				'hidden_value'    => 'yes'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'title_area_animation',
				'type'          => 'select',
				'default_value' => 'no',
				'label'         => esc_html__('Animations', 'gotravel'),
				'description'   => esc_html__('Choose an animation for Title Area', 'gotravel'),
				'parent'        => $show_title_text_container,
				'options'       => array(
					'no'         => esc_html__('No Animation', 'gotravel'),
					'right-left' => esc_html__('Text right to left', 'gotravel'),
					'left-right' => esc_html__('Text left to right', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'title_area_vertial_alignment',
				'type'          => 'select',
				'default_value' => 'header_bottom',
				'label'         => esc_html__('Vertical Alignment', 'gotravel'),
				'description'   => esc_html__('Specify title vertical alignment', 'gotravel'),
				'parent'        => $show_title_text_container,
				'options'       => array(
					'header_bottom' => esc_html__('From Bottom of Header', 'gotravel'),
					'window_top'    => esc_html__('From Window Top', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'title_area_content_alignment',
				'type'          => 'select',
				'default_value' => 'center',
				'label'         => esc_html__('Horizontal Alignment', 'gotravel'),
				'description'   => esc_html__('Specify title horizontal alignment', 'gotravel'),
				'parent'        => $show_title_text_container,
				'options'       => array(
					'left'   => esc_html__('Left', 'gotravel'),
					'center' => esc_html__('Center', 'gotravel'),
					'right'  => esc_html__('Right', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'title_text_size',
			'type'          => 'select',
			'default_value' => 'medium',
			'label'         => esc_html__('Choose Title Text Size', 'gotravel'),
			'description'   => esc_html__('Choose predefined size for title text', 'gotravel'),
			'parent'        => $show_title_text_container,
			'options'       => array(
				''       => esc_html__('Default', 'gotravel'),
				'medium' => esc_html__('Medium', 'gotravel'),
				'large'  => esc_html__('Large', 'gotravel')
			)
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'title_area_background_color',
				'type'        => 'color',
				'label'       => esc_html__('Background Color', 'gotravel'),
				'description' => esc_html__('Choose a background color for Title Area', 'gotravel'),
				'parent'      => $show_title_area_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'        => 'title_area_background_image',
				'type'        => 'image',
				'label'       => esc_html__('Background Image', 'gotravel'),
				'description' => esc_html__('Choose an Image for Title Area', 'gotravel'),
				'parent'      => $show_title_area_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'title_area_background_image_responsive',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Background Responsive Image', 'gotravel'),
				'description'   => esc_html__('Enabling this option will make Title background image responsive', 'gotravel'),
				'parent'        => $show_title_area_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#mkdf_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $show_title_area_container,
				'name'            => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value'    => 'yes'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'title_area_background_image_parallax',
				'type'          => 'select',
				'default_value' => 'no',
				'label'         => esc_html__('Background Image in Parallax', 'gotravel'),
				'description'   => esc_html__('Enabling this option will make Title background image parallax', 'gotravel'),
				'parent'        => $title_area_background_image_responsive_container,
				'options'       => array(
					'no'       => esc_html__('No', 'gotravel'),
					'yes'      => esc_html__('Yes', 'gotravel'),
					'yes_zoom' => esc_html__('Yes, with zoom out', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'        => 'title_area_height',
			'type'        => 'text',
			'label'       => esc_html__('Height', 'gotravel'),
			'description' => esc_html__('Set a height for Title Area', 'gotravel'),
			'parent'      => $title_area_background_image_responsive_container,
			'args'        => array(
				'col_width' => 2,
				'suffix'    => 'px'
			)
		));
		
		$panel_typography = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title_typography',
				'title' => esc_html__('Typography', 'gotravel')
			)
		);

		$group_page_title_styles = gotravel_mikado_add_admin_group(array(
			'name'        => 'group_page_title_styles',
			'title'       => esc_html__('Title', 'gotravel'),
			'description' => esc_html__('Define styles for page title', 'gotravel'),
			'parent'      => $panel_typography
		));

		$row_page_title_styles_1 = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_page_title_styles_1',
			'parent' => $group_page_title_styles
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'page_title_color',
			'label'         => esc_html__('Text Color', 'gotravel'),
			'parent'        => $row_page_title_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_title_fontsize',
			'label'         => esc_html__('Font Size', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_title_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_title_lineheight',
			'label'         => esc_html__('Line Height', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_title_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_title_texttransform',
			'label'         => esc_html__('Text Transform', 'gotravel'),
			'options'       => gotravel_mikado_get_text_transform_array(),
			'parent'        => $row_page_title_styles_1
		));

		$row_page_title_styles_2 = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_page_title_styles_2',
			'parent' => $group_page_title_styles,
			'next'   => true
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'fontsimple',
			'name'          => 'page_title_google_fonts',
			'default_value' => '-1',
			'label'         => esc_html__('Font Family', 'gotravel'),
			'parent'        => $row_page_title_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_title_fontstyle',
			'label'         => esc_html__('Font Style', 'gotravel'),
			'options'       => gotravel_mikado_get_font_style_array(),
			'parent'        => $row_page_title_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_title_fontweight',
			'label'         => esc_html__('Font Weight', 'gotravel'),
			'options'       => gotravel_mikado_get_font_weight_array(),
			'parent'        => $row_page_title_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_title_letter_spacing',
			'label'         => esc_html__('Letter Spacing', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_title_styles_2
		));

		$group_page_subtitle_styles = gotravel_mikado_add_admin_group(array(
			'name'        => 'group_page_subtitle_styles',
			'title'       => esc_html__('Subtitle', 'gotravel'),
			'description' => esc_html__('Define styles for page subtitle', 'gotravel'),
			'parent'      => $panel_typography
		));

		$row_page_subtitle_styles_1 = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_page_subtitle_styles_1',
			'parent' => $group_page_subtitle_styles
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'page_subtitle_color',
			'label'         => esc_html__('Text Color', 'gotravel'),
			'parent'        => $row_page_subtitle_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_subtitle_fontsize',
			'label'         => esc_html__('Font Size', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_subtitle_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_subtitle_lineheight',
			'label'         => esc_html__('Line Height', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_subtitle_styles_1
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_subtitle_texttransform',
			'label'         => esc_html__('Text Transform', 'gotravel'),
			'options'       => gotravel_mikado_get_text_transform_array(),
			'parent'        => $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_page_subtitle_styles_2',
			'parent' => $group_page_subtitle_styles,
			'next'   => true
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'fontsimple',
			'name'          => 'page_subtitle_google_fonts',
			'default_value' => '-1',
			'label'         => esc_html__('Font Family', 'gotravel'),
			'parent'        => $row_page_subtitle_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_subtitle_fontstyle',
			'label'         => esc_html__('Font Style', 'gotravel'),
			'options'       => gotravel_mikado_get_font_style_array(),
			'parent'        => $row_page_subtitle_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'page_subtitle_fontweight',
			'label'         => esc_html__('Font Weight', 'gotravel'),
			'options'       => gotravel_mikado_get_font_weight_array(),
			'parent'        => $row_page_subtitle_styles_2
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'page_subtitle_letter_spacing',
			'label'         => esc_html__('Letter Spacing', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_page_subtitle_styles_2
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_title_options_map', 7);
}