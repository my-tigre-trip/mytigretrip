<?php
namespace GoTravel\Modules\Shortcodes\PricingTable;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Pricing Table', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkdf_pricing_tables'),
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
					'dependency'  => array('element' => 'title', 'not_empty' => true)
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
					'type'        => 'textfield',
					'heading'     => esc_html__('Label', 'gotravel'),
					'param_name'  => 'label'
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
					'type'        => 'dropdown',
					'heading'     => esc_html__('Active', 'gotravel'),
					'param_name'  => 'active',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false)),
					'save_always' => true
				),
				array(
					'type'        => 'textarea_html',
					'heading'     => esc_html__('Content', 'gotravel'),
					'param_name'  => 'content',
					'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>'
				)
			)
		));
	}

	public function render($atts, $content = null) {

		$args   = array(
			'title'        => 'Basic Plan',
			'title_size'   => '',
			'price'        => '100',
			'currency'     => '',
			'price_period' => '',
			'label'        => '',
			'active'       => 'no',
			'show_button'  => 'yes',
			'link'         => '',
			'button_text'  => 'button'
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html                  = '';
		$pricing_table_clasess = 'mkdf-price-table';

		if($active == 'yes') {
			$pricing_table_clasess .= ' mkdf-pt-active';
		}

		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content']               = $content;
		$params['button_params']         = $this->getButtonParams($params);

		$params['title_styles'] = array();

		if(!empty($params['title_size'])) {
			$params['title_styles'][] = 'font-size: '.gotravel_mikado_filter_px($params['title_size']).'px';
		}

		$html .= gotravel_mikado_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

		return $html;

	}

	private function getButtonParams($params) {
		$buttonParams = array();

		if($params['show_button'] === 'yes' && $params['button_text'] !== '') {
			$buttonParams = array(
				'link' => $params['link'],
				'text' => $params['button_text'],
				'size' => 'medium'
			);

			$buttonParams['type']       = $params['active'] === 'yes' ? 'white' : 'solid';
			$buttonParams['hover_type'] = $params['active'] === 'yes' ? 'white' : 'outline';
		}

		return $buttonParams;
	}

}
