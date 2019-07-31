<?php
namespace GoTravel\Modules\Shortcodes\SectionSubtitle;

use GoTravel\Modules\Shortcodes\Lib;

class SectionSubtitle implements Lib\ShortcodeInterface {
	private $base;

	/**
	 * SectionSubtitle constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_section_subtitle';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Section Subtitle', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-section-subtitle extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Color', 'gotravel'),
					'param_name'  => 'color'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Text Align', 'gotravel'),
					'param_name'  => 'text_align',
					'value'       => array(
						esc_html__('Default', 'gotravel')       => '',
						esc_html__('Center', 'gotravel') => 'center',
						esc_html__('Left', 'gotravel')   => 'left',
						esc_html__('Right', 'gotravel')  => 'right'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Text', 'gotravel'),
					'param_name'  => 'text'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Width (%)', 'gotravel'),
					'param_name'  => 'width',
					'description' => esc_html__('Adjust the width of section subtitle in percentages. Ommit the unit', 'gotravel')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'text'       => '',
			'color'      => '',
			'text_align' => '',
			'width'      => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		if($params['text'] !== '') {

			$params['styles']  = array();
			$params['classes'] = array('mkdf-section-subtitle-holder');

			if($params['color'] !== '') {
				$params['styles'][] = 'color: '.$params['color'];
			}

			if($params['text_align'] !== '') {
				$params['styles'][] = 'text-align: '.$params['text_align'];

				$params['classes'][] = 'mkdf-section-subtitle-'.$params['text_align'];
			}

			$params['holder_styles'] = array();

			if($params['width'] !== '') {
				$params['holder_styles'][] = 'width: '.$params['width'].'%';
			}

			return gotravel_mikado_get_shortcode_module_template_part('templates/section-subtitle-template', 'section-subtitle', '', $params);
		}
	}
}
