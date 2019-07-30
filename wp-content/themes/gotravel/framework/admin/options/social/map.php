<?php

if(!function_exists('gotravel_mikado_social_options_map')) {

	function gotravel_mikado_social_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__('Social Networks', 'gotravel'),
				'icon'  => 'fa fa-share-alt'
			)
		);

		/**
		 * Enable Social Share
		 */
		$panel_social_share = gotravel_mikado_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_social_share',
			'title' => esc_html__('Enable Social Share', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_social_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Social Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow social share on networks of your choice', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_panel_social_networks, #mkdf_panel_show_social_share_on'
			),
			'parent'        => $panel_social_share
		));

		$panel_show_social_share_on = gotravel_mikado_add_admin_panel(array(
			'page'            => '_social_page',
			'name'            => 'panel_show_social_share_on',
			'title'           => esc_html__('Show Social Share On', 'gotravel'),
			'hidden_property' => 'enable_social_share',
			'hidden_value'    => 'no'
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_social_share_on_post',
			'default_value' => 'no',
			'label'         => esc_html__('Posts', 'gotravel'),
			'description'   => esc_html__('Show Social Share on Blog Posts', 'gotravel'),
			'parent'        => $panel_show_social_share_on
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_social_share_on_page',
			'default_value' => 'no',
			'label'         => esc_html__('Pages', 'gotravel'),
			'description'   => esc_html__('Show Social Share on Pages', 'gotravel'),
			'parent'        => $panel_show_social_share_on
		));

		if(gotravel_mikado_tours_plugin_installed()) {
			gotravel_mikado_add_admin_field(array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_tour-item',
				'default_value' => 'no',
				'label'         => esc_html__('Tour Item', 'gotravel'),
				'description'   => esc_html__('Show Social Share for Tour Items', 'gotravel'),
				'parent'        => $panel_show_social_share_on
			));

			gotravel_mikado_add_admin_field(array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_destinations',
				'default_value' => 'no',
				'label'         => esc_html__('Destination', 'gotravel'),
				'description'   => esc_html__('Show Social Share for Destination', 'gotravel'),
				'parent'        => $panel_show_social_share_on
			));
		}

		if(gotravel_mikado_is_woocommerce_installed()) {
			gotravel_mikado_add_admin_field(array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_product',
				'default_value' => 'no',
				'label'         => esc_html__('Product', 'gotravel'),
				'description'   => esc_html__('Show Social Share for Product Items', 'gotravel'),
				'parent'        => $panel_show_social_share_on
			));
		}

		/**
		 * Social Share Networks
		 */
		$panel_social_networks = gotravel_mikado_add_admin_panel(array(
			'page'            => '_social_page',
			'name'            => 'panel_social_networks',
			'title'           => esc_html__('Social Networks', 'gotravel'),
			'hidden_property' => 'enable_social_share',
			'hidden_value'    => 'no'
		));

		/**
		 * Facebook
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'facebook_title',
			'title'  => esc_html__('Share on Facebook', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_facebook_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via Facebook', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_facebook_share_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_facebook_share_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_facebook_share_container',
			'hidden_property' => 'enable_facebook_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'facebook_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_facebook_share_container
		));

		/**
		 * Twitter
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'twitter_title',
			'title'  => esc_html__('Share on Twitter', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_twitter_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via Twitter', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_twitter_share_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_twitter_share_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_twitter_share_container',
			'hidden_property' => 'enable_twitter_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'twitter_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_twitter_share_container
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'text',
			'name'          => 'twitter_via',
			'default_value' => '',
			'label'         => esc_html__('Via', 'gotravel'),
			'parent'        => $enable_twitter_share_container
		));

		/**
		 * Google Plus
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'google_plus_title',
			'title'  => esc_html__('Share on Google Plus', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_google_plus_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via Google Plus', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_google_plus_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_google_plus_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_google_plus_container',
			'hidden_property' => 'enable_google_plus_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'google_plus_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_google_plus_container
		));

		/**
		 * Linked In
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'linkedin_title',
			'title'  => esc_html__('Share on LinkedIn', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_linkedin_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via LinkedIn', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_linkedin_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_linkedin_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_linkedin_container',
			'hidden_property' => 'enable_linkedin_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'linkedin_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_linkedin_container
		));

		/**
		 * Tumblr
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'tumblr_title',
			'title'  => esc_html__('Share on Tumblr', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_tumblr_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via Tumblr', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_tumblr_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_tumblr_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_tumblr_container',
			'hidden_property' => 'enable_tumblr_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'tumblr_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_tumblr_container
		));

		/**
		 * Pinterest
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'pinterest_title',
			'title'  => esc_html__('Share on Pinterest', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_pinterest_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via Pinterest', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_pinterest_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_pinterest_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_pinterest_container',
			'hidden_property' => 'enable_pinterest_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'pinterest_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_pinterest_container
		));

		/**
		 * VK
		 */
		gotravel_mikado_add_admin_section_title(array(
			'parent' => $panel_social_networks,
			'name'   => 'vk_title',
			'title'  => esc_html__('Share on VK', 'gotravel')
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'enable_vk_share',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Share', 'gotravel'),
			'description'   => esc_html__('Enabling this option will allow sharing via VK', 'gotravel'),
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_vk_container'
			),
			'parent'        => $panel_social_networks
		));

		$enable_vk_container = gotravel_mikado_add_admin_container(array(
			'name'            => 'enable_vk_container',
			'hidden_property' => 'enable_vk_share',
			'hidden_value'    => 'no',
			'parent'          => $panel_social_networks
		));

		gotravel_mikado_add_admin_field(array(
			'type'          => 'image',
			'name'          => 'vk_icon',
			'default_value' => '',
			'label'         => esc_html__('Upload Icon', 'gotravel'),
			'parent'        => $enable_vk_container
		));

		if(defined('MIKADOF_TWITTER_FEED_VERSION')) {
			$twitter_panel = gotravel_mikado_add_admin_panel(array(
				'title' => esc_html__('Twitter', 'gotravel'),
				'name'  => 'panel_twitter',
				'page'  => '_social_page'
			));

			gotravel_mikado_add_admin_twitter_button(array(
				'name'   => 'twitter_button',
				'parent' => $twitter_panel
			));
		}

		if(defined('MIKADOF_INSTAGRAM_FEED_VERSION')) {
			$instagram_panel = gotravel_mikado_add_admin_panel(array(
				'title' => esc_html__('Instagram', 'gotravel'),
				'name'  => 'panel_instagram',
				'page'  => '_social_page'
			));

			gotravel_mikado_add_admin_instagram_button(array(
				'name'   => 'instagram_button',
				'parent' => $instagram_panel
			));
		}
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_social_options_map', 16);
}