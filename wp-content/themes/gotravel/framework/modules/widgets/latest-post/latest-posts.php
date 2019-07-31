<?php

class GoTravelMikadoLatestPosts extends GoTravelMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkdf_latest_posts_widget', // Base ID
	        esc_html__('Mikado Latest Post', 'gotravel'), // Name
            array('description' => esc_html__('Display a list of your blog posts', 'gotravel')) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'gotravel')
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'gotravel'),
                'options' => array(
                    'minimal'      => esc_html__('Minimal', 'gotravel'),
                    'image-in-box' => esc_html__('Image in box', 'gotravel')
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => esc_html__('Number of posts', 'gotravel')
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order By', 'gotravel'),
                'options' => array(
                    'title' => esc_html__('Title', 'gotravel'),
                    'date'  => esc_html__('Date', 'gotravel')
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order', 'gotravel'),
                'options' => array(
                    'ASC'  => esc_html__('ASC', 'gotravel'),
                    'DESC' => esc_html__('DESC', 'gotravel')
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => esc_html__('Image Size', 'gotravel'),
                'options' => array(
                    'original'  => esc_html__('Original', 'gotravel'),
                    'landscape' => esc_html__('Landscape', 'gotravel'),
                    'square'    => esc_html__('Square', 'gotravel'),
                    'custom'    => esc_html__('Custom', 'gotravel')
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => esc_html__('Custom Image Size', 'gotravel')
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => esc_html__('Category Slug', 'gotravel')
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => esc_html__('Number of characters', 'gotravel')
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => esc_html__('Title Tag', 'gotravel'),
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            ),
            array(
                'name'    => 'remove_category',
                'type'    => 'dropdown',
                'title'   => esc_html__('Remove Comments on Image In Box', 'gotravel'),
                'options' => array(
                    'yes' => esc_html__('Yes', 'gotravel'),
                    'no'  => esc_html__('No', 'gotravel')
                ),
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkdf-latest-posts-widget">';

        if(!empty($instance['title'])) {
            print $args['before_title'].$instance['title'].$args['after_title'];
        }

        echo gotravel_mikado_execute_shortcode('mkdf_blog_list', $params);

        echo '</div>'; //close mkdf-latest-posts-widget
    }
}
