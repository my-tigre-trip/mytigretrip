<?php

if(!function_exists('gotravel_mikado_link_post_meta_box')) {
	/**
	 * Maps link post meta box
	 */
	function gotravel_mikado_link_post_meta_box() {
		$link_post_format_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => esc_html__('Link Post Format', 'gotravel'),
				'name'  => 'post_format_link_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__('Link', 'gotravel'),
				'description' => esc_html__('Enter link', 'gotravel'),
				'parent'      => $link_post_format_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_link_post_meta_box');
}