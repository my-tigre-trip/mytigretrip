<?php

namespace MikadofTours\CPT\Tours\Shortcodes;

use MikadofTours\Lib\ShortcodeInterface;

class TourTypeList implements ShortcodeInterface {
    private $base;

    /**
     * TourTypeList constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_tour_type_list';
	    
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Tour Type List', 'mikado-tours'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mikado-tours'),
            'icon'                      => 'icon-wpb-tour-type-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Number of Tour Types', 'mikado-tours'),
                    'param_name'  => 'number'
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order By', 'mikado-tours'),
                    'param_name'  => 'orderby',
                    'value'       => array(
	                    esc_html__('Name', 'mikado-tours')  => 'name',
	                    esc_html__('Count', 'mikado-tours') => 'count'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Order Type', 'mikado-tours'),
                    'param_name'  => 'order',
                    'value'       => array(
					    esc_html__('ASC', 'mikado-tours')  => 'ASC',
					    esc_html__('DESC', 'mikado-tours') => 'DESC'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Choose Hover Color', 'mikado-tours'),
                    'param_name'  => 'hover_color',
                    'value'       => array(
	                    esc_html__('White', 'mikado-tours') => 'white',
	                    esc_html__('Gray', 'mikado-tours')  => 'gray'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Split in Two Columns', 'mikado-tours'),
                    'param_name'  => 'split_two_cols',
                    'value'       => array(
					    esc_html__('No', 'mikado-tours')  => 'no',
					    esc_html__('Yes', 'mikado-tours') => 'yes'
                    ),
	                'save_always' => true
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'number'          => '',
            'orderby'         => 'name',
            'order'           => 'ASC',
            'hover_color'     => '',
            'split_two_cols'  => ''
        );

        $params = shortcode_atts($args, $atts);

        $hover_holder = '';
        if($params['hover_color'] == 'gray') {
            $hover_holder = 'mkdf-gray-hover';
        }

        $params['li_hover_color'] = $hover_holder;

        $tour_types = $this->getTourTypes($params);

        $params['tour_types'] = $tour_types;
        $params['caller']     = $this;

        $params['split_two_cols'] = $params['split_two_cols'] === 'yes';
        $params['list_class']     = $params['split_two_cols'] ? 'mkdf-grid-col-6' : 'mkdf-grid-col-12';

        $divider = $params['split_two_cols'] ? ceil(count($tour_types) / 2) : count($tour_types);

        $tour_types_arrays = !empty($tour_types) ? array_chunk($tour_types, $divider) : '';

        $params['tour_types_arrays'] = $tour_types_arrays;

        return mkdf_tours_get_tour_module_template_part('templates/tour-type-list', 'tours', 'shortcodes', '', $params);
    }

    private function getTourTypes($params) {
        $defaults = array(
	        'taxonomy' => 'tour-category',
            'number'   => '',
            'orderby'  => 'name',
            'order'    => 'ASC'
        );

        $query_args = wp_parse_args($params, $defaults);

        return get_terms($query_args);
    }

    public function getTypeIcon($tour_type) {
        $type_image = get_term_meta($tour_type->term_id, 'term_custom_image', true);

        if(!empty($type_image)) {
            return '<img src="'.esc_url($type_image).'" alt="term-custom-icon">';
        }

        if(!mkdf_tours_theme_installed()) {
            return false;
        }

        $category_icon_pack = get_term_meta($tour_type->term_id, 'icon_pack', true);
        $icon_param_name    = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($category_icon_pack);
        $category_icon      = get_term_meta($tour_type->term_id, $icon_param_name, true);

        if(empty($category_icon)) {
            return '';
        }

        return gotravel_mikado_icon_collections()->renderIcon($category_icon, $category_icon_pack);
    }

    public function getTypeMinPrice($tour_type) {
        global $wpdb;
	
	    if(mkdf_tours_is_wpml_installed()) {
		    $lang = ICL_LANGUAGE_CODE;
		
		    $sql = "SELECT MIN(CAST(pm.meta_value AS UNSIGNED)) AS min_price
					FROM {$wpdb->prefix}postmeta pm
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
					LEFT JOIN {$wpdb->prefix}term_relationships tr ON tr.object_id = p.ID
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID
					WHERE pm.meta_key = 'mkdf_tours_price'
					AND tr.term_taxonomy_id = %d
					AND icl_t.language_code='$lang'";
	    } else {
		    $sql = "SELECT MIN(CAST(pm.meta_value AS UNSIGNED)) AS min_price
					FROM {$wpdb->prefix}postmeta pm
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
					LEFT JOIN {$wpdb->prefix}term_relationships tr ON tr.object_id = p.ID
					WHERE pm.meta_key = 'mkdf_tours_price'
					AND tr.term_taxonomy_id = %d";
	    }

        $results = $wpdb->get_results($wpdb->prepare($sql, $tour_type->term_id));

        if(!(is_array($results) && count($results))) {
            return false;
        }
        
	    $result_instance = array_shift($results);
	
	    return $result_instance->min_price;
    }
}