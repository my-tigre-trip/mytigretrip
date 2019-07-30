<?php

if(!function_exists('gotravel_mikado_map_audio_post_meta_box')) {
	/**
	 * Maps audio meta box
	 */
	function gotravel_mikado_map_audio_post_meta_box() {
		$audio_post_format_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => esc_html__('Audio Post Format', 'gotravel'),
				'name'  => 'post_format_audio_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__('Link', 'gotravel'),
				'description' => esc_html__('Enter audion link', 'gotravel'),
				'parent'      => $audio_post_format_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_audio_post_meta_box');
}