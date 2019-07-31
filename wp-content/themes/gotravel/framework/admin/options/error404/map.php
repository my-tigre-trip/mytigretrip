<?php

if(!function_exists('gotravel_mikado_error_404_options_map')) {

	function gotravel_mikado_error_404_options_map() {

		gotravel_mikado_add_admin_page(array(
			'slug'  => '__404_error_page',
			'title' => esc_html__('404 Error Page', 'gotravel'),
			'icon'  => 'fa fa-exclamation-triangle'
		));

		$panel_404_options = gotravel_mikado_add_admin_panel(array(
			'page'  => '__404_error_page',
			'name'  => 'panel_404_options',
			'title' => esc_html__('404 Page Option', 'gotravel')
		));
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type' => 'color',
				'name' => '404_page_background_color',
				'label' => esc_html__('Background Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type' => 'image',
				'name' => '404_page_background_image',
				'label' => esc_html__('Background Image', 'gotravel'),
				'description' => esc_html__('Choose a background image for 404 page', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type' => 'image',
				'name' => '404_page_background_pattern_image',
				'label' => esc_html__('Pattern Background Image', 'gotravel'),
				'description' => esc_html__('Choose a pattern image for 404 page', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(array(
			'parent'        => $panel_404_options,
			'type'          => 'text',
			'name'          => '404_title',
			'default_value' => esc_html__( 'Page you are looking is not found', 'gotravel' ),
			'label'         => esc_html__('Title', 'gotravel'),
			'description'   => esc_html__('Enter title for 404 page', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $panel_404_options,
			'type'          => 'text',
			'name'          => '404_text',
			'default_value' => esc_html__( 'The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'gotravel' ),
			'label'         => esc_html__('Text', 'gotravel'),
			'description'   => esc_html__('Enter text for 404 page', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $panel_404_options,
			'type'          => 'text',
			'name'          => '404_back_to_home',
			'default_value' => esc_html__( 'Back To Home', 'gotravel' ),
			'label'         => esc_html__('Back to Home Button Label', 'gotravel'),
			'description'   => esc_html__('Enter label for "Back to Home" button', 'gotravel')
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_error_404_options_map', 18);
}