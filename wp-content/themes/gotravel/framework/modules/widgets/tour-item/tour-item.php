<?php

class GoTravelMikadoTourItems extends GoTravelMikadoWidget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkdf_tour_items_widget', // Base ID
			esc_html__('Mikado Tour Items', 'gotravel'), // Name
			array('description' => esc_html__('Display Tour items', 'gotravel'),) // Args
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
					'DESC' => esc_html__('DESC', 'gotravel')
				)
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Text length', 'gotravel'),
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
				'title'       => esc_html__('Tour Category', 'gotravel'),
				'name'        => 'tour_category',
				'description' => esc_html__('Enter one tour category slug (leave empty for showing all categories)', 'gotravel')
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Number of Tours Per Page', 'gotravel'),
				'name'        => 'number',
				'options'     => '-1',
				'description' => esc_html__('Enter -1 to show all', 'gotravel')
			),
			array(
				'type'        => 'textfield',
				'title'       => esc_html__('Show Only Tours with Listed IDs', 'gotravel'),
				'name'        => 'selected_tours',
				'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'gotravel'),
			)
		);
	}

	public function widget($args, $instance) {
		$instance['thumb_size'] = mkdf_tours_get_image_size_param($instance);
		$instance['title_style'] = '';
		$query                  = mkdf_tours_query()->buildQueryObject($instance);
		
		$tour_check = 'gallery';
		if(($instance['tour_type']) == 'standard') {
			$tour_check = 'standard';
		}
		?>
		<div class="widget mkdf-widget-tour-holder mkdf-tours-item-with-smaller-spacing">

			<?php if($query->have_posts()) : ?>
				<?php while($query->have_posts()) : ?>
					<div class="mkdf-tours-widget-item">
						<?php $query->the_post(); ?>
						<?php echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_check, 'tours', '', '', $instance); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
