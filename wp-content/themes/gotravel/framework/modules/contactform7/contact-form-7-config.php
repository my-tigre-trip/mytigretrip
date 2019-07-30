<?php

if(!function_exists('gotravel_mikado_contact_form_map')) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function gotravel_mikado_contact_form_map() {

		vc_add_param('contact-form-7', array(
			'type'        => 'dropdown',
			'heading'     => 'Style',
			'param_name'  => 'html_class',
			'value'       => array(
				esc_html__('Default', 'gotravel') => 'default',
				esc_html__('Custom Style 1', 'gotravel') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'gotravel') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'gotravel') => 'cf7_custom_style_3',
				esc_html__('Custom Style 4', 'gotravel') => 'cf7_custom_style_4'
			),
			'description' => esc_html__('You can style each form element individually in Mikado Options > Contact Form 7', 'gotravel')
		));
	}

	add_action('vc_after_init', 'gotravel_mikado_contact_form_map');
}