<?php

class GoTravelMikadoSideAreaOpener extends GoTravelMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_side_area_opener', // Base ID
			esc_html__('Mikado Side Area Opener', 'gotravel'), // Name
			array('description' => esc_html__('Display a "hamburger" icon that opens the side area', 'gotravel'),) // Args
		);
		
		$this->setParams();
	}

	protected function setParams() {

		$this->params = array(
			array(
				'name'        => 'side_area_opener_icon_color',
				'type'        => 'textfield',
				'title'       => esc_html__('Icon Color', 'gotravel'),
				'description' => esc_html__('Define color for Side Area opener icon', 'gotravel')
			),
			array(
				'type'        => 'textfield',
				'name'        => 'side_area_opener_icon_margin',
				'title'       => esc_html__('Icon Margin', 'gotravel'),
				'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'gotravel')
			)
		);
	}

	public function widget($args, $instance) {
		$styles = array();

		if(!empty($instance['side_area_opener_icon_color'])) {
			$styles[] = 'color: '.$instance['side_area_opener_icon_color'].';';
		}
		if (!empty($instance['side_area_opener_icon_margin'])) {
			$styles[] = 'margin: ' . $instance['side_area_opener_icon_margin'];
		}

		print $args['before_widget'];
		
		$default_sidearea_opener_class = gotravel_mikado_options()->getOptionValue('side_area_enable_default_opener') === 'yes' ? 'mkdf-side-menu-button-opener-default' : '';
		?>
		<a class="mkdf-side-menu-button-opener <?php echo esc_attr($default_sidearea_opener_class); ?>" <?php gotravel_mikado_inline_style($styles) ?> href="javascript:void(0)">
			<?php echo gotravel_mikado_get_side_menu_icon_html(); ?>
		</a>

		<?php print $args['after_widget']; ?>

	<?php }
}