<?php

if(!function_exists('gotravel_mikado_get_button_html')) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function gotravel_mikado_get_button_html($params) {
		$button_html = gotravel_mikado_execute_shortcode('mkdf_button', $params);
		$button_html = str_replace("\n", '', $button_html);

		return $button_html;
	}
}

if(!function_exists('gotravel_mikado_get_btn_hover_animation_types')) {
	/**
	 * @param bool $empty_val
	 *
	 * @return array
	 */
	function gotravel_mikado_get_btn_hover_animation_types($empty_val = false) {
		$types = array(
			'disable'         => esc_html__('Disable Animation', 'gotravel'),
			'fill-from-top'   => esc_html__('Fill From Top', 'gotravel'),
			'fill-from-left'  => esc_html__('Fill From Left', 'gotravel'),
			'fill-from-right' => esc_html__('Fill From Right', 'gotravel')
		);

		if($empty_val) {
			$types = array_merge(array(
				'' => 'Default'
			), $types);
		}

		return $types;
	}
}

if(!function_exists('mkdf_get_btn_types')) {
	function gotravel_mikado_get_btn_types($empty_val = false) {
		$types = array(
			'outline'       => esc_html__('Outline', 'gotravel'),
			'solid'         => esc_html__('Solid', 'gotravel'),
			'white'         => esc_html__('White', 'gotravel'),
			'white-outline' => esc_html__('White Outline', 'gotravel'),
			'black'         => esc_html__('Black', 'gotravel')
		);

		if($empty_val) {
			$types = array_merge(array(
				'' => esc_html__('Default', 'gotravel')
			), $types);
		}

		return $types;
	}
}