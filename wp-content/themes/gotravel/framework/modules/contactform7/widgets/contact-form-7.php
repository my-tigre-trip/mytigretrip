<?php

class GoTravelMikadoContactForm7 extends GoTravelMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkdf_contact_form7_widget', // Base ID
            esc_html__('Mikado Contact Form 7', 'gotravel'), // Name
            array('description' => esc_html__('Display Contact Form 7', 'gotravel'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {

        $contact_forms = array();

        $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

        if($cf7) {
            foreach($cf7 as $cform) {
                $contact_forms[$cform->ID] = $cform->post_title;
            }

        } else {
            $contact_forms[esc_html__('No contact forms found', 'gotravel')] = 0;
        }

        $this->params = array(
	        array(
		        'name'    => 'cf_type',
		        'type'    => 'dropdown',
		        'title'   => esc_html__('Choose Layout', 'gotravel'),
		        'options' => array(
			        'boxed'  => esc_html__('Boxed', 'gotravel'),
			        'normal' => esc_html__('Normal', 'gotravel')
		        ),
	        ),
	        array(
		        'name'    => 'cf_boxed_type_alignment',
		        'type'    => 'dropdown',
		        'title'   => esc_html__('Boxed Layout Alignment', 'gotravel'),
		        'options' => array(
			        ''  => esc_html__('Default (Center)', 'gotravel'),
			        'left' => esc_html__('Left', 'gotravel')
		        ),
	        ),
	        array(
		        'name'  => 'boxed_padding',
		        'type'  => 'textfield',
		        'title' => esc_html__('Padding (top right bottom left)', 'gotravel'),
		        'description' => esc_html__('Set padding for Boxed layout', 'gotravel')
	        ),
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'gotravel')
            ),
	        array(
		        'name'    => 'title_tag',
		        'type'    => 'dropdown',
		        'title'   => esc_html__('Title Tag', 'gotravel'),
		        'options' => array(
			        'h1' => 'h1',
			        'h2' => 'h2',
			        'h3' => 'h3',
			        'h4' => 'h4',
			        'h5' => 'h5',
			        'h6' => 'h6',
			        'p' => 'p'
		        )
	        ),
            array(
                'name'  => 'text',
                'type'  => 'textfield',
                'title' => esc_html__('Text', 'gotravel')
            ),
	        array(
		        'name'    => 'text_tag',
		        'type'    => 'dropdown',
		        'title'   => esc_html__('Text Tag', 'gotravel'),
		        'options' => array(
			        'h1' => 'h1',
			        'h2' => 'h2',
			        'h3' => 'h3',
			        'h4' => 'h4',
			        'h5' => 'h5',
			        'h6' => 'h6',
			        'p' => 'p'
		        )
	        ),
            array(
                'name'  => 'background_color',
                'type'  => 'textfield',
                'title' => esc_html__('Background Color', 'gotravel')
            ),
            array(
                'name'  => 'background_image',
                'type'  => 'textfield',
                'title' => esc_html__('Background Image Url', 'gotravel')
            ),
            array(
                'name'    => 'id',
                'type'    => 'dropdown',
                'title'   => esc_html__('Contact Form', 'gotravel'),
                'options' => $contact_forms
            ),
            array(
                'name'        => 'html_class',
                'type'        => 'dropdown',
                'title'       => esc_html__('Style', 'gotravel'),
                'options'     => array(
                    'default'            => esc_html__('Default', 'gotravel'),
                    'cf7_custom_style_1' => esc_html__('Custom Style 1', 'gotravel'),
                    'cf7_custom_style_2' => esc_html__('Custom Style 2', 'gotravel'),
                    'cf7_custom_style_3' => esc_html__('Custom Style 3', 'gotravel'),
                    'cf7_custom_style_4' => esc_html__('Custom Style 4', 'gotravel')
                ),
                'description' => esc_html__('You can style each form element individually in Mikado Options > Contact Form 7', 'gotravel')
            ),
            array(
                'name'    => 'color_type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Choose Skin', 'gotravel'),
                'options' => array(
	                '' => esc_html__('Default', 'gotravel'),
                	'light' => esc_html__('Light', 'gotravel'),
                    'dark'  => esc_html__('Dark', 'gotravel')
                )
            ),
	        array(
		        'name'    => 'button_position',
		        'type'    => 'dropdown',
		        'title'   => esc_html__('Set Submit Button Position', 'gotravel'),
		        'options' => array(
			        '' => esc_html__('Default', 'gotravel'),
			        'out-of-box' => esc_html__('Out Of Box', 'gotravel')
		        )
	        )
        );
    }
	
    public function widget($args, $instance) {
        extract($args);
	    
        $params = array();
        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }

        $layout_type = '';
        if($instance['cf_type'] == 'boxed') {
            $layout_type = 'mkdf-widget-cf-boxed';
        }
        
        if(isset($instance['button_position']) && !empty($instance['button_position'])) {
	        $layout_type .= ' mkdf-cf7-widget-button-out';
        }

        $cfStyles = array();

        if($instance['background_color'] !== '') {
            $cfStyles[] = 'background-color: '.$instance['background_color'];
        }

        if($instance['background_image'] !== '' && $instance['background_color'] == '') {
            $cfStyles[] = 'background-image: url('.$instance['background_image'].')';
        }
	
	    if($instance['cf_type'] == 'boxed' && $instance['boxed_padding'] !== '') {
		    $cfStyles[] = 'padding: ' . $instance['boxed_padding'];
	    }
	    
	    if($instance['cf_type'] == 'boxed' && isset($instance['cf_boxed_type_alignment']) && !empty($instance['cf_boxed_type_alignment'])) {
		    $cfStyles[] = 'text-align: ' . $instance['cf_boxed_type_alignment'];
	    }

        $layout_color = '';
        if(($instance['color_type']) == 'light') {
            $layout_color = ' mkdf-widget-cf-light';
        }
	    if(($instance['color_type']) == 'dark') {
		    $layout_color = ' mkdf-widget-cf-dark';
	    }

        $cf_custom_style = '';
        if(($instance['html_class']) === 'cf7_custom_style_1') {
            $cf_custom_style = ' cf7_custom_style_1';
        } elseif(($instance['html_class']) === 'cf7_custom_style_2') {
            $cf_custom_style = ' cf7_custom_style_2';
        } elseif(($instance['html_class']) === 'cf7_custom_style_3') {
	        $cf_custom_style = ' cf7_custom_style_3';
        } elseif(($instance['html_class']) === 'cf7_custom_style_4') {
	        $cf_custom_style = ' cf7_custom_style_4';
        }

        echo '<div class="widget mkdf-contact-form-7-widget '.$layout_type.$layout_color.$cf_custom_style.'" '.gotravel_mikado_get_inline_style($cfStyles).'>';

	    $title_tag = !empty($instance['title_tag']) ? $instance['title_tag'] : 'h2';
        if(!empty($instance['title'])) {
            print '<'.$title_tag.' class="mkdf-cft-title">'.$instance['title'].'</'.$title_tag.'>';
        }
	
	    $text_tag = !empty($instance['text_tag']) ? $instance['text_tag'] : 'h6';
        echo '<div class="mkdf-contact-form-text">';
	        if(!empty($instance['text'])) {
		        print '<'.$text_tag.' class="mkdf-cft-title">'.$instance['text'].'</'.$text_tag.'>';
	        }
        echo '</div>';

        echo gotravel_mikado_execute_shortcode('contact-form-7', $params);

        echo '</div>';
    }
}

add_action('widgets_init', function () {
    register_widget('GoTravelMikadoContactForm7');
});