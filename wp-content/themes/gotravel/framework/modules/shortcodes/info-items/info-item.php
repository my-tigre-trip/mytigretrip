<?php
namespace GoTravel\Modules\Shortcodes\InfoItem;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */
class InfoItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_info_item';
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
            'name'                    => esc_html__('Mikado Info Item', 'gotravel'),
            'base'                    => $this->getBase(),
            'as_parent'               => array('except' => 'vc_row'),
            'as_child'                => array('only' => 'mkdf_info_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => esc_html__('by MIKADO', 'gotravel'),
            'icon'                    => 'icon-wpb-info-item extended-custom-icon',
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'gotravel'),
                    'param_name'  => 'dest_title',
                    'admin-label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Description', 'gotravel'),
                    'param_name'  => 'description'
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'dest_title'  => '',
            'description' => ''
        );

        $args   = array_merge($args, gotravel_mikado_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        extract($params);
        $params['content'] = $content;

        $output = '';

        $output .= gotravel_mikado_get_shortcode_module_template_part('templates/info-item-inner', 'info-items', '', $params);

        return $output;
    }
}