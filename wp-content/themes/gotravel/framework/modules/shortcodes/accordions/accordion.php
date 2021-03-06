<?php
namespace GoTravel\Modules\Shortcodes\Accordion;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * class Accordions
 */
class Accordion implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_accordion';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Mikado Accordion', 'gotravel'),
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkdf_accordion_tab'),
			'content_element'         => true,
			'category'                => esc_html__('by MIKADO', 'gotravel'),
			'icon'                    => 'icon-wpb-accordion extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => esc_html__('Extra class name', 'gotravel'),
					'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'gotravel')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Style', 'gotravel'),
					'param_name'  => 'style',
					'value'       => array(
						esc_html__('Accordion', 'gotravel')       => 'accordion',
						esc_html__('Boxed Accordion', 'gotravel') => 'boxed_accordion',
						esc_html__('Toggle', 'gotravel')         => 'toggle',
						esc_html__('Boxed Toggle', 'gotravel')    => 'boxed_toggle'
					),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = (array(
			'el_class' => '',
			'style' => 'accordion'
		));
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$acc_class           = $this->getAccordionClasses($params);
		$params['acc_class'] = $acc_class;
		$params['content']   = $content;

		$output = '';

		$output .= gotravel_mikado_get_shortcode_module_template_part('templates/accordion-holder-template', 'accordions', '', $params);

		return $output;
	}

	/**
	 * Generates accordion classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getAccordionClasses($params) {

		$acc_class = array();
		$style     = $params['style'];
		switch($style) {
			case 'toggle':
				$acc_class[] = 'mkdf-toggle';
				$acc_class[] = 'mkdf-initial';
				break;
			case 'boxed_toggle':
				$acc_class[] = 'mkdf-toggle';
				$acc_class[] = 'mkdf-boxed';
				break;
			case 'boxed_accordion':
				$acc_class[] = 'mkdf-accordion';
				$acc_class[] = 'mkdf-boxed';
				break;
			default:
				$acc_class[] = 'mkdf-accordion';
				$acc_class[] = 'mkdf-initial';
		}
		 if($params['el_class'] != ''){
			 $acc_class[] = $params['el_class'];
		 }

		return implode(' ', $acc_class);
	}
}
