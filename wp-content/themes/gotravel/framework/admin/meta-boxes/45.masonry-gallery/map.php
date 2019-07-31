<?php

$masonry_gallery_meta_box = gotravel_mikado_add_meta_box(
	array(
		'scope' => array('masonry-gallery'),
		'title' => esc_html__('Masonry Gallery General', 'gotravel'),
		'name' => 'masonry_gallery_meta'
	)
);


	gotravel_mikado_add_meta_box_field(
		array(
			'name' => 'mkdf_masonry_gallery_item_title_tag',
			'type' => 'select',
			'default_value' => 'h4',
			'label' => esc_html__('Title Tag', 'gotravel'),
			'parent' => $masonry_gallery_meta_box,
			'options' => gotravel_mikado_get_title_tag()
		)
	);
	
	gotravel_mikado_add_meta_box_field(
		array(
			'name' => 'mkdf_masonry_gallery_item_text',
			'type' => 'text',
			'label' => esc_html__('Text', 'gotravel'),
			'parent' => $masonry_gallery_meta_box
		)
	);

	gotravel_mikado_add_meta_box_field(
		array(
			'name' => 'mkdf_masonry_gallery_item_additional_text',
			'type' => 'text',
			'label' => esc_html__('Additional Text', 'gotravel'),
			'parent' => $masonry_gallery_meta_box
		)
	);

	gotravel_mikado_add_meta_box_field(
		array(
			'name' => 'mkdf_masonry_gallery_item_link',
			'type' => 'text',
			'label' => esc_html__('Link', 'gotravel'),
			'parent' => $masonry_gallery_meta_box
		)
	);
	
	gotravel_mikado_add_meta_box_field(
		array(
			'name' => 'mkdf_masonry_gallery_item_link_target',
			'type' => 'select',
			'default_value' => '_self',
			'label' => esc_html__('Link Target', 'gotravel'),
			'parent' => $masonry_gallery_meta_box,
			'options' => array(
				'_self' => esc_html__('Same Window', 'gotravel'),
				'_blank' => esc_html__('New Window', 'gotravel')
			)
		)
	);

	gotravel_mikado_add_admin_section_title(array(
		'name'   => 'mkdf_section_style_title',
		'parent' => $masonry_gallery_meta_box,
		'title'  => esc_html__('Masonry Gallery Item Style', 'gotravel')
	));

		gotravel_mikado_add_meta_box_field(
			array(
				'name' => 'mkdf_masonry_gallery_item_size',
				'type' => 'select',
				'default_value' => 'square-small',
				'label' => esc_html__('Size', 'gotravel'),
				'parent' => $masonry_gallery_meta_box,
				'options' => array(
					'square-small'			=> esc_html__('Square Small', 'gotravel'),
					'square-big'			=> esc_html__('Square Big', 'gotravel'),
					'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'gotravel'),
					'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'gotravel')
				)
			)
		);
		
		gotravel_mikado_add_meta_box_field(
			array(
				'name' => 'mkdf_masonry_gallery_item_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => esc_html__('Type', 'gotravel'),
				'parent' => $masonry_gallery_meta_box,
				'options' => array(
					'standard'		=> esc_html__('Standard', 'gotravel'),
					'with-button'	=> esc_html__('With Button', 'gotravel'),
					'simple'		=> esc_html__('Simple', 'gotravel')
				),
				'args' => array(
					'dependence' => true,
					'hide' => array(
						'with-button' => '#mkdf_masonry_gallery_item_simple_type_container',
						'simple' => '#mkdf_masonry_gallery_item_button_type_container',
						'standard' => '#mkdf_masonry_gallery_item_button_type_container, #mkdf_masonry_gallery_item_simple_type_container'
					),
					'show' => array(
						'with-button' => '#mkdf_masonry_gallery_item_button_type_container',
						'simple' => '#mkdf_masonry_gallery_item_simple_type_container',
						'standard' => ''
					)
				)
			)
		);

			$masonry_gallery_item_button_type_container = gotravel_mikado_add_admin_container_no_style(array(
				'name'				=> 'masonry_gallery_item_button_type_container',
				'parent'			=> $masonry_gallery_meta_box,
				'hidden_property'	=> 'mkdf_masonry_gallery_item_type',
				'hidden_values'		=> array('standard', 'simple')
			));

				gotravel_mikado_add_meta_box_field(
					array(
						'name' => 'mkdf_masonry_gallery_button_label',
						'type' => 'text',
						'label' => esc_html__('Button Label', 'gotravel'),
						'parent' => $masonry_gallery_item_button_type_container
					)
				);

			$masonry_gallery_item_simple_type_container = gotravel_mikado_add_admin_container_no_style(array(
				'name'				=> 'masonry_gallery_item_simple_type_container',
				'parent'			=> $masonry_gallery_meta_box,
				'hidden_property'	=> 'mkdf_masonry_gallery_item_type',
				'hidden_values'		=> array('standard', 'with-button')
			));
			
				gotravel_mikado_add_meta_box_field(
					array(
						'name' => 'mkdf_masonry_gallery_simple_content_background_skin',
						'type' => 'select',
						'default_value' => '',
						'label' => esc_html__('Content Background Skin', 'gotravel'),
						'parent' => $masonry_gallery_item_simple_type_container,
						'options' => array(
							'default' => esc_html__('Default', 'gotravel'),
							'light'	=> esc_html__('Light', 'gotravel'),
							'dark'	=> esc_html__('Dark', 'gotravel')
						)
					)
				);