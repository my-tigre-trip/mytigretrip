<?php

if(!function_exists('gotravel_mikado_quote_post_meta_box')) {
	/**
	 * Maps quote post meta box
	 */
	function gotravel_mikado_quote_post_meta_box() {
		$quote_post_format_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => esc_html__('Quote Post Format', 'gotravel'),
				'name'  => 'post_format_quote_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__('Quote Text', 'gotravel'),
				'description' => esc_html__('Enter Quote text', 'gotravel'),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_quote_post_meta_box');
}