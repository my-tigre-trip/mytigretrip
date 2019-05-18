<?php
namespace MikadoCore\CPT\Carousels\Shortcodes;

use MikadoCore\Lib;

/**
 * Class Carousel
 * @package MikadoCore\CPT\Carousels\Shortcodes
 */
class Carousel implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_carousel';

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
            'name'                      => esc_html__('Mikado Carousel', 'mikado-core'),
            'base'                      => $this->base,
            'category'                  => esc_html__( 'by MIKADO', 'mikado-core' ),
            'icon'                      => 'icon-wpb-carousel-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Carousel Slider', 'mikado-core'),
                    'param_name'  => 'carousel',
                    'value'       => mkd_core_get_carousel_slider_array_vc(),
	                'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order By', 'mikado-core'),
                    'param_name'  => 'orderby',
                    'value'       => array(
					    esc_html__('Title', 'mikado-core') => 'title',
					    esc_html__('Date', 'mikado-core')  => 'date'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order', 'mikado-core'),
                    'param_name'  => 'order',
                    'value'       => array(
                        esc_html__('ASC', 'mikado-core')  => 'ASC',
                        esc_html__('DESC', 'mikado-core') => 'DESC',
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Number of Items Showing', 'mikado-core'),
                    'param_name'  => 'number_of_items',
                    'value'       => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Image Animation', 'mikado-core'),
                    'param_name'  => 'image_animation',
                    'value'       => array(
					    esc_html__('Image Change', 'mikado-core') => 'image-change',
					    esc_html__('Image Zoom', 'mikado-core')   => 'image-zoom'
                    ),
                    'save_always' => true,
                    'description' => esc_html__('Note: Only on "Image Change" zoom image will be used', 'mikado-core')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Show Navigation?', 'mikado-core'),
                    'param_name'  => 'show_navigation',
                    'value'       => array(
					    esc_html__('Yes', 'mikado-core') => 'yes',
					    esc_html__('No', 'mikado-core')  => 'no',
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Number of Rows', 'mikado-core'),
                    'param_name'  => 'show_items_in_rows',
                    'value'       => array(
                        "1" => "1",
                        "2" => "2",
                        "3" => "3"
                    )
                ),
	            array(
		            'type'        => 'dropdown',
		            'heading'     => esc_html__('Enable Boxed Layout?', 'mikado-core'),
		            'param_name'  => 'enable_boxed_layout',
		            'value'       => array(
			            esc_html__('No', 'mikado-core')  => 'no',
			            esc_html__('Yes', 'mikado-core') => 'yes'
		            )
	            ),
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
            'carousel'           => '',
            'orderby'            => 'date',
            'order'              => 'ASC',
            'number_of_items'    => '7',
            'image_animation'    => 'image-change',
            'show_navigation'    => '',
            'show_items_in_rows' => '',
	        'enable_boxed_layout' => 'no'
        );

        $params                             = shortcode_atts($args, $atts);
        $params['carousel_data_attributes'] = $this->getCarouselDataAttributes($params);

        extract($params);

        $html = '';

        if($carousel !== '') {
	        
            if($show_items_in_rows === '1') {
                $carousel_holder_classes = 'mkdf-carousel-one-row';
            } elseif($show_items_in_rows === '2') {
                $carousel_holder_classes = 'mkdf-carousel-two-rows';
            } else {
                $carousel_holder_classes = 'mkdf-carousel-three-rows';
            }
	
	        if($enable_boxed_layout == 'yes') {
		        $carousel_holder_classes .= ' mkdf-carousel-boxed';
	        }

            if($show_navigation == 'yes') {
                $carousel_holder_classes .= ' mkdf-carousel-navigation';
            }

            $html .= '<div class="mkdf-carousel-holder clearfix '.$carousel_holder_classes.'">';
            $html .= '<div class="mkdf-carousel " '.gotravel_mikado_get_inline_attrs($carousel_data_attributes).'>';

            $args = array(
            	'post_status'        => 'publish',
                'post_type'          => 'carousels',
                'carousels_category' => $params['carousel'],
                'orderby'            => $params['orderby'],
                'order'              => $params['order'],
                'posts_per_page'     => '-1'
            );

            $query = new \WP_Query($args);

            $post_count = 1;
            if($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    $carousel_item = $this->getCarouselItemData(get_the_ID(), $params);

                    if(($post_count % 3 === 1 || $post_count === 1) && $show_items_in_rows === '3') {
                        $html .= '<div class="mkdf-carousel-item-outer-holder">';
                    } elseif($post_count % 2 !== 0 && $show_items_in_rows === '2') {
                        $html .= '<div class="mkdf-carousel-item-outer-holder">';
                    } elseif($show_items_in_rows == '') {
                        $html .= '<div class="mkdf-carousel-item-outer-holder">';
                    }

                    $html .= mkd_core_get_shortcode_module_template_part('carousel-template', 'carousels', '', $carousel_item);

                    if($post_count % 3 === 0 && $show_items_in_rows === '3') {
                        $html .= '</div>';
                    } elseif($post_count % 2 === 0 && $show_items_in_rows === '2') {
                        $html .= '</div>';
                    } elseif($show_items_in_rows == '') {
                        $html .= '</div>';
                    }
                    $post_count++;
                }
            }

            wp_reset_postdata();


            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    /**
     * Return all data that carousel needs, images, titles, links, etc
     *
     * @param $params
     *
     * @return array
     */
    private function getCarouselItemData($item_id, $params) {
        $carousel_item = array();

        if(($meta_temp = get_post_meta($item_id, 'mkdf_carousel_image', true)) !== '') {
            $carousel_item['image']    = $meta_temp;
            $carousel_item['image_id'] = mkd_core_get_attachment_id_from_url($carousel_item['image']);
        } else {
            $carousel_item['image'] = '';
        }

        if($params['image_animation'] == 'image-change' && ($meta_temp = get_post_meta($item_id, 'mkdf_carousel_hover_image', true)) !== '') {
            $carousel_item['hover_image']    = $meta_temp;
            $carousel_item['hover_class']    = 'mkdf-has-hover-image';
            $carousel_item['hover_image_id'] = mkd_core_get_attachment_id_from_url($carousel_item['hover_image']);
        } else {
            $carousel_item['hover_image'] = '';
            $carousel_item['hover_class'] = '';
        }

        if(($meta_temp = get_post_meta($item_id, 'mkdf_carousel_item_link', true)) != '') {
            $carousel_item['link'] = $meta_temp;
        } else {
            $carousel_item['link'] = '';
        }

        if(($meta_temp = get_post_meta($item_id, 'mkdf_carousel_item_title', true)) != '') {
            $carousel_item['car_title'] = $meta_temp;
        } else {
            $carousel_item['car_title'] = '';
        }

        if(($meta_temp = get_post_meta($item_id, 'mkdf_carousel_item_text', true)) != '') {
            $carousel_item['text'] = $meta_temp;
        } else {
            $carousel_item['text'] = '';
        }

        if(($meta_temp = get_post_meta($item_id, 'mkdf_carousel_item_target', true)) != '') {
            $carousel_item['target'] = $meta_temp;
        } else {
            $carousel_item['target'] = '_self';
        }

        $carousel_item['title'] = get_the_title();

        $carousel_item['carousel_image_classes'] = $this->getCarouselImageClasses($params);

        return $carousel_item;
    }

    /**
     * Return CSS classes for carousel image
     *
     * @param $params
     *
     * @return array
     */
    private function getCarouselImageClasses($params) {
        $carousel_image_classes = array();
	    
        if($params['image_animation'] !== '') {
            $carousel_image_classes[] = 'mkdf-'.$params['image_animation'];
        }

        return implode(' ', $carousel_image_classes);
    }

    /**
     * Return data attributes for carousel
     *
     * @param $params
     *
     * @return array
     */
    private function getCarouselDataAttributes($params) {
        $carousel_data = array();

        if($params['number_of_items'] !== '') {
            $carousel_data['data-items'] = $params['number_of_items'];
        }

        if($params['show_navigation'] !== '') {
            $carousel_data['data-navigation'] = $params['show_navigation'];
        }

        return $carousel_data;
    }
}