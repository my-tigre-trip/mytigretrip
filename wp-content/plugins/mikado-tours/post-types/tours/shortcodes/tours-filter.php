<?php

namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class ToursFilter implements ShortcodeInterface {
	private $base;

	/**
	 * ToursFilter constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_filter';

		add_action('vc_before_init_vc', array($this, 'vcMap'));
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Tours Filters', 'mikado-tours'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'mikado-tours'),
			'icon'                      => 'icon-wpb-tours-filters extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Type', 'mikado-tours'),
					'param_name'  => 'filter_type',
					'value'       => array(
						esc_html__('Vertical', 'mikado-tours')   => 'vertical',
						esc_html__('Horizontal', 'mikado-tours') => 'horizontal'
					),
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mikado-tours'),
					'param_name'  => 'vertical_filter_skin',
					'value'       => array(
						esc_html__('Grey', 'mikado-tours')  => 'grey',
						esc_html__('White', 'mikado-tours') => 'white'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mikado-tours'),
					'param_name'  => 'horizontal_filter_skin',
					'value'       => array(
						esc_html__('Light', 'mikado-tours') => 'light',
						esc_html__('Dark', 'mikado-tours')  => 'dark'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Full Width', 'mikado-tours'),
					'param_name'  => 'filter_full_width',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Semi-Transparent', 'mikado-tours'),
					'param_name'  => 'filter_semitransparent',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Show Tour Types Checkboxes', 'mikado-tours'),
					'param_name'  => 'show_tour_types',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Tour Types', 'mikado-tours'),
					'param_name'  => 'number_of_tour_types',
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				)
			)
		));
	}

	public function getBase() {
		return $this->base;
	}

	public function render($atts, $content = null) {
		$args = array(
			'filter_type'            => 'vertical',
			'vertical_filter_skin'   => 'grey',
			'horizontal_filter_skin' => 'light',
			'show_tour_types'        => 'yes',
			'filter_full_width'      => 'yes',
			'filter_semitransparent' => 'yes',
			'number_of_tour_types'   => ''
		);

		$params = shortcode_atts($args, $atts);

		$filterClass = array(
			'mkdf-tours-filter-holder',
			'mkdf-tours-filter-'.$params['filter_type']
		);

		switch($params['filter_type']) {
			case 'vertical':
				$filterClass[] = 'mkdf-tours-filter-skin-'.$params['vertical_filter_skin'];
				break;
			case 'horizontal':
				$filterClass[] = 'mkdf-tours-filter-skin-'.$params['horizontal_filter_skin'];
				break;
		}


		$params['show_tour_types'] = $params['show_tour_types'] === 'yes';

		$params['display_container_inner'] = $params['filter_full_width'] === 'yes' && $params['filter_type'] === 'horizontal';

		if($params['filter_semitransparent'] === 'yes') {
			$filterClass[] = 'mkdf-tours-filter-semitransparent';
		}

		if($params['display_container_inner']) {
			$filterClass[] = 'mkdf-tours-full-width-filter';
		}

		$params['filter_class'] = $filterClass;

		return mkdf_tours_get_tour_module_template_part('templates/tours-filters-holder', 'tours', 'shortcodes', '', $params);
	}
}