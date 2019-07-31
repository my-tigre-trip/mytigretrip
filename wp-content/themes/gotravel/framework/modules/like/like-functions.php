<?php

if ( ! function_exists('gotravel_mikado_like') ) {
	/**
	 * Returns GoTravelMikadoLike instance
	 *
	 * @return GoTravelMikadoLike
	 */
	function gotravel_mikado_like() {
		return GoTravelMikadoLike::get_instance();
	}

}

function gotravel_mikado_get_like() {

	echo wp_kses(gotravel_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('gotravel_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function gotravel_mikado_like_latest_posts() {
		return gotravel_mikado_like()->add_like();
	}

}