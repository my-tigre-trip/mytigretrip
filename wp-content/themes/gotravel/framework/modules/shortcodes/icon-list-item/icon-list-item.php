<?php
namespace GoTravel\Modules\Shortcodes\IconListItem;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */
class IconListItem implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_icon_list_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		vc_map(array(
			'name'     => esc_html__('Mikado Icon List Item', 'gotravel'),
			'base'     => $this->base,
			'icon'     => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'gotravel'),
			'params'   => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Icon List Type', 'gotravel'),
						'param_name'  => 'list_type',
						'value' => array(
							esc_html__('Default', 'gotravel') => '',
							esc_html__('With Dividers', 'gotravel') => 'with-dividers'
						)
					),
				),
				\GoTravelMikadoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Icon Size (px)', 'gotravel'),
						'param_name'  => 'icon_size'
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Color', 'gotravel'),
						'param_name'  => 'icon_color'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title', 'gotravel'),
						'param_name'  => 'title'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title Size (px)', 'gotravel'),
						'param_name'  => 'title_size',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title Line Height (px)', 'gotravel'),
						'param_name'  => 'title_line_height',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Title Color', 'gotravel'),
						'param_name'  => 'title_color',
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Title Font Weight', 'gotravel'),
						'param_name'  => 'title_font_weight',
						'value'       => array_flip(gotravel_mikado_get_font_weight_array(true)),
						'dependency'  => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Spacing between Title and Icon (px)', 'gotravel'),
						'param_name'  => 'space_title_and_icon'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Margin Bottom (px)', 'gotravel'),
						'param_name'  => 'margin_bottom'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Link', 'gotravel'),
						'param_name'  => 'link'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Link Target', 'gotravel'),
						'param_name'  => 'link_target',
						'value' => array(
							esc_html__('Same Window', 'gotravel') => '_self',
							esc_html__('New Window', 'gotravel') => '_blank'
						),
						'dependency' => array('element' => 'link', 'not_empty' => true)
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'list_type'            => '',
			'icon_size'            => '',
			'icon_color'           => '',
			'title'                => '',
			'title_color'          => '',
			'title_size'           => '',
			'title_line_height'    => '',
			'title_font_weight'    => '',
			'space_title_and_icon' => '',
			'margin_bottom'        => '',
			'link'                 => '',
			'link_target'          => '_blank'
		);

		$args = array_merge($args, gotravel_mikado_icon_collections()->getShortcodeParams());

		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);
		
		$iconPackName = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses  = '';

		//generate icon holder classes
		$iconClasses .= 'mkdf-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];

		$params['icon_classes']             = $iconClasses;
		$params['icon']                     = !empty($iconPackName) ? $params[$iconPackName] : '';
		$params['icon_attributes']['style'] = $this->getIconStyle($params);
		
		
		$params['title_style']              = $this->getTitleStyle($params);

		$params['holder_classes'] = array('mkdf-icon-list-item');
		$params['holder_styles']  = array();

		if ($params['list_type'] !== ''){
			$params['holder_classes'][] = 'mkdf-il-'.$params['list_type'];
		}

		if($params['margin_bottom'] !== '') {
			$params['holder_styles'][] = 'margin-bottom: '.gotravel_mikado_filter_px($params['margin_bottom']).'px';
		}

		//Get HTML from template
		$html = gotravel_mikado_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);

		return $html;
	}

	/**
	 * Generates icon styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconStyle($params) {

		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:'.$params['icon_color'];
		}

		if(!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:'.gotravel_mikado_filter_px($params['icon_size']).'px';
		}

		return implode(';', $iconStylesArray);
	}

	/**
	 * Generates title styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyle($params) {
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:'.$params['title_color'];
		}

		if(!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:'.gotravel_mikado_filter_px($params['title_size']).'px';
		}

		if(!empty($params['title_line_height'])) {
			$titleStylesArray[] = 'line-height:'.gotravel_mikado_filter_px($params['title_line_height']).'px';
		}

		if(!empty($params['title_font_weight'])) {
			$titleStylesArray[] = 'font-weight: '.$params['title_font_weight'];
		}

		if(!empty($params['space_title_and_icon'])) {
			$titleStylesArray[] = 'padding-left: '.gotravel_mikado_filter_px($params['space_title_and_icon']).'px';
		}

		return implode(';', $titleStylesArray);
	}

}