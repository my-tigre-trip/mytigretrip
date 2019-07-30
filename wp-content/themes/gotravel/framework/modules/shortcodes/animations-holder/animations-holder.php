<?php
namespace GoTravel\Modules\Shortcodes\AnimationsHolder;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class AnimationsHolder implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_animations_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(
			array(
				'name'                    => esc_html__('Mikado Animations Holder', 'gotravel'),
				'base'                    => $this->base,
				'as_parent'               => array('except' => 'vc_row, vc_accordion, vc_tabs, mkdf_elements_holder, mkdf_pricing_tables, mkdf_text_slider_holder, mkdf_info_card_slider, mkdf_icon_slider'),
				'content_element'         => true,
				'category'                => esc_html__('by MIKADO', 'gotravel'),
				'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
				'show_settings_on_create' => true,
				'js_view'                 => 'VcColumnView',
				'params'                  => array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Animation', 'gotravel'),
						'param_name'  => 'css_animation',
						'value'       => array(
							esc_html__('No animation', 'gotravel')                    => '',
							esc_html__('Elements Shows From Left Side', 'gotravel')   => 'mkdf-element-from-left',
							esc_html__('Elements Shows From Right Side', 'gotravel')  => 'mkdf-element-from-right',
							esc_html__('Elements Shows From Top Side', 'gotravel')    => 'mkdf-element-from-top',
							esc_html__('Elements Shows From Bottom Side', 'gotravel') => 'mkdf-element-from-bottom',
							esc_html__('Elements Shows From Fade', 'gotravel')        => 'mkdf-element-from-fade'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Animation Delay (ms)', 'gotravel'),
						'param_name'  => 'animation_delay'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Animation Speed (ms)', 'gotravel'),
						'param_name'  => 'animation_speed'
					)
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'css_animation'   => '',
			'animation_delay' => '',
			'animation_speed' => '500'
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;
		$params['class']   = array(
			'mkdf-animations-holder',
			$params['css_animation']
		);

		$params['style'] = $this->getHolderStyles($params);
		$params['data']  = array(
			'data-animation' => $params['css_animation']
		);

		return gotravel_mikado_get_shortcode_module_template_part('templates/animations-holder-template', 'animations-holder', '', $params);
	}

	private function getHolderStyles($params) {
		$styles = array();

		if($params['animation_delay'] !== '') {
			$styles[] = 'transition-delay: '.$params['animation_delay'].'ms';
			$styles[] = '-webkit-animation-delay: '.$params['animation_delay'].'ms';
			$styles[] = 'animation-delay: '.$params['animation_delay'].'ms';
		}

		if($params['animation_speed'] !== '') {
			$styles[] = 'animation-duration: '.$params['animation_speed'].'ms';
			$styles[] = '-webkit-animation-duration: '.$params['animation_speed'].'ms';
			$styles[] = '-moz-animation-duration: '.$params['animation_speed'].'ms';
		}

		return $styles;
	}
}