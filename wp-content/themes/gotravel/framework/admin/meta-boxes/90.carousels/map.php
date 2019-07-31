<?php

if(!function_exists('gotravel_mikado_map_carousel_meta_box')) {
	/**
	 * Maps carousel meta box
	 */
	function gotravel_mikado_map_carousel_meta_box() {
		$carousel_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('carousels'),
				'title' => esc_html__('Carousel', 'gotravel'),
				'name'  => 'carousel_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_image',
				'type'        => 'image',
				'label'       => esc_html__('Carousel Image', 'gotravel'),
				'description' => esc_html__('Choose carousel image (min width needs to be 215px)', 'gotravel'),
				'parent'      => $carousel_meta_box
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_hover_image',
				'type'        => 'image',
				'label'       => esc_html__('Carousel Hover Image', 'gotravel'),
				'description' => esc_html__('Choose carousel hover image (min width needs to be 215px)', 'gotravel'),
				'parent'      => $carousel_meta_box
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_title',
				'type'        => 'text',
				'label'       => esc_html__('Title', 'gotravel'),
				'description' => esc_html__('Enter the title for your carousel', 'gotravel'),
				'parent'      => $carousel_meta_box
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_text',
				'type'        => 'text',
				'label'       => esc_html__('Text', 'gotravel'),
				'description' => esc_html__('Enter the text for your carousel', 'gotravel'),
				'parent'      => $carousel_meta_box
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_link',
				'type'        => 'text',
				'label'       => esc_html__('Link', 'gotravel'),
				'description' => esc_html__('Enter the URL to which you want the image to link to', 'gotravel'),
				'parent'      => $carousel_meta_box
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_carousel_item_target',
				'type'        => 'selectblank',
				'label'       => esc_html__('Target', 'gotravel'),
				'description' => esc_html__('Specify where to open the linked document', 'gotravel'),
				'parent'      => $carousel_meta_box,
				'options'     => array(
					'_self'  => esc_html__('Same Window', 'gotravel'),
					'_blank' => esc_html__('New Window', 'gotravel')
				)
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_carousel_meta_box');
}