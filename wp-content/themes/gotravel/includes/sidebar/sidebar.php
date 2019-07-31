<?php

if(!function_exists('gotravel_mikado_register_sidebars')) {
	/**
	 * Function that registers theme's sidebars
	 */
	function gotravel_mikado_register_sidebars() {

		register_sidebar(array(
			'name'          => esc_html__('Sidebar', 'gotravel'),
			'id'            => 'sidebar',
			'description'   => esc_html__('Default Sidebar', 'gotravel'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4><span class="mkdf-sidearea-title">',
			'after_title'   => '</span></h4>'
		));
	}

	add_action('widgets_init', 'gotravel_mikado_register_sidebars');
}

if(!function_exists('gotravel_mikado_add_support_custom_sidebar')) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates GoTravelMikadoSidebar object
	 */
	function gotravel_mikado_add_support_custom_sidebar() {
		add_theme_support('GoTravelMikadoSidebar');
		if(get_theme_support('GoTravelMikadoSidebar')) {
			new GoTravelMikadoSidebar();
		}
	}

	add_action('after_setup_theme', 'gotravel_mikado_add_support_custom_sidebar');
}
