<?php
namespace GoTravel\Modules\Shortcodes\BlogSlider;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class BlogSlider implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_blog_slider';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Mikado Blog Slider', 'gotravel'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-blog-slider extended-custom-icon',
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Posts', 'gotravel'),
					'param_name'  => 'number_of_posts'
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
					'type'        => 'textfield',
					'heading'     => esc_html__('Text Length', 'gotravel'),
					'param_name'  => 'text_length',
					'description' => esc_html__('Number of characters', 'gotravel')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number_of_posts' => '',
			'order_by'        => '',
			'order'           => '',
			'category'        => '',
			'text_length'     => '90',
		);

		$params = shortcode_atts($default_atts, $atts);

		$queryParams = $this->generateBlogQueryArray($params);

		$query = new \WP_Query($queryParams);

		$params['query'] = $query;

		return gotravel_mikado_get_shortcode_module_template_part('templates/blog-slider-template', 'blog-slider', '', $params);
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
}