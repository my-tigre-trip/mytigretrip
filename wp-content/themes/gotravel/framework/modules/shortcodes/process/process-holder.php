<?php
namespace GoTravel\Modules\Shortcodes\Process;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessHolder implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_process_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Mikado Process', 'gotravel'),
			'base'                    => $this->getBase(),
			'as_parent'               => array('only' => 'mkdf_process_item'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => esc_html__('by MIKADO', 'gotravel'),
			'icon'                    => 'icon-wpb-process extended-custom-icon',
			'js_view'                 => 'VcColumnView',
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'param_name'  => 'number_of_items',
					'heading'     => esc_html__('Number of Process Items', 'gotravel'),
					'value'       => array(
						esc_html__('Three', 'gotravel') => 'three',
						esc_html__('Four', 'gotravel')  => 'four'
					),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number_of_items' => ''
		);

		$params            = shortcode_atts($default_atts, $atts);
		$params['content'] = $content;

		$params['holder_classes'] = array(
			'mkdf-process-holder',
			'mkdf-process-holder-items-'.$params['number_of_items']
		);

		return gotravel_mikado_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
	}
}