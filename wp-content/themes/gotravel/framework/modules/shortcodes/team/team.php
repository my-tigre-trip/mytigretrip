<?php
namespace GoTravel\Modules\Shortcodes\Team;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Team
 */
class Team implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkdf_team';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		$team_social_icons_array = array();
		for($x = 1; $x < 6; $x++) {
			$teamIconCollections = gotravel_mikado_icon_collections()->getCollectionsWithSocialIcons();
			foreach($teamIconCollections as $collection_key => $collection) {

				$team_social_icons_array[] = array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Social Icon ', 'gotravel').$x,
					'param_name' => 'team_social_'.$collection->param.'_'.$x,
					'value'      => $collection->getSocialIconsArrayVC(),
					'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
				);

			}

			$team_social_icons_array[] = array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Social Icon ', 'gotravel').$x.esc_html__(' Link', 'gotravel'),
				'param_name' => 'team_social_icon_'.$x.'_link',
				'dependency' => array(
					'element' => 'team_social_icon_pack',
					'value'   => gotravel_mikado_icon_collections()->getIconCollectionsKeys()
				)
			);

			$team_social_icons_array[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Social Icon ', 'gotravel').$x.esc_html__(' Target', 'gotravel'),
				'param_name' => 'team_social_icon_'.$x.'_target',
				'value'      => array(
					esc_html__('Same Window', 'gotravel')  => '_self',
					esc_html__('New Window', 'gotravel') => '_blank'
				),
				'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
			);
		}

		vc_map(array(
			'name'                      => esc_html__('Mikado Team', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-team extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Type', 'gotravel'),
						'param_name'  => 'team_type',
						'value'       => array(
							esc_html__('Main Info on Hover', 'gotravel')    => 'main-info-on-hover',
							esc_html__('Main Info Below Image', 'gotravel') => 'main-info-below-image'
						),
						'save_always' => true
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image', 'gotravel'),
						'param_name' => 'team_image'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Set Dark/Light Type', 'gotravel'),
						'param_name' => 'dark_light_type',
						'value'      => array(
							esc_html__('Dark', 'gotravel')  => 'dark',
							esc_html__('Light', 'gotravel') => 'light',
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Name', 'gotravel'),
						'param_name'  => 'team_name'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Name Tag', 'gotravel'),
						'param_name' => 'team_name_tag',
						'value'       => array_flip(gotravel_mikado_get_title_tag(true)),
						'dependency' => array('element' => 'team_name', 'not_empty' => true)
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Position', 'gotravel'),
						'param_name'  => 'team_position'
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__('Description', 'gotravel'),
						'param_name'  => 'team_description'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Social Icon Pack', 'gotravel'),
						'param_name'  => 'team_social_icon_pack',
						'value'       => array_merge(array('' => ''), gotravel_mikado_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Social Icons Type', 'gotravel'),
						'param_name'  => 'team_social_icon_type',
						'value'       => array(
							esc_html__('Normal', 'gotravel') => 'normal',
							esc_html__('Circle', 'gotravel') => 'circle',
							esc_html__('Square', 'gotravel') => 'square'
						),
						'save_always' => true,
						'dependency'  => array(
							'element' => 'team_social_icon_pack',
							'value'   => gotravel_mikado_icon_collections()->getIconCollectionsKeys()
						)
					),
				),
				$team_social_icons_array
			)
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
			'team_image'            => '',
			'team_type'             => 'main-info-on-hover',
			'team_name'             => '',
			'team_name_tag'         => 'h5',
			'team_position'         => '',
			'team_description'      => '',
			'team_social_icon_pack' => '',
			'team_social_icon_type' => 'normal',
			'dark_light_type'       => ''
		);

		$team_social_icons_form_fields = array();
		$number_of_social_icons        = 5;

		for($x = 1; $x <= $number_of_social_icons; $x++) {

			foreach(gotravel_mikado_icon_collections()->iconCollections as $collection_key => $collection) {
				$team_social_icons_form_fields['team_social_'.$collection->param.'_'.$x] = '';
			}

			$team_social_icons_form_fields['team_social_icon_'.$x.'_link']   = '';
			$team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';

		}

		$args = array_merge($args, $team_social_icons_form_fields);

		$params = shortcode_atts($args, $atts);

		$counter_classes = '';

		if($params['dark_light_type'] == 'light') {
			$counter_classes .= 'light';
		}

		$params['light_class'] = $counter_classes;

		$params['number_of_social_icons'] = 5;
		$params['team_name_tag']          = !empty($params['team_name_tag']) ? $params['team_name_tag'] : $args['team_name_tag'];
		$params['team_image_src']         = $this->getTeamImage($params);
		$params['team_social_icons']      = $this->getTeamSocialIcons($params);

		//Get HTML from template based on type of team
		$html = gotravel_mikado_get_shortcode_module_template_part('templates/'.$params['team_type'], 'team', '', $params);

		return $html;
	}

	/**
	 * Return Team image
	 *
	 * @param $params
	 *
	 * @return false|string
	 */
	private function getTeamImage($params) {

		if(is_numeric($params['team_image'])) {
			$team_image_src = wp_get_attachment_url($params['team_image']);
		} else {
			$team_image_src = $params['team_image'];
		}

		return $team_image_src;

	}

	private function getTeamSocialIcons($params) {

		extract($params);
		$social_icons = array();

		if($team_social_icon_pack !== '') {

			$icon_pack                    = gotravel_mikado_icon_collections()->getIconCollection($team_social_icon_pack);
			$team_social_icon_type_label  = 'team_social_'.$icon_pack->param;
			$team_social_icon_param_label = $icon_pack->param;

			for($i = 1; $i <= $number_of_social_icons; $i++) {

				$team_social_icon   = ${$team_social_icon_type_label.'_'.$i};
				$team_social_link   = ${'team_social_icon_'.$i.'_link'};
				$team_social_target = ${'team_social_icon_'.$i.'_target'};

				if($team_social_icon !== '') {

					$team_icon_params                                = array();
					$team_icon_params['icon_pack']                   = $team_social_icon_pack;
					$team_icon_params[$team_social_icon_param_label] = $team_social_icon;
					$team_icon_params['link']                        = ($team_social_link !== '') ? $team_social_link : '';
					$team_icon_params['target']                      = ($team_social_target !== '') ? $team_social_target : '';
					$team_icon_params['type']                        = ($team_social_icon_type !== '') ? $team_social_icon_type : '';

					$social_icons[] = gotravel_mikado_execute_shortcode('mkdf_icon', $team_icon_params);
				}

			}

		}

		return $social_icons;

	}

}