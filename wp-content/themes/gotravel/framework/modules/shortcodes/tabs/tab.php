<?php
namespace GoTravel\Modules\Shortcodes\Tab;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tab
 */
class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkdf_tab';
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
			'name'                    => esc_html__('Mikado Tab', 'gotravel'),
			'base'                    => $this->getBase(),
			'as_parent'               => array('except' => 'vc_row'),
			'as_child'                => array('only' => 'mkdf_tabs'),
			'is_container'            => true,
			'category'                => esc_html__('by MIKADO', 'gotravel'),
			'icon'                    => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'params'                  => array_merge(
				\GoTravelMikadoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title', 'gotravel'),
						'param_name'  => 'title'
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {

		$default_atts = array(
			'title'  => 'Tab',
			'tab_id' => ''
		);

		$default_atts = array_merge($default_atts, gotravel_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$iconPackName   = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];

		$rand_number     = rand(0, 1000);
		$params['title'] = $params['title'].'-'.$rand_number;

		$params['content'] = $content;

		$output = '';
		$output .= gotravel_mikado_get_shortcode_module_template_part('templates/tab_content', 'tabs', '', $params);

		return $output;

	}
}