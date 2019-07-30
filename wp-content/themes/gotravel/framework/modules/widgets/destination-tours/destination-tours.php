<?php

class GoTravelMikadoDestinationTours extends GoTravelMikadoWidget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkdf_destination_tours_widget', // Base ID
			esc_html__('Mikado Destination Tours', 'gotravel'), // Name
			array('description' => esc_html__('Display Tours For Current Destination', 'gotravel'),) // Args
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'title'   => esc_html__('Tours List Type', 'gotravel'),
				'name'    => 'tour_type',
				'options' => array(
					'standard' => esc_html__('Standard', 'gotravel'),
					'gallery'  => esc_html__('Gallery', 'gotravel')
				),
			),
			array(
				'type'        => 'dropdown',
				'title'       => esc_html__('Order By', 'gotravel'),
				'name'        => 'order_by',
				'options'     => array(
					'menu_order' => esc_html__('Menu Order', 'gotravel'),
					'title'      => esc_html__('Title', 'gotravel'),
					'date'       => esc_html__('Date', 'gotravel')
				)
			),
			array(
				'type'        => 'dropdown',
				'title'       => esc_html__('Order', 'gotravel'),
				'name'        => 'order',
				'options'     => array(
					'ASC'  => esc_html__('ASC', 'gotravel'),
					'DESC' => esc_html__('DESC', 'gotravel'),
				)
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Text Length', 'gotravel'),
				'name'        => 'text_length',
				'description' => esc_html__('Number of words', 'gotravel')
			),
			array(
				'type'    => 'dropdown',
				'title'   => esc_html__('Image Proportions', 'gotravel'),
				'name'    => 'image_size',
				'options' => array(
					'original'  => esc_html__('Original', 'gotravel'),
					'square'    => esc_html__('Square', 'gotravel'),
					'landscape' => esc_html__('Landscape', 'gotravel'),
					'portrait'  => esc_html__('Portrait', 'gotravel'),
					'custom'    => esc_html__('Custom', 'gotravel')
				),
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Image Dimensions', 'gotravel'),
				'name'        => 'custom_image_dimensions',
				'description' => esc_html__('Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height). It will be applied only if "Custom" image proportion option is selected', 'gotravel')
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Number of Tours Per Page', 'gotravel'),
				'name'        => 'number',
				'options'     => '-1',
				'admin_label' => true,
				'description' => esc_html__('Enter -1 to show all', 'gotravel'),
			)
		);
	}

	public function widget($args, $instance) {

		$instance['thumb_size']  = mkdf_tours_get_image_size_param($instance);
		$instance['title_style'] = '';
		$query                   = mkdf_tours_query()->buildQueryObject($instance, array(
			'meta_key' => 'mkdf_tours_destination',
			'meta_value' => gotravel_mikado_get_page_id()
		));

		$tour_check = '';
		if(($instance['tour_type']) == 'standard') {
			$tour_check = 'standard';
		} else {
			$tour_check = 'gallery';
		}

		?>

		<?php if($query->have_posts()) : ?>
			<div class="widget mkdf-widget-destination-tours-holder mkdf-tours-gallery-without-hover mkdf-tours-item-with-smaller-spacing mkdf-widget-tour-holder">
				<?php while($query->have_posts()) : ?>
					<div class="mkdf-destination-tours-widget-item mkdf-tours-widget-item">
						<?php $query->the_post(); ?>
						<?php echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_check, 'tours', '', '', $instance); ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php
	}
}
