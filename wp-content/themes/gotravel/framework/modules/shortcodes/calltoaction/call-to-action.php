<?php
namespace GoTravel\Modules\Shortcodes\CallToAction;

use GoTravel\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CallToAction
 */
class CallToAction implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_call_to_action';

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
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        $call_to_action_button_icons_array     = array();
        $call_to_action_button_IconCollections = gotravel_mikado_icon_collections()->iconCollections;
        foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

            $call_to_action_button_icons_array[] = array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Button Icon', 'gotravel'),
                'param_name'  => 'button_'.$collection->param,
                'value'       => $collection->getIconsArray(),
                'save_always' => true,
                'dependency'  => Array('element' => 'button_icon_pack', 'value' => array($collection_key))
            );

        }

        vc_map(array(
            'name'                      => esc_html__('Mikado Call to Action', 'gotravel'),
            'base'                      => $this->getBase(),
            'category'                  => esc_html__('by MIKADO', 'gotravel'),
            'icon'                      => 'icon-wpb-call-to-action extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Full Width', 'gotravel'),
                        'param_name'  => 'full_width',
                        'admin_label' => true,
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false, true)),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Content in grid', 'gotravel'),
                        'param_name'  => 'content_in_grid',
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false, true)),
                        'save_always' => true,
                        'dependency'  => array('element' => 'full_width', 'value' => 'yes')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Grid size', 'gotravel'),
                        'param_name'  => 'grid_size',
                        'value'       => array(
                            '75/25' => '75',
                            '50/50' => '50',
                            '66/33' => '66'
                        ),
                        'save_always' => true,
                        'dependency'  => array('element' => 'content_in_grid', 'value' => 'yes')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type', 'gotravel'),
                        'param_name'  => 'type',
                        'admin_label' => true,
                        'value'       => array(
						    esc_html__('Normal', 'gotravel')    => 'normal',
						    esc_html__('With Icon', 'gotravel') => 'with-icon',
                        ),
                        'save_always' => true
                    )
                ),
                gotravel_mikado_icon_collections()->getVCParamsArray(array(
                    'element' => 'type',
                    'value'   => array('with-icon')
                )),
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Icon Size (px)', 'gotravel'),
                        'param_name'  => 'icon_size',
                        'dependency'  => array('element' => 'type', 'value' => array('with-icon')),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Box Padding (top right bottom left) px', 'gotravel'),
                        'param_name'  => 'box_padding',
                        'description' => esc_html__('Default padding is 20px on all sides', 'gotravel'),
                        'group'       => esc_html__('Design Options', 'gotravel')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Box Background Color', 'gotravel'),
                        'param_name'  => 'box_background_color',
                        'group'       => esc_html__('Design Options', 'gotravel')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Box Border Color', 'gotravel'),
                        'param_name'  => 'box_border_color',
                        'group'       => esc_html__('Design Options', 'gotravel')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Box Border Width (px)', 'gotravel'),
                        'param_name'  => 'box_border_width',
                        'group'       => esc_html__('Design Options', 'gotravel')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Default Text Font Size (px)', 'gotravel'),
                        'param_name'  => 'text_size',
                        'description' => esc_html__('Font size for p tag', 'gotravel'),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Show Button', 'gotravel'),
                        'param_name'  => 'show_button',
                        'value'       => array_flip(gotravel_mikado_get_yes_no_select_array(false, true)),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Type', 'gotravel'),
                        'param_name'  => 'button_type',
                        'value'       => array_flip(gotravel_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Hover Button Type', 'gotravel'),
                        'param_name'  => 'button_hover_type',
                        'value'       => array_flip(gotravel_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Hover Animation', 'gotravel'),
                        'param_name'  => 'button_hover_animation',
                        'value'       => array_flip(gotravel_mikado_get_btn_hover_animation_types(true)),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Position', 'gotravel'),
                        'param_name'  => 'button_position',
                        'value'       => array(
						    esc_html__('Default/right', 'gotravel') => '',
						    esc_html__('Center', 'gotravel')        => 'center',
						    esc_html__('Left', 'gotravel')          => 'left'
                        ),
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Size', 'gotravel'),
                        'param_name'  => 'button_size',
                        'value'       => array(
						    esc_html__('Default', 'gotravel')     => '',
						    esc_html__('Small', 'gotravel')       => 'small',
						    esc_html__('Medium', 'gotravel')      => 'medium',
						    esc_html__('Large', 'gotravel')       => 'large',
						    esc_html__('Extra Large', 'gotravel') => 'big_large'
                        ),
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes')),
                        'group'       => esc_html__('Design Options', 'gotravel'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Button Text', 'gotravel'),
                        'param_name'  => 'button_text',
                        'description' => esc_html__('Default text is "button"', 'gotravel'),
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Button Link', 'gotravel'),
                        'param_name'  => 'button_link',
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Target', 'gotravel'),
                        'param_name'  => 'button_target',
                        'value'       => array(
						    esc_html__('Same Window', 'gotravel')  => '_self',
						    esc_html__('New Window', 'gotravel') => '_blank'
                        ),
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_color',
		                'heading'    => esc_html__('Button Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_hover_color',
		                'heading'    => esc_html__('Button Hover Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_background_color',
		                'heading'    => esc_html__('Button Background Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_hover_background_color',
		                'heading'    => esc_html__('Button Hover Background Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_border_color',
		                'heading'    => esc_html__('Button Border Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
	                array(
		                'type'       => 'colorpicker',
		                'param_name' => 'button_hover_border_color',
		                'heading'    => esc_html__('Button Hover Border Color', 'gotravel'),
		                'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
	                ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Button Icon Pack', 'gotravel'),
                        'param_name'  => 'button_icon_pack',
                        'value'       => array_merge(array('No Icon' => ''), gotravel_mikado_icon_collections()->getIconCollectionsVC()),
                        'save_always' => true,
                        'dependency'  => array('element' => 'show_button', 'value' => array('yes'))
                    )
                ),
                $call_to_action_button_icons_array,
                array(
                    array(
                        'type'        => 'textarea_html',
                        'heading'     => esc_html__('Content', 'gotravel'),
                        'param_name'  => 'content',
                        'value'       => '<p>'.esc_html__('I am test text for Call to action.', 'gotravel').'</p>'
                    )
                )
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
            'type'                          => 'normal',
            'button_type'                   => '',
            'button_hover_type'             => '',
            'full_width'                    => 'yes',
            'content_in_grid'               => 'yes',
            'grid_size'                     => '75',
            'icon_size'                     => '',
            'box_padding'                   => '20px',
            'box_background_color'          => '',
            'box_border_color'              => '',
            'box_border_width'              => '',
            'text_size'                     => '',
            'show_button'                   => 'yes',
            'button_position'               => 'right',
            'button_size'                   => 'medium',
            'button_link'                   => '',
            'button_text'                   => 'button',
            'button_target'                 => '',
            'button_color'                  => '',
            'button_hover_color'            => '',
            'button_background_color'       => '',
            'button_hover_background_color' => '',
            'button_border_color'           => '',
            'button_hover_border_color'     => '',
            'button_icon_pack'              => '',
            'button_hover_animation'        => ''
        );

        $call_to_action_icons_form_fields = array();

        foreach(gotravel_mikado_icon_collections()->iconCollections as $collection_key => $collection) {

            $call_to_action_icons_form_fields['button_'.$collection->param] = '';

        }

        $args = array_merge($args, gotravel_mikado_icon_collections()->getShortcodeParams(), $call_to_action_icons_form_fields);

        $params = shortcode_atts($args, $atts);

		$params['content']					= preg_replace('#^<\/p>|<p>$#', '', $content);
        $params['text_wrapper_classes']		= $this->getTextWrapperClasses($params);
        $params['content_styles']			= $this->getContentStyles($params);
        $params['call_to_action_styles']	= $this->getCallToActionStyles($params);
        $params['icon']						= $this->getCallToActionIcon($params);
        $params['button_parameters']		= $this->getButtonParameters($params);

        $params['button_type'] = !empty($params['button_type']) ? $params['button_type'] : 'solid';


        //Get HTML from template
        $html = gotravel_mikado_get_shortcode_module_template_part('templates/call-to-action-template', 'calltoaction', '', $params);

        return $html;

    }

    /**
     * Return Classes for Call To Action text wrapper
     *
     * @param $params
     *
     * @return string
     */
    private function getTextWrapperClasses($params) {
        return ($params['show_button'] == 'yes') ? 'mkdf-call-to-action-column1 mkdf-call-to-action-cell' : '';
    }

    /**
     * Return CSS styles for Call To Action Icon
     *
     * @param $params
     *
     * @return string
     */
    private function getIconStyles($params) {
        $icon_style = array();

        if($params['icon_size'] !== '') {
            $icon_style[] = 'font-size: '.$params['icon_size'].'px';
        }

        return implode(';', $icon_style);
    }

    /**
     * Return CSS styles for Call To Action Content
     *
     * @param $params
     *
     * @return string
     */
    private function getContentStyles($params) {
        $content_styles = array();

        if($params['text_size'] !== '') {
            $content_styles[] = 'font-size: '.$params['text_size'].'px';
        }

        return implode(';', $content_styles);
    }

    /**
     * Return CSS styles for Call To Action shortcode
     *
     * @param $params
     *
     * @return string
     */
    private function getCallToActionStyles($params) {
        $call_to_action_styles = array();

        if($params['box_padding'] != '') {
            $call_to_action_styles[] = 'padding: '.$params['box_padding'].';';
        }

        if($params['box_background_color'] != '') {
            $call_to_action_styles[] = 'background-color: '.$params['box_background_color'].';';
        }

        if($params['box_border_color'] != '') {
            $call_to_action_styles[] = 'border-color: '.$params['box_border_color'].';';
            $call_to_action_styles[] = 'border-style: solid';

            $border_width = 2;

            if($params['box_border_width'] !== '') {
                $border_width = gotravel_mikado_filter_px($params['box_border_width']);
            }

            $call_to_action_styles[] = 'border-width: '.$border_width.'px';
        }

        return $call_to_action_styles;
    }

    /**
     * Return Icon for Call To Action Shortcode
     *
     * @param $params
     *
     * @return mixed
     */
    private function getCallToActionIcon($params) {

        $icon                                   = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $iconStyles                             = array();
        $iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);
        $call_to_action_icon                    = '';
        if(!empty($params[$icon])) {
            $call_to_action_icon = gotravel_mikado_icon_collections()->renderIcon($params[$icon], $params['icon_pack'], $iconStyles);
        }

        return $call_to_action_icon;

    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if(!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        if(!empty($params['button_size'])) {
            $button_params_array['size'] = $params['button_size'];
        }

        if(!empty($params['button_type'])) {
            $button_params_array['type'] = $params['button_type'];
        }

        if(!empty($params['button_icon_pack'])) {
            $button_params_array['icon_pack']   = $params['button_icon_pack'];
            $iconPackName                       = gotravel_mikado_icon_collections()->getIconCollectionParamNameByKey($params['button_icon_pack']);
            $button_params_array[$iconPackName] = $params['button_'.$iconPackName];
        }

        if(!empty($params['button_target'])) {
            $button_params_array['target'] = $params['button_target'];
        }
	
	    if(!empty($params['button_color'])) {
		    $button_params_array['color'] = $params['button_color'];
	    }
	
	    if(!empty($params['button_hover_color'])) {
		    $button_params_array['hover_color'] = $params['button_hover_color'];
	    }
	
	    if(!empty($params['button_background_color'])) {
		    $button_params_array['background_color'] = $params['button_background_color'];
	    }
	
	    if(!empty($params['button_hover_background_color'])) {
		    $button_params_array['hover_background_color'] = $params['button_hover_background_color'];
	    }
	
	    if(!empty($params['button_border_color'])) {
		    $button_params_array['border_color'] = $params['button_border_color'];
	    }
	
	    if(!empty($params['button_hover_border_color'])) {
		    $button_params_array['hover_border_color'] = $params['button_hover_border_color'];
	    }

        if(!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        $button_params_array['hover_type']      = $params['button_hover_type'];
        $button_params_array['hover_animation'] = $params['button_hover_animation'];

        return $button_params_array;
    }
}