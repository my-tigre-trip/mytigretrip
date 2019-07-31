<?php
namespace GoTravel\Modules\Shortcodes\VideoButton;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class VideoButton
 */
class VideoButton implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_video_button';

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

        vc_map(array(
            'name'                      => esc_html__('Mikado Video Button', 'gotravel'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by MIKADO', 'gotravel'),
            'icon'                      => 'icon-wpb-video-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__("Video Link", 'gotravel'),
                    "param_name" => "video_link"
                ),
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__("Play Button Size (px)", 'gotravel'),
                    "param_name" => "button_size",
                    "dependency" => array('element' => 'video_link', 'not_empty' => true),
                ),
                array(
                    "type"       => "textfield",
                    "heading"    => esc_html__("Title", 'gotravel'),
                    "param_name" => "title"
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Video Button Style', 'gotravel'),
                    'param_name'  => 'title_style',
                    'value'       => array(
					    esc_html__('Dark', 'gotravel')  => 'dark',
					    esc_html__('Light', 'gotravel') => 'light'
                    ),
                    'save_always' => true
                ),
                array(
                    "type"       => "dropdown",
                    "heading"    => esc_html__("Title Tag", 'gotravel'),
                    "param_name" => "title_tag",
                    'value'       => array_flip(gotravel_mikado_get_title_tag(true)),
                    "dependency" => array('element' => 'title', 'not_empty' => true),
                )
            )
        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'video_link'  => '#',
            'button_size' => '',
            'title'       => 'Title',
            'title_style' => 'dark',
            'title_tag'   => 'h3',
        );

        $params = shortcode_atts($args, $atts);

        $title_class = '';

        if($params['title_style'] === 'light') {
            $title_class .= 'mkdf-light ';
        }

        $params['button_light'] = $title_class;

        $params['button_style']    = $this->getButtonStyle($params);
        $params['video_title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $args['title_tag'];

        //Get HTML from template
        $html = gotravel_mikado_get_shortcode_module_template_part('templates/video-button-template', 'videobutton', '', $params);

        return $html;
    }

    /**
     * Return Style for Button
     *
     * @param $params
     *
     * @return string
     */
    private function getButtonStyle($params) {
        $button_style = array();

        if($params['button_size'] !== '') {
            $button_size    = strstr($params['button_size'], 'px') ? $params['button_size'] : $params['button_size'].'px';
            $button_style[] = 'width: '.$button_size;
            $button_style[] = 'height: '.$button_size;
            $button_style[] = 'font-size: '.intval($button_size) .'px';
        }

        return implode(';', $button_style);
    }
}