<?php

namespace GoTravel\Modules\Shortcodes\ComparisonPricingTables;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComparisonPricingTable implements ShortcodeInterface {
	private $base;

	/**
	 * ComparisonPricingTable constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_comparison_pricing_table';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Comparison Pricing Table', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-comparison-pricing-table extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_comparison_pricing_tables_holder'),
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title Size (px)', 'gotravel'),
					'param_name'  => 'title_size',
					'dependency'  => array('element' => 'title', 'not_empty' => true),
					'group'       => esc_html__('Design Options', 'gotravel')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Price', 'gotravel'),
					'param_name'  => 'price',
					'description' => esc_html__('Default value is 100', 'gotravel')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Currency', 'gotravel'),
					'param_name'  => 'currency',
					'description' => esc_html__('Default mark is $', 'gotravel')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Price Period', 'gotravel'),
					'param_name'  => 'price_period',
					'description' => esc_html__('Default label is monthly', 'gotravel')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Show Button', 'gotravel'),
					'param_name'  => 'show_button',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array())
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Button Text', 'gotravel'),
					'param_name'  => 'button_text',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Button Link', 'gotravel'),
					'param_name'  => 'link',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'textarea_html',
					'heading'     => esc_html__('Content', 'gotravel'),
					'param_name'  => 'content',
					'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Border Top Color', 'gotravel'),
					'param_name'  => 'border_top_color',
					'group'       => esc_html__('Design Options', 'gotravel')
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Button Background Color', 'gotravel'),
					'param_name'  => 'btn_background_color',
					'group'       => esc_html__('Design Options', 'gotravel')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'title'                => 'Basic Plan',
			'title_size'           => '',
			'price'                => '100',
			'currency'             => '',
			'price_period'         => '',
			'show_button'          => 'yes',
			'link'                 => '',
			'button_text'          => 'button',
			'border_top_color'     => '',
			'btn_background_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['content']        = $content;
		$params['border_style']   = $this->getBorderStyles($params);
		$params['display_border'] = is_array($params['border_style']) && count($params['border_style']);
		$params['btn_styles']     = $this->getBtnStyles($params);

		return gotravel_mikado_get_shortcode_module_template_part('templates/cpt-table-template', 'comparison-pricing-tables', '', $params);
	}

	private function getBorderStyles($params) {
		$styles = array();

		if($params['border_top_color'] !== '') {
			$styles[] = 'background-color: '.$params['border_top_color'];
		}

		return $styles;
	}

	private function getBtnStyles($params) {
		$styles = array();

		if($params['btn_background_color'] !== '') {
			$styles[] = 'background-color: '.$params['btn_background_color'];
		}

		return $styles;
	}
}