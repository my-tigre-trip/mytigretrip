<?php

if(!function_exists('gotravel_mikado_map_testimonial_meta_box')) {
	/**
	 * Maps testimonials meta box
	 */
	function gotravel_mikado_map_testimonial_meta_box() {
		$testimonial_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('testimonials'),
				'title' => esc_html__('Testimonial', 'gotravel'),
				'name'  => 'testimonial_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__('Title', 'gotravel'),
				'description' => esc_html__('Enter testimonial title', 'gotravel'),
				'parent'      => $testimonial_meta_box,
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__('Author', 'gotravel'),
				'description' => esc_html__('Enter author name', 'gotravel'),
				'parent'      => $testimonial_meta_box,
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__('Job Position', 'gotravel'),
				'description' => esc_html__('Enter job position', 'gotravel'),
				'parent'      => $testimonial_meta_box,
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__('Text', 'gotravel'),
				'description' => esc_html__('Enter testimonial text', 'gotravel'),
				'parent'      => $testimonial_meta_box,
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_testimonial_meta_box');
}