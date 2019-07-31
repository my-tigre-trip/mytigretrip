<?php

if(!function_exists('gotravel_mikado_map_general_meta_box')) {
	/**
	 * Maps general meta box
	 */
	function gotravel_mikado_map_general_meta_box() {
	    $general_meta_box = gotravel_mikado_add_meta_box(
		    array(
			    'scope' => array('page', 'post'),
			    'title' => esc_html__('General', 'gotravel'),
			    'name'  => 'general_meta'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_background_color_meta',
			    'type'          => 'color',
			    'label'         => esc_html__('Page Background Color', 'gotravel'),
			    'description'   => esc_html__('Choose background color for page content', 'gotravel'),
			    'parent'        => $general_meta_box
		    )
	    );
		
		gotravel_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_top_margin_offset_meta',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Page Top Margin Offset', 'gotravel'),
				'description'   => esc_html__('Insert top margin offset for your page content. You can use % or px. Example -100px', 'gotravel'),
				'parent'        => $general_meta_box
			)
		);

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_padding_meta',
			    'type'          => 'text',
			    'default_value' => '',
			    'label'         => esc_html__('Page Content Padding', 'gotravel'),
			    'description'   => esc_html__('Insert page padding for content area in format top right bottom left. Default value is 64px 0 64px 0', 'gotravel'),
			    'parent'        => $general_meta_box
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_content_behind_header_meta',
			    'type'          => 'yesno',
			    'default_value' => 'no',
			    'label'         => esc_html__('Always put content behind header', 'gotravel'),
			    'description'   => esc_html__('Enabling this option will put page content behind page header', 'gotravel'),
			    'parent'        => $general_meta_box,
			    'args'          => array(
				    'suffix' => 'px'
			    )
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_page_slider_meta',
			    'type'          => 'text',
			    'default_value' => '',
			    'label'         => esc_html__('Slider Shortcode', 'gotravel'),
			    'description'   => esc_html__('Paste your slider shortcode here', 'gotravel'),
			    'parent'        => $general_meta_box
		    )
	    );
		
		gotravel_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__('Show Comments', 'gotravel'),
				'description' => esc_html__('Enabling this option will show comments on your page', 'gotravel'),
				'parent'      => $general_meta_box,
				'options'     => array(
					''    => esc_html__('Default', 'gotravel'),
					'no'  => esc_html__('No', 'gotravel'),
					'yes' => esc_html__('Yes', 'gotravel')
				)
			)
		);
    }

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_general_meta_box');
}