<?php
namespace GoTravel\Modules\Shortcodes\IconProgressBar;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class IconProgressBar implements ShortcodeInterface {
	private $base;

	/**
	 * IconProgressBar constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_icon_progress_bar';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'     => esc_html__('Mikado Icon Progress Bar', 'gotravel'),
			'base'     => $this->base,
			'category' => esc_html__('by MIKADO', 'gotravel'),
			'icon'     => 'icon-wpb-icon-progress-bar  extended-custom-icon',
			'params'   => array_merge(
				gotravel_mikado_icon_collections()->getVCParamsArray(),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Number of Icons', 'gotravel'),
						'param_name'  => 'number_of_icons'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Number of Active Icons', 'gotravel'),
						'param_name'  => 'number_of_active_icons'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Size', 'gotravel'),
						'param_name'  => 'size',
						'value'       => array(
							esc_html__('Tiny', 'gotravel')       => 'mkdf-icon-tiny',
							esc_html__('Small', 'gotravel')      => 'mkdf-icon-small',
							esc_html__('Medium', 'gotravel')     => 'mkdf-icon-medium',
							esc_html__('Large', 'gotravel')      => 'mkdf-icon-large',
							esc_html__('Very Large', 'gotravel') => 'mkdf-icon-huge'
						),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Custom Icon Size (px)', 'gotravel'),
						'param_name'  => 'custom_icon_size'
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Color', 'gotravel'),
						'param_name'  => 'icon_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Active Icon Color', 'gotravel'),
						'param_name'  => 'active_icon_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Spacing Between Icons (px)', 'gotravel'),
						'param_name'  => 'spacing_between_icons',
						'group'       => esc_html__('Design Options', 'gotravel')
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number_of_icons'        => '',
			'number_of_active_icons' => '',
			'size'                   => '',
			'custom_icon_size'       => '',
			'icon_color'             => '',
			'active_icon_color'      => '',
			'spacing_between_icons'  => ''
		);

		$default_atts = array_merge($default_atts, gotravel_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$iconPackName = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

		$params['icon']           = $params[$iconPackName];
		$params['data']           = $this->getDataAttrs($params);
		$params['icon_styles']    = $this->getIconStyles($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

		return gotravel_mikado_get_shortcode_module_template_part('templates/icon-progress-bar-template', 'icon-progress-bar', '', $params);
	}

	private function getDataAttrs($params) {
		$data = array();

		if($params['number_of_active_icons'] !== '') {
			$data['data-number-of-active-icons'] = $params['number_of_active_icons'];
		}

		if($params['active_icon_color'] !== '') {
			$data['data-icon-active-color'] = $params['active_icon_color'];
		}

		return $data;
	}

	private function getIconStyles($params) {
		$styles = array();

		if($params['icon_color'] !== '') {
			$styles[] = 'color: '.$params['icon_color'];
		}

		if($params['custom_icon_size'] !== '') {
			$styles[] = 'font-size: '.gotravel_mikado_filter_px($params['custom_icon_size']).'px';
		}

		if($params['spacing_between_icons'] !== '') {
			$styles[] = 'margin-right: '.gotravel_mikado_filter_px($params['spacing_between_icons']).'px';
		}

		return implode(';', $styles);
	}

	private function getHolderClasses($params) {
		$classes = array('mkdf-icon-progress-bar');

		if($params['size'] !== '') {
			$classes[] = $params['size'];
		}

		return $classes;
	}
}