<?php

if(!function_exists('gotravel_mikado_map_breadcrumbs_meta_box')) {
	/**
	 * Maps breadcrumbs meta box
	 */
	function gotravel_mikado_map_breadcrumbs_meta_box() {
	    $breadcrumbs_meta_box = gotravel_mikado_add_meta_box(
		    array(
			    'scope' => array('page', 'post', 'tour-item'),
			    'title' => esc_html__('Breadcrumbs', 'gotravel'),
			    'name'  => 'breadcrumbs_meta'
		    )
	    );
		
	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_show_breadcrumbs_area_meta',
			    'type'          => 'yesno',
			    'default_value' => gotravel_mikado_options()->getOptionValue('show_breadcrumbs_area'),
			    'label'         => esc_html__('Show Breadcrumbs Area', 'gotravel'),
			    'description'   => esc_html__('This option will enable/disable Breadcrumbs Area', 'gotravel'),
			    'parent'        => $breadcrumbs_meta_box,
			    'args'          => array(
				    'dependence'             => true,
				    'dependence_hide_on_yes' => '',
				    'dependence_show_on_yes' => '#mkdf_mkdf_show_breadcrumbs_area_container_meta'
			    )
		    )
	    );

	    $show_breadcrumbs_area_container = gotravel_mikado_add_admin_container(
		    array(
			    'parent'          => $breadcrumbs_meta_box,
			    'name'            => 'mkdf_show_breadcrumbs_area_container_meta',
			    'hidden_property' => 'mkdf_show_breadcrumbs_area_meta',
			    'hidden_value'    => 'no'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'          => 'mkdf_breadcrumbs_text_size_meta',
			    'type'          => 'select',
			    'default_value' => '',
			    'label'         => esc_html__('Breadcrumbs Text Size', 'gotravel'),
			    'description'   => esc_html__('Choose breadcrumbs text size', 'gotravel'),
			    'options'       => array(
				    ''       => esc_html__('Default', 'gotravel'),
				    'medium' => esc_html__('Medium', 'gotravel')
			    ),
			    'parent'        => $show_breadcrumbs_area_container
		    )
	    );
    }

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_breadcrumbs_meta_box');
}