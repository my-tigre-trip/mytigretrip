<?php
namespace MikadoCore\CPT\MasonryGallery;

use MikadoCore\Lib;

/**
 * Class MasonryGalleryRegister
 * @package MikadoCore\CPT\MasonryGallery
 */
class MasonryGalleryRegister implements Lib\PostTypeInterface  {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'masonry-gallery';
        $this->taxBase = 'masonry-gallery-category';
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
     * Registers custom post type with WordPress
     */

   private function registerPostType() {
	   global $gotravel_mikado_Framework;

	   $menuPosition = 7;
	   $menuIcon = 'dashicons-admin-post';

	   if(mkd_core_theme_installed()) {
		   $menuPosition = $gotravel_mikado_Framework->getSkin()->getMenuItemPosition('masonry-gallery');
		   $menuIcon = $gotravel_mikado_Framework->getSkin()->getMenuIcon('masonry-gallery');
	   }

        register_post_type($this->base,
            array(
                'labels' 		=> array(
                    'name' 				=> esc_html__('Mikado Masonry Gallery', 'mikado-core' ),
                    'menu_name'         => esc_html__('Mikado Masonry Gallery', 'mikado-core'),
                    'all_items'			=> esc_html__('Masonry Gallery Items', 'mikado-core'),
                    'singular_name' 	=> esc_html__('Masonry Gallery Item', 'mikado-core' ),
                    'add_item'			=> esc_html__('New Masonry Gallery Item', 'mikado-core'),
                    'add_new_item' 		=> esc_html__('Add New Masonry Gallery Item', 'mikado-core'),
                    'edit_item' 		=> esc_html__('Edit Masonry Gallery Item', 'mikado-core')
                ),
                'public'		=>	false,
                'show_in_menu'	=>	true,
                'rewrite' 		=> 	array('slug' => 'masonry-gallery'),
				'menu_position' => 	$menuPosition,
                'show_ui'		=>	true,
                'has_archive'	=>	false,
                'hierarchical'	=>	false,
                'supports'		=>	array('title', 'thumbnail'),
				'menu_icon'  =>  $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name' => esc_html__('Masonry Gallery Categories', 'mikado-core'),
            'singular_name' => esc_html__('Masonry Gallery Category', 'mikado-core'),
            'search_items' =>  esc_html__('Search Masonry Gallery Categories', 'mikado-core'),
            'all_items' => esc_html__('All Masonry Gallery Categories', 'mikado-core'),
            'parent_item' => esc_html__('Parent Masonry Gallery Category', 'mikado-core'),
            'parent_item_colon' => esc_html__('Parent Masonry Gallery Category:', 'mikado-core'),
            'edit_item' => esc_html__('Edit Masonry Gallery Category', 'mikado-core'),
            'update_item' => esc_html__('Update Masonry Gallery Category', 'mikado-core'),
            'add_new_item' => esc_html__('Add New Masonry Gallery Category', 'mikado-core'),
            'new_item_name' => esc_html__('New Masonry Gallery Category Name', 'mikado-core'),
            'menu_name' => esc_html__('Masonry Gallery Categories', 'mikado-core'),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'masonry-gallery-category' ),
        ));
    }
}