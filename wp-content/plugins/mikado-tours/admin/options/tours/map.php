<?php

if(!function_exists('gotravel_mikado_tours_options_map')) {

	function gotravel_mikado_tours_options_map() {

		gotravel_mikado_add_admin_page(array(
			'slug'  => '_tours_page',
			'title' => esc_html__('Tours', 'mikado-tours'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_payment = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Payment', 'mikado-tours'),
			'name'  => 'panel_payment',
			'page'  => '_tours_page'
		));

		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_payment,
			'name'   => 'paypal_section_title',
			'title'  => esc_html__('PayPal', 'mikado-tours')
		));

		gotravel_mikado_add_admin_field(
			array(
				'name'          => 'tours_enable_paypal',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Enable Paypal', 'mikado-tours'),
				'description'   => esc_html__('This option will enable/disable Paypal payment', 'mikado-tours'),
				'parent'        => $panel_payment,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_show_paypal_container"
				)
			)
		);

		$show_paypal_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_payment,
				'name'            => 'show_paypal_container',
				'hidden_property' => 'tours_enable_paypal',
				'hidden_value'    => 'no'
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'paypal_facilitator_id',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Account ID', 'mikado-tours'),
			'description'   => esc_html__('Insert Business Account ID (Email)', 'mikado-tours'),
			'parent'        => $show_paypal_container
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'paypal_currency',
			'type'          => 'select',
			'default_value' => 'USD',
			'label'         => esc_html__('Currency', 'mikado-tours'),
			'description'   => esc_html__('Payment Currency', 'mikado-tours'),
			'parent'        => $show_paypal_container,
			'options'       => array(
				'USD' => esc_html__('U.S. Dollar', 'mikado-tours'),
				'EUR' => esc_html__('Euro', 'mikado-tours'),
				'GBP' => esc_html__('Pound Sterling', 'mikado-tours'),
				'AUD' => esc_html__('Australian Dollar', 'mikado-tours'),
				'CHF' => esc_html__('Swiss Franc', 'mikado-tours'),
				'BRL' => esc_html__('Brazilian Real', 'mikado-tours'),
				'CAD' => esc_html__('Canadian Dollar', 'mikado-tours'),
				'CZK' => esc_html__('Czech Koruna', 'mikado-tours'),
				'DKK' => esc_html__('Danish Krone', 'mikado-tours'),
				'HKD' => esc_html__('Hong Kong Dollar', 'mikado-tours'),
				'HUF' => esc_html__('Hungarian Forint', 'mikado-tours'),
				'ILS' => esc_html__('Israeli New Sheqel', 'mikado-tours'),
				'JPY' => esc_html__('Japanese Yen', 'mikado-tours'),
				'MYR' => esc_html__('Malaysian Ringgit', 'mikado-tours'),
				'MXN' => esc_html__('Mexican Peso', 'mikado-tours'),
				'NOK' => esc_html__('Norwegian Krone', 'mikado-tours'),
				'NZD' => esc_html__('New Zealand Dollar', 'mikado-tours'),
				'PHP' => esc_html__('Philippine Peso', 'mikado-tours'),
				'PLN' => esc_html__('Polish Zloty', 'mikado-tours'),
				'SGD' => esc_html__('Singapore Dollar', 'mikado-tours'),
				'SEK' => esc_html__('Swedish Krona', 'mikado-tours'),
				'TWD' => esc_html__('Taiwan New Dollar', 'mikado-tours'),
				'THB' => esc_html__('Thai Baht', 'mikado-tours'),
				'TRY' => esc_html__('Turkish Lira', 'mikado-tours')
			)
		));

		$settings_panel = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Settings', 'mikado-tours'),
			'name'  => 'panel_settings',
			'page'  => '_tours_page'
		));
		
		$checkout_pages = mkdf_tours_get_checkout_pages(true);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'tours_checkout_page',
			'type'          => 'select',
			'default_value' => '',
			'label'         => esc_html__('Checkout Page', 'mikado-tours'),
			'description'   => esc_html__('Choose checkout page', 'mikado-tours'),
			'parent'        => $settings_panel,
			'options'       => $checkout_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Price Currency', 'mikado-tours'),
			'description'   => esc_html__('Insert currency for tour prices', 'mikado-tours'),
			'parent'        => $settings_panel,
			'args'          => array(
				'col_width' => '3'
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol_position',
			'type'          => 'select',
			'default_value' => 'left',
			'label'         => esc_html__('Price Currency Position', 'mikado-tours'),
			'description'   => esc_html__('Choose position for your currency symbol', 'mikado-tours'),
			'parent'        => $settings_panel,
			'options'       => array(
				'left'  => esc_html__('Left', 'mikado-tours'),
				'right' => esc_html__('Right', 'mikado-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		$search_pages = mkdf_tours_get_search_pages(true);

		$search_panel = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Search Page', 'mikado-tours'),
			'name'  => 'panel_search',
			'page'  => '_tours_page'
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_main_page',
			'default_value' => '',
			'label'         => esc_html__('Main Search Page', 'mikado-tours'),
			'description'   => esc_html__('Choose main search page. Defaults to tour item archive page', 'mikado-tours'),
			'options'       => $search_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_per_page',
			'default_value' => 12,
			'label'         => esc_html__('Items per Page', 'mikado-tours'),
			'description'   => esc_html__('Choose number of tour items per page', 'mikado-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_view_type',
			'default_value' => 'list',
			'label'         => esc_html__('Default Tour View Type', 'mikado-tours'),
			'description'   => esc_html__('Choose default tour view type', 'mikado-tours'),
			'options'       => array(
				'list'     => esc_html__('List', 'mikado-tours'),
				'standard' => esc_html__('Standard', 'mikado-tours'),
				'gallery'  => esc_html__('Gallery', 'mikado-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_ordering',
			'default_value' => 'date',
			'label'         => esc_html__('Default Tour Ordering', 'mikado-tours'),
			'description'   => esc_html__('Choose default tour ordering', 'mikado-tours'),
			'options'       => array(
				'date'       => esc_html__('Date', 'mikado-tours'),
				'price_low'  => esc_html__('Price Low to High', 'mikado-tours'),
				'price_high' => esc_html__('Price High to Low', 'mikado-tours'),
				'name'       => esc_html__('Name', 'mikado-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_standard_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Standard Item Text Length', 'mikado-tours'),
			'description'   => esc_html__('Choose number of words for standard tour item', 'mikado-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_standard_thumb_size',
			'default_value' => 'full',
			'label'         => esc_html__('Standard Thumbnail Size', 'mikado-tours'),
			'description'   => esc_html__('Choose thumbnail size for standard tour item', 'mikado-tours'),
			'options'       => array(
				'full'               => esc_html__('Full', 'mikado-tours'),
				'gotravel_landscape' => esc_html__('Landscape', 'mikado-tours'),
				'gotravel_portrait'  => esc_html__('Portrait', 'mikado-tours'),
				'gotravel_square'    => esc_html__('Square', 'mikado-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_gallery_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Gallery Item Text Length', 'mikado-tours'),
			'description'   => esc_html__('Choose number of words for gallery tour item', 'mikado-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_gallery_thumb_size',
			'default_value' => 'full',
			'options'       => array(
				'full'               => esc_html__('Full', 'mikado-tours'),
				'gotravel_landscape' => esc_html__('Landscape', 'mikado-tours'),
				'gotravel_portrait'  => esc_html__('Portrait', 'mikado-tours'),
				'gotravel_square'    => esc_html__('Square', 'mikado-tours')
			),
			'label'         => esc_html__('Gallery Thumbnail Size', 'mikado-tours'),
			'description'   => esc_html__('Choose thumbnail size for gallery tour item', 'mikado-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_list_text_length',
			'default_value' => 55,
			'label'         => esc_html__('List Item Text Length', 'mikado-tours'),
			'description'   => esc_html__('Choose number of words for list tour item', 'mikado-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		$reviews_panel = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Reviews', 'mikado-tours'),
			'name'  => 'panel_reviews',
			'page'  => '_tours_page'
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'text',
			'name'          => 'reviews_section_title',
			'default_value' => '',
			'label'         => esc_html__('Reviews Section Title', 'mikado-tours'),
			'description'   => esc_html__('Enter title that you want to show before average rating for each tour', 'mikado-tours'),
		));

		gotravel_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'textarea',
			'name'          => 'reviews_section_subtitle',
			'default_value' => '',
			'label'         => esc_html__('Reviews Section Subtitle', 'mikado-tours'),
			'description'   => esc_html__('Enter subtitle that you want to show before average rating for each tour', 'mikado-tours'),
		));
		
		$panel_admin_email = gotravel_mikado_add_admin_panel(array(
			'title' => esc_html__('Admin Booking Email', 'mikado-tours'),
			'name'  => 'admin_email',
			'page'  => '_tours_page'
		));
		
		gotravel_mikado_add_admin_field(array(
			'parent'        => $panel_admin_email,
			'type'          => 'yesno',
			'name'          => 'enable_admin_booking_email',
			'default_value' => 'yes',
			'label'         => esc_html__('Should Admin Receive Booking Emails?', 'mikado-tours'),
			'description'   => esc_html__('Enabling this option will forward all booking emails to the site administrator’s inbox', 'mikado-tours'),
			'args'          => array(
				"dependence"             => true,
				"dependence_hide_on_yes" => "",
				"dependence_show_on_yes" => "#mkdf_show_admin_email_container"
			)
		));
		
		$show_admin_email_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $panel_admin_email,
				'name'            => 'show_admin_email_container',
				'hidden_property' => 'admin_email_enable',
				'hidden_value'    => 'no'
			)
		);
		
		gotravel_mikado_add_admin_field(array(
			'name'          => 'admin_email',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Admin Email', 'mikado-tours'),
			'description'   => esc_html__('Input the site administrator’s email address. If you leave this field empty, booking emails will be sent to the default admin’s email address', 'mikado-tours'),
			'parent'        => $show_admin_email_container
		));
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_tours_options_map', 11);
}