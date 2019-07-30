<?php

if(!function_exists('gotravel_mikado_sidearea_options_map')) {

	function gotravel_mikado_sidearea_options_map() {

		gotravel_mikado_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__('Side Area', 'gotravel'),
				'icon'  => 'fa fa-search'
			)
		);

		$side_area_panel = gotravel_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'gotravel'),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'select',
				'name'          => 'side_area_type',
				'default_value' => 'side-menu-slide-from-right',
				'label'         => esc_html__('Side Area Type', 'gotravel'),
				'description'   => esc_html__('Choose a type of Side Area', 'gotravel'),
				'options'       => array(
					'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'gotravel'),
					'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'gotravel'),
					'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'gotravel')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'side-menu-slide-from-right'       => '#mkdf_side_area_slide_with_content_container',
						'side-menu-slide-with-content'     => '#mkdf_side_area_width_container',
						'side-area-uncovered-from-content' => '#mkdf_side_area_width_container, #mkdf_side_area_slide_with_content_container'
					),
					'show'       => array(
						'side-menu-slide-from-right'       => '#mkdf_side_area_width_container',
						'side-menu-slide-with-content'     => '#mkdf_side_area_slide_with_content_container',
						'side-area-uncovered-from-content' => ''
					)
				)
			)
		);

		$side_area_width_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_width_container',
				'hidden_property' => 'side_area_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'side-menu-slide-with-content',
					'side-area-uncovered-from-content'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__('Side Area Width', 'gotravel'),
				'description'   => esc_html__('Enter a width for Side Area (in percentages, enter more than 30)', 'gotravel'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'color',
				'name'          => 'side_area_content_overlay_color',
				'default_value' => '',
				'label'         => esc_html__('Content Overlay Background Color', 'gotravel'),
				'description'   => esc_html__('Choose a background color for a content overlay', 'gotravel'),
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_width_container,
				'type'          => 'text',
				'name'          => 'side_area_content_overlay_opacity',
				'default_value' => '',
				'label'         => esc_html__('Content Overlay Background Transparency', 'gotravel'),
				'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'gotravel'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		$side_area_slide_with_content_container = gotravel_mikado_add_admin_container(
			array(
				'parent'          => $side_area_panel,
				'name'            => 'side_area_slide_with_content_container',
				'hidden_property' => 'side_area_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'side-menu-slide-from-right',
					'side-area-uncovered-from-content'
				)
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_slide_with_content_container,
				'type'          => 'select',
				'name'          => 'side_area_slide_with_content_width',
				'default_value' => 'width-470',
				'label'         => esc_html__('Side Area Width', 'gotravel'),
				'description'   => esc_html__('Choose width for Side Area', 'gotravel'),
				'options'       => array(
					'width-270' => esc_html__('270px', 'gotravel'),
					'width-370' => esc_html__('370px', 'gotravel'),
					'width-470' => esc_html__('470px', 'gotravel')
				)
			)
		);

		gotravel_mikado_add_admin_field(array(
				'parent'      => $side_area_panel,
				'type'        => 'image',
				'name'        => 'side_area_bakground_image',
				'label'       => esc_html__('Side Area Background Image', 'gotravel'),
				'description' => esc_html__('Choose background image for Side Area', 'gotravel')
			)
		);

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'yesno',
				'name'          => 'side_area_enable_default_opener',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Default Side Area Opener Icon', 'gotravel'),
				'description'   => esc_html__('Enabling this option will enable default side area opener icon', 'gotravel'),
				'args'          => array(
					'dependence'             => true,
					'dependence_show_on_yes' => '',
					'dependence_hide_on_yes' => '#mkdf_side_area_opener_icon_container_no_style'
				)
			)
		);

//init icon pack hide and show array. It will be populated dinamically from collections array
		$side_area_icon_pack_hide_array = array();
		$side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
		if(is_array(gotravel_mikado_icon_collections()->iconCollections) && count(gotravel_mikado_icon_collections()->iconCollections)) {
			//get collections params array. It will contain values of 'param' property for each collection
			$side_area_icon_collections_params = gotravel_mikado_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach(gotravel_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$side_area_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$side_area_icon_pack_show_array[$dep_collection_key] = '#mkdf_side_area_icon_'.$dep_collection_object->param.'_container';

				//for all collections param generate hide string
				foreach($side_area_icon_collections_params as $side_area_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if($side_area_icon_collections_param !== $dep_collection_object->param) {
						$side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkdf_side_area_icon_'.$side_area_icon_collections_param.'_container,';
					}
				}

				//remove remaining ',' character
				$side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
			}
		}

		$side_area_opener_icon_container_no_style = gotravel_mikado_add_admin_container_no_style(array(
			'name'            => 'side_area_opener_icon_container_no_style',
			'parent'          => $side_area_panel,
			'hidden_property' => 'side_area_enable_default_opener',
			'hidden_value'    => 'yes'
		));

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_opener_icon_container_no_style,
				'type'          => 'select',
				'name'          => 'side_area_button_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__('Side Area Button Icon Pack', 'gotravel'),
				'description'   => esc_html__('Choose icon pack for side area button', 'gotravel'),
				'options'       => gotravel_mikado_icon_collections()->getIconCollections(),
				'args'          => array(
					'dependence' => true,
					'hide'       => $side_area_icon_pack_hide_array,
					'show'       => $side_area_icon_pack_show_array
				)
			)
		);

		if(is_array(gotravel_mikado_icon_collections()->iconCollections) && count(gotravel_mikado_icon_collections()->iconCollections)) {
			//foreach icon collection we need to generate separate container that will have dependency set
			//it will have one field inside with icons dropdown
			foreach(gotravel_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
				$icons_array = $collection_object->getIconsArray();

				//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
				$icon_collections_keys = gotravel_mikado_icon_collections()->getIconCollectionsKeys();

				//unset current one, because it doesn't have to be included in dependency that hides icon container
				unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

				$side_area_icon_hide_values = $icon_collections_keys;

				$side_area_icon_container = gotravel_mikado_add_admin_container(
					array(
						'parent'          => $side_area_opener_icon_container_no_style,
						'name'            => 'side_area_icon_'.$collection_object->param.'_container',
						'hidden_property' => 'side_area_button_icon_pack',
						'hidden_value'    => '',
						'hidden_values'   => $side_area_icon_hide_values
					)
				);

				gotravel_mikado_add_admin_field(
					array(
						'parent'        => $side_area_icon_container,
						'type'          => 'select',
						'name'          => 'side_area_icon_'.$collection_object->param,
						'default_value' => 'icon_menu',
						'label'         => esc_html__('Side Area Icon', 'gotravel'),
						'description'   => esc_html__('Choose Side Area Icon', 'gotravel'),
						'options'       => $icons_array,
					)
				);
			}
		}

		gotravel_mikado_add_admin_field(
			array(
				'parent'        => $side_area_opener_icon_container_no_style,
				'type'          => 'text',
				'name'          => 'side_area_icon_font_size',
				'default_value' => '',
				'label'         => esc_html__('Side Area Icon Size', 'gotravel'),
				'description'   => esc_html__('Choose a size for Side Area (px)', 'gotravel'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				),
			)
		);
		
		$side_area_icon_style_group = gotravel_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'gotravel'),
				'description' => esc_html__('Define styles for Side Area icon', 'gotravel')
			)
		);
		
		$side_area_icon_style_row1 = gotravel_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'gotravel')
			)
		);
		
		$side_area_icon_style_row2 = gotravel_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_light_icon_color',
				'label' => esc_html__('Light Menu Icon Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_light_icon_hover_color',
				'label' => esc_html__('Light Menu Icon Hover Color', 'gotravel')
			)
		);
		
		$side_area_icon_style_row3 = gotravel_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row3',
				'next'		=> true
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row3,
				'type' => 'colorsimple',
				'name' => 'side_area_dark_icon_color',
				'label' => esc_html__('Dark Menu Icon Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row3,
				'type' => 'colorsimple',
				'name' => 'side_area_dark_icon_hover_color',
				'label' => esc_html__('Dark Menu Icon Hover Color', 'gotravel')
			)
		);
		
		$side_area_icon_style_row4 = gotravel_mikado_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row4'
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row4,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row4,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_title',
				'default_value' => '',
				'label' => esc_html__('Side Area Title', 'gotravel'),
				'description' => esc_html__('Enter a title to appear in Side Area', 'gotravel'),
				'args' => array(
					'col_width' => 3,
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'gotravel'),
				'description' => esc_html__('Enter a width for Side Area', 'gotravel'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'gotravel'),
				'description' => esc_html__('Choose a background color for Side Area', 'gotravel')
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'gotravel'),
				'description' => esc_html__('Choose text alignment for side area', 'gotravel'),
				'options' => array(
					'' => esc_html__('Default', 'gotravel'),
					'left' => esc_html__('Left', 'gotravel'),
					'center' => esc_html__('Center', 'gotravel'),
					'right' => esc_html__('Right', 'gotravel')
				)
			)
		);
		
		$padding_group = gotravel_mikado_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'padding_group',
				'title' => esc_html__('Padding', 'gotravel'),
				'description' => esc_html__('Define padding for Side Area', 'gotravel')
			)
		);
		
		$padding_row = gotravel_mikado_add_admin_row(
			array(
				'parent' => $padding_group,
				'name' => 'padding_row',
				'next' => true
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_top',
				'label' => esc_html__('Top Padding', 'gotravel'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_right',
				'label' => esc_html__('Right Padding', 'gotravel'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_bottom',
				'label' => esc_html__('Bottom Padding', 'gotravel'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
		
		gotravel_mikado_add_admin_field(
			array(
				'parent' => $padding_row,
				'type' => 'textsimple',
				'name' => 'side_area_padding_left',
				'label' => esc_html__('Left Padding', 'gotravel'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
	}

	add_action('gotravel_mikado_options_map', 'gotravel_mikado_sidearea_options_map', 5);
}