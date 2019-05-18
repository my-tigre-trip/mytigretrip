<?php
namespace MikadofTours\CPT\Attributes;

use MikadofTours\Lib;

/**
 * Class DestinationsRegister
 * @package MikadofTours\CPT\Destinations
 */
class AttributesRegister implements Lib\PostTypeInterface {
	/**
	 * @var string
	 */
	private $base;
	/**
	 * @var string
	 */
	private $taxBase;

	public function __construct() {
		$this->base    = 'tour-attributes';
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
	}

	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$slug         = $this->base;

		register_post_type($this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__('Tour Attributes', 'mikado-tours'),
					'menu_name'     => esc_html__('Tour Attributes', 'mikado-tours'),
					'all_items'     => esc_html__('Attributes Items', 'mikado-tours'),
					'add_new'       => esc_html__('Add New Attribut Item', 'mikado-tours'),
					'singular_name' => esc_html__('Attribut Item', 'mikado-tours'),
					'add_item'      => esc_html__('New Attribut Item', 'mikado-tours'),
					'add_new_item'  => esc_html__('Add New Attribut Item', 'mikado-tours'),
					'edit_item'     => esc_html__('Edit Attribut Item', 'mikado-tours')
				),
				'public'        => true,
				'has_archive'   => false,
				'rewrite'       => array('slug' => $slug),
				'show_ui'       => true,
				'show_in_menu' 		  => 'edit.php?post_type=tour-item',
				'supports'      => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments'
				)
			)
		);
	}
}