<?php

if(!function_exists('gotravel_mikado_get_related_post_type')) {
	/**
	 * Function for returning latest posts types
	 *
	 * @param $post_id
	 * @param array $options
	 *
	 * @return WP_Query
	 */
	function gotravel_mikado_get_related_post_type($post_id, $options = array()) {
		//Get tags
		$tags = get_the_tags($post_id);
		//Get categories
		$categories = get_the_category($post_id);

		$tag_ids = array();
		if($tags) {
			foreach($tags as $tag) {
				$tag_ids[] = $tag->term_id;
			}
		}

		$category_ids = array();
		if($categories) {
			foreach($categories as $category) {
				$category_ids[] = $category->term_id;
			}
		}

		$hasRelatedByTag = false;

		if($tag_ids) {
			$related_by_tag = gotravel_mikado_get_related_posts($post_id, $tag_ids, 'tag', $options);

			if(!empty($related_by_tag->posts)) {
				$hasRelatedByTag = true;

				return $related_by_tag;
			}
		}
		
		if($categories && !$hasRelatedByTag) {
			$related_by_category = gotravel_mikado_get_related_posts($post_id, $category_ids, 'category', $options);

			if(!empty($related_by_category->posts)) {
				return $related_by_category;
			}
		}
	}
}

if(!function_exists('gotravel_mikado_get_related_posts')) {
	/**
	 * Function for related posts
	 *
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $slug - term slug for WP_Query
	 * @param array $options
	 *
	 * @return WP_Query
	 */
	function gotravel_mikado_get_related_posts($post_id, $term_ids, $slug, $options = array()) {
		//Query options
		$posts_per_page = -1;

		//Override query options
		extract($options);

		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array($post_id),
			$slug.'__in'     => $term_ids,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => $posts_per_page
		);

		$related_posts = new WP_Query($args);

		return $related_posts;
	}
}