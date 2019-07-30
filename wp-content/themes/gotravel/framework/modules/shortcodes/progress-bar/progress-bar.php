<?php
namespace GoTravel\Modules\Shortcodes\ProgressBar;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkdf_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Progress Bar', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-progress-bar extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Percentage', 'gotravel'),
					'param_name'  => 'percent'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Bar Color', 'gotravel'),
					'param_name'  => 'bar_color'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Inactive Bar Color', 'gotravel'),
					'param_name'  => 'inactive_bar_color'
				),
			)
		));
	}

	public function render($atts, $content = null) {
		$args   = array(
			'title'              => '',
			'percent'            => '100',
			'bar_color'          => '',
			'inactive_bar_color' => ''
		);
		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);

		$params['bar_styles']         = $this->getBarStyles($params);
		$params['inactive_bar_style'] = $this->getInactiveBarStyle($params);

		//init variables
		$html = gotravel_mikado_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);

		return $html;
	}

	private function getBarStyles($params) {
		$styles = array();

		if($params['bar_color'] !== '') {
			$styles[] = 'background-color: '.$params['bar_color'];
		}

		return $styles;
	}

	private function getInactiveBarStyle($params) {
		$style = array();

		if($params['inactive_bar_color'] !== '') {
			$style[] = 'background-color: '.$params['inactive_bar_color'];
		}

		return $style;
	}

}