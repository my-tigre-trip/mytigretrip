<?php
namespace GoTravel\Modules\Header\Types;

use GoTravel\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-standard';

		if(!is_admin()) {

			$menuAreaHeight       = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('menu_area_height_header_standard'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 88;

			$mobileHeaderHeight       = gotravel_mikado_filter_px(gotravel_mikado_options()->getOptionValue('mobile_header_height'));
			$this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? $mobileHeaderHeight : 80;

			add_action('wp', array($this, 'setHeaderHeightProps'));

			add_filter('gotravel_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
			add_filter('gotravel_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
		}
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate($parameters = array()) {
		$parameters = apply_filters('gotravel_mikado_header_standard_parameters', $parameters);

		gotravel_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = gotravel_mikado_get_page_id();
		$transparencyHeight = 0;
		
		$menuAreaTransparent = gotravel_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
		                       gotravel_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '1';
		
		$sliderExists        = get_post_meta($id, 'mkdf_page_slider_meta', true) !== '';
		$contentBehindHeader = get_post_meta($id, 'mkdf_page_content_behind_header_meta', true) === 'yes';

		if($sliderExists || $contentBehindHeader) {
			$menuAreaTransparent = true;
		}

		if($menuAreaTransparent) {
			$transparencyHeight = $this->menuAreaHeight;
			
			if(gotravel_mikado_is_top_bar_enabled()) {
				$transparencyHeight += gotravel_mikado_get_top_bar_height();
			}
		}

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$transparencyHeight = 0;
		
		$menuAreaTransparent = gotravel_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
		                       gotravel_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';

		if($menuAreaTransparent) {
			$transparencyHeight = $this->menuAreaHeight;
		}

		return $transparencyHeight;
	}

	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		
		if(gotravel_mikado_is_top_bar_enabled()) {
			$headerHeight += gotravel_mikado_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;

		return $mobileHeaderHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables($globalVariables) {
		$globalVariables['mkdfLogoAreaHeight']     = 0;
		$globalVariables['mkdfMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['mkdfMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables($perPageVars) {
		//calculate transparency height only if header has no sticky behaviour
		if(!in_array(gotravel_mikado_options()->getOptionValue('header_behaviour'), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		))
		) {
			$perPageVars['mkdfHeaderTransparencyHeight'] = $this->headerHeight - (gotravel_mikado_get_top_bar_height() + $this->heightOfCompleteTransparency);
		} else {
			$perPageVars['mkdfHeaderTransparencyHeight'] = 0;
		}

		return $perPageVars;
	}
}