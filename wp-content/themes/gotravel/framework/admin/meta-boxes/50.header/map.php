<?php

if(!function_exists('gotravel_mikado_map_header_meta_box')) {
	/**
	 * Maps header meta box
	 */
	function gotravel_mikado_map_header_meta_box() {
		$header_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => esc_html__('Header', 'gotravel'),
				'name'  => 'header_meta'
			)
		);
		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Header Skin', 'gotravel'),
				'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'gotravel'),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__('Default', 'gotravel'),
					'light-header' => esc_html__('Light', 'gotravel'),
					'dark-header'  => esc_html__('Dark', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'parent'        => $header_meta_box,
				'type'          => 'select',
				'name'          => 'mkdf_enable_header_style_on_scroll_meta',
				'default_value' => '',
				'label'         => esc_html__('Enable Header Style on Scroll', 'gotravel'),
				'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'gotravel'),
				'options'       => array(
					''    => esc_html__('Default', 'gotravel'),
					'no'  => esc_html__('No', 'gotravel'),
					'yes' => esc_html__('Yes', 'gotravel')
				)
			)
		);

		$sticky_amount_container = gotravel_mikado_add_admin_container_no_style(array(
			'name'            => 'sticky_amount_container',
			'parent'          => $header_meta_box,
			'hidden_property' => 'header_behaviour',
			'hidden_values'   => array('sticky-header-on-scroll-up', 'fixed-on-scroll')
		));

		$sticky_amount_group = gotravel_mikado_add_admin_group(array(
			'name'        => 'sticky_amount_group',
			'title'       => esc_html__('Scroll Amount for Sticky Header Appearance', 'gotravel'),
			'parent'      => $sticky_amount_container,
			'description' => esc_html__('Enter the amount of pixels for sticky header appearance, or set browser height to "Yes" for predefined sticky header appearance amount', 'gotravel')
		));

		$sticky_amount_row = gotravel_mikado_add_admin_row(array(
			'name'   => 'sticky_amount_group',
			'parent' => $sticky_amount_group
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'   => 'mkdf_scroll_amount_for_sticky_meta',
				'type'   => 'textsimple',
				'label'  => esc_html__('Amount in px', 'gotravel'),
				'parent' => $sticky_amount_row,
				'args'   => array(
					'suffix' => 'px'
				)
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_scroll_amount_for_sticky_fullscreen_meta',
				'type'          => 'yesnosimple',
				'label'         => esc_html__('Browser Height', 'gotravel'),
				'default_value' => 'no',
				'parent'        => $sticky_amount_row
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_header_meta_box');
}