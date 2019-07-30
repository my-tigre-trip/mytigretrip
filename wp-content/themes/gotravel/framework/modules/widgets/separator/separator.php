<?php

/**
 * Widget that adds separator boxes type
 *
 * Class Separator_Widget
 */
class GoTravelMikadoSeparatorWidget extends GoTravelMikadoWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'mkd_separator_widget', // Base ID
			esc_html__('Mikado Separator Widget', 'gotravel'), // Name
			array('description' => esc_html__('Add a separator element to your widget areas', 'gotravel'),) // Args
		);
		
		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'title'   => esc_html__('Type', 'gotravel'),
				'name'    => 'type',
				'options' => array(
					'normal'     => esc_html__('Normal', 'gotravel'),
					'full-width' => esc_html__('Full Width', 'gotravel')
				)
			),
			array(
				'type'    => 'dropdown',
				'title'   => esc_html__('Position', 'gotravel'),
				'name'    => 'position',
				'options' => array(
					'center' => esc_html__('Center', 'gotravel'),
					'left'   => esc_html__('Left', 'gotravel'),
					'right'  => esc_html__('Right', 'gotravel')
				)
			),
			array(
				'type'    => 'dropdown',
				'title'   => esc_html__('Style', 'gotravel'),
				'name'    => 'border_style',
				'options' => array(
					'solid'  => esc_html__('Solid', 'gotravel'),
					'dashed' => esc_html__('Dashed', 'gotravel'),
					'dotted' => esc_html__('Dotted', 'gotravel')
				)
			),
			array(
				'type'  => 'textfield',
				'title' => esc_html__('Color', 'gotravel'),
				'name'  => 'color'
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Width', 'gotravel'),
				'name'        => 'width'
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Thickness (px)', 'gotravel'),
				'name'        => 'thickness'
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Top Margin', 'gotravel'),
				'name'        => 'top_margin'
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Bottom Margin', 'gotravel'),
				'name'        => 'bottom_margin'
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {

		extract($args);

		//prepare variables
		$params = '';

		//is instance empty?
		if(is_array($instance) && count($instance)) {
			//generate shortcode params
			foreach($instance as $key => $value) {
				$params .= " $key='$value' ";
			}
		}

		echo '<div class="widget mkdf-separator-widget">';

		//finally call the shortcode
		echo do_shortcode("[mkdf_separator $params]"); // XSS OK

		echo '</div>'; //close div.mkdf-separator-widget
	}
}