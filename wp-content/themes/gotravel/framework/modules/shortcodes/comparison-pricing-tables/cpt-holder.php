<?php

namespace GoTravel\Modules\Shortcodes\ComparisonPricingTables;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComparisonPricingTablesHolder implements ShortcodeInterface {
	private $base;

	/**
	 * ComparisonPricingTablesHolder constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_comparison_pricing_tables_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Mikado Comparison Pricing Tables', 'gotravel'),
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkdf_comparison_pricing_table'),
			'content_element'         => true,
			'category'                => esc_html__('by MIKADO', 'gotravel'),
			'icon'                    => 'icon-wpb-comparison-pricing-tables extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Columns', 'gotravel'),
					'param_name'  => 'columns',
					'value'       => array(
						esc_html__('Two', 'gotravel')   => 'mkdf-two-columns',
						esc_html__('Three', 'gotravel') => 'mkdf-three-columns',
						esc_html__('Four', 'gotravel')  => 'mkdf-four-columns',
					),
					'save_always' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title'
				),
				array(
					'type'        => 'exploded_textarea',
					'heading'     => esc_html__('Features', 'gotravel'),
					'param_name'  => 'features',
					'description' => esc_html__('Enter features. Separate each features with new line (enter).', 'gotravel')
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Border Top Color', 'gotravel'),
					'param_name'  => 'border_top_color'
				)
			),
			'js_view' => 'VcColumnView'
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'          => 'mkdf-two-columns',
			'features'         => '',
			'title'            => '',
			'border_top_color' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['features']       = $this->getFeaturesArray($params);
		$params['content']        = $content;
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['border_style']   = $this->getBorderStyles($params);
		$params['display_border'] = is_array($params['border_style']) && count($params['border_style']);

		return gotravel_mikado_get_shortcode_module_template_part('templates/cpt-holder-template', 'comparison-pricing-tables', '', $params);
	}

	private function getFeaturesArray($params) {
		$features = array();

		if(!empty($params['features'])) {
			$features = explode(',', $params['features']);
		}

		return $features;
	}

	private function getHolderClasses($params) {
		$classes = array('mkdf-comparision-pricing-tables-holder');

		if($params['columns'] !== '') {
			$classes[] = $params['columns'];
		}

		return $classes;
	}

	private function getBorderStyles($params) {
		$styles = array();

		if($params['border_top_color'] !== '') {
			$styles[] = 'background-color: '.$params['border_top_color'];
		}

		return $styles;
	}

}