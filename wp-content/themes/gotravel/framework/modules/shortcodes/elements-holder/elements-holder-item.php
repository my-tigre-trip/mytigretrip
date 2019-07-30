<?php
namespace GoTravel\Modules\Shortcodes\ElementsHolderItem;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolderItem implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'mkdf_elements_holder_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Mikado Elements Holder Item', 'gotravel'),
					'base' => $this->base,
					'as_child' => array('only' => 'mkdf_elements_holder'),
					'as_parent' => array('except' => 'vc_row, vc_accordion'),
					'content_element' => true,
					'category' => esc_html__('by MIKADO', 'gotravel'),
					'icon' => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__('Background Color', 'gotravel')
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__('Background Image', 'gotravel')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__('Padding', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel')
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_aligment',
							'heading'    => esc_html__('Horizontal Alignment', 'gotravel'),
							'value'      => array(
								esc_html__('Left', 'gotravel')    	=> 'left',
								esc_html__('Right', 'gotravel')     => 'right',
								esc_html__('Center', 'gotravel')    => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__('Vertical Alignment', 'gotravel'),
							'value'      => array(
								esc_html__('Middle', 'gotravel')    => 'middle',
								esc_html__('Top', 'gotravel')    	=> 'top',
								esc_html__('Bottom', 'gotravel')    => 'bottom'
							)
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_1280_1600',
                            'heading'     => esc_html__('Padding on screen size between 1280px-1600px', 'gotravel'),
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
                            'group'       => esc_html__('Width & Responsiveness', 'gotravel')
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1024_1280',
							'heading'     => esc_html__('Padding on screen size between 1024px-1280px', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
							'group'       => esc_html__('Width & Responsiveness', 'gotravel')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_768_1024',
							'heading'     => esc_html__('Padding on screen size between 768px-1024px', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
							'group'       => esc_html__('Width & Responsiveness', 'gotravel')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_600_768',
							'heading'     => esc_html__('Padding on screen size between 600px-768px', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
							'group'       => esc_html__('Width & Responsiveness', 'gotravel')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480_600',
							'heading'     => esc_html__('Padding on screen size between 480px-600px', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
							'group'       => esc_html__('Width & Responsiveness', 'gotravel')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_480',
							'heading'     => esc_html__('Padding on Screen Size Bellow 480px', 'gotravel'),
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'gotravel'),
							'group'       => esc_html__('Width & Responsiveness', 'gotravel')
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_color' => '',
			'background_image' => '',
			'item_padding' => '',
			'horizontal_aligment' => '',
			'vertical_alignment' => '',
            'item_padding_1280_1600' => '',
			'item_padding_1024_1280' => '',
			'item_padding_768_1024' => '',
			'item_padding_600_768' => '',
			'item_padding_480_600' => '',
			'item_padding_480' => ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$rand_class = 'mkdf-eh-custom-' . mt_rand(100000,1000000);

		$params['elements_holder_item_style'] = $this->getElementsHolderItemStyles($params);
		$params['elements_holder_item_content_style'] = $this->getElementsHolderItemContentStyles($params);
		$params['elements_holder_item_class'] = $this->getElementsHolderItemClass($params);
		$params['elements_holder_item_content_class'] = $rand_class;
		$params['elements_holder_item_responsive_data'] = $this->getElementsHolderItemContentResponsiveData($params);

		$html = gotravel_mikado_get_shortcode_module_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

		return $html;
	}
	
	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemStyles($params) {
		$styles = array();

		if ($params['background_color'] !== '') {
			$styles[] = 'background-color: '.$params['background_color'];
		}
		
		if ($params['background_image'] !== '') {
			$styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentStyles($params) {
		$styles = array();

		if ($params['item_padding'] !== '') {
			$styles[] = 'padding: '.$params['item_padding'];
		}

		return implode(';', $styles);
	}

	/**
	 * Return Elements Holder Item classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemClass($params) {

		$element_holder_item_class = array();

		if ($params['vertical_alignment'] !== '') {
			$element_holder_item_class[] = 'mkdf-vertical-alignment-'. $params['vertical_alignment'];
		}

		if ($params['horizontal_aligment'] !== '') {
			$element_holder_item_class[] = 'mkdf-horizontal-alignment-'. $params['horizontal_aligment'];
		}
		
		return implode(' ', $element_holder_item_class);
	}

	/**
	 * Return Elements Holder Item Content Responssive data
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentResponsiveData($params) {

		$data = array();
		$data['data-item-class'] = $params['elements_holder_item_content_class'];

		if ($params['item_padding_1280_1600'] !== '') {
			$data['data-1280-1600'] = $params['item_padding_1280_1600'];
		}

		if ($params['item_padding_1024_1280'] !== '') {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}

		if ($params['item_padding_768_1024'] !== '') {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}

		if ($params['item_padding_600_768'] !== '') {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}

		if ($params['item_padding_480_600'] !== '') {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}

		if ($params['item_padding_480'] !== '') {
			$data['data-480'] = $params['item_padding_480'];
		}

		return $data;
	}
}
