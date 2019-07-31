<?php

if(!function_exists('gotravel_mikado_register_footer_sidebar')) {
	function gotravel_mikado_register_footer_sidebar() {

		register_sidebar(array(
			'name'          => esc_html__('Footer Top Column 1', 'gotravel'),
			'description'   => esc_html__('Widgets added here will appear in the first column of top footer area', 'gotravel'),
			'id'            => 'footer_column_1',
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-1 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Top Column 2', 'gotravel'),
			'description'   => esc_html__('Widgets added here will appear in the second column of top footer area', 'gotravel'),
			'id'            => 'footer_column_2',
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-2 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Top Column 3', 'gotravel'),
			'description'   => esc_html__('Widgets added here will appear in the third column of top footer area', 'gotravel'),
			'id'            => 'footer_column_3',
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Top Column 4', 'gotravel'),
			'description'   => esc_html__('Widgets added here will appear in the fourth column of top footer area', 'gotravel'),
			'id'            => 'footer_column_4',
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-4 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Bottom', 'gotravel'),
			'id'            => 'footer_text',
			'description'   => esc_html__('Widgets added here will appear in the middle column of bottom footer area', 'gotravel'),
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-text %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Bottom Left', 'gotravel'),
			'id'            => 'footer_bottom_left',
			'description'   => esc_html__('Widgets added here will appear in the left column of bottom footer area', 'gotravel'),
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-left %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Footer Bottom Right', 'gotravel'),
			'id'            => 'footer_bottom_right',
			'description'   => esc_html__('Widgets added here will appear in the right column of bottom footer area', 'gotravel'),
			'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkdf-footer-widget-title">',
			'after_title'   => '</h5>'
		));
	}

	add_action('widgets_init', 'gotravel_mikado_register_footer_sidebar');
}

if(!function_exists('gotravel_mikado_get_footer')) {
	/**
	 * Loads footer HTML
	 */
	function gotravel_mikado_get_footer() {
		$parameters                          = array();
		$id                                  = gotravel_mikado_get_page_id();
		$parameters['footer_classes']        = gotravel_mikado_get_footer_classes($id);
		$parameters['display_footer_top']    = (gotravel_mikado_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
		$parameters['display_footer_bottom'] = (gotravel_mikado_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;
		
		if (!is_active_sidebar('footer_column_1') && !is_active_sidebar('footer_column_2') && !is_active_sidebar('footer_column_3') && !is_active_sidebar('footer_column_4')) {
			$parameters['display_footer_top'] = false;
		}
		
		if (!is_active_sidebar('footer_bottom_left') && !is_active_sidebar('footer_text') && !is_active_sidebar('footer_bottom_right')) {
			$parameters['display_footer_bottom'] = false;
		}
		
		gotravel_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
	}
}

if(!function_exists('gotravel_mikado_get_content_bottom_area')) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function gotravel_mikado_get_content_bottom_area() {
		$parameters = array();

		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = gotravel_mikado_get_meta_field_intersect('enable_content_bottom_area');
		if($parameters['content_bottom_area'] == 'yes') {
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = gotravel_mikado_get_meta_field_intersect('content_bottom_sidebar_custom_display');
			//Content bottom area in grid
			$parameters['content_bottom_area_in_grid'] = gotravel_mikado_get_meta_field_intersect('content_bottom_in_grid');
			//Content bottom area background color
			$parameters['content_bottom_background_color'] = 'background-color: '.gotravel_mikado_get_meta_field_intersect('content_bottom_background_color');
		}

		gotravel_mikado_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);
	}
}

if(!function_exists('gotravel_mikado_get_footer_top')) {
	/**
	 * Return footer top HTML
	 */
	function gotravel_mikado_get_footer_top() {
		$parameters = array();

		$parameters['footer_in_grid']            = (gotravel_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_top_classes']        = gotravel_mikado_footer_top_classes();
		$parameters['footer_top_columns']        = gotravel_mikado_options()->getOptionValue('footer_top_columns');

		gotravel_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
	}
}

if(!function_exists('gotravel_mikado_get_footer_bottom')) {
	/**
	 * Return footer bottom HTML
	 */
	function gotravel_mikado_get_footer_bottom() {
		$parameters = array();

		$parameters['footer_in_grid']               = (gotravel_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_bottom_columns']        = gotravel_mikado_options()->getOptionValue('footer_bottom_columns');

		gotravel_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
	}
}

//Functions for loading sidebars

if(!function_exists('gotravel_mikado_get_footer_sidebar_25_25_50')) {
	function gotravel_mikado_get_footer_sidebar_25_25_50() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_sidebar_50_25_25')) {
	function gotravel_mikado_get_footer_sidebar_50_25_25() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_sidebar_four_columns')) {
	function gotravel_mikado_get_footer_sidebar_four_columns() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_sidebar_three_columns')) {
	function gotravel_mikado_get_footer_sidebar_three_columns() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_sidebar_two_columns')) {
	function gotravel_mikado_get_footer_sidebar_two_columns() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_sidebar_one_column')) {
	function gotravel_mikado_get_footer_sidebar_one_column() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_bottom_sidebar_three_columns')) {
	function gotravel_mikado_get_footer_bottom_sidebar_three_columns() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_bottom_sidebar_two_columns')) {
	function gotravel_mikado_get_footer_bottom_sidebar_two_columns() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
	}
}

if(!function_exists('gotravel_mikado_get_footer_bottom_sidebar_one_column')) {
	function gotravel_mikado_get_footer_bottom_sidebar_one_column() {
		gotravel_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
	}
}