<?php

if(!function_exists('gotravel_mikado_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function gotravel_mikado_get_vc_version() {
		if(gotravel_mikado_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}