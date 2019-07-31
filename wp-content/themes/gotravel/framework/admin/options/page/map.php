<?php

if(!function_exists('gotravel_mikado_page_options_map')) {

	function gotravel_mikado_page_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_page_page',
				'title' => esc_html__('Page', 'gotravel'),
				'icon'  => 'fa fa-institution'
			)
		);
		
		/***************** Page Layout - begin **********************/
		
		$panel_page = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_page',
				'title' => esc_html__('Page Style', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(array(
			'type'          => 'text',
			'name'          => 'page_padding',
			'default_value' => '',
			'label'         => esc_html__('Page Padding', 'gotravel'),
			'description'   => esc_html__('Insert page padding for content area in format top right bottom left. Default value is 64px 0 64px 0', 'gotravel'),
			'args'          => array(
				'col_width' => 3
			),
			'parent'        => $panel_page
		));
		
		gotravel_mikado_add_admin_field(array(
			'type'          => 'text',
			'name'          => 'page_padding_mobile',
			'default_value' => '',
			'label'         => esc_html__('Page Content Padding for Smaller Screens', 'gotravel'),
			'description'   => esc_html__('Enter page padding for content area when Mobile Header is active. Default value is 64px 0 64px 0', 'gotravel'),
			'args'          => array(
				'col_width' => 3
			),
			'parent'        => $panel_page
		));
		
		gotravel_mikado_add_admin_field(array(
			'name'        => 'page_show_comments',
			'type'        => 'yesno',
			'label'       => esc_html__('Show Comments', 'gotravel'),
			'description' => esc_html__('Enabling this option will show comments on your page', 'gotravel'),
			'default_value' => 'yes',
			'parent'      => $panel_page
		));
		
		/***************** Page Layout - end **********************/

		$custom_sidebars = gotravel_mikado_get_custom_sidebars();

		$panel_sidebar = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_sidebar',
				'title' => esc_html__('Design Style', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'page_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'gotravel'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'gotravel'),
			'default_value' => 'default',
			'parent'        => $panel_sidebar,
			'options'       => array(
				'default'          => esc_html__('No Sidebar', 'gotravel'),
				'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'gotravel'),
				'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'gotravel'),
				'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'gotravel'),
				'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'gotravel')
			)
		));
		
		if(count($custom_sidebars) > 0) {
			gotravel_mikado_add_admin_field(array(
				'name'        => 'page_custom_sidebar',
				'type'        => 'selectblank',
				'label'       => esc_html__('Sidebar to Display', 'gotravel'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'gotravel'),
				'parent'      => $panel_sidebar,
				'options'     => $custom_sidebars
			));
		}
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_page_options_map', 9);
}