<?php
namespace GoTravel\Modules\Shortcodes\Button;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class Button that represents button shortcode
 * @package GoTravel\Modules\Shortcodes\Button
 */
class Button implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * Sets base attribute and registers shortcode with Visual Composer
	 */
	public function __construct() {
		$this->base = 'mkdf_button';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base attribute
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Button', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-button extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Size', 'gotravel'),
						'param_name'  => 'size',
						'value'       => array(
							esc_html__('Default', 'gotravel')              => '',
							esc_html__('Small', 'gotravel')                  => 'small',
							esc_html__('Medium', 'gotravel')                 => 'medium',
							esc_html__('Large', 'gotravel')                  => 'large',
							esc_html__('Extra Large', 'gotravel')           => 'huge',
							esc_html__('Extra Large Full Width', 'gotravel') => 'huge-full-width'
						),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Type', 'gotravel'),
						'param_name'  => 'type',
						'value'       => array_flip(gotravel_mikado_get_btn_types(true)),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Hover Type', 'gotravel'),
						'param_name'  => 'hover_type',
						'value'       => array_flip(gotravel_mikado_get_btn_types(true)),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Text', 'gotravel'),
						'param_name'  => 'text'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Link', 'gotravel'),
						'param_name'  => 'link'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Link Target', 'gotravel'),
						'param_name'  => 'target',
						'value'       => array(
							esc_html__('Same Window', 'gotravel')  => '_self',
							esc_html__('New Window', 'gotravel') => '_blank'
						),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Custom CSS Class', 'gotravel'),
						'param_name'  => 'custom_class'
					)
				),
				gotravel_mikado_icon_collections()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Hover Animation', 'gotravel'),
						'param_name'  => 'hover_animation',
						'value'       => array_flip(gotravel_mikado_get_btn_hover_animation_types(true)),
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Color', 'gotravel'),
						'param_name'  => 'color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Hover Color', 'gotravel'),
						'param_name'  => 'hover_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Background Color', 'gotravel'),
						'param_name'  => 'background_color',
						'dependency'  => array('element' => 'type', 'value' => array('solid','')),
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Hover Background Color', 'gotravel'),
						'param_name'  => 'hover_background_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Border Color', 'gotravel'),
						'param_name'  => 'border_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Hover Border Color', 'gotravel'),
						'param_name'  => 'hover_border_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Font Size (px)', 'gotravel'),
						'param_name'  => 'font_size',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Font Weight', 'gotravel'),
						'param_name'  => 'font_weight',
						'value'       => array_flip(gotravel_mikado_get_font_weight_array(true)),
						'group'       => esc_html__('Design Options', 'gotravel'),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Margin', 'gotravel'),
						'param_name'  => 'margin',
						'description' => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'gotravel'),
						'group'       => esc_html__('Design Options', 'gotravel')
					)
				)
			)
		));
	}

	/**
	 * Renders HTML for button shortcode
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => '',
			'hover_type'             => '',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'font_size'              => '',
			'font_weight'            => '',
			'margin'                 => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'hover_animation'        => '',
			'custom_attrs'           => array()
		);

		$default_atts = array_merge($default_atts, gotravel_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		if($params['html_type'] !== 'input') {
			$iconPackName   = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
			$params['icon'] = $iconPackName ? $params[$iconPackName] : '';
		}

		$params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
		$params['type'] = !empty($params['type']) ? $params['type'] : 'solid';


		$params['link']   = !empty($params['link']) ? $params['link'] : '#';
		$params['target'] = !empty($params['target']) ? $params['target'] : '_self';

		$params['hover_animation'] = $this->getHoverAnimation($params);

		//prepare params for template
		$params['button_classes']      = $this->getButtonClasses($params);
		$params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles($params);
		$params['button_data']         = $this->getButtonDataAttr($params);
		$params['show_icon']           = !empty($params['icon']);
		$params['display_helper']      = $params['hover_animation'] !== '' && ($params['hover_type'] !== 'outline' || $params['hover_type'] !== 'white-outline');
		$params['helper_styles']       = $this->getHelperStyles($params);

		return gotravel_mikado_get_shortcode_module_template_part('templates/'.$params['html_type'], 'button', '', $params);
	}

	/**
	 * Returns array of button styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonStyles($params) {
		$styles = array();

		if(!empty($params['color'])) {
			$styles[] = 'color: '.$params['color'];
		}

		if(!empty($params['background_color']) && $params['type'] !== 'outline') {
			$styles[] = 'background-color: '.$params['background_color'];
		}

		if(!empty($params['border_color'])) {
			$styles[] = 'border-color: '.$params['border_color'];
		}

		if(!empty($params['font_size'])) {
			$styles[] = 'font-size: '.gotravel_mikado_filter_px($params['font_size']).'px';
		}

		if(!empty($params['font_weight'])) {
			$styles[] = 'font-weight: '.$params['font_weight'];
		}

		if(!empty($params['margin'])) {
			$styles[] = 'margin: '.$params['margin'];
		}

		return $styles;
	}

	/**
	 *
	 * Returns array of button data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonDataAttr($params) {
		$data = array();

		if(!empty($params['hover_background_color']) && ($params['hover_animation'] === '' || $params['hover_animation'] === 'disable')) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}

		if(!empty($params['hover_color'])) {
			$data['data-hover-color'] = $params['hover_color'];
		}

		if(!empty($params['hover_color'])) {
			$data['data-hover-color'] = $params['hover_color'];
		}

		if(!empty($params['hover_border_color'])) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}

		return $data;
	}

	/**
	 * Returns array of HTML classes for button
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonClasses($params) {
		$buttonClasses = array(
			'mkdf-btn',
			'mkdf-btn-'.$params['size'],
			'mkdf-btn-'.$params['type']
		);

		if(!empty($params['hover_background_color'])) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-bg';
		}

		if(!empty($params['hover_border_color'])) {
			$buttonClasses[] = 'mkdf-btn-custom-border-hover';
		}

		if(!empty($params['hover_color'])) {
			$buttonClasses[] = 'mkdf-btn-custom-hover-color';
		}

		if(!empty($params['icon'])) {
			$buttonClasses[] = 'mkdf-btn-icon';
		}

		if(!empty($params['custom_class'])) {
			$buttonClasses[] = $params['custom_class'];
		}

		if(!empty($params['hover_animation']) && $params['hover_animation'] !== 'disable') {
			$buttonClasses[] = 'mkdf-btn-'.$params['hover_animation'];
			$buttonClasses[] = 'mkdf-btn-with-animation';
		}

		$hoverType       = $this->getHoverStyle($params);
		$buttonClasses[] = 'mkdf-btn-hover-'.$hoverType;

		return $buttonClasses;
	}

	private function getHoverStyle($params) {
		if(!empty($params['hover_type'])) {
			$hoverType = $params['hover_type'];
		} else {
			$hoverType = 'solid';
		}

		return $hoverType;
	}

	private function getHoverAnimation($params) {
		if(!empty($params['hover_animation']) && ($params['hover_type'] !== 'outline' || $params['hover_type'] !== 'white-outline')) {
			return $params['hover_animation'];
		}

		return gotravel_mikado_options()->getOptionValue('button_hover_animation');
	}

	private function getHelperStyles($params) {
		$styles = array();

		if($params['display_helper']) {
			if(!empty($params['hover_background_color'])) {
				$styles[] = 'background-color: '.$params['hover_background_color'];
			}
		}

		return $styles;
	}
}