<?php

/**
 * Widget that adds search icon that triggers opening of search form
 *
 * Class Mikado_Search_Opener
 */
class GoTravelMikadoSearchOpener extends GoTravelMikadoWidget {
	/**
	 * Set basic widget options and call parent class construct
	 */
	public function __construct() {
		parent::__construct(
			'mkd_search_opener', // Base ID
			esc_html__('Mikado Search Opener', 'gotravel'),
			array('description' => esc_html__('Display a "search" icon that opens the search form', 'gotravel'),) // Args
		);
		
		$this->setParams();
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params = array(
			array(
				'name'        => 'search_icon_size',
				'type'        => 'textfield',
				'title'       => esc_html__('Search Icon Size (px)', 'gotravel'),
				'description' => esc_html__('Define size for Search icon', 'gotravel')
			),
			array(
				'name'        => 'search_icon_color',
				'type'        => 'textfield',
				'title'       => esc_html__('Search Icon Color', 'gotravel'),
				'description' => esc_html__('Define color for Search icon', 'gotravel')
			),
			array(
				'name'        => 'search_icon_hover_color',
				'type'        => 'textfield',
				'title'       => esc_html__('Search Icon Hover Color', 'gotravel'),
				'description' => esc_html__('Define hover color for Search icon', 'gotravel')
			),
			array(
				'name'        => 'show_label',
				'type'        => 'dropdown',
				'title'       => esc_html__('Enable Search Icon Text', 'gotravel'),
				'description' => esc_html__('Enable this option to show \'Search\' text next to search icon in header', 'gotravel'),
				'options'     => array(
					''    => esc_html__('Default', 'gotravel'),
					'yes' => esc_html__('Yes', 'gotravel'),
					'no'  => esc_html__('No', 'gotravel')
				)
			),
			array(
				'name'        => 'close_icon_position',
				'type'        => 'dropdown',
				'title'       => esc_html__('Close icon stays on opener place', 'gotravel'),
				'description' => esc_html__('Enable this option to set close icon on same position like opener icon', 'gotravel'),
				'options'     => array(
					'yes' => esc_html__('Yes', 'gotravel'),
					'no'  => esc_html__('No', 'gotravel')
				)
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
		global $gotravel_mikado_options, $gotravel_mikado_IconCollections;

		$search_type_class           = 'mkdf-search-opener';
		$fullscreen_search_overlay   = false;
		$search_opener_styles        = array();
		$show_search_text            = $instance['show_label'] == 'yes' || $gotravel_mikado_options['enable_search_icon_text'] == 'yes' ? true : false;
		$close_icon_on_same_position = $instance['close_icon_position'] == 'yes' ? true : false;

		if(isset($gotravel_mikado_options['search_type']) && $gotravel_mikado_options['search_type'] == 'fullscreen-search') {
			if(isset($gotravel_mikado_options['search_animation']) && $gotravel_mikado_options['search_animation'] == 'search-from-circle') {
				$fullscreen_search_overlay = true;
			}
		}

		if(isset($gotravel_mikado_options['search_type']) && $gotravel_mikado_options['search_type'] == 'search_covers_header') {
			if(isset($gotravel_mikado_options['search_cover_only_bottom_yesno']) && $gotravel_mikado_options['search_cover_only_bottom_yesno'] == 'yes') {
				$search_type_class .= ' search_covers_only_bottom';
			}
		}

		if(!empty($instance['search_icon_size'])) {
			$search_opener_styles[] = 'font-size: '.$instance['search_icon_size'].'px';
		}

		if(!empty($instance['search_icon_color'])) {
			$search_opener_styles[] = 'color: '.$instance['search_icon_color'];
		}

		print $args['before_widget'];

		?>

		<a <?php echo gotravel_mikado_get_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?>
			<?php if($close_icon_on_same_position) {
				echo gotravel_mikado_get_inline_attr('yes', 'data-icon-close-same-position');
			} ?>
			<?php gotravel_mikado_inline_style($search_opener_styles); ?>
			<?php gotravel_mikado_class_attribute($search_type_class); ?> href="javascript:void(0)">
			<?php if(isset($gotravel_mikado_options['search_icon_pack'])) {
				$gotravel_mikado_IconCollections->getSearchIcon($gotravel_mikado_options['search_icon_pack'], false);
			} ?>
			<?php if($show_search_text) { ?>
				<span class="mkdf-search-icon-text"><?php esc_html_e('Search', 'gotravel'); ?></span>
			<?php } ?>
		</a>

		<?php if($fullscreen_search_overlay) { ?>
			<div class="mkdf-fullscreen-search-overlay"></div>
		<?php } ?>

		<?php do_action('gotravel_mikado_after_search_opener'); ?>

		<?php print $args['after_widget']; ?>
	<?php }
}