<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\CPT\Tours\Lib\ToursQuery;
use MikadofTours\Lib\ShortcodeInterface;

class ToursList implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_list';

		add_action('vc_before_init', array($this, 'vcMap'));

		add_action('wp_ajax_nopriv_mkdf_tours_list_ajax_pagination', array($this, 'handleLoadMore'));
		add_action('wp_ajax_mkdf_tours_list_ajax_pagination', array($this, 'handleLoadMore'));
	}


	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Tours List', 'mikado-tours'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'mikado-tours'),
			'icon'                      => 'icon-wpb-tours-list extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Tours List Type', 'mikado-tours'),
						'param_name'  => 'tour_type',
						'value'       => array(
							esc_html__('Standard', 'mikado-tours') => 'standard',
							esc_html__('Gallery', 'mikado-tours')  => 'gallery'
						),
						'admin_label' => true,
						'save_always' => true,
						'description' => esc_html__('Default value is Standard', 'mikado-tours'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Number of Columns', 'mikado-tours'),
						'param_name'  => 'tour_item',
						'value'       => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4'
						),
						'save_always' => true,
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Image Proportions', 'mikado-tours'),
						'param_name'  => 'image_size',
						'value'       => array(
							esc_html__('Original', 'mikado-tours')  => 'full',
							esc_html__('Square', 'mikado-tours')    => 'square',
							esc_html__('Landscape', 'mikado-tours') => 'landscape',
							esc_html__('Portrait', 'mikado-tours')  => 'portrait',
							esc_html__('Custom', 'mikado-tours')    => 'custom'
						),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Image Dimensions', 'mikado-tours'),
						'param_name'  => 'custom_image_dimensions',
						'description' => esc_html__('Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)', 'mikado-tours'),
						'dependency'  => array('element' => 'image_size', 'value' => 'custom')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title Size (px)', 'mikado-tours'),
						'param_name'  => 'title_size'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Text Length', 'mikado-tours'),
						'param_name'  => 'text_length',
						'description' => esc_html__('Number of words', 'mikado-tours')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Border Around Content', 'mikado-tours'),
						'param_name'  => 'enable_border_around_content',
						'value'       => array(
							esc_html__('No', 'mikado-tours')  => 'no',
							esc_html__('Yes', 'mikado-tours') => 'yes'
						)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Category Filter', 'mikado-tours'),
						'param_name'  => 'filter',
						'value'       => array(
							esc_html__('No', 'mikado-tours')  => 'no',
							esc_html__('Yes', 'mikado-tours') => 'yes'
						),
						'save_always' => true,
						'description' => esc_html__('Default value is No', 'mikado-tours'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Load More', 'mikado-tours'),
						'param_name'  => 'enable_load_more',
						'value'       => array(
							esc_html__('No', 'mikado-tours')  => 'no',
							esc_html__('Yes', 'mikado-tours') => 'yes'
						),
						'save_always' => true,
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Load More Button Text', 'mikado-tours'),
						'param_name'  => 'load_more_text',
						'dependency'  => array('element' => 'enable_load_more', 'value' => 'yes'),
						'description' => esc_html__('Default text is "Load More"', 'mikado-tours')
					)
				),
				mkdf_tours_query()->queryVCParams()
			) //close array_merge
		));
	}

	public function handleLoadMore() {
		$fields = $this->parseRequest();

		$returnObject = new \stdClass();
		
		if(!empty($fields['destination'])) {
			$destination_query = new \WP_Query(array('post_status' => 'published', 'post_type' => 'destinations', 'name' => esc_attr(strtolower($fields['destination']))));
			wp_reset_postdata();
			$destination_id = $destination_query->posts[0]->ID;
			
			$query = mkdf_tours_query()->buildQueryObject($fields, array(
				'meta_key' => 'mkdf_tours_destination',
				'meta_value' => esc_attr($destination_id)
			));
		} else {
			$query  = mkdf_tours_query()->buildQueryObject($fields);
		}

		if($query->have_posts()) {
			ob_start();

			$this->getToursQueryTemplate(array(
				'query'     => $query,
				'tour_type' => $fields['tour_type'],
				'caller'    => $this,
				'params'    => $fields
			));

			$returnObject->html      = ob_get_clean();
			$returnObject->havePosts = true;
			$returnObject->message   = 'Success';
			$returnObject->nextPage  = $fields['next_page'] + 1;
		} else {
			$returnObject->havePosts = false;
			$returnObject->message   = esc_html__('No more tours.', 'mikado-tours');
		}

		echo json_encode($returnObject);
		exit;
	}

	private function parseRequest() {
		if(empty($_POST['fields'])) {
			return false;
		}

		parse_str($_POST['fields'], $fields);

		if(!(is_array($fields) && count($fields))) {
			return false;
		}

		return $fields;
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'tour_type'                     => 'standard',
			'tour_item'                     => '3',
			'image_size'                    => 'full',
			'custom_image_dimensions'       => '',
			'title_size'                    => '',
			'text_length'                   => '90',
			'enable_border_around_content'  => 'no',
			'filter'                        => 'no',
			'enable_load_more'              => '',
			'load_more_text'                => ''
		);

		$args   = array_merge($args, mkdf_tours_query()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);
		
		if(!empty($params['destination'])) {
			$destination_query = new \WP_Query(array('post_status' => 'published', 'post_type' => 'destinations', 'name' => esc_attr(strtolower($params['destination']))));
			wp_reset_postdata();
			$destination_id = $destination_query->posts[0]->ID;
			
			$query = mkdf_tours_query()->buildQueryObject($params, array(
				'meta_key' => 'mkdf_tours_destination',
				'meta_value' => esc_attr($destination_id)
			));
		} else {
			$query  = mkdf_tours_query()->buildQueryObject($params);
		}

		$params['query']  = $query;
		$params['caller'] = $this;
		$params['hover_class'] = '';
		$params['title_style'] = '';

		$params['thumb_size'] = mkdf_tours_get_image_size_param($params);

		if($params['filter'] == 'yes') {
			$params['filter_categories'] = $this->getFilterCategories($params);
		}

		if (!empty($params['title_size'])) {
			$params['title_style'] = 'font-size:'.gotravel_mikado_filter_px($params['title_size']).'px';
		}

		$params['holder_classes'] = $this->getHolderInnerClasses($params);
		$params['enable_load_more']        = $params['enable_load_more'] === 'yes';
		$params['load_more_text']          = empty($params['load_more_text']) ? esc_html__('Load More', 'mikado-tours') : $params['load_more_text'];
		$params['display_load_more_data']  = (int) $params['number'] == $params['number'] && $params['number'] > 0;

		return mkdf_tours_get_tour_module_template_part('templates/tours-list-holder', 'tours', 'shortcodes', '', $params);
	}

	public function getItemTemplate($tour_type = 'standard', $params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_type, 'tours', '', '', $params);
	}

	public function getFilterCategories($params) {
		$cat_id       = 0;
		$top_category = '';

		if(!empty($params['tour_category'])) {
			$top_category = get_term_by('slug', $params['tour_category'], 'tour-category');
			if(isset($top_category->term_id)) {
				$cat_id = $top_category->term_id;
			}
		}

		$args = array(
			'taxonomy' => 'tour-category',
			'child_of' => $cat_id,
		);

		$filter_categories = get_terms($args);

		return $filter_categories;
	}

	public function getToursQueryTemplate($params) {
		echo mkdf_tours_get_tour_module_template_part('templates/tours-list-loop', 'tours', 'shortcodes', '', $params);
	}

	private function getHolderInnerClasses($params) {
		$holder_classes = array();

		switch($params['tour_item']) {
			case '1':
				$number_of_columns_class = 'mkdf-one-item';
				break;
			case '2':
				$number_of_columns_class = 'mkdf-two-items';
				break;
			case '3':
				$number_of_columns_class = 'mkdf-three-items';
				break;
			case '4':
				$number_of_columns_class = 'mkdf-four-items';
				break;
			default:
				$number_of_columns_class = 'mkdf-three-items';
		}
		
		if($params['enable_border_around_content'] === 'yes') {
			$number_of_columns_class .= ' mkdf-tour-item-has-border';
		}
		
		$holder_classes[] = $number_of_columns_class;

		return implode(' ', $holder_classes);
	}
}