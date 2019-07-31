<?php

if(!function_exists('gotravel_mikado_map_footer_meta_box')) {
	/**
	 * Map footer meta box
	 */
	function gotravel_mikado_map_footer_meta_box() {
		$footer_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('page', 'post'),
				'title' => esc_html__('Footer', 'gotravel'),
				'name'  => 'footer_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Disable Footer for this Page', 'gotravel'),
				'description'   => esc_html__('Enabling this option will hide footer on this page', 'gotravel'),
				'parent'        => $footer_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_footer_meta_box');
}