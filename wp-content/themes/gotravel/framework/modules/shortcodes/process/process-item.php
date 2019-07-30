<?php
namespace GoTravel\Modules\Shortcodes\Process;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Mikado Process Item', 'gotravel'),
			'base'                    => $this->getBase(),
			'as_child'                => array('only' => 'mkdf_process_holder'),
			'category'                => esc_html__('by MIKADO', 'gotravel'),
			'icon'                    => 'icon-wpb-process-item extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__('Image', 'gotravel'),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Text', 'gotravel'),
					'param_name'  => 'text'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Highlight Item?', 'gotravel'),
					'param_name'  => 'highlighted',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false)),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'image'       => '',
			'title'       => '',
			'text'        => '',
			'highlighted' => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['item_classes'] = array(
			'mkdf-process-item-holder'
		);

		if($params['highlighted'] === 'yes') {
			$params['item_classes'][] = 'mkdf-pi-highlighted';
		}

		return gotravel_mikado_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
	}

}