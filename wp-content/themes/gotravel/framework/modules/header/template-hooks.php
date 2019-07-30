<?php

//top header bar
add_action('gotravel_mikado_before_page_header', 'gotravel_mikado_get_header_top');

//mobile header
add_action('gotravel_mikado_after_page_header', 'gotravel_mikado_get_mobile_header');