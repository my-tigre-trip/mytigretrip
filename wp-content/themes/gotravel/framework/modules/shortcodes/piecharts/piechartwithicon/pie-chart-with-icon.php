<?php
namespace GoTravel\Modules\Shortcodes\PieCharts\PieChartWithIcon;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class PieChartWithIcon implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkdf_pie_chart_with_icon';

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
		vc_map( array(
			'name' => esc_html__('Mikado Pie Chart With Icon', 'gotravel'),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-pie-chart-with-icon extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Percentage', 'gotravel'),
						'param_name' => 'percent'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Size (px)', 'gotravel'),
						'param_name' => 'size',
						'group' => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Active Color', 'gotravel'),
						'param_name'  => 'active_color',
						'group'       => esc_html__('Design Options', 'gotravel'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Inactive Color', 'gotravel'),
						'param_name'  => 'inactive_color',
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Margin below chart (px)', 'gotravel'),
						'param_name' => 'margin_below_chart',
						'group' => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'gotravel'),
						'param_name' => 'title'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Title Tag', 'gotravel'),
						'param_name' => 'title_tag',
						'value'       => array_flip(gotravel_mikado_get_title_tag(true)),
						'dependency' => array('element' => 'title', 'not_empty' => true)
					),
				),
				gotravel_mikado_icon_collections()->getVCParamsArray(),
				array(
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__('Icon Color', 'gotravel'),
						'param_name' => 'icon_color',
						'dependency' => Array('element' => 'icon_pack', 'value' => gotravel_mikado_icon_collections()->getIconCollectionsKeys()),
						'group' => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Icon Size (px)', 'gotravel'),
						'param_name' => 'icon_custom_size',
						'dependency' => Array('element' => 'icon_pack', 'value' => gotravel_mikado_icon_collections()->getIconCollectionsKeys()),
						'group' => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Typography Style', 'gotravel'),
						'param_name'  => 'typography_style',
						'value'       => array(
							esc_html__('Dark', 'gotravel')  => 'dark',
							esc_html__('Light', 'gotravel') => 'light'
						),
						'group'       => esc_html__('Design Options', 'gotravel')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Text', 'gotravel'),
						'param_name' => 'text'
					)
				)
			)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'size'               => '',
			'percent'            => '',
			'icon_color'         => '',
			'icon_custom_size'   => '',
			'title'              => '',
			'title_tag'          => 'h4',
			'text'               => '',
			'margin_below_chart' => '',
		    'active_color'       => '#00bdbb',
			'inactive_color'     => '#ebebeb',
			'typography_style'   => 'dark'
		);

		$args = array_merge($args, gotravel_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['active_color'] = !empty($params['active_color']) ? $params['active_color'] : $args['active_color'];

		$params['title_tag']       = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];
		$params['pie_chart_data']  = $this->getPieChartData($params);
		$params['pie_chart_style'] = $this->getPieChartStyle($params);
		$params['data_attr']       = $this->getDataParams($params);
		$params['icon']            = $this->getPieChartIcon($params);
		$params['holder_classes']  = $this->getHolderClasses($params);

		$html = gotravel_mikado_get_shortcode_module_template_part('templates/pie-chart-with-icon', 'piecharts/piechartwithicon', '', $params);

		return $html;
	}

	/**
	 * Return Pie Chart icon style for icon getPieChartIcon() method
	 *
	 * @param $params
	 * @return string
	 */
	private function getIconStyles($params) {

		$iconStyles = array();

		if ($params['icon_color'] !== '') {
			$iconStyles[] = 'color: ' . $params['icon_color'];
		}

		if ($params['icon_custom_size'] !== '') {
			$iconStyles[] = 'font-size: ' . $params['icon_custom_size'] . 'px';
		}

		return implode(';', $iconStyles);

	}

	/**
	 * Return Pie Chart style
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartStyle($params) {

		$pieChartStyle = array();

		if ($params['margin_below_chart'] !== '') {
			$pieChartStyle[] = 'margin-top: ' . $params['margin_below_chart'] . 'px';
		}

		return $pieChartStyle;

	}

	private function getDataParams($params) {

		$data_attr = array();

		if($params['active_color'] !== '') {
			$data_attr['data-bar-color'] = $params['active_color'];
		}

		if($params['inactive_color'] !== '') {
			$data_attr['data-track-color'] = $params['inactive_color'];
		}

		if( $params['size'] !== '' ) {
			$data_attr['data-size'] = $params['size'];
		}

		return $data_attr;
	}

	/**
	 * Return data attributes for Pie Chart
	 *
	 * @param $params
	 * @return array
	 */
	private function getPieChartData($params) {

		$pieChartData = array();

		if( $params['percent'] !== '' ) {
			$pieChartData['data-percent'] = $params['percent'];
		}

		return $pieChartData;

	}

	/**
	 * Return Pie Chart Icon
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getPieChartIcon($params) {

		$icon = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconStyles = array();
		$iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);

		$pie_chart_icon = gotravel_mikado_icon_collections()->renderIcon( $params[$icon], $params['icon_pack'], $iconStyles );

		return $pie_chart_icon;

	}

	private function getHolderClasses($params) {
		$classes = array('mkdf-pie-chart-with-icon-holder');

		if(!empty($params['typography_style'])) {
			$classes[] = 'mkdf-pie-chart-typography-'.$params['typography_style'];
		}

		return $classes;
	}
}