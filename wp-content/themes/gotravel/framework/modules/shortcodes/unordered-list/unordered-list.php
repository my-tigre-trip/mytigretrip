<?php
namespace GoTravel\Modules\Shortcodes\UnorderedList;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class unordered List
 */
class UnorderedList implements ShortcodeInterface {

	private $base;

	function __construct() {
		$this->base = 'mkdf_unordered_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**\
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado List - Unordered', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-unordered-list extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Style', 'gotravel'),
					'param_name'  => 'style',
					'value'       => array(
						esc_html__('Circle', 'gotravel') => 'circle',
						esc_html__('Line', 'gotravel')   => 'line'
					)
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Animate List', 'gotravel'),
					'param_name'  => 'animate',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Padding left (px)', 'gotravel'),
					'param_name' => 'padding_left'
				),
				array(
					'type'        => 'textarea_html',
					'heading'     => esc_html__('Content', 'gotravel'),
					'param_name'  => 'content',
					'value'       => '<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>'
				)
			)
		));
	}
	
	public function render($atts, $content = null) {
		$args   = array(
			'style'        => '',
			'animate'      => '',
			'padding_left' => ''
		);
		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);

		$list_item_classes = "";

		if($style != '') {
			if($style == 'circle') {
				$list_item_classes .= ' mkdf-circle';
			} elseif($style == 'line') {
				$list_item_classes .= ' mkdf-line';
			}
		}

		if($animate == 'yes') {
			$list_item_classes .= ' mkdf-animate-list';
		}

		$list_style = '';
		if($padding_left != '') {
			$list_style .= 'padding-left: '.$padding_left.'px;';
		}
		$html = '';
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$html .= '<div class="mkdf-unordered-list '.$list_item_classes.'" '.gotravel_mikado_get_inline_style($list_style).'>';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}

}