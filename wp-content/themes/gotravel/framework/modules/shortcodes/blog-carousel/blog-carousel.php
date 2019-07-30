<?php

namespace GoTravel\Modules\Shortcodes\BlogCarousel;

use GoTravel\Modules\Blog\Lib\BlogQuery;
use GoTravel\Modules\Blog\Lib\BlogVCParams;
use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class BlogCarousel
 * @package GoTravel\Modules\Shortcodes\BlogCarousel
 */
class BlogCarousel implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var BlogVCParams
     */
    private $blogVCParams;

    /**
     * BlogCarousel constructor.
     */
    public function __construct() {
        $this->base         = 'mkdf_blog_carousel';
        $this->blogVCParams = new BlogVCParams();

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Blog Carousel', 'gotravel'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-blog-carousel extended-custom-icon',
            'category'                  => esc_html__('by MIKADO', 'gotravel'),
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text Length', 'gotravel'),
                        'param_name'  => 'text_length'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Disable Border?', 'gotravel'),
                        'param_name'  => 'disable_border',
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Hide Featured Image?', 'gotravel'),
                        'param_name'  => 'disable_image',
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false))
                    )
                ),
                $this->blogVCParams->queryVCParams()
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return \html
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'text_length'    => '90',
            'disable_border' => '',
            'disable_image'  => ''
        );

        $default_atts = array_merge($default_atts, $this->blogVCParams->getShortcodeAtts());
        $params       = shortcode_atts($default_atts, $atts);

        $blogQuery = new BlogQuery($params);

        $params['blogQuery'] = $blogQuery;
        $params['caller']    = $this;

        return gotravel_mikado_get_shortcode_module_template_part('templates/blog-carousel-holder', 'blog-carousel', '', $params);
    }

    public function getItemTemplate($params) {
        $params['item_style'] = array();

        if($params['disable_border'] === 'yes') {
            $params['item_style'] = 'border: none';
        }

        echo gotravel_mikado_get_shortcode_module_template_part('templates/blog-carousel-item', 'blog-carousel', '', $params);
    }

    public function featuredImageHidden($params) {
        return !has_post_thumbnail() || $params['disable_image'] === 'yes';
    }
}