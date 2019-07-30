<?php

if(!function_exists('gotravel_mikado_map_blog_meta_box')) {
	/**
	 * Maps blog meta box
	 */
	function gotravel_mikado_map_blog_meta_box() {
	    $mkd_blog_categories = array();
	    $categories           = get_categories();
	    foreach($categories as $category) {
		    $mkd_blog_categories[$category->term_id] = $category->name;
	    }

	    $blog_meta_box = gotravel_mikado_add_meta_box(
		    array(
			    'scope' => array('page'),
			    'title' => esc_html__('Blog', 'gotravel'),
			    'name'  => 'blog_meta'
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_blog_category_meta',
			    'type'        => 'selectblank',
			    'label'       => esc_html__('Blog Category', 'gotravel'),
			    'description' => esc_html__('Choose category of posts to display (leave empty to display all categories)', 'gotravel'),
			    'parent'      => $blog_meta_box,
			    'options'     => $mkd_blog_categories
		    )
	    );

	    gotravel_mikado_add_meta_box_field(
		    array(
			    'name'        => 'mkdf_show_posts_per_page_meta',
			    'type'        => 'text',
			    'label'       => esc_html__('Number of Posts', 'gotravel'),
			    'description' => esc_html__('Enter the number of posts to display', 'gotravel'),
			    'parent'      => $blog_meta_box,
			    'options'     => $mkd_blog_categories,
			    'args'        => array("col_width" => 3)
		    )
	    );
    }

	add_action('gotravel_mikado_meta_boxes_map', 'gotravel_mikado_map_blog_meta_box');
}