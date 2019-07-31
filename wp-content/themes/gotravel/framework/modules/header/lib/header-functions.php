<?php
use GoTravel\Modules\Header\Lib;

if(!function_exists('gotravel_mikado_set_header_object')) {
	function gotravel_mikado_set_header_object() {
		$header_type = gotravel_mikado_get_meta_field_intersect('header_type', gotravel_mikado_get_page_id());

		$object = Lib\HeaderFactory::getInstance()->build($header_type);

		if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
			$header_connector = new Lib\HeaderConnector($object);
			$header_connector->connect($object->getConnectConfig());
		}
	}

	add_action('wp', 'gotravel_mikado_set_header_object', 1);
}