<?php
namespace GoTravel\Modules\Shortcodes\VideoBanner;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

class VideoBanner implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkdf_video_banner';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Video Banner', 'gotravel'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'gotravel'),
			'icon'                      => 'icon-wpb-video-banner extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Video Link', 'gotravel'),
					'param_name'  => 'video_link'
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Video Banner', 'gotravel'),
					'param_name'  => 'video_banner'
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'video_link'   => '',
			'video_banner' => ''
		);

		$params              = shortcode_atts($default_atts, $atts);
		$params['banner_id'] = rand();

		return gotravel_mikado_get_shortcode_module_template_part('templates/video-banner', 'video-banner', '', $params);
	}
}