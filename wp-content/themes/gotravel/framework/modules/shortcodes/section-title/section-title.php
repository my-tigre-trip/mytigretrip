<?php
namespace GoTravel\Modules\Shortcodes\SectionTitle;

use GoTravel\Modules\Shortcodes\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;

	/**
	 * SectionTitle constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_section_title';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Section Title', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-section-title extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Color', 'gotravel'),
					'param_name'  => 'title_color'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Text Transform', 'gotravel'),
					'param_name'  => 'title_text_transform',
					'value'       => array_flip(gotravel_mikado_get_text_transform_array(true)),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Text Align', 'gotravel'),
					'param_name'  => 'title_text_align',
					'value'       => array(
						esc_html__('Default', 'gotravel')       => '',
						esc_html__('Center', 'gotravel') => 'center',
						esc_html__('Left', 'gotravel')   => 'left',
						esc_html__('Right', 'gotravel')  => 'right'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Margin Bottom', 'gotravel'),
					'param_name'  => 'margin_bottom'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Size', 'gotravel'),
					'param_name'  => 'title_size',
					'value'       => array(
						esc_html__('Default', 'gotravel') => '',
						esc_html__('Small', 'gotravel')   => 'small',
						esc_html__('Medium', 'gotravel')  => 'medium',
						esc_html__('Large', 'gotravel')   => 'large'
					),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'                => '',
			'title_color'          => '',
			'title_size'           => '',
			'title_text_transform' => '',
			'title_text_align'     => '',
			'margin_bottom'        => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		if($params['title'] !== '') {
			$params['section_title_classes'] = array('mkdf-section-title');

			if($params['title_size'] !== '') {
				$params['section_title_classes'][] = 'mkdf-section-title-'.$params['title_size'];
			}

			$params['section_title_styles'] = array();

			if($params['title_color'] !== '') {
				$params['section_title_styles'][] = 'color: '.$params['title_color'];
			}

			if($params['title_text_transform'] !== '') {
				$params['section_title_styles'][] = 'text-transform: '.$params['title_text_transform'];
			}

			if($params['title_text_align'] !== '') {
				$params['section_title_styles'][] = 'text-align: '.$params['title_text_align'];
			}

			if($params['margin_bottom'] !== '') {
				$params['section_title_styles'][] = 'margin-bottom: '.gotravel_mikado_filter_px($params['margin_bottom']).'px';
			}

			$params['title_tag'] = $this->getTitleTag($params);

			return gotravel_mikado_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);
		}
	}

	private function getTitleTag($params) {
		switch($params['title_size']) {
			default:
				$titleTag = 'h1';
		}

		return $titleTag;
	}
}