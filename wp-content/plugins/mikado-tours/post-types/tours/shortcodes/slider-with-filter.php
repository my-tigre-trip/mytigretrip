<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class SliderWithFilter implements ShortcodeInterface {
	private $base;

	/**
	 * SliderWithFilter constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_slider_with_filter';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'            => esc_html__('Mikado Slider With Filter', 'mikado-tours'),
			'base'            => $this->base,
			'category'        => esc_html__('by MIKADO', 'mikado-tours'),
			'icon'            => 'icon-wpb-slider-with-filter extended-custom-icon',
			'js_view'         => 'VcColumnView',
			'as_parent'       => array('only' => 'rev_slider_vc'),
			'content_element' => true,
			'params'          => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Type', 'mikado-tours'),
					'param_name'  => 'filter_type',
					'value'       => array(
						esc_html__('Vertical', 'mikado-tours')   => 'vertical',
						esc_html__('Horizontal', 'mikado-tours') => 'horizontal'
					),
					'admin_label' => true,
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Position', 'mikado-tours'),
					'param_name'  => 'horizontal_filter_position',
					'value'       => array(
						esc_html__('Bottom', 'mikado-tours')                 => 'bottom',
						esc_html__('Offset From the Bottom', 'mikado-tours') => 'bottom-offset'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Position', 'mikado-tours'),
					'param_name'  => 'vertical_filter_position',
					'value'       => array(
						esc_html__('Left', 'mikado-tours')  => 'left',
						esc_html__('Right', 'mikado-tours') => 'right'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mikado-tours'),
					'param_name'  => 'vertical_filter_skin',
					'value'       => array(
						esc_html__('Grey', 'mikado-tours')  => 'grey',
						esc_html__('White', 'mikado-tours') => 'white'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Top Offset (px)', 'mikado-tours'),
					'param_name'  => 'top_offset',
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => esc_html__('Filter Options', 'mikado-tours'),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mikado-tours'),
					'param_name'  => 'horizontal_filter_skin',
					'value'       => array(
						esc_html__('Light', 'mikado-tours') => 'light',
						esc_html__('Dark', 'mikado-tours')  => 'dark'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Full Width', 'mikado-tours'),
					'param_name'  => 'filter_full_width',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Filter Semi-Transparent', 'mikado-tours'),
					'param_name'  => 'filter_semitransparent',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Show Tour Types Checkboxes', 'mikado-tours'),
					'param_name'  => 'show_tour_types',
					'value'       => array(
						esc_html__('Yes', 'mikado-tours') => 'yes',
						esc_html__('No', 'mikado-tours')  => 'no'
					),
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Tour Types', 'mikado-tours'),
					'param_name'  => 'number_of_tour_types',
					'value'       => '',
					'admin_label' => true,
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical'),
					'group'       => esc_html__('Filter Options', 'mikado-tours')
				)
			),
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'filter_type'                => 'vertical',
			'horizontal_filter_position' => 'bottom',
			'vertical_filter_position'   => 'left',
			'vertical_filter_skin'       => 'grey',
			'horizontal_filter_skin'     => 'light',
			'filter_full_width'          => 'yes',
			'filter_semitransparent'     => 'yes',
			'show_tour_types'            => 'yes',
			'number_of_tour_types'       => '',
			'top_offset'                 => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['filter_style'] = '';

		$filterClass = array('mkdf-tours-swf-filter-holder');

		switch($params['filter_type']) {
			case 'vertical':
				$filterClass[] = 'mkdf-tours-swf-filter-'.$params['vertical_filter_position'];
				$filterClass[] = 'mkdf-tours-swf-filter-vertical';
				$filterClass[] = 'mkdf-grid';
				break;
			case 'horizontal':
				$filterClass[] = 'mkdf-tours-swf-filter-'.$params['horizontal_filter_position'];
				$filterClass[] = 'mkdf-tours-swf-filter-horizontal';

				break;
		}

		$params['filter_class'] = $filterClass;

		if ($params['top_offset'] !== ''){
			$params['filter_style'] .= 'padding-top:'.gotravel_mikado_filter_px($params['top_offset']).'px;';
		}

		$params['display_grid_div'] = $params['filter_full_width'] !== 'yes' && $params['filter_type'] === 'horizontal';

		return mkdf_tours_get_tour_module_template_part('templates/slider-with-filter', 'tours', 'shortcodes', '', $params);
	}
}