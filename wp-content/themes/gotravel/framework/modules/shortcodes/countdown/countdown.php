<?php
namespace GoTravel\Modules\Shortcodes\Countdown;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Countdown
 */
class Countdown implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkdf_countdown';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Countdown', 'gotravel'),
			'base' => $this->getBase(),
			'category' => esc_html__('by MIKADO', 'gotravel'),
			'admin_enqueue_css' => array(gotravel_mikado_get_skin_uri().'/assets/css/mkdf-vc-extend.css'),
			'icon' => 'icon-wpb-countdown extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'       => 'dropdown',
					'param_name' => 'skin',
					'heading'    => esc_html__('Skin', 'gotravel'),
					'value'      => array(
						esc_html__('Dark', 'gotravel') => '',
						esc_html__('Light', 'gotravel') => 'light',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Year', 'gotravel'),
					'param_name' => 'year',
					'value' => array(
						'' => '',
						'2016' => '2016',
						'2017' => '2017',
						'2018' => '2018',
						'2019' => '2019',
						'2020' => '2020'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Month', 'gotravel'),
					'param_name' => 'month',
					'value' => array(
						'' => '',
						'January' => '1',
						'February' => '2',
						'March' => '3',
						'April' => '4',
						'May' => '5',
						'June' => '6',
						'July' => '7',
						'August' => '8',
						'September' => '9',
						'October' => '10',
						'November' => '11',
						'December' => '12'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Day', 'gotravel'),
					'param_name' => 'day',
					'value' => array(
						'' => '',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Hour', 'gotravel'),
					'param_name' => 'hour',
					'value' => array(
						'' => '',
						'0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Minute', 'gotravel'),
					'param_name' => 'minute',
					'value' => array(
						'' => '',
						'0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						'32' => '32',
						'33' => '33',
						'34' => '34',
						'35' => '35',
						'36' => '36',
						'37' => '37',
						'38' => '38',
						'39' => '39',
						'40' => '40',
						'41' => '41',
						'42' => '42',
						'43' => '43',
						'44' => '44',
						'45' => '45',
						'46' => '46',
						'47' => '47',
						'48' => '48',
						'49' => '49',
						'50' => '50',
						'51' => '51',
						'52' => '52',
						'53' => '53',
						'54' => '54',
						'55' => '55',
						'56' => '56',
						'57' => '57',
						'58' => '58',
						'59' => '59',
						'60' => '60',
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Month Label', 'gotravel'),
					'param_name' => 'month_label'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Day Label', 'gotravel'),
					'param_name' => 'day_label'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Hour Label', 'gotravel'),
					'param_name' => 'hour_label'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Minute Label', 'gotravel'),
					'param_name' => 'minute_label'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Second Label', 'gotravel'),
					'param_name' => 'second_label'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Digit Font Size (px)', 'gotravel'),
					'param_name' => 'digit_font_size',
					'group' => esc_html__('Design Options', 'gotravel')
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Label Font Size (px)', 'gotravel'),
					'param_name' => 'label_font_size',
					'group' => esc_html__('Design Options', 'gotravel')
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
	public function render($atts, $content = null)	{
		$args = array(
			'skin' => '',
			'year' => '',
			'month' => '', 
			'day' => '',
			'hour' => '',
			'minute' => '',
			'month_label' => 'Months',
			'day_label' => 'Days',
			'hour_label' => 'Hours',
			'minute_label' => 'Minutes',
			'second_label' => 'Seconds',
			'digit_font_size' => '',
			'label_font_size' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['id'] = mt_rand(1000, 9999);
		$params['holder_classes'] = $this->getHolderClasses($params);

		//Get HTML from template
		$html = gotravel_mikado_get_shortcode_module_template_part('templates/countdown-template', 'countdown', '', $params);

		return $html;
	}

	/**
	 * Return Classes for Countdown
	 *
	 * @param $params
	 * @return string
	 */
	private function getHolderClasses($params) {
		return !empty($params['skin']) ? $params['skin'] : '';
	}
}