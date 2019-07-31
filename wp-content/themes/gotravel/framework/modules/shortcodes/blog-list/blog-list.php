<?php

namespace GoTravel\Modules\Shortcodes\BlogList;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogList
 */
class BlogList implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_blog_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Blog List', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-list extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Type', 'gotravel'),
					'param_name'  => 'type',
					'value'       => array(
						esc_html__('Grid Type 1', 'gotravel')  => 'grid-type-1',
						esc_html__('Grid Type 2', 'gotravel')  => 'grid-type-2',
						esc_html__('Masonry', 'gotravel')      => 'masonry',
						esc_html__('Minimal', 'gotravel')      => 'minimal',
						esc_html__('Image in box', 'gotravel') => 'image-in-box'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Posts', 'gotravel'),
					'param_name'  => 'number_of_posts'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Number of Columns', 'gotravel'),
					'param_name'  => 'number_of_columns',
					'value'       => array(
						esc_html__('One', 'gotravel')   => '1',
						esc_html__('Two', 'gotravel')   => '2',
						esc_html__('Three', 'gotravel') => '3',
						esc_html__('Four', 'gotravel')  => '4'
					),
					'dependency'  => Array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2')),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order By', 'gotravel'),
					'param_name'  => 'order_by',
					'value'       => array(
						esc_html__('Title', 'gotravel') => 'title',
						esc_html__('Date', 'gotravel')  => 'date'
					),
					'save_always' => true
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order', 'gotravel'),
					'param_name'  => 'order',
					'value'       => array(
						esc_html__('ASC', 'gotravel')  => 'ASC',
						esc_html__('DESC', 'gotravel') => 'DESC'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Category Slug', 'gotravel'),
					'param_name'  => 'category',
					'description' => esc_html__('Leave empty for all or use comma for list', 'gotravel')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Hide Image?', 'gotravel'),
					'param_name'  => 'hide_image',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array()),
					'save_always' => true,
					'dependency'  => array('element' => 'type', 'value' => array('grid-type-1', 'grid-type-2'))
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Image Size', 'gotravel'),
					'param_name'  => 'image_size',
					'value'       => array(
						esc_html__('Original', 'gotravel')  => 'original',
						esc_html__('Landscape', 'gotravel') => 'landscape',
						esc_html__('Square', 'gotravel')    => 'square',
						esc_html__('Custom', 'gotravel')    => 'custom'
					),
					'save_always' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Custom Image Size', 'gotravel'),
					'param_name'  => 'custom_image_size',
					'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'gotravel'),
					'dependency'  => array('element' => 'image_size', 'value' => 'custom')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Text Length', 'gotravel'),
					'param_name'  => 'text_length',
					'description' => esc_html__('Number of characters', 'gotravel')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Title Tag', 'gotravel'),
					'param_name'  => 'title_tag',
					'value'       => array_flip(gotravel_mikado_get_title_tag(true))
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Remove Comments on Image In Box?', 'gotravel'),
					'param_name'  => 'remove_category',
					'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false, true)),
					'save_always' => true,
					'dependency'  => array('element' => 'type', 'value' => 'image-in-box')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Style', 'gotravel'),
					'param_name'  => 'style',
					'value'       => array(
						esc_html__('Default', 'gotravel')      => '',
						esc_html__('Light', 'gotravel') => 'light',
						esc_html__('Dark', 'gotravel')  => 'dark'
					),
					'dependency'  => array('element' => 'type',	'value'   => array('grid-type-1', 'grid-type-2'))
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'type'              => 'grid-type-1',
			'number_of_posts'   => '',
			'number_of_columns' => '',
			'image_size'        => 'original',
			'custom_image_size' => '',
			'remove_category'   => 'no',
			'order_by'          => '',
			'order'             => '',
			'category'          => '',
			'title_tag'         => 'h4',
			'text_length'       => '90',
			'hide_image'        => '',
			'style'             => ''
		);

		$params                   = shortcode_atts($default_atts, $atts);
		$params['holder_classes'] = $this->getBlogHolderClasses($params);

		if(empty($atts['title_tag'])) {
			if(in_array($params['type'], array('image-in-box', 'minimal'))) {
				$params['title_tag'] = 'h5';
			}
		}

		$queryArray             = $this->generateBlogQueryArray($params);
		$query_result           = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$params['use_custom_image_size'] = $params['image_size'] === 'custom' && !empty($params['custom_image_size']);

		if($params['use_custom_image_size']) {
			$params['custom_image_dimensions'] = $this->splitCustomImageSize($params['custom_image_size']);
		} else {
			$thumbImageSize             = $this->generateImageSize($params);
			$params['thumb_image_size'] = $thumbImageSize;
		}

		$params['hide_image'] = !empty($params['hide_image']) && $params['hide_image'] === 'yes';

		$html = '';
		$html .= gotravel_mikado_get_shortcode_module_template_part('templates/blog-list-holder', 'blog-list', '', $params);

		return $html;

	}

	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getBlogHolderClasses($params) {
		$holderClasses = array(
			'mkdf-blog-list-holder',
			$this->getColumnNumberClass($params),
			'mkdf-'.$params['type']
		);

		if($params['hide_image'] === 'yes' && in_array($params['type'], array('grid-type-1', 'grid-type-2'))) {
			$holderClasses[] = 'mkdf-blog-list-without-image';
		}

		if(in_array($params['type'], $this->getGridTypes())) {
			$holderClasses[] = 'mkdf-blog-list-grid';

			if($params['style'] !== '') {
				$holderClasses[] = 'mkdf-blog-list-'.$params['style'];
			}
		}

		return $holderClasses;

	}

	/**
	 * Generates column classes for boxes type
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getColumnNumberClass($params) {

		$columnsNumber = '';
		$type          = $params['type'];
		$columns       = $params['number_of_columns'];

		if(in_array($type, $this->getGridTypes())) {
			switch($columns) {
				case 1:
					$columnsNumber = 'mkdf-one-column';
					break;
				case 2:
					$columnsNumber = 'mkdf-two-columns';
					break;
				case 3:
					$columnsNumber = 'mkdf-three-columns';
					break;
				case 4:
					$columnsNumber = 'mkdf-four-columns';
					break;
				default:
					$columnsNumber = 'mkdf-one-column';
					break;
			}
		}

		return $columnsNumber;
	}

	private function getGridTypes() {
		return array(
			'grid-type-1',
			'grid-type-2'
		);
	}

	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generateBlogQueryArray($params) {

		$queryArray = array(
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'category_name'  => $params['category']
		);

		return $queryArray;
	}

	/**
	 * Generates image size option
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function generateImageSize($params) {
		$imageSize = $params['image_size'];

		switch($imageSize) {
			case 'landscape':
				$thumbImageSize = 'gotravel_landscape';
				break;
			case 'square';
				$thumbImageSize = 'gotravel_square';
				break;
			default:
				$thumbImageSize = 'full';
				break;
		}

		return $thumbImageSize;
	}

	private function splitCustomImageSize($customImageSize) {
		if(!empty($customImageSize)) {
			$imageSize = trim($customImageSize);
			//Find digits
			preg_match_all('/\d+/', $imageSize, $matches);
			if(!empty($matches[0])) {
				return array(
					$matches[0][0],
					$matches[0][1]
				);
			}
		}

		return false;
	}


}
