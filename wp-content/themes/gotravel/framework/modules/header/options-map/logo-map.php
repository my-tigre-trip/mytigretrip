<?php

if(!function_exists('gotravel_mikado_logo_options_map')) {

	function gotravel_mikado_logo_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__('Logo', 'gotravel'),
				'icon'  => 'fa fa-coffee'
			)
		);

		$panel_logo = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__('Logo', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__('Hide Logo', 'gotravel'),
				'description'   => esc_html__('Enabling this option will hide logo image', 'gotravel'),
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "#mkdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value'    => 'yes'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Default', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Dark', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label'         => esc_html__('Logo Image - Light', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label'         => esc_html__('Logo Image - Sticky', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label'         => esc_html__('Logo Image - Mobile', 'gotravel'),
				'description'   => esc_html__('Choose a default logo image to display', 'gotravel'),
				'parent'        => $hide_logo_container
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_logo_options_map');
}