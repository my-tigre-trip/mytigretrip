<?php

if(!function_exists('gotravel_mikado_footer_options_map')) {
	/**
	 * Add footer options
	 */
	function gotravel_mikado_footer_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__('Footer', 'gotravel'),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = gotravel_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'gotravel'),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'uncovering_footer',
				'default_value' => 'no',
				'label'         => esc_html__('Uncovering Footer', 'gotravel'),
				'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'gotravel'),
				'parent'        => $footer_panel,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__('Footer in Grid', 'gotravel'),
				'description'   => esc_html__('Enabling this option will place Footer content in grid', 'gotravel'),
				'parent'        => $footer_panel,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__('Show Footer Top', 'gotravel'),
				'description'   => esc_html__('Enabling this option will show Footer Top area', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_top_container'
				),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_top_container = gotravel_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'default_value' => '4',
				'label'         => esc_html__('Footer Top Columns', 'gotravel'),
				'description'   => esc_html__('Choose number of columns for Footer Top area', 'gotravel'),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'5' => '3(25%+25%+50%)',
					'6' => '3(50%+25%+25%)',
					'4' => '4'
				),
				'parent'        => $show_footer_top_container,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => '',
				'label'         => esc_html__('Footer Top Columns Alignment', 'gotravel'),
				'description'   => esc_html__('Text Alignment in Footer Columns', 'gotravel'),
				'options'       => array(
					'left'   => esc_html__('Left', 'gotravel'),
					'center' => esc_html__('Center', 'gotravel'),
					'right'  => esc_html__('Right', 'gotravel')
				),
				'parent'        => $show_footer_top_container,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__('Show Footer Bottom', 'gotravel'),
				'description'   => esc_html__('Enabling this option will show Footer Bottom area', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_bottom_container'
				),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = gotravel_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);


		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '3',
				'label'         => esc_html__('Footer Bottom Columns', 'gotravel'),
				'description'   => esc_html__('Choose number of columns for Footer Bottom area', 'gotravel'),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_footer_options_map', 10);
}