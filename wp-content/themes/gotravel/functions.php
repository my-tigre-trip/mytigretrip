<?php
include_once get_template_directory().'/theme-includes.php';

if(!function_exists('gotravel_mikado_styles')) {
	/**
	 * Function that includes theme's core styles
	 */
	function gotravel_mikado_styles() {

		//include theme's core styles
		wp_enqueue_style('gotravel_mikado_default_style', MIKADO_ROOT.'/style.css');

		gotravel_mikado_icon_collections()->enqueueStyles();

		wp_enqueue_style('wp-mediaelement');

		wp_enqueue_style('gotravel_mikado_modules', MIKADO_ASSETS_ROOT.'/css/modules.min.css');

		//is woocommerce installed?
		if(gotravel_mikado_is_woocommerce_installed()) {
			if(gotravel_mikado_load_woo_assets()) {

				//include theme's woocommerce styles
				wp_enqueue_style('gotravel_mikado_woo', MIKADO_ASSETS_ROOT.'/css/woocommerce.min.css');
			}
		}

		if(gotravel_mikado_tours_plugin_installed()) {
			wp_enqueue_style('gotravel_mikado_tours', MIKADO_ASSETS_ROOT.'/css/tours.min.css');
		}

		//define files afer which style dynamic needs to be included. It should be included last so it can override other files
		$style_dynamic_deps_array = array();
		if (gotravel_mikado_tours_plugin_installed()){
			$style_dynamic_deps_array[] = 'gotravel_mikado_tours';
			$style_dynamic_deps_array[] = 'gotravel_mikado_tours_responsive';
		}

		if(gotravel_mikado_is_woocommerce_installed()) {
			if ( gotravel_mikado_load_woo_assets() ) {
				$style_dynamic_deps_array[] = 'gotravel_mikado_woo';
				$style_dynamic_deps_array[] = 'gotravel_mikado_woo_responsive';
			}
		}

		if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic.css') && gotravel_mikado_is_css_folder_writable() && !is_multisite()) {
			wp_enqueue_style('gotravel_mikado_style_dynamic', MIKADO_ASSETS_ROOT.'/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic.css')); //it must be included after woocommerce & tours styles so it can override it
		} else if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css') && gotravel_mikado_is_css_folder_writable() && is_multisite()) {
			wp_enqueue_style('gotravel_mikado_style_dynamic', MIKADO_ASSETS_ROOT.'/css/style_dynamic_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css')); //it must be included after woocommerce styles so it can override it
		}

		//is responsive option turned on?
		if(gotravel_mikado_is_responsive_on()) {
			wp_enqueue_style('gotravel_mikado_modules_responsive', MIKADO_ASSETS_ROOT.'/css/modules-responsive.min.css');

			//is woocommerce installed?
			if(gotravel_mikado_is_woocommerce_installed()) {
				if(gotravel_mikado_load_woo_assets()) {

					//include theme's woocommerce responsive styles
					wp_enqueue_style('gotravel_mikado_woo_responsive', MIKADO_ASSETS_ROOT.'/css/woocommerce-responsive.min.css');
				}
			}

			if(gotravel_mikado_tours_plugin_installed()) {
				wp_enqueue_style('gotravel_mikado_tours_responsive', MIKADO_ASSETS_ROOT.'/css/tours-responsive.min.css');
			}

			//include proper styles
			if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive.css') && gotravel_mikado_is_css_folder_writable() && !is_multisite()) {
				wp_enqueue_style('gotravel_mikado_style_dynamic_responsive', MIKADO_ASSETS_ROOT.'/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive.css'));
			} else if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css') && gotravel_mikado_is_css_folder_writable() && is_multisite()) {
				wp_enqueue_style('gotravel_mikado_style_dynamic_responsive', MIKADO_ASSETS_ROOT.'/css/style_dynamic_responsive_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css', array(), filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. gotravel_mikado_get_multisite_blog_id() .'.css'));
			}
		}

		//include Visual Composer styles
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			wp_enqueue_style('js_composer_front');
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_styles');
}

if(!function_exists('gotravel_mikado_google_fonts_styles')) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function gotravel_mikado_google_fonts_styles() {
		$font_simple_field_array = gotravel_mikado_options()->getOptionsByType('fontsimple');
		if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
			$font_simple_field_array = array();
		}

		$font_field_array = gotravel_mikado_options()->getOptionsByType('font');
		if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
			$font_field_array = array();
		}

		$available_font_options = array_merge($font_simple_field_array, $font_field_array);

		$google_font_weight_array = gotravel_mikado_options()->getOptionValue('google_font_weight');
		if(!empty($google_font_weight_array)) {
			$google_font_weight_array = array_slice(gotravel_mikado_options()->getOptionValue('google_font_weight'), 1);
		}

		$font_weight_str = '300,400,500,600,700';
		if(!empty($google_font_weight_array) && $google_font_weight_array !== '') {
			$font_weight_str = implode(',',$google_font_weight_array);
		}

		$google_font_subset_array = gotravel_mikado_options()->getOptionValue('google_font_subset');
		if(!empty($google_font_subset_array)) {
			$google_font_subset_array = array_slice(gotravel_mikado_options()->getOptionValue('google_font_subset'), 1);
		}

		$font_subset_str = 'latin-ext';
		if(!empty($google_font_subset_array) && $google_font_subset_array !== '') {
			$font_subset_str = implode(',',$google_font_subset_array);
		}

		//define available font options array
		$fonts_array = array();
		foreach($available_font_options as $font_option) {
			//is font set and not set to default and not empty?
			$font_option_value = gotravel_mikado_options()->getOptionValue($font_option);
			if(gotravel_mikado_is_font_option_valid($font_option_value) && !gotravel_mikado_is_native_font($font_option_value)) {
				$font_option_string = $font_option_value.':'.$font_weight_str;
				if(!in_array($font_option_string, $fonts_array)) {
					$fonts_array[] = $font_option_string;
				}
			}
		}

		$fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
		$google_fonts_string = implode('|', $fonts_array);

		//default fonts
		$default_font_string = 'Raleway:'.$font_weight_str.'|Poppins:'.$font_weight_str;
		$protocol = is_ssl() ? 'https:' : 'http:';

		//is google font option checked anywhere in theme?
		if (count($fonts_array) > 0) {

			//include all checked fonts
			$fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
			$fonts_full_list_args = array(
				'family' => urlencode($fonts_full_list),
				'subset' => urlencode($font_subset_str),
			);

			$gotravel_mikado_fonts = add_query_arg( $fonts_full_list_args, $protocol.'//fonts.googleapis.com/css' );
			wp_enqueue_style( 'gotravel_mikado_google_fonts', esc_url_raw($gotravel_mikado_fonts), array(), '1.0.0' );

		} else {
			//include default google font that theme is using
			$default_fonts_args = array(
				'family' => urlencode($default_font_string),
				'subset' => urlencode($font_subset_str),
			);
			$gotravel_mikado_fonts = add_query_arg( $default_fonts_args, $protocol.'//fonts.googleapis.com/css' );
			wp_enqueue_style( 'gotravel_mikado_google_fonts', esc_url_raw($gotravel_mikado_fonts), array(), '1.0.0' );
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_google_fonts_styles');
}

if(!function_exists('gotravel_mikado_scripts')) {
	/**
	 * Function that includes all necessary scripts
	 */
	function gotravel_mikado_scripts() {
		global $wp_scripts;

		//init theme core scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('wp-mediaelement');

		wp_enqueue_script('gotravel_mikado_third_party', MIKADO_ASSETS_ROOT.'/js/third-party.min.js', array('jquery'), false, true);
		wp_enqueue_script('isotope', MIKADO_ASSETS_ROOT.'/js/isotope.pkgd.min.js', array('jquery'), false, true);
		wp_enqueue_script('packery', MIKADO_ASSETS_ROOT.'/js/packery-mode.pkgd.min.js', array('jquery'), false, true);

		if(gotravel_mikado_is_woocommerce_installed()) {
			wp_enqueue_script('select2');
		}

		//include google map api script
		$mkdf_google_map_api = gotravel_mikado_options()->getOptionValue('google_maps_api_key');
		if(!empty($mkdf_google_map_api)) {
			wp_enqueue_script('gotravel_google_map_api', '//maps.googleapis.com/maps/api/js?key=' . $mkdf_google_map_api, array(), false, true);
		} else {
			wp_enqueue_script('gotravel_google_map_api', '//maps.googleapis.com/maps/api/js', array(), false, true);
		}

		//wp_enqueue_script('mkd_default', MIKADO_ASSETS_ROOT.'/js/default.js', array(), false, true);
		wp_enqueue_script('gotravel_mikado_modules', MIKADO_ASSETS_ROOT.'/js/modules.js', array('jquery'), false, true);

		//include comment reply script
		$wp_scripts->add_data('comment-reply', 'group', 1);
		if(is_singular() && comments_open() && get_option( 'thread_comments' )) {
			wp_enqueue_script("comment-reply");
		}

		//include Visual Composer script
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			wp_enqueue_script('wpb_composer_front_js');
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_scripts');
}

//defined content width variable
if(!isset($content_width)) {
	$content_width = 1060;
}

if(!function_exists('gotravel_mikado_theme_setup')) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function gotravel_mikado_theme_setup() {
		//add support for feed links
		add_theme_support('automatic-feed-links');

		//add support for post formats
		add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

		//add theme support for post thumbnails
		add_theme_support('post-thumbnails');

		//add theme support for title tag
		add_theme_support('title-tag');

		//define thumbnail sizes
		add_image_size('gotravel_square', 550, 550, true);
		add_image_size('gotravel_landscape', 800, 600, true);
		add_image_size('gotravel_portrait', 600, 800, true);
		add_image_size('gotravel_large_width', 1100, 550, true);
		add_image_size('gotravel_large_height', 550, 1100, true);
		add_image_size('gotravel_large_width_height', 1100, 1100, true);

		load_theme_textdomain('gotravel', get_template_directory().'/languages');
	}

	add_action('after_setup_theme', 'gotravel_mikado_theme_setup');
}

if(!function_exists('gotravel_mikado_rgba_color')) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function gotravel_mikado_rgba_color($color, $transparency) {
		if($color !== '' && $transparency !== '') {
			$rgba_color = '';

			$rgb_color_array = gotravel_mikado_hex2rgb($color);
			$rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

			return $rgba_color;
		}
	}
}

if(!function_exists('gotravel_mikado_header_meta')) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function gotravel_mikado_header_meta() { ?>
		<meta charset="<?php bloginfo('charset'); ?>"/>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
	<?php }

	add_action('gotravel_mikado_header_meta', 'gotravel_mikado_header_meta');
}

if(!function_exists('gotravel_mikado_user_scalable_meta')) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to gotravel_mikado_header_meta action
	 */
	function gotravel_mikado_user_scalable_meta() {
		//is responsiveness option is chosen?
		if(gotravel_mikado_is_responsive_on()) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
		<?php }
	}

	add_action('gotravel_mikado_header_meta', 'gotravel_mikado_user_scalable_meta');
}

if(!function_exists('gotravel_mikado_get_page_id')) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see gotravel_mikado_is_woocommerce_installed()
	 * @see gotravel_mikado_is_woocommerce_shop()
	 */
	function gotravel_mikado_get_page_id() {
		if(gotravel_mikado_is_woocommerce_installed() && gotravel_mikado_is_woocommerce_shop()) {
			return gotravel_mikado_get_woo_shop_page_id();
		}

		if(gotravel_mikado_is_default_wp_template()) {
			return -1;
		}

		return get_queried_object_id();
	}
}

if (!function_exists('gotravel_mikado_get_multisite_blog_id')) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function gotravel_mikado_get_multisite_blog_id() {
		if(is_multisite()){
			return get_blog_details()->blog_id;
		}
	}
}

if(!function_exists('gotravel_mikado_is_default_wp_template')) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function gotravel_mikado_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
	}
}

if(!function_exists('gotravel_mikado_get_page_template_name')) {
	/**
	 * Returns current template file name without extension
	 * @return string name of current template file
	 */
	function gotravel_mikado_get_page_template_name() {
		$file_name = '';

		if(!gotravel_mikado_is_default_wp_template()) {
			$file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

			if($file_name_without_ext !== '') {
				$file_name = $file_name_without_ext;
			}
		}

		return $file_name;
	}
}

if(!function_exists('gotravel_mikado_has_shortcode')) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function gotravel_mikado_has_shortcode($shortcode, $content = '') {
		$has_shortcode = false;

		if($shortcode) {
			//if content variable isn't past
			if($content == '') {
				//take content from current post
				$page_id = gotravel_mikado_get_page_id();
				if(!empty($page_id)) {
					$current_post = get_post($page_id);

					if(is_object($current_post) && property_exists($current_post, 'post_content')) {
						$content = $current_post->post_content;
					}
				}
			}

			//does content has shortcode added?
			if(stripos($content, '['.$shortcode) !== false) {
				$has_shortcode = true;
			}
		}

		return $has_shortcode;
	}
}

if(!function_exists('gotravel_mikado_get_sidebar')) {
	/**
	 * Return Sidebar
	 *
	 * @return string
	 */
	function gotravel_mikado_get_sidebar() {
		$id = gotravel_mikado_get_page_id();

		$sidebar = "sidebar";

		if(get_post_meta($id, 'mkdf_custom_sidebar_meta', true) != '') {
			$sidebar = get_post_meta($id, 'mkdf_custom_sidebar_meta', true);
		} else {
			if(is_single() && gotravel_mikado_options()->getOptionValue('blog_single_custom_sidebar') != '') {
				$sidebar = esc_attr(gotravel_mikado_options()->getOptionValue('blog_single_custom_sidebar'));
			} elseif((is_archive() || (is_home() && is_front_page())) && gotravel_mikado_options()->getOptionValue('blog_custom_sidebar') != '') {
				$sidebar = esc_attr(gotravel_mikado_options()->getOptionValue('blog_custom_sidebar'));
			} elseif(is_page() && gotravel_mikado_options()->getOptionValue('page_custom_sidebar') != '') {
				$sidebar = esc_attr(gotravel_mikado_options()->getOptionValue('page_custom_sidebar'));
			}
		}

		return apply_filters('gotravel_mikado_sidebar', $sidebar);
	}
}

if(!function_exists('gotravel_mikado_sidebar_columns_class')) {
	/**
	 * Return classes for columns holder when sidebar is active
	 *
	 * @return array
	 */
	function gotravel_mikado_sidebar_columns_class() {
		$sidebar_class  = array();
		$sidebar_layout = gotravel_mikado_sidebar_layout();

		switch($sidebar_layout):
			case 'sidebar-33-right':
				$sidebar_class[] = 'mkdf-two-columns-66-33';
				break;
			case 'sidebar-25-right':
				$sidebar_class[] = 'mkdf-two-columns-75-25';
				break;
			case 'sidebar-33-left':
				$sidebar_class[] = 'mkdf-two-columns-33-66';
				break;
			case 'sidebar-25-left':
				$sidebar_class[] = 'mkdf-two-columns-25-75';
				break;

		endswitch;

		$sidebar_class[] = 'clearfix';

		return gotravel_mikado_class_attribute($sidebar_class);
	}
}

if(!function_exists('gotravel_mikado_get_content_sidebar_class')) {
	/**
	 * @return string
	 */
	function gotravel_mikado_get_content_sidebar_class() {
		$sidebar_layout = gotravel_mikado_sidebar_layout();
		$content_class  = array('mkdf-page-content-holder');

		switch($sidebar_layout) {
			case 'sidebar-33-right':
				$content_class[] = 'mkdf-grid-col-8';
				break;
			case 'sidebar-25-right':
				$content_class[] = 'mkdf-grid-col-9';
				break;
			case 'sidebar-33-left':
				$content_class[] = 'mkdf-grid-col-8';
				$content_class[] = 'mkdf-grid-col-push-4';
				break;
			case 'sidebar-25-left':
				$content_class[] = 'mkdf-grid-col-9';
				$content_class[] = 'mkdf-grid-col-push-3';
				break;
			default:
				$content_class[] = 'mkdf-grid-col-12';
				break;
		}

		return gotravel_mikado_get_class_attribute($content_class);
	}
}

if(!function_exists('gotravel_mikado_get_sidebar_holder_class')) {
	/**
	 * @return string
	 */
	function gotravel_mikado_get_sidebar_holder_class() {
		$sidebar_layout = gotravel_mikado_sidebar_layout();
		$sidebar_class  = array('mkdf-sidebar-holder');

		switch($sidebar_layout) {
			case 'sidebar-33-right':
				$sidebar_class[] = 'mkdf-grid-col-4';
				break;
			case 'sidebar-25-right':
				$sidebar_class[] = 'mkdf-grid-col-3';
				break;
			case 'sidebar-33-left':
				$sidebar_class[] = 'mkdf-grid-col-4';
				$sidebar_class[] = 'mkdf-grid-col-pull-8';
				break;
			case 'sidebar-25-left':
				$sidebar_class[] = 'mkdf-grid-col-3';
				$sidebar_class[] = 'mkdf-grid-col-pull-9';
				break;
		}

		return gotravel_mikado_get_class_attribute($sidebar_class);
	}
}

if(!function_exists('gotravel_mikado_sidebar_layout')) {
	/**
	 * Function that check is sidebar is enabled and return type of sidebar layout
	 */
	function gotravel_mikado_sidebar_layout() {
		$sidebar_layout = '';
		$page_id        = gotravel_mikado_get_page_id();

		$page_sidebar_meta = get_post_meta($page_id, 'mkdf_sidebar_meta', true);

		if(($page_sidebar_meta !== '') && $page_id !== -1) {
			$sidebar_layout = $page_sidebar_meta !== 'no-sidebar' ? $page_sidebar_meta : '';
		} else {
			if(is_single() && gotravel_mikado_options()->getOptionValue('blog_single_sidebar_layout')) {
				$sidebar_layout = esc_attr(gotravel_mikado_options()->getOptionValue('blog_single_sidebar_layout'));
			} elseif((is_archive() || (is_home() && is_front_page())) && gotravel_mikado_options()->getOptionValue('archive_sidebar_layout')) {
				$sidebar_layout = esc_attr(gotravel_mikado_options()->getOptionValue('archive_sidebar_layout'));
			} elseif(is_page() && gotravel_mikado_options()->getOptionValue('page_sidebar_layout')) {
				$sidebar_layout = esc_attr(gotravel_mikado_options()->getOptionValue('page_sidebar_layout'));
			}
		}

		return apply_filters('gotravel_mikado_sidebar_layout', $sidebar_layout);
	}
}

if(!function_exists('gotravel_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function gotravel_mikado_is_responsive_on() {
		return gotravel_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}

if(!function_exists('gotravel_mikado_page_custom_style')) {
	/**
	 * Function that print custom page style
	 */
	function gotravel_mikado_page_custom_style() {
		$style = '';
		$style = apply_filters('gotravel_mikado_add_page_custom_style', $style);

		if($style !== '') {
			wp_add_inline_style( 'gotravel_mikado_modules', $style);
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_page_custom_style');
}

if(!function_exists('gotravel_mikado_container_style')) {
	/**
	 * Function that return container style
	 */
	function gotravel_mikado_container_style($style) {
		$id = gotravel_mikado_get_page_id();
		$class_id = gotravel_mikado_get_page_id();
		if(gotravel_mikado_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}

		$class_prefix = gotravel_mikado_get_unique_page_class($class_id);

		$container_selector = array(
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-container',
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-full-width',
		);

		$container_class = array();
		$page_backgorund_color = get_post_meta($id, "mkdf_page_background_color_meta", true);

		if($page_backgorund_color){
			$container_class['background-color'] = $page_backgorund_color;
		}

		$current_style = gotravel_mikado_dynamic_css($container_selector, $container_class);
		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('gotravel_mikado_add_page_custom_style', 'gotravel_mikado_container_style');
}

if(!function_exists('gotravel_mikado_get_unique_page_class')) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * @return string
	 */
	function gotravel_mikado_get_unique_page_class($id) {
		$page_class = '';

		if(is_single()) {
			$page_class = '.postid-'.$id;
		} elseif($id === gotravel_mikado_get_woo_shop_page_id()) {
			$page_class = '.archive';
		} elseif (is_home()) {
			$page_class .= '.home';
		} else {
			$page_class .= '.page-id-'.$id;
		}

		return $page_class;
	}
}

if(!function_exists('gotravel_mikado_page_padding')) {
	/**
	 * Function that return container style
	 */
	function gotravel_mikado_page_padding($style) {
		$id = gotravel_mikado_get_page_id();
		$class_id = gotravel_mikado_get_page_id();
		if(gotravel_mikado_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}

		$class_prefix = gotravel_mikado_get_unique_page_class($class_id);

		$current_style = '';

		$content_selector = array(
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner'
		);

		$content_class = array();

		$page_padding_top = get_post_meta($id, "mkdf_page_padding_meta", true);

		if($page_padding_top !== ''){
			$content_class['padding'] = $page_padding_top;

			$current_style .= gotravel_mikado_dynamic_css($content_selector, $content_class);
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('gotravel_mikado_add_page_custom_style', 'gotravel_mikado_page_padding');
}

if(!function_exists('gotravel_mikado_page_top_margin_offset')) {
	/**
	 * Function that return container style
	 */
	function gotravel_mikado_page_top_margin_offset($style) {
		$id = gotravel_mikado_get_page_id();
		$class_id = gotravel_mikado_get_page_id();
		if(gotravel_mikado_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}

		$class_prefix = gotravel_mikado_get_unique_page_class($class_id);

		$current_style = '';

		$content_selector = array(
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
			$class_prefix.' .mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner'
		);

		$content_class = array();

		$page_top_margin = get_post_meta($id, "mkdf_page_top_margin_offset_meta", true);

		if($page_top_margin !== ''){
			$content_class['margin-top'] = $page_top_margin;

			$current_style .= gotravel_mikado_dynamic_css($content_selector, $content_class);
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter('gotravel_mikado_add_page_custom_style', 'gotravel_mikado_page_top_margin_offset');
}

if(!function_exists('gotravel_mikado_print_custom_css')) {
	/**
	 * Prints out custom css from theme options
	 */
	function gotravel_mikado_print_custom_css() {
		$custom_css = gotravel_mikado_options()->getOptionValue('custom_css');

		if($custom_css !== '') {
			wp_add_inline_style('gotravel_mikado_modules', $custom_css);
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_print_custom_css');
}

if(!function_exists('gotravel_mikado_print_custom_js')) {
	/**
	 * Prints out custom css from theme options
	 */
	function gotravel_mikado_print_custom_js() {
		$custom_js = gotravel_mikado_options()->getOptionValue('custom_js');

		if($custom_js !== '') {
			 wp_add_inline_script('gotravel_mikado_modules', $custom_js);
		}
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_print_custom_js');
}

if(!function_exists('gotravel_mikado_get_global_variables')) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function gotravel_mikado_get_global_variables() {

		$global_variables      = array();
		$element_appear_amount = -100;

		$global_variables['mkdfAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
		$global_variables['mkdfElementAppearAmount'] = $element_appear_amount;
		$global_variables['mkdfFinishedMessage']     = esc_html__('No more posts', 'gotravel');
		$global_variables['mkdfMessage']             = esc_html__('Loading new posts...', 'gotravel');

		$global_variables = apply_filters('gotravel_mikado_js_global_variables', $global_variables);

		wp_localize_script('gotravel_mikado_modules', 'mkdfGlobalVars', array(
			'vars' => $global_variables
		));
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_get_global_variables');
}

if(!function_exists('gotravel_mikado_per_page_js_variables')) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function gotravel_mikado_per_page_js_variables() {
		$per_page_js_vars = apply_filters('gotravel_mikado_per_page_js_vars', array());

		wp_localize_script('gotravel_mikado_modules', 'mkdfPerPageVars', array(
			'vars' => $per_page_js_vars
		));
	}

	add_action('wp_enqueue_scripts', 'gotravel_mikado_per_page_js_variables');
}

if(!function_exists('gotravel_mikado_content_elem_style_attr')) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function gotravel_mikado_content_elem_style_attr() {
		$styles = apply_filters('gotravel_mikado_content_elem_style_attr', array());

		gotravel_mikado_inline_style($styles);
	}
}

if(!function_exists('gotravel_mikado_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function gotravel_mikado_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('gotravel_mikado_visual_composer_installed')) {
	/**
	 * Function that checks if visual composer installed
	 * @return bool
	 */
	function gotravel_mikado_visual_composer_installed() {
		//is Visual Composer installed?
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('gotravel_mikado_contact_form_7_installed')) {
	/**
	 * Function that checks if contact form 7 installed
	 * @return bool
	 */
	function gotravel_mikado_contact_form_7_installed() {
		//is Contact Form 7 installed?
		if(defined('WPCF7_VERSION')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('gotravel_mikado_is_wpml_installed')) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function gotravel_mikado_is_wpml_installed() {
		return defined('ICL_SITEPRESS_VERSION');
	}
}

if (!function_exists('gotravel_mikado_is_membership_plugin_installed')) {
	/**
	 * Function that checks if Mikado Membership Plugin installed
	 *
	 * @return bool
	 */
	function gotravel_mikado_is_membership_plugin_installed() {
		return defined('MIKADO_MEMBERSHIP_VERSION');
	}
}

if(!function_exists('gotravel_mikado_tours_plugin_installed')) {
	/**
	 * @return bool
	 */
	function gotravel_mikado_tours_plugin_installed() {
        return defined('MIKADO_TOURS_VERSION');
    }
}

if(!function_exists('gotravel_mikado_max_image_width_srcset')) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function gotravel_mikado_max_image_width_srcset() {
		return 1920;
	}

	add_filter('max_srcset_image_width', 'gotravel_mikado_max_image_width_srcset');
}

if(!function_exists('gotravel_mikado_add_attachment_field')) {
	/**
	 * Add link field to attachment details
	 * @return array
	 */
	function gotravel_mikado_add_attachment_field($form_fields, $post) {
		$link_field_value = get_post_meta( $post->ID, 'custom_link_to', true );
		$link_text_field_value = get_post_meta( $post->ID, 'custom_link_text', true );
		$image_size_field_value = get_post_meta( $post->ID, 'tours_gallery_masonry_image_size', true );

		$form_fields['custom_link_to'] = array(
			'value' => $link_field_value ? $link_field_value : '',
			'label' => esc_html__( 'Link To', 'gotravel'),
			'helps' => esc_html__( 'Set a custom link to be used in Image Gallery for this attachment', 'gotravel')
		);

		$form_fields['custom_link_text'] = array(
			'value' => $link_text_field_value ? $link_text_field_value : '',
			'label' => esc_html__( 'Link Text', 'gotravel'),
			'helps' => esc_html__( 'Set a custom link text to be used in Image Gallery for this attachment', 'gotravel')
		);

		$form_fields['tours_gallery_masonry_image_size'] = array(
			'input' => 'html',
			'label' => esc_html__( 'Image Size', 'gotravel'),
			'helps' => esc_html__( 'Choose image size for tours gallery', 'gotravel')
		);

		$form_fields['tours_gallery_masonry_image_size']['html']  = "<select name='attachments[{$post->ID}][tours_gallery_masonry_image_size]'>";
		$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option '.selected($image_size_field_value, 'mkdf-default-masonry-item', false).' value="mkdf-default-masonry-item">'.esc_html__('Default Size','gotravel').'</option>';
		$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option '.selected($image_size_field_value, 'mkdf-large-width-masonry-item', false).' value="mkdf-large-width-masonry-item">'.esc_html__('Large Width','gotravel').'</option>';
		$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option '.selected($image_size_field_value, 'mkdf-large-height-masonry-item', false).' value="mkdf-large-height-masonry-item">'.esc_html__('Large Height','gotravel').'</option>';
		$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option '.selected($image_size_field_value, 'mkdf-large-width-height-masonry-item', false).' value="mkdf-large-width-height-masonry-item">'.esc_html__('Large Width/Height','gotravel').'</option>';
		$form_fields['tours_gallery_masonry_image_size']['html'] .= '</select>';

		return $form_fields;
	}

	add_filter('attachment_fields_to_edit', 'gotravel_mikado_add_attachment_field',10,2);
}

if(!function_exists('gotravel_mikado_edit_attachment_field')) {
	/**
	* Edit link fields
	*/
	function gotravel_mikado_edit_attachment_field( $attachment_id ) {
		if ( isset( $_REQUEST['attachments'][$attachment_id]['custom_link_to'] ) ) {
			$custom_link_to = $_REQUEST['attachments'][$attachment_id]['custom_link_to'];
			update_post_meta( $attachment_id, 'custom_link_to', $custom_link_to );
		}

		if ( isset( $_REQUEST['attachments'][$attachment_id]['custom_link_text'] ) ) {
			$custom_link_text = $_REQUEST['attachments'][$attachment_id]['custom_link_text'];
			update_post_meta( $attachment_id, 'custom_link_text', $custom_link_text );
		}

		if ( isset( $_REQUEST['attachments'][$attachment_id]['tours_gallery_masonry_image_size'] ) ) {
			$custom_image_size = $_REQUEST['attachments'][$attachment_id]['tours_gallery_masonry_image_size'];
			update_post_meta( $attachment_id, 'tours_gallery_masonry_image_size', $custom_image_size );
		}
	}

	add_action( 'edit_attachment', 'gotravel_mikado_edit_attachment_field' );
}


/*JOSE*/

// Extended subscription function with subscription type variable
function jose_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'subtype' => 'RSS',
        'subtypeurl' => 'http://feeds.feedburner.com/ElegantThemes',
    ), $atts, 'multilink' ) );

    return esc_url( $subtypeurl ).esc_html( $subtype );
}

add_shortcode( 'jose', 'jose_shortcode' );


add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_shortcodes' );
function my_module_add_grid_shortcodes( $shortcodes ) {
   $shortcodes['vc_say_hello'] = array(
     'name' => __( 'Say Hello', 'my-text-domain' ),
     'base' => 'vc_say_hello',
     'category' => __( 'Content', 'my-text-domain' ),
     'description' => __( 'Just outputs Hello World', 'my-text-domain' ),
     'post_type' => Vc_Grid_Item_Editor::postType(),
  );
   return $shortcodes;
}

add_shortcode( 'vc_say_hello', 'vc_say_hello_render' );



function vc_say_hello_render() {
	// The Query
query_posts( ['tour-category'=> 'actividad'] );

// The Loop

?>
<div class="mkdf-tours-destination-grid">

		<div class="mkdf-grid-row">

				<?php if(has_post_thumbnail()) : ?>
				<div
					<?php post_class('mkdf-grid-col-3 mkdf-grid-col-ipad-landscape-6 mkdf-grid-col-phone-landscape-12 mkdf-tours-destination-grid-item'); ?>
				>

						<?php while ( have_posts() ) : the_post(); ?>
						<div class="mkdf-tours-destination-item-holder">
							<a href="<?php the_permalink() ?>">
								<div class="mkdf-tours-destination-item-image">
									<?php the_post_thumbnail('full'); ?>
								</div>

								<div class="mkdf-tours-destination-item-content">
									<div class="mkdf-tours-destination-item-content-inner">
										<h3 class="mkdf-tours-destination-item-title"><?php the_title(); ?></h3>
									</div>
								</div>
							</a>
						</div>
					<?php  endwhile;?>
				</div>
				<?php endif; ?>

		</div>
		<?php wp_reset_postdata(); ?>

</div>
<?php
// Reset Query
wp_reset_query();
}

add_shortcode( 'grilla', 'vc_say_hello_render' );


function add_choose_activity_shortcode($atts){
	extract( shortcode_atts( array(
        'opcion' =>  'opcion'

    ), $atts, 'multilink' ) );


	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));

	echo '<a class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-hover-solid" href="'.get_site_url().'/select-option.php?back='.$current_url.'&option='.$opcion.'">Choose this option</a>"';
}

add_shortcode( 'elegir_actividad', 'add_choose_activity_shortcode' );
