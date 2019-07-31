<?php

if(!function_exists('gotravel_mikado_reset_options_map')) {
	/**
	 * Reset options panel
	 */
	function gotravel_mikado_reset_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset', 'gotravel'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'reset_to_defaults',
			'default_value' => 'no',
			'label'         => esc_html__('Reset to Defaults', 'gotravel'),
			'description'   => esc_html__('This option will reset all Mikado Options values to defaults', 'gotravel'),
			'parent'        => $panel_reset
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_reset_options_map', 21);
}