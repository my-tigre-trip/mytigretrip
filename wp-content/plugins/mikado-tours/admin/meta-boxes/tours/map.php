<?php
if(!function_exists('mkdf_tours_info_section_map')) {

	function mkdf_tours_info_section_map() {
		$destinations = mkdf_tours_get_destinations(true);

		$info_section_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Info Section', 'mikado-tours'),
				'name'  => 'tours_info_section_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_info_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Info Section', 'mikado-tours'),
				'parent'        => $info_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_info_section_container',
				)
			)
		);

		$info_section_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'info_section_container',
			'parent'          => $info_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_info_section',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Price', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_discount_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Discount Price', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_duration',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Duration', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_destination',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Destination', 'mikado-tours'),
				'options'       => $destinations,
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_label',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Custom Label', 'mikado-tours'),
				'description'   => esc_html__('Define custom label which will show on tour lists and tour single pages', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_label_skin',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Custom Label Skin', 'mikado-tours'),
				'options'       => array(
					''      => esc_html__('Default', 'mikado-tours'),
					'skin1' => esc_html__('Skin 1', 'mikado-tours'),
					'skin2' => esc_html__('Skin 2', 'mikado-tours'),
					'skin3' => esc_html__('Skin 3', 'mikado-tours')
				),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_info_min_years',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Minimum Years Required', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Departure/Return Location', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Departure Time', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_return_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Return Time', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_dress_code',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Dress Code', 'mikado-tours'),
				'parent'        => $info_section_container
			)
		);

		$tour_attributes = mkdf_tours_get_tour_attributes();

		if(is_array($tour_attributes) && count($tour_attributes)) {
			gotravel_mikado_add_meta_box_field(array(
				'name'          => 'mkdf_tours_attributes',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__('Attributes', 'mikado-tours'),
				'description'   => esc_html__('Define tour attributes', 'mikado-tours'),
				'parent'        => $info_section_container,
				'options'       => $tour_attributes
			));
		}
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_info_section_map');
}

if(!function_exists('mkdf_tours_tour_plan_section_map')) {

	function mkdf_tours_tour_plan_section_map() {

		$tour_plan_section_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Tour Plan', 'mikado-tours'),
				'name'  => 'tours_plan_section_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_tour_plan_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Tour Plan Section', 'mikado-tours'),
				'parent'        => $tour_plan_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_tour_plan_section_container',
				)
			)
		);

		$tour_plan_section_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'tour_plan_section_container',
			'parent'          => $tour_plan_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_tour_plan_section',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_repeater_field(array(
				'name'        => 'mkdf_tour_plan_repeater',
				'parent'      => $tour_plan_section_container,
				'button_text' => esc_html__('Add new Tour Plan Section', 'mikado-tours'),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'mkdf_tour_plan_section_title',
						'label'       => esc_html__('Tour Plan Section Title', 'mikado-tours'),
						'description' => esc_html__('Description', 'mikado-tours')
					),
					array(
						'type'        => 'textareahtml',
						'name'        => 'mkdf_tour_plan_section_description',
						'label'       => esc_html__('Tour Plan Section Description', 'mikado-tours'),
						'description' => esc_html__('Description field', 'mikado-tours')
					)
				)
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_tour_plan_section_map');
}

if(!function_exists('mkdf_tours_location_section_map')) {

	function mkdf_tours_location_section_map() {

		$location_section_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Location Section', 'mikado-tours'),
				'name'  => 'location_section_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_location_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Location Section', 'mikado-tours'),
				'parent'        => $location_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_location_section_container',
				)
			)
		);

		$location_section_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'location_section_container',
			'parent'          => $location_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_location_section',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Location Excerpt', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address1',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 1', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address2',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 2', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address3',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 3', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address4',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 4', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address5',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 5', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Location Content', 'mikado-tours'),
				'parent'        => $location_section_container
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_location_section_map');
}

if(!function_exists('mkdf_tours_gallery_section_map')) {

	function mkdf_tours_gallery_section_map() {

		$gallery_section_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Gallery Section', 'mikado-tours'),
				'name'  => 'gallery_section_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_gallery_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Gallery Section', 'mikado-tours'),
				'parent'        => $gallery_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_gallery_section_container',
				)
			)
		);

		$gallery_section_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'gallery_section_container',
			'parent'          => $gallery_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_gallery_section',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_gallery_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Excerpt', 'mikado-tours'),
				'parent'        => $gallery_section_container
			)
		);

		gotravel_mikado_add_multiple_images_field(
			array(
				'parent'      => $gallery_section_container,
				'name'        => 'mkdf_tours_gallery_images',
				'label'       => esc_html__('Gallery Images', 'mikado-tours'),
				'description' => esc_html__('Choose your gallery images', 'mikado-tours')
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_gallery_section_map');
}

if(!function_exists('mkdf_tours_review_section_map')) {

	function mkdf_tours_review_section_map() {

		$review_section_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Review Section', 'mikado-tours'),
				'name'  => 'review_section_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_review_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Review Section', 'mikado-tours'),
				'parent'        => $review_section_meta_box,
				'default_value' => 'yes'
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_review_section_map');
}

if(!function_exists('mkdf_tours_custom_section_1_map')) {

	function mkdf_tours_custom_section_1_map() {

		$custom_section_1_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Custom Section 1', 'mikado-tours'),
				'name'  => 'custom_section_1_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_1',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Custom Section 1', 'mikado-tours'),
				'parent'        => $custom_section_1_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_1_container',
				)
			)
		);

		$custom_section_1_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_1_container',
			'parent'          => $custom_section_1_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_1',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Title', 'mikado-tours'),
				'parent'        => $custom_section_1_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Content', 'mikado-tours'),
				'parent'        => $custom_section_1_container
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_custom_section_1_map');
}

if(!function_exists('mkdf_tours_custom_section_2_map')) {

	function mkdf_tours_custom_section_2_map() {

		$custom_section_2_meta_box = gotravel_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Custom Section 2', 'mikado-tours'),
				'name'  => 'custom_section_2_meta'
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_2',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Custom Section 2', 'mikado-tours'),
				'parent'        => $custom_section_2_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_2_container',
				)
			)
		);

		$custom_section_2_container = gotravel_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_2_container',
			'parent'          => $custom_section_2_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_2',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Title', 'mikado-tours'),
				'parent'        => $custom_section_2_container
			)
		);

		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Content', 'mikado-tours'),
				'parent'        => $custom_section_2_container
			)
		);
	}

	add_action('gotravel_mikado_meta_boxes_map', 'mkdf_tours_custom_section_2_map');
}