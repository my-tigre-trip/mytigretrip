<?php

if(!function_exists('gotravel_mikado_map_gallery_post_meta_box')) {
	/**
	 * Maps gallery post meta box
	 */
	function gotravel_mikado_map_gallery_post_meta_box() {
		$gallery_post_format_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => esc_html__('Gallery Post Format', 'gotravel'),
				'name'  => 'post_format_gallery_meta'
			)
		);

		gotravel_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__('Gallery Images', 'gotravel'),
				'description' => esc_html__('Choose your gallery images', 'gotravel'),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_gallery_post_meta_box');
}