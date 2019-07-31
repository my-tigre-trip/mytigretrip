<?php
namespace GoTravel\Modules\Shortcodes\WorkingHours;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class WorkingHours implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_working_hours';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Working Hours', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-working-hours extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'gotravel'),
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Working Hours Style', 'gotravel'),
					'param_name'  => 'style',
					'value'       => array(
						esc_html__('Dark', 'gotravel')  => 'dark',
						esc_html__('Light', 'gotravel') => 'light'
					),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Use Shortened Version?', 'gotravel'),
					'param_name'  => 'use_shortened_version',
					'admin_label' => true,
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false, true)),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Monday To Friday', 'gotravel'),
					'param_name'  => 'monday_to_friday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Weekend', 'gotravel'),
					'param_name'  => 'weekend',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Monday', 'gotravel'),
					'param_name'  => 'monday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Tuesday', 'gotravel'),
					'param_name'  => 'tuesday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Wednesday', 'gotravel'),
					'param_name'  => 'wednesday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Thursday', 'gotravel'),
					'param_name'  => 'thursday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Friday', 'gotravel'),
					'param_name'  => 'friday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Saturday', 'gotravel'),
					'param_name'  => 'saturday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Sunday', 'gotravel'),
					'param_name'  => 'sunday',
					'group'       => esc_html__('Settings', 'gotravel'),
					'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'title'                 => '',
			'style'                 => '',
			'use_shortened_version' => '',
			'monday_to_friday'      => '',
			'weekend'               => '',
			'monday'                => '',
			'tuesday'               => '',
			'wednesday'             => '',
			'thursday'              => '',
			'friday'                => '',
			'saturday'              => '',
			'sunday'                => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['working_hours']  = $this->getWorkingHours($params);
		$params['holder_classes'] = $this->getHolderClasses($params);

		return gotravel_mikado_get_shortcode_module_template_part('templates/working-hours-template', 'working-hours', '', $params);
	}

	private function getWorkingHours($params) {
		$workingHours = array();

		if(!empty($params['use_shortened_version']) && $params['use_shortened_version'] === 'yes') {
			if(!empty($params['monday_to_friday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Monday - Friday', 'gotravel'),
					'time'  => $params['monday_to_friday']
				);
			}

			if(!empty($params['weekend'])) {
				$workingHours[] = array(
					'label' => esc_html__('Saturday - Sunday', 'gotravel'),
					'time'  => $params['weekend']
				);
			}
		} else {
			if(!empty($params['monday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Monday', 'gotravel'),
					'time'  => $params['monday']
				);
			}

			if(!empty($params['tuesday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Tuesday', 'gotravel'),
					'time'  => $params['tuesday']
				);
			}

			if(!empty($params['wednesday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Wednesday', 'gotravel'),
					'time'  => $params['wednesday']
				);
			}

			if(!empty($params['thursday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Thursday', 'gotravel'),
					'time'  => $params['thursday']
				);
			}

			if(!empty($params['friday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Friday', 'gotravel'),
					'time'  => $params['friday']
				);
			}

			if(!empty($params['saturday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Saturday', 'gotravel'),
					'time'  => $params['saturday']
				);
			}

			if(!empty($params['sunday'])) {
				$workingHours[] = array(
					'label' => esc_html__('Sunday', 'gotravel'),
					'time'  => $params['sunday']
				);
			}
		}

		return $workingHours;
	}

	private function getHolderClasses($params) {
		$classes = array(
			'mkdf-working-hours-holder',
			'mkdf-working-hours-'.$params['style']
		);

		return $classes;
	}

}
