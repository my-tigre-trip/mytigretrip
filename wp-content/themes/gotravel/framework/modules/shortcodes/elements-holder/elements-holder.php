<?php
namespace GoTravel\Modules\Shortcodes\ElementsHolder;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolder implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_elements_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Mikado Elements Holder', 'gotravel'),
			'base' => $this->base,
			'icon' => 'icon-wpb-elements-holder extended-custom-icon',
			'category' => esc_html__('by MIKADO', 'gotravel'),
			'as_parent' => array('only' => 'mkdf_elements_holder_item'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'       => 'colorpicker',
					'param_name' => 'background_color',
					'heading'    => esc_html__('Background Color', 'gotravel')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'number_of_columns',
					'heading'    => esc_html__('Columns', 'gotravel'),
					'value'      => array(
						esc_html__('1 Column', 'gotravel')  => 'one-column',
						esc_html__('2 Columns', 'gotravel') => 'two-columns',
						esc_html__('3 Columns', 'gotravel') => 'three-columns',
						esc_html__('4 Columns', 'gotravel') => 'four-columns',
						esc_html__('5 Columns', 'gotravel') => 'five-columns',
						esc_html__('6 Columns', 'gotravel') => 'six-columns'
					)
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'items_float_left',
					'heading'    => esc_html__('Items Float Left', 'gotravel'),
					'value'      => array('Make Items Float Left?' => 'yes')
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'switch_to_one_column',
					'heading'    => esc_html__('Switch to One Column', 'gotravel'),
					'value'      => array(
						esc_html__('Default', 'gotravel')   	=> '',
						esc_html__('Below 1280px', 'gotravel') 	=> '1280',
						esc_html__('Below 1024px', 'gotravel')  => '1024',
						esc_html__('Below 768px', 'gotravel')   => '768',
						esc_html__('Below 600px', 'gotravel')   => '600',
						esc_html__('Below 480px', 'gotravel')   => '480',
						esc_html__('Never', 'gotravel')    		=> 'never'
					),
					'description' => esc_html__('Choose on which stage item will be in one column', 'gotravel'),
					'save_always' => true
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'alignment_one_column',
					'heading'    => esc_html__('Choose Alignment In Responsive Mode', 'gotravel'),
					'value'      => array(
						esc_html__('Default', 'gotravel') => '',
						esc_html__('Left', 'gotravel') 	  => 'left',
						esc_html__('Center', 'gotravel')  => 'center',
						esc_html__('Right', 'gotravel')   => 'right'
					),
					'description' => esc_html__('Alignment When Items are in One Column', 'gotravel'),
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'number_of_columns' 		=> '',
			'switch_to_one_column'		=> '',
			'alignment_one_column' 		=> '',
			'items_float_left' 			=> '',
			'background_color' 			=> ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';

		$elements_holder_classes = array();
		$elements_holder_classes[] = 'mkdf-elements-holder';
		$elements_holder_style = '';

		if($number_of_columns != ''){
			$elements_holder_classes[] .= 'mkdf-'.$number_of_columns ;
		}

		if($switch_to_one_column != ''){
			$elements_holder_classes[] = 'mkdf-responsive-mode-' . $switch_to_one_column ;
		} else {
			$elements_holder_classes[] = 'mkdf-responsive-mode-768' ;
		}

		if($alignment_one_column != ''){
			$elements_holder_classes[] = 'mkdf-one-column-alignment-' . $alignment_one_column ;
		}

		if($items_float_left !== ''){
			$elements_holder_classes[] = 'mkdf-ehi-float';
		}

		if($background_color != ''){
			$elements_holder_style .= 'background-color:'. $background_color . ';';
		}

		$elements_holder_class = implode(' ', $elements_holder_classes);

		$html .= '<div ' . gotravel_mikado_get_class_attribute($elements_holder_class) . ' ' . gotravel_mikado_get_inline_attr($elements_holder_style, 'style'). '>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}
