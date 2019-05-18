<?php
namespace MikadofTours\CPT\Tours;

use MikadofTours\Lib;

/**
 * Class ToursRegister
 * @package MikadofTours\CPT\Tours
 */
class ToursRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base    = 'tour-item';
        $this->taxBase = 'tour-category';
        add_filter('single_template', array($this, 'registerSingleTemplate'));

        add_action('admin_menu', array($this, 'removeReviewCriteriaMetaBox'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers listing-item single template if one does'nt exists in theme.
     * Hooked to single_template filter
     *
     * @param $single string current template
     *
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-tour-item.php')) {
                return MIKADO_TOURS_CPT_PATH.'/tours/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $gotravel_mikado_Framework;

        $menuPosition = 11;
        $menuIcon     = 'dashicons-before';
	    
        if(mkdf_tours_theme_installed()) {
            $menuPosition = $gotravel_mikado_Framework->getSkin()->getMenuItemPosition('tours');
            $menuIcon     = $gotravel_mikado_Framework->getSkin()->getMenuIcon('tours');
        }
        $slug = $this->base;

        register_post_type($this->base,
            array(
                'labels'        => array(
                    'name'          => esc_html__('Mikado Tour', 'mikado-tours'),
                    'menu_name'     => esc_html__('Mikado Tour', 'mikado-tours'),
                    'all_items'     => esc_html__('Tour Items', 'mikado-tours'),
                    'add_new'       => esc_html__('Add New Tour Item', 'mikado-tours'),
                    'singular_name' => esc_html__('Tour Item', 'mikado-tours'),
                    'add_item'      => esc_html__('New Tour Item', 'mikado-tours'),
                    'add_new_item'  => esc_html__('Add New Tour Item', 'mikado-tours'),
                    'edit_item'     => esc_html__('Edit Tour Item', 'mikado-tours')
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'show_in_menu'  => true,
                'supports'      => array(
                    'author',
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'page-attributes',
                    'comments'
                ),
                'menu_icon'     => $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Tours Categories', 'mikado-tours'),
            'singular_name'     => esc_html__('Tour Category', 'mikado-tours'),
            'search_items'      => esc_html__('Search Tours Categories', 'mikado-tours'),
            'all_items'         => esc_html__('All Tours Categories', 'mikado-tours'),
            'parent_item'       => esc_html__('Parent Tour Category', 'mikado-tours'),
            'parent_item_colon' => esc_html__('Parent Tour Category:', 'mikado-tours'),
            'edit_item'         => esc_html__('Edit Tour Category', 'mikado-tours'),
            'update_item'       => esc_html__('Update Tour Category', 'mikado-tours'),
            'add_new_item'      => esc_html__('Add New Tour Category', 'mikado-tours'),
            'new_item_name'     => esc_html__('New Tour Category Name', 'mikado-tours'),
            'menu_name'         => esc_html__('Tours Categories', 'mikado-tours'),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'tour-category'),
        ));

        register_taxonomy('review-criteria', array($this->base), array(
            'hierarchical'      => true,
            'show_ui'           => true,
            'labels'            => array(
                'name'              => esc_html__('Review Criteria', 'mikado-tours'),
                'singular_name'     => esc_html__('Review Criterion', 'mikado-tours'),
                'search_items'      => esc_html__('Search Review Criteria', 'mikado-tours'),
                'all_items'         => esc_html__('All Review Criteria', 'mikado-tours'),
                'parent_item'       => esc_html__('Parent Review Criterion', 'mikado-tours'),
                'parent_item_colon' => esc_html__('Parent Review Criterion:', 'mikado-tours'),
                'edit_item'         => esc_html__('Edit Review Criterion', 'mikado-tours'),
                'update_item'       => esc_html__('Update Review Criterion', 'mikado-tours'),
                'add_new_item'      => esc_html__('Add New Review Criterion', 'mikado-tours'),
                'new_item_name'     => esc_html__('New Review Criterion Name', 'mikado-tours'),
                'menu_name'         => esc_html__('Review Criteria', 'mikado-tours'),
            ),
            'query_var'         => true,
            'show_admin_column' => false,
        ));
    }

    public function removeReviewCriteriaMetaBox() {
        //remove review criteria meta box from tour single page,
        //because we don't want user to check review criteria for each tour
        remove_meta_box('review-criteriadiv', $this->base, 'side');
    }
}