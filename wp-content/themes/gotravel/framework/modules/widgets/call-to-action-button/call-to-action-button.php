<?php

class GoTravelMikadoCallToActionButton extends GoTravelMikadoWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_call_to_action_button', // Base ID
			esc_html__('Mikado Call To Action Button', 'gotravel'), // Name
			array('description' => esc_html__('Add call to action element to widget areas', 'gotravel'),) // Args
		);

		$this->setParams();
	}

	protected function setParams() {

		$this->params = array_merge(
			gotravel_mikado_icon_collections()->getWidgetIconParams(),
			array(
				array(
					'type'        => 'textfield',
					'title'       => esc_html__('Button Text', 'gotravel'),
					'name'        => 'button_text'
				),
				array(
					'type'        => 'textfield',
					'title'       => esc_html__('Link', 'gotravel'),
					'name'        => 'link'
				),
				array(
					'type'        => 'dropdown',
					'title'       => esc_html__('Link Target', 'gotravel'),
					'name'        => 'link_target',
					'options'     => array(
						'_self'  => esc_html__('Same Window', 'gotravel'),
						'_blank' => esc_html__('New Window', 'gotravel')
					)
				),
				array(
					'type'        => 'textfield',
					'title'       => esc_html__('Text Color', 'gotravel'),
					'name'        => 'text_color'
				),
				array(
					'type'        => 'textfield',
					'title'       => esc_html__('Background Color', 'gotravel'),
					'name'        => 'background_color'
				)
			)
		);
	}

	public function widget($args, $instance) {
		print $args['before_widget'];

		$iconPack = $instance['icon_pack'];
		$iconHtml = '';

		if($iconPack !== '') {
			$iconPackName = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($iconPack);
			$icon         = $instance[$iconPackName];

			$iconHtml = gotravel_mikado_icon_collections()->renderIcon($icon, $iconPack);
		}

		$buttonStyles = array();

		if($instance['background_color'] !== '') {
			$buttonStyles[] = 'background-color: '.$instance['background_color'];
		}

		if($instance['text_color'] !== '') {
			$buttonStyles[] = 'color: '.$instance['text_color'];
		}

		?>

		<?php if($instance['link'] !== '' && $instance['button_text'] !== '') : ?>
			<a <?php gotravel_mikado_inline_style($buttonStyles); ?> class="mkdf-call-to-action-button" target="<?php echo esc_attr($instance['link_target']); ?>" href="<?php echo esc_url($instance['link']) ?>">
				<span class="mkdf-ctab-holder">
					<?php if($iconHtml !== '') : ?>
						<span class="mkdf-ctab-icon">
							<?php print $iconHtml; ?>
						</span>
					<?php endif; ?>
					<?php echo esc_html($instance['button_text']); ?>
				</span>
			</a>
		<?php endif; ?>

		<?php print $args['after_widget'];
	}
}