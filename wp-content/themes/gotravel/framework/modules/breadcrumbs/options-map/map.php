<?php

if(!function_exists('gotravel_mikado_breadcrumbs_map')) {
	function gotravel_mikado_breadcrumbs_map() {
		gotravel_mikado_add_admin_page(array(
			'slug'  => '_breadcrumbs_page',
			'title' => esc_html__('Breadcrumbs', 'gotravel'),
			'icon'  => 'fa fa-angle-right'
		));

		$panel_breadcrumbs = gotravel_mikado_add_admin_panel(array(
			'page'  => '_breadcrumbs_page',
			'name'  => 'panel_breadcrumbs',
			'title' => esc_html__('Breadcrumbs Settings', 'gotravel')
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'show_breadcrumbs_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Show Breadcrumbs Area', 'gotravel'),
				'description'   => esc_html__('This option will enable/disable Breadcrumbs Area', 'gotravel'),
				'parent'        => $panel_breadcrumbs,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_breadcrumbs_area_container'
				)
			)
		);

		$show_breadcrumbs_area_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_breadcrumbs,
				'name'            => 'show_breadcrumbs_area_container',
				'hidden_property' => 'show_breadcrumbs_area',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_area_height',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Breadcrumbs Area Height', 'gotravel'),
				'description'   => esc_html__('Choose height for breadcrumbs area', 'gotravel'),
				'parent'        => $show_breadcrumbs_area_container,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_area_background_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => esc_html__('Breadcrumbs Area Background Color', 'gotravel'),
				'description'   => esc_html__('Choose background color for breadcrumbs area', 'gotravel'),
				'parent'        => $show_breadcrumbs_area_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_text_size',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Breadcrumbs Text Size', 'gotravel'),
				'description'   => esc_html__('Choose breadcrumbs text size', 'gotravel'),
				'options'       => array(
					''       => esc_html__('Default', 'gotravel'),
					'medium' => esc_html__('Medium', 'gotravel')
				),
				'parent'        => $show_breadcrumbs_area_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_text_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => esc_html__('Breadcrumbs Area Text Color', 'gotravel'),
				'description'   => esc_html__('Choose breadcrumbs area text color', 'gotravel'),
				'parent'        => $show_breadcrumbs_area_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'breadcrumbs_enable_share',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Enable Social Share in Breadcrumbs?', 'gotravel'),
				'description'   => esc_html__('Enable / disable social share links in breadcrumbs area', 'gotravel'),
				'parent'        => $show_breadcrumbs_area_container
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_breadcrumbs_map', 8);
}