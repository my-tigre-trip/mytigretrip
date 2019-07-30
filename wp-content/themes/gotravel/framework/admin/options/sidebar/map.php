<?php

if(!function_exists('gotravel_mikado_sidebar_options_map')) {

	function gotravel_mikado_sidebar_options_map() {

		$panel_widgets = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_widgets',
				'title' => esc_html__('Widgets', 'gotravel')
			)
		);

		/**
		 * Navigation style
		 */
		gotravel_mikado_add_admin_field(array(
			'type'          => 'color',
			'name'          => 'sidebar_background_color',
			'label'         => esc_html__('Sidebar Background Color', 'gotravel'),
			'description'   => esc_html__('Choose background color for sidebar', 'gotravel'),
			'parent'        => $panel_widgets
		));

		$group_sidebar_padding = gotravel_mikado_add_admin_group(array(
			'name'   => 'group_sidebar_padding',
			'title'  => esc_html__('Padding', 'gotravel'),
			'parent' => $panel_widgets
		));

		$row_sidebar_padding = gotravel_mikado_add_admin_row(array(
			'name'   => 'row_sidebar_padding',
			'parent' => $group_sidebar_padding
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'sidebar_padding_top',
			'default_value' => '',
			'label'         => esc_html__('Top Padding', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_sidebar_padding
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'sidebar_padding_right',
			'default_value' => '',
			'label'         => esc_html__('Right Padding', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_sidebar_padding
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'sidebar_padding_bottom',
			'default_value' => '',
			'label'         => esc_html__('Bottom Padding', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_sidebar_padding
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'sidebar_padding_left',
			'default_value' => '',
			'label'         => esc_html__('Left Padding', 'gotravel'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_sidebar_padding
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'select',
			'name'          => 'sidebar_alignment',
			'default_value' => '',
			'label'         => esc_html__('Text Alignment', 'gotravel'),
			'description'   => esc_html__('Choose text aligment', 'gotravel'),
			'options'       => array(
				'left'   => esc_html__('Left', 'gotravel'),
				'center' => esc_html__('Center', 'gotravel'),
				'right'  => esc_html__('Right', 'gotravel')
			),
			'parent'        => $panel_widgets
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_sidebar_options_map');
}