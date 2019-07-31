<?php

if(!function_exists('gotravel_mikado_map_video_post_meta_box')) {
	/**
	 * Maps video post meta box
	 */
	function gotravel_mikado_map_video_post_meta_box() {
		$video_post_format_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('post'),
				'title' => esc_html__('Video Post Format', 'gotravel'),
				'name'  => 'post_format_video_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__('Video Type', 'gotravel'),
				'description'   => esc_html__('Choose video type', 'gotravel'),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'youtube',
				'options'       => array(
					'youtube' => esc_html__('Youtube', 'gotravel'),
					'vimeo'   => esc_html__('Vimeo', 'gotravel'),
					'self'    => esc_html__('Self Hosted', 'gotravel')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'youtube' => '#mkdf_mkdf_video_self_hosted_container',
						'vimeo'   => '#mkdf_mkdf_video_self_hosted_container',
						'self'    => '#mkdf_mkdf_video_embedded_container'
					),
					'show'       => array(
						'youtube' => '#mkdf_mkdf_video_embedded_container',
						'vimeo'   => '#mkdf_mkdf_video_embedded_container',
						'self'    => '#mkdf_mkdf_video_self_hosted_container'
					)
				)
			)
		);

		$mkdf_video_embedded_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_embedded_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_value'    => 'self'
			)
		);

		$mkdf_video_self_hosted_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_self_hosted_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_values'   => array('youtube', 'vimeo')
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_id_meta',
				'type'        => 'text',
				'label'       => esc_html__('Video ID', 'gotravel'),
				'description' => esc_html__('Enter Video ID', 'gotravel'),
				'parent'      => $mkdf_video_embedded_container,
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__('Video Image', 'gotravel'),
				'description' => esc_html__('Upload video image', 'gotravel'),
				'parent'      => $mkdf_video_self_hosted_container,
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_mp4_link_meta',
				'type'        => 'text',
				'label'       => esc_html__('Video MP4', 'gotravel'),
				'description' => esc_html__('Enter video URL for MP4 format', 'gotravel'),
				'parent'      => $mkdf_video_self_hosted_container,

			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_video_post_meta_box');
}