<?php

if(!function_exists('gotravel_mikado_blog_options_map')) {

	function gotravel_mikado_blog_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__('Blog', 'gotravel'),
				'icon'  => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$custom_sidebars = gotravel_mikado_get_custom_sidebars();

		$panel_blog_lists = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'          => 'blog_list_type',
			'type'          => 'select',
			'label'         => esc_html__('Blog Layout for Archive Pages', 'gotravel'),
			'description'   => esc_html__('Choose a default blog layout', 'gotravel'),
			'default_value' => 'standard-date-on-side',
			'parent'        => $panel_blog_lists,
			'options'       => array(
				'standard'              => esc_html__('Blog: Standard', 'gotravel'),
				'split-column'          => esc_html__('Blog: Split Column', 'gotravel'),
				'masonry'               => esc_html__('Blog: Masonry', 'gotravel'),
				'masonry-full-width'    => esc_html__('Blog: Masonry Full Width', 'gotravel'),
				'standard-date-on-side' => esc_html__('Blog: Standard Date On Side', 'gotravel')
			)
		));

		gotravel_mikado_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Archive and Category Sidebar', 'gotravel'),
			'description' => esc_html__('Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'gotravel'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'          => esc_html__('No Sidebar', 'gotravel'),
				'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'gotravel'),
				'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'gotravel'),
				'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'gotravel'),
				'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'gotravel'),
			)
		));


		if(count($custom_sidebars) > 0) {
			gotravel_mikado_add_admin_field(array(
				'name'        => 'blog_custom_sidebar',
				'type'        => 'selectblank',
				'label'       => esc_html__('Sidebar to Display', 'gotravel'),
				'description' => esc_html__('Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"', 'gotravel'),
				'parent'      => $panel_blog_lists,
				'options'     => gotravel_mikado_get_custom_sidebars()
			));
		}

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'pagination',
				'default_value' => 'yes',
				'label'         => esc_html__('Pagination', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enabling this option will display pagination links on bottom of Blog Post List', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_pagination_container'
				)
			)
		);

		$pagination_container = gotravel_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_lists,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $pagination_container,
				'type'          => 'text',
				'name'          => 'blog_page_range',
				'default_value' => '',
				'label'         => esc_html__('Pagination Range limit', 'gotravel'),
				'description'   => esc_html__('Enter a number that will limit pagination to a certain range of links', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label'       => esc_html__('Pagination on Masonry', 'gotravel'),
			'description' => esc_html__('Choose a pagination style for Masonry Blog List', 'gotravel'),
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'        => esc_html__('Standard', 'gotravel'),
				'load-more'       => esc_html__('Load More', 'gotravel'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'gotravel')
			),

		));
		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_load_more_pag',
				'default_value' => 'no',
				'label'         => esc_html__('Load More Pagination on Other Lists', 'gotravel'),
				'parent'        => $pagination_container,
				'description'   => esc_html__('Enable Load More Pagination on other lists', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'masonry_filter',
				'default_value' => 'no',
				'label'         => esc_html__('Masonry Filter', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '',
				'label'         => esc_html__('Number of Words in Excerpt', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'standard_number_of_chars',
				'default_value' => '45',
				'label'         => esc_html__('Standard Type Number of Words in Excerpt', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'masonry_number_of_chars',
				'default_value' => '45',
				'label'         => esc_html__('Masonry Type Number of Words in Excerpt', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'split_column_number_of_chars',
				'default_value' => '45',
				'label'         => esc_html__('Split Column Type Number of Words in Excerpt', 'gotravel'),
				'parent'        => $panel_blog_lists,
				'description'   => esc_html__('Enter a number of words in excerpt (article summary)', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = gotravel_mikado_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(array(
			'name'        => 'blog_single_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Single Type', 'gotravel'),
			'description' => esc_html__('Choose a layout type for Blog Single pages', 'gotravel'),
			'parent'      => $panel_blog_single,
			'options'     => array(
				'standard'     => esc_html__('Standard', 'gotravel'),
				'date-on-side' => esc_html__('Date On Side', 'gotravel'),
			),
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'blog_single_sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'gotravel'),
			'description'   => esc_html__('Choose a sidebar layout for Blog Single pages', 'gotravel'),
			'parent'        => $panel_blog_single,
			'options'       => array(
				'default'          => esc_html__('No Sidebar', 'gotravel'),
				'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'gotravel'),
				'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'gotravel'),
				'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'gotravel'),
				'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'gotravel')
			),
			'default_value' => 'default'
		));


		if(count($custom_sidebars) > 0) {
			gotravel_mikado_add_admin_field(array(
				'name'        => 'blog_single_custom_sidebar',
				'type'        => 'selectblank',
				'label'       => esc_html__('Sidebar to Display', 'gotravel'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'gotravel'),
				'parent'      => $panel_blog_single,
				'options'     => gotravel_mikado_get_custom_sidebars()
			));
		}
		
		gotravel_mikado_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'gotravel'),
			'description'   => esc_html__('Enabling this option will show comments on your page.', 'gotravel'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		gotravel_mikado_add_admin_field(array(
			'name'          => 'blog_single_related_posts',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Related Posts', 'gotravel'),
			'description'   => esc_html__('Enabling this option will show related posts on your single post.', 'gotravel'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Prev/Next Single Post Navigation Links', 'gotravel'),
				'parent'        => $panel_blog_single,
				'description'   => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = gotravel_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Navigation Only in Current Category', 'gotravel'),
				'description'   => esc_html__('Limit your navigation only through current category', 'gotravel'),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'blog_enable_single_tags',
			'default_value' => 'yes',
			'label'         => esc_html__('Enable Tags on Single Post', 'gotravel'),
			'description'   => esc_html__('Enabling this option will display posts\s tags on single post page', 'gotravel'),
			'parent'        => $panel_blog_single
		));

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'no',
				'label'         => esc_html__('Show Author Info Box', 'gotravel'),
				'parent'        => $panel_blog_single,
				'description'   => esc_html__('Enabling this option will display author name and descriptions on Blog Single pages', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = gotravel_mikado_add_admin_container(
			array(
				'name'            => 'mkdf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value'    => 'no',
				'parent'          => $panel_blog_single,
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__('Show Author Email', 'gotravel'),
				'description'   => esc_html__('Enabling this option will show author email', 'gotravel'),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_blog_options_map', 14);
}











