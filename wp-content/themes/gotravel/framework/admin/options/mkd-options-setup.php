<?php

add_action('after_setup_theme', 'gotravel_mikado_admin_map_init', 0);

function gotravel_mikado_admin_map_init() {

	do_action('gotravel_mikado_before_options_map');

	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/sidebar/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/contentbottom/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/error404/map.php';
	require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';
	
	do_action('gotravel_mikado_options_map');

	do_action('gotravel_mikado_after_options_map');
}