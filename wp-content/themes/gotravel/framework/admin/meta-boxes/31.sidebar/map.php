<?php

if(!function_exists('gotravel_mikado_map_sidebar_meta_box')) {
	/**
	 * Maps sidebar meta box
	 */
	function gotravel_mikado_map_sidebar_meta_box() {
		$custom_sidebars = gotravel_mikado_get_custom_sidebars();

		$sidebar_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => esc_html__('Sidebar', 'gotravel'),
				'name'  => 'sidebar_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_meta',
				'type'        => 'select',
				'label'       => esc_html__('Layout', 'gotravel'),
				'description' => esc_html__('Choose the sidebar layout', 'gotravel'),
				'parent'      => $sidebar_meta_box,
				'options'     => array(
					''                 => esc_html__('Default', 'gotravel'),
					'no-sidebar'       => esc_html__('No Sidebar', 'gotravel'),
					'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'gotravel'),
					'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'gotravel'),
					'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'gotravel'),
					'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'gotravel')
				)
			)
		);

		if(count($custom_sidebars) > 0) {
			gotravel_mikado_add_meta_box_field(array(
				'name'        => 'mkdf_custom_sidebar_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__('Choose Widget Area in Sidebar', 'gotravel'),
				'description' => esc_html__('Choose Custom Widget area to display in Sidebar', 'gotravel'),
				'parent'      => $sidebar_meta_box,
				'options'     => $custom_sidebars
			));
		}
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_sidebar_meta_box');
}