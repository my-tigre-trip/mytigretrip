<?php
namespace GoTravel\Modules\Shortcodes\Icon;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon
 */
class Icon implements ShortcodeInterface {
	
    /**
     * Icon constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     *
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
            'name'                      => esc_html__('Mikado Icon', 'gotravel'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'gotravel'),
            'icon'                      => 'icon-wpb-icon extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                \GoTravelMikadoIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'size',
                        'heading'    => esc_html__('Size', 'gotravel'),
                        'value'      => array(
	                        esc_html__('Tiny', 'gotravel')       => 'mkdf-icon-tiny',
	                        esc_html__('Small', 'gotravel')      => 'mkdf-icon-small',
	                        esc_html__('Medium', 'gotravel')     => 'mkdf-icon-medium',
	                        esc_html__('Large', 'gotravel')      => 'mkdf-icon-large',
	                        esc_html__('Huge', 'gotravel') => 'mkdf-icon-huge'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'custom_size',
                        'heading'    => esc_html__('Custom Size (px)', 'gotravel')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'type',
                        'heading'    => esc_html__('Type', 'gotravel'),
                        'value'      => array(
						    esc_html__('Normal', 'gotravel') => 'mkdf-normal',
						    esc_html__('Circle', 'gotravel') => 'mkdf-circle',
						    esc_html__('Square', 'gotravel') => 'mkdf-square'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'border_radius',
                        'heading'     => esc_html__('Border Radius', 'gotravel'),
                        'description' => esc_html__('Please insert border radius(Rounded corners) in px. For example: 4 ', 'gotravel'),
                        'dependency'  => array('element' => 'type', 'value' => array('mkdf-square'))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'shape_size',
                        'heading'    => esc_html__('Shape Size (px)', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'icon_color',
                        'heading'    => esc_html__('Icon Color', 'gotravel')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'border_color',
                        'heading'    => esc_html__('Border Color', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'border_width',
                        'heading'    => esc_html__('Border Width', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'background_color',
                        'heading'    => esc_html__('Background Color', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_icon_color',
                        'heading'    => esc_html__('Hover Icon Color', 'gotravel')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_border_color',
                        'heading'    => esc_html__('Hover Border Color', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'hover_background_color',
                        'heading'    => esc_html__('Hover Background Color', 'gotravel'),
                        'dependency' => array('element' => 'type', 'value' => array('mkdf-circle', 'mkdf-square'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'margin',
                        'heading'     => esc_html__('Margin', 'gotravel'),
                        'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'gotravel')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'icon_animation',
                        'heading'     => esc_html__('Icon Animation', 'gotravel'),
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false))
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'icon_animation_delay',
                        'heading'    => esc_html__('Icon Animation Delay (ms)', 'gotravel'),
                        'dependency' => array('element' => 'icon_animation', 'value' => 'yes')
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'link',
                        'heading'    => esc_html__('Link', 'gotravel')
                    ),
                    array(
                        'type'        => 'checkbox',
                        'param_name'  => 'anchor_icon',
                        'heading'     => esc_html__('Use Link as Anchor', 'gotravel'),
                        'value'       => array('Use this icon as Anchor?' => 'yes'),
                        'description' => esc_html__('Check this box to use icon as anchor link (eg. #contact)', 'gotravel'),
                        'dependency'  => Array('element' => 'link', 'not_empty' => true)
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'target',
                        'heading'    => esc_html__('Target', 'gotravel'),
                        'value'      => array(
						    esc_html__('Same Window', 'gotravel')  => '_self',
						    esc_html__('New Window', 'gotravel') => '_blank'
                        ),
                        'dependency'  => array('element' => 'link', 'not_empty' => true)
                    )
                )
            )
        ));
    }

    /**
     * Renders shortcode's HTML
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'custom_size'            => '',
            'type'                   => 'mkdf-normal',
            'border_radius'          => '',
            'shape_size'             => '',
            'icon_color'             => '',
            'border_color'           => '',
            'border_width'           => '',
            'background_color'       => '',
            'hover_icon_color'       => '',
            'hover_border_color'     => '',
            'hover_background_color' => '',
            'margin'                 => '',
            'icon_animation'         => '',
            'icon_animation_delay'   => '',
            'link'                   => '',
            'anchor_icon'            => '',
            'target'                 => '_self'
        );

        $default_atts = array_merge($default_atts, gotravel_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        //generate icon holder classes
        $iconHolderClasses = array('mkdf-icon-shortcode', $params['type']);

        if($params['icon_animation'] == 'yes') {
            $iconHolderClasses[] = 'mkdf-icon-animation';
        }

        if($params['custom_size'] == '') {
            $iconHolderClasses[] = $params['size'];
        }

        //prepare params for template
        $params['icon']                  = $params[$iconPackName];
        $params['icon_holder_classes']   = $iconHolderClasses;
        $params['icon_holder_styles']    = $this->generateIconHolderStyles($params);
        $params['icon_holder_data']      = $this->generateIconHolderData($params);
        $params['icon_params']           = $this->generateIconParams($params);
        $params['icon_animation_holder'] = isset($params['icon_animation']) && $params['icon_animation'] == 'yes';
        $params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles($params);
	    $params['link_class']            = $this->getLinkClass($params);
	    $params['target']                = !empty($params['target']) ? $params['target'] : $default_atts['target'];
	    
        $html = gotravel_mikado_get_shortcode_module_template_part('templates/icon', 'icon', '', $params);

        return $html;
    }

    /**
     * Generates icon parameters array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconParams($params) {
        $iconParams = array('icon_attributes' => array());

        $iconParams['icon_attributes']['style'] = $this->generateIconStyles($params);
        $iconParams['icon_attributes']['class'] = 'mkdf-icon-element';

        return $iconParams;
    }

    /**
     * Generates icon styles array
     *
     * @param $params
     *
     * @return string
     */
    private function generateIconStyles($params) {
        $iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(($params['type'] !== 'mkdf-normal' && !empty($params['shape_size'])) || ($params['type'] == 'mkdf-normal')) {
            if(!empty($params['custom_size'])) {
                $iconStyles[] = 'font-size:'.gotravel_mikado_filter_px($params['custom_size']).'px';
            }
        }

        return implode(';', $iconStyles);
    }

    /**
     * Generates icon holder styles for circle and square icon type
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderStyles($params) {
        $iconHolderStyles = array();

        if(isset($params['margin']) && $params['margin'] !== '') {
            $iconHolderStyles[] = 'margin: '.$params['margin'];
        }

        //generate styles attribute only if type isn't normal
        if(isset($params['type']) && $params['type'] !== 'mkdf-normal') {

            $shapeSize = '';
            if(!empty($params['shape_size'])) {
                $shapeSize = $params['shape_size'];
            } elseif(!empty($params['custom_size'])) {
                $shapeSize = $params['custom_size'];
            }

            if(!empty($shapeSize)) {
                $iconHolderStyles[] = 'width: '.gotravel_mikado_filter_px($shapeSize).'px';
                $iconHolderStyles[] = 'height: '.gotravel_mikado_filter_px($shapeSize).'px';
                $iconHolderStyles[] = 'line-height: '.gotravel_mikado_filter_px($shapeSize).'px';
            }

            if(!empty($params['background_color'])) {
                $iconHolderStyles[] = 'background-color: '.$params['background_color'];
            }

            if(!empty($params['border_color']) && (isset($params['border_width']) && $params['border_width'] !== '')) {
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
				$iconHolderStyles[] = 'border-width: '.gotravel_mikado_filter_px($params['border_width']).'px';
			} else if(isset($params['border_width']) && $params['border_width'] !== ''){
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-width: '.gotravel_mikado_filter_px($params['border_width']).'px';
			} else if(!empty($params['border_color'])){
				$iconHolderStyles[] = 'border-color: '.$params['border_color'];
			}

            if($params['type'] == 'mkdf-square') {
                if(isset($params['border_radius']) && $params['border_radius'] !== '') {
                    $iconHolderStyles[] = 'border-radius: '.gotravel_mikado_filter_px($params['border_radius']).'px';
                }
            }
        }

        return $iconHolderStyles;
    }

    /**
     * Generates icon holder data attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function generateIconHolderData($params) {
        $iconHolderData = array();

        if(isset($params['type']) && $params['type'] !== 'mkdf-normal') {
            if(!empty($params['hover_border_color'])) {
                $iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
            }

            if(!empty($params['hover_background_color'])) {
                $iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
            }
        }

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes')
           && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')
        ) {
            $iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
        }

        if(!empty($params['hover_icon_color'])) {
            $iconHolderData['data-hover-color'] = $params['hover_icon_color'];
        }

        if(!empty($params['icon_color'])) {
            $iconHolderData['data-color'] = $params['icon_color'];
        }

        return $iconHolderData;
    }

    private function generateIconAnimationHolderStyles($params) {
        $styles = array();

        if((isset($params['icon_animation']) && $params['icon_animation'] == 'yes') && (isset($params['icon_animation_delay']) && $params['icon_animation_delay'] !== '')) {
            $styles[] = 'transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-webkit-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-moz-transition-delay: '.$params['icon_animation_delay'].'ms';
            $styles[] = '-ms-transition-delay: '.$params['icon_animation_delay'].'ms';
        }

        return $styles;
    }

    private function getLinkClass($params) {
        $class = '';

        if($params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes') {
            $class .= 'mkdf-anchor';
        }

        return $class;
    }
}