<?php

if(!function_exists('gotravel_mikado_map_title_meta_box')) {
	/**
	 * Maps title meta box
	 */
	function gotravel_mikado_map_title_meta_box() {
	    $title_meta_box = gotravel_mikado_add_meta_box(
		    array(
			    'scope' => array('page', 'post'),
			    'title' => esc_html__('Title', 'gotravel'),
			    'name'  => 'title_meta'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_show_title_area_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Show Title Area', 'gotravel'),
			    'description'   => esc_html__('Disabling this option will turn off page title area', 'gotravel'),
			    'parent'        => $title_meta_box,
			    'options'       => array(
				    ''    => esc_html__('Default', 'gotravel'),
				    'no'  => esc_html__('No', 'gotravel'),
				    'yes' => esc_html__('Yes', 'gotravel')
			    ),
			    'args'          => array(
				    "dependence" => true,
				    "hide"       => array(
					    ""    => "",
					    "no"  => "#mkdf_mkdf_show_title_area_meta_container",
					    "yes" => ""
				    ),
				    "show"       => array(
					    ""    => "#mkdf_mkdf_show_title_area_meta_container",
					    "no"  => "",
					    "yes" => "#mkdf_mkdf_show_title_area_meta_container"
				    )
			    )
		    )
	    );

	    $show_title_area_meta_container = gotravel_mikado_add_admin_container(
		    array(
			    'parent'          => $title_meta_box,
			    'name'            => 'mkdf_show_title_area_meta_container',
			    'hidden_property' => 'mkdf_show_title_area_meta',
			    'hidden_value'    => 'no'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_hide_title_text_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Hide Title Text', 'gotravel'),
			    'description'   => esc_html__('Enabling this option will turn off page title text', 'gotravel'),
			    'parent'        => $show_title_area_meta_container,
			    'options'       => array(
				    ''    => esc_html__('Default', 'gotravel'),
				    'no'  => esc_html__('No', 'gotravel'),
				    'yes' => esc_html__('Yes', 'gotravel')
			    ),
			    'args'          => array(
				    "dependence" => true,
				    "hide"       => array(
					    ""    => "",
					    "no"  => "",
					    "yes" => "#mkdf_mkdf_show_title_text_meta_container"
				    ),
				    "show"       => array(
					    ""    => "#mkdf_mkdf_show_title_text_meta_container",
					    "no"  => "#mkdf_mkdf_show_title_text_meta_container",
					    "yes" => ""
				    )
			    )
		    )
	    );

	    $show_title_text_meta_container = gotravel_mikado_add_admin_container(
		    array(
			    'parent'          => $show_title_area_meta_container,
			    'name'            => 'mkdf_show_title_text_meta_container',
			    'hidden_property' => 'mkdf_hide_title_text_meta',
			    'hidden_value'    => 'yes'
		    )
	    );

		gotravel_mikado_add_meta_box_field(array(
			'name'        => 'mkdf_title_text_size_meta',
			'type'        => 'select',
			'label'       => esc_html__('Choose Title Text Size', 'gotravel'),
			'description' => esc_html__('Choose predefined size for title text', 'gotravel'),
			'parent'      => $show_title_text_meta_container,
			'options'     => array(
				''       => esc_html__('Default', 'gotravel'),
				'medium' => esc_html__('Medium', 'gotravel'),
				'large'  => esc_html__('Large', 'gotravel')
			)
		));

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_title_area_animation_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Animations', 'gotravel'),
			    'description'   => esc_html__('Choose an animation for Title Area', 'gotravel'),
			    'parent'        => $show_title_text_meta_container,
			    'options'       => array(
				    ''           => esc_html__('Default', 'gotravel'),
				    'no'         => esc_html__('No Animation', 'gotravel'),
				    'right-left' => esc_html__('Text right to left', 'gotravel'),
				    'left-right' => esc_html__('Text left to right', 'gotravel')
			    )
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_title_area_vertial_alignment_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Vertical Alignment', 'gotravel'),
			    'description'   => esc_html__('Specify title vertical alignment', 'gotravel'),
			    'parent'        => $show_title_text_meta_container,
			    'options'       => array(
				    ''              => esc_html__('Default', 'gotravel'),
				    'header_bottom' => esc_html__('From Bottom of Header', 'gotravel'),
				    'window_top'    => esc_html__('From Window Top', 'gotravel')
			    )
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_title_area_content_alignment_meta',
			    'type'          => 'select',
			    'default_value' => 'center',
			    'label'         => esc_html__('Horizontal Alignment', 'gotravel'),
			    'description'   => esc_html__('Specify title horizontal alignment', 'gotravel'),
			    'parent'        => $show_title_text_meta_container,
			    'options'       => array(
				    ''       => esc_html__('Default', 'gotravel'),
				    'left'   => esc_html__('Left', 'gotravel'),
				    'center' => esc_html__('Center', 'gotravel'),
				    'right'  => esc_html__('Right', 'gotravel')
			    )
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_title_text_color_meta',
			    'type'        => 'color',
			    'label'       => esc_html__('Title Color', 'gotravel'),
			    'description' => esc_html__('Choose a color for title text', 'gotravel'),
			    'parent'      => $show_title_text_meta_container
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_title_area_background_color_meta',
			    'type'        => 'color',
			    'label'       => esc_html__('Background Color', 'gotravel'),
			    'description' => esc_html__('Choose a background color for Title Area', 'gotravel'),
			    'parent'      => $show_title_area_meta_container
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_hide_background_image_meta',
			    'type'          => 'yesno',
			    'default_value' => 'no',
			    'label'         => esc_html__('Hide Background Image', 'gotravel'),
			    'description'   => esc_html__('Enable this option to hide background image in Title Area', 'gotravel'),
			    'parent'        => $show_title_area_meta_container,
			    'args'          => array(
				    "dependence"             => true,
				    "dependence_hide_on_yes" => "#mkdf_mkdf_hide_background_image_meta_container",
				    "dependence_show_on_yes" => ""
			    )
		    )
	    );

	    $hide_background_image_meta_container = gotravel_mikado_add_admin_container(
		    array(
			    'parent'          => $show_title_area_meta_container,
			    'name'            => 'mkdf_hide_background_image_meta_container',
			    'hidden_property' => 'mkdf_hide_background_image_meta',
			    'hidden_value'    => 'yes'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_title_area_background_image_meta',
			    'type'        => 'image',
			    'label'       => esc_html__('Background Image', 'gotravel'),
			    'description' => esc_html__('Choose an Image for Title Area', 'gotravel'),
			    'parent'      => $hide_background_image_meta_container
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_title_area_background_image_responsive_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Background Responsive Image', 'gotravel'),
			    'description'   => esc_html__('Enabling this option will make Title background image responsive', 'gotravel'),
			    'parent'        => $hide_background_image_meta_container,
			    'options'       => array(
				    ''    => esc_html__('Default', 'gotravel'),
				    'no'  => esc_html__('No', 'gotravel'),
				    'yes' => esc_html__('Yes', 'gotravel')
			    ),
			    'args'          => array(
				    "dependence" => true,
				    "hide"       => array(
					    ""    => "",
					    "no"  => "",
					    "yes" => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta"
				    ),
				    "show"       => array(
					    ""    => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta",
					    "no"  => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta",
					    "yes" => ""
				    )
			    )
		    )
	    );

	    $title_area_background_image_responsive_meta_container = gotravel_mikado_add_admin_container(
		    array(
			    'parent'          => $hide_background_image_meta_container,
			    'name'            => 'mkdf_title_area_background_image_responsive_meta_container',
			    'hidden_property' => 'mkdf_title_area_background_image_responsive_meta',
			    'hidden_value'    => 'yes'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_title_area_background_image_parallax_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Background Image in Parallax', 'gotravel'),
			    'description'   => esc_html__('Enabling this option will make Title background image parallax', 'gotravel'),
			    'parent'        => $title_area_background_image_responsive_meta_container,
			    'options'       => array(
				    ''         => esc_html__('Default', 'gotravel'),
				    'no'       => esc_html__('No', 'gotravel'),
				    'yes'      => esc_html__('Yes', 'gotravel'),
				    'yes_zoom' => esc_html__('Yes, with zoom out', 'gotravel')
			    )
		    )
	    );

	    gotravel_mikado_add_meta_box_field(array(
		    'name'        => 'mkdf_title_area_height_meta',
		    'type'        => 'text',
		    'label'       => esc_html__('Height', 'gotravel'),
		    'description' => esc_html__('Set a height for Title Area', 'gotravel'),
		    'parent'      => $show_title_area_meta_container,
		    'args'        => array(
			    'col_width' => 2,
			    'suffix'    => 'px'
		    )
	    ));

	    gotravel_mikado_add_meta_box_field(array(
		    'name'          => 'mkdf_title_area_subtitle_meta',
		    'type'          => 'text',
		    'default_value' => '',
		    'label'         => esc_html__('Subtitle Text', 'gotravel'),
		    'description'   => esc_html__('Enter your subtitle text', 'gotravel'),
		    'parent'        => $show_title_area_meta_container,
		    'args'          => array(
			    'col_width' => 6
		    )
	    ));

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_subtitle_color_meta',
			    'type'        => 'color',
			    'label'       => esc_html__('Subtitle Color', 'gotravel'),
			    'description' => esc_html__('Choose a color for subtitle text', 'gotravel'),
			    'parent'      => $show_title_area_meta_container
		    )
	    );
    }

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_title_meta_box');
}