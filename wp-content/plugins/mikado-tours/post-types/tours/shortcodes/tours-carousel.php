<?php
namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\CPT\Tours\Lib\ToursQuery;
use MikadofTours\Lib\ShortcodeInterface;

class ToursCarousel implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
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
			'name'                      => esc_html__('Mikado Tours Carousel', 'mikado-tours'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'mikado-tours'),
			'icon'                      => 'icon-wpb-tours-carousel extended-custom-icon',
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
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Border Around Content', 'mikado-tours'),
						'param_name'  => 'enable_border_around_content',
						'value'       => array(
							esc_html__('No', 'mikado-tours')  => 'no',
							esc_html__('Yes', 'mikado-tours') => 'yes'
						)
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
				),
				mkdf_tours_query()->queryVCParams()
			) //close array_merge
		));
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
			'image_size'                    => 'full',
			'custom_image_dimensions'       => '',
			'enable_border_around_content'  => 'no',
			'title_size'                    => '',
			'text_length'                   => '90'
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

		if ($params['enable_border_around_content'] === 'yes'){
			$params['hover_class'] = 'mkdf-tour-item-has-border';
		}
		
		if ($params['title_size'] !== ''){
			$params['title_style'] = 'font-size:'.gotravel_mikado_filter_px($params['title_size']).'px';
		}

		return mkdf_tours_get_tour_module_template_part('templates/tours-carousel-holder', 'tours', 'shortcodes', '', $params);
	}

	public function getItemTemplate($tour_type = 'standard', $params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_type, 'tours', '', '', $params);
	}
}