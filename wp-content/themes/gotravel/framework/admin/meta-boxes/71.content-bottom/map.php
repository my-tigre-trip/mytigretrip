<?php

if(!function_exists('gotravel_mikado_map_content_bottom_meta_box')) {
	/**
	 * Maps content bottom meta box
	 */
	function gotravel_mikado_map_content_bottom_meta_box() {
		$content_bottom_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => esc_html__('Content Bottom', 'gotravel'),
				'name'  => 'content_bottom_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_enable_content_bottom_area_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__('Enable Content Bottom Area', 'gotravel'),
				'description'   => esc_html__('This option will enable Content Bottom area on pages', 'gotravel'),
				'parent'        => $content_bottom_meta_box,
				'options'       => array(
					'no'  => esc_html__('No', 'gotravel'),
					'yes' => esc_html__('Yes', 'gotravel')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#mkdf_mkdf_show_content_bottom_meta_container',
						'no' => '#mkdf_mkdf_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#mkdf_mkdf_show_content_bottom_meta_container'
					)
				)
			)
		);

		$show_content_bottom_meta_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'mkdf_show_content_bottom_meta_container',
				'hidden_property' => 'mkdf_enable_content_bottom_area_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('', 'no')
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__('Sidebar to Display', 'gotravel'),
				'description'   => esc_html__('Choose a Content Bottom sidebar to display', 'gotravel'),
				'options'       => gotravel_mikado_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'mkdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__('Display in Grid', 'gotravel'),
				'description'   => esc_html__('Enabling this option will place Content Bottom in grid', 'gotravel'),
				'options'       => array(
					'no'  => esc_html__('No', 'gotravel'),
					'yes' => esc_html__('Yes', 'gotravel')
				),
				'parent'        => $show_content_bottom_meta_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'type'          => 'color',
				'name'          => 'mkdf_content_bottom_background_color_meta',
				'label'         => esc_html__('Background Color', 'gotravel'),
				'description'   => esc_html__('Choose a background color for Content Bottom area', 'gotravel'),
				'parent'        => $show_content_bottom_meta_container
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_content_bottom_meta_box');
}