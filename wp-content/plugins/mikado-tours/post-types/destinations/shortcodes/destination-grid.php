<?php
namespace MikadofTours\CPT\Destination\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class DestinationGrid implements ShortcodeInterface {
	private $base;

	/**
	 * DestinationGrid constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_destination_grid';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Destinations Grid', 'mikado-tours'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'mikado-tours'),
			'icon'                      => 'icon-wpb-destinations-grid extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order By', 'mikado-tours'),
					'param_name'  => 'order_by',
					'value'       => array(
						esc_html__('Menu Order', 'mikado-tours') => 'menu_order',
						esc_html__('Title', 'mikado-tours')      => 'title',
						esc_html__('Date', 'mikado-tours')       => 'date'
					),
					'save_always' => true,
					'group'       => esc_html__('Query Options', 'mikado-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order', 'mikado-tours'),
					'param_name'  => 'order',
					'value'       => array(
						esc_html__('ASC', 'mikado-tours')  => 'ASC',
						esc_html__('DESC', 'mikado-tours') => 'DESC',
					),
					'save_always' => true,
					'group'       => esc_html__('Query Options', 'mikado-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Destinations Per Page', 'mikado-tours'),
					'param_name'  => 'number',
					'value'       => '-1',
					'description' => esc_html__('Enter -1 to show all', 'mikado-tours'),
					'group'       => esc_html__('Query Options', 'mikado-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Show Only Destinations with Listed IDs', 'mikado-tours'),
					'param_name'  => 'selected_destinations',
					'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'mikado-tours'),
					'group'       => esc_html__('Query Options', 'mikado-tours')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'order_by'              => 'date',
			'order'                 => 'DESC',
			'number'                => '-1',
			'selected_destinations' => ''
		);

		$params = shortcode_atts($args, $atts);

		$query = $this->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;

		return mkdf_tours_get_tour_module_template_part('templates/destination-grid-template', 'destinations', 'shortcodes', '', $params);
	}

	private function buildQueryObject($params) {
		$queryArray['post_status'] = 'published';
		$queryArray['post_type'] = 'destinations';

		if(!empty($params['order_by'])) {
			$queryArray['orderby'] = $params['order_by'];
		}

		if(!empty($params['order'])) {
			$queryArray['order'] = $params['order'];
		}

		if(!empty($params['number'])) {
			$queryArray['posts_per_page'] = $params['number'];
		}

		$toursIds = null;
		if(!empty($params['selected_destinations'])) {
			$toursIds               = explode(',', $params['selected_destinations']);
			$queryArray['post__in'] = $toursIds;
		}

		return new \WP_Query($queryArray);
	}
}