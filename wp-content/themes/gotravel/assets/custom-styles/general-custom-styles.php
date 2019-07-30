<?php
if(!function_exists('gotravel_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function gotravel_mikado_design_styles() {

        $preload_background_styles = array();

        if(gotravel_mikado_options()->getOptionValue('preload_pattern_image') !== "") {
            $preload_background_styles['background-image'] = 'url('.gotravel_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        } else {
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo gotravel_mikado_dynamic_css('.mkdf-preload-background', $preload_background_styles);

        if(gotravel_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = gotravel_mikado_options()->getOptionValue('google_fonts');
            if(gotravel_mikado_is_font_option_valid($font_family)) {
                echo gotravel_mikado_dynamic_css('body', array('font-family' => gotravel_mikado_get_font_option_val($font_family)));
            }
        }

        if(gotravel_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
	            'a',
				'p a',
				'blockquote:not(.mkdf-blockquote-shortcode):before',
	            '.mkdf-comment-holder .mkdf-comment-reply-holder > a:hover',
	            '.mkdf-comment-holder .mkdf-comment-reply-holder a.comment-reply-link:before',
	            '.mkdf-pagination li.active span',
				'.mkdf-pagination li a:hover',
				'.mkdf-pagination li a:hover span',
	            '.mkdf-like.liked',
	            '.wpb_widgetised_column .widget a:hover',
				'aside.mkdf-sidebar .widget a:hover',
	            '.wpb_widgetised_column .widget.widget_categories li:hover',
				'aside.mkdf-sidebar .widget.widget_categories li:hover',
	            '.wpb_widgetised_column .widget.widget_rss > h5 .rsswidget:hover',
				'aside.mkdf-sidebar .widget.widget_rss > h5 .rsswidget:hover',
	            '.wpb_widgetised_column .widget.widget_nav_menu ul.menu li a:hover',
				'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu li a:hover',
	            '.wpb_widgetised_column .widget.widget_nav_menu .current-menu-item > a',
				'aside.mkdf-sidebar .widget.widget_nav_menu .current-menu-item > a',
	            '.wpb_widgetised_column .widget.widget_product_tag_cloud .tagcloud a:hover',
				'.wpb_widgetised_column .widget.widget_tag_cloud .tagcloud a:hover',
				'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a:hover',
				'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a:hover',
	            '#ui-datepicker-div .ui-datepicker-title',
	            '.mkdf-main-menu > ul > li > a:hover',
	            '.mkdf-main-menu > ul > li.mkdf-active-item > a',
	            '.mkdf-drop-down .wide .second.mkdf-dropdown-with-background-image .inner ul li a:hover',
	            '.mkdf-drop-down .wide .second.mkdf-dropdown-with-background-image .inner ul li.current-menu-ancestor > a',
				'.mkdf-drop-down .wide .second.mkdf-dropdown-with-background-image .inner ul li.current-menu-item > a',
	            '.mkdf-mobile-header .mkdf-mobile-nav a:hover',
	            '.mkdf-mobile-header .mkdf-mobile-nav h4:hover',
	            '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
	            '.mkdf-breadcrumbs-area-holder .mkdf-breadcrumbs-holder .mkdf-breadcrumbs a:hover',
	            '.mkdf-breadcrumbs-area-holder .mkdf-breadcrumbs-social-holder .mkdf-social-share-holder.mkdf-list li a:hover',
	            '.mkdf-side-menu-button-opener:hover',
	            '.mkdf-side-menu .widget a:hover',
	            '.mkdf-blog-holder article.sticky .mkdf-post-title a',
	            '.mkdf-blog-holder article .mkdf-post-info > div:hover .mkdf-like > i',
				'.mkdf-blog-holder article .mkdf-post-info > div:hover .mkdf-post-info-comments-icon > span',
				'.mkdf-blog-holder article .mkdf-post-info > div:hover.mkdf-post-info-category > span',
	            '.mkdf-filter-blog-holder li.mkdf-active',
	            'article .mkdf-category',
	            'article .mkdf-category span.icon_tags',
	            '.mejs-controls .mejs-button button:hover',
	            '.mkdf-team .mkdf-icon-shortcode a:hover',
	            '.mkdf-message .mkdf-message-inner a.mkdf-close i:hover',
	            '.mkdf-ordered-list ol > li:before',
	            '.mkdf-blog-carousel-holder .mkdf-blog-carousel.owl-carousel .owl-nav .owl-prev:hover',
				'.mkdf-blog-carousel-holder .mkdf-blog-carousel.owl-carousel .owl-nav .owl-next:hover',
	            '.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner > *',
	            '.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-author a:hover',
	            '.mkdf-blog-slider-holder .mkdf-bs-item-bottom-section .mkdf-bs-item-categories:hover > span',
	            '.mkdf-blog-slider-holder .owl-prev:hover',
				'.mkdf-blog-slider-holder .owl-next:hover',
	            '.mkdf-testimonials.owl-carousel .owl-nav .owl-prev:hover .mkdf-prev-icon i',
				'.mkdf-testimonials.owl-carousel .owl-nav .owl-prev:hover .mkdf-next-icon i',
				'.mkdf-testimonials.owl-carousel .owl-nav .owl-next:hover .mkdf-prev-icon i',
				'.mkdf-testimonials.owl-carousel .owl-nav .owl-next:hover .mkdf-next-icon i',
	            '.mkdf-masonry-gallery-holder .mkdf-mg-item .mkdf-mg-item-additional-text',
	            '.mkdf-pie-chart-with-icon-holder .mkdf-percentage-with-icon i',
				'.mkdf-pie-chart-with-icon-holder .mkdf-percentage-with-icon span',
	            '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active',
	            '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover',
	            '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active .mkdf-accordion-mark-icon .mkdf-accordion-mark-open',
	            '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover .mkdf-accordion-mark-icon .mkdf-accordion-mark-open',
	            '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active .mkdf-accordion-mark-icon .mkdf-accordion-mark-close',
	            '.mkdf-blog-list-holder .mkdf-item-info-section > div:hover .mkdf-like > i',
				'.mkdf-blog-list-holder .mkdf-item-info-section > div:hover .mkdf-post-info-comments-icon > span',
				'.mkdf-blog-list-holder .mkdf-item-info-section > div:hover.mkdf-post-info-category > span',
	            '.mkdf-blog-list-holder.mkdf-grid-type-2 .mkdf-post-item-author-holder a:hover',
	            '.mkdf-blog-list-holder.mkdf-masonry .mkdf-post-item-author-holder a:hover',
	            '.mkdf-btn.mkdf-btn-outline, .woocommerce .mkdf-btn-outline.button',
	            '.post-password-form input.mkdf-btn-outline[type=\'submit\']',
	            'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit',
	            'blockquote .mkdf-icon-quotations-holder',
	            '.mkdf-image-gallery .owl-nav .owl-prev:hover .mkdf-prev-icon i',
				'.mkdf-image-gallery .owl-nav .owl-prev:hover .mkdf-next-icon i',
				'.mkdf-image-gallery .owl-nav .owl-next:hover .mkdf-prev-icon i',
				'.mkdf-image-gallery .owl-nav .owl-next:hover .mkdf-next-icon i',
	            '.mkdf-dropcaps',
	            '.mkdf-social-share-holder.mkdf-list li a:hover',
	            '.mkdf-info-item-inner:hover h5',
	            '.mkdf-icon-progress-bar .mkdf-ipb-active',
	            '.widget_icl_lang_sel_widget #lang_sel ul li a:hover',
				'.widget_icl_lang_sel_widget #lang_sel_click ul li a:hover',
	            '.widget_icl_lang_sel_widget .lang_sel_list_horizontal ul li a:hover',
	            '.widget_icl_lang_sel_widget .lang_sel_list_vertical ul li a:hover',
	            '.mkdf-tours-price-holder',
	            '.mkdf-tour-item-label.mkdf-tour-item-label-skin2',
	            '.mkdf-tours-standard-item .mkdf-tours-item-discount-price.mkdf-tours-item-price',
	            '.mkdf-tours-gallery-item .mkdf-tours-price-with-discount .mkdf-tours-item-discount-price.mkdf-tours-item-price',
	            '.mkdf-tours-list-item .mkdf-tours-price-with-discount .mkdf-tours-item-discount-price.mkdf-tours-item-price',
	            '.mkdf-tours-list-item .mkdf-tours-tour-categories-item a:hover',
	            '.mkdf-tour-type-list-holder li a:hover',
	            '.mkdf-tours-top-reviews-carousel-holder .owl-prev:hover',
				'.mkdf-tours-top-reviews-carousel-holder .owl-next:hover',
	            '.mkdf-tour-item-single-holder .mkdf-tabs.mkdf-horizontal .mkdf-tabs-nav li.ui-state-active a',
	            '.mkdf-tour-item-single-holder .mkdf-tabs.mkdf-horizontal .mkdf-tabs-nav li a:hover',
	            '.mkdf-tour-item-single-holder article .mkdf-tour-item-price-holder .mkdf-tour-item-price',
	            '.mkdf-tour-item-single-holder article .mkdf-tour-item-price-holder .mkdf-tours-item-discount-price.mkdf-tours-item-price',
	            '.mkdf-tour-item-single-holder article .mkdf-tour-item-short-info .mkdf-tours-tour-categories-item a:hover',
	            '.mkdf-tour-item-single-holder article .mkdf-tour-main-info-holder li:hover .col6.mkdf-info',
	            '.mkdf-tour-item-single-holder article .mkdf-tour-main-info-holder li.mkdf-tours-checked-attributes .mkdf-tour-main-info-attr:before',
	            '.mkdf-tour-reviews-criteria-holder .mkdf-tour-reviews-rating-holder',
	            '.mkdf-tour-reviews-display-wrapper .mkdf-tour-reviews-average-rating',
	            '.mkdf-tours-booking-form-holder .mkdf-tour-message-success',
	            '.mkdf-tours-my-booking-item .mkdf-tours-info-items .mkdf-tours-booking-price',
	            '.mkdf-search-ordering-holder .mkdf-search-ordering-list li.mkdf-search-ordering-item-active a',
	            '.mkdf-search-ordering-holder .mkdf-search-ordering-list li a:hover',
	            '.mkdf-tours-checkout-content-inner .mkdf-tours-info-holder .mkdf-tours-info-message',
	            '.mkdf-tours-checkout-content-inner .mkdf-tours-info-holder .mkdf-tours-booking-price',
	            'article .mkdf-post-quote-holder .mkdf-post-mark',
	            'article .mkdf-post-link-holder .mkdf-post-mark',
	            '.mkdf-blog-holder article .mkdf-post-info>div a:hover',
	            '.mkdf-blog-holder article.format-link:hover .mkdf-post-title'
            );
	
	        $woo_color_selector = array();
	        if(gotravel_mikado_is_woocommerce_installed()) {
		        $woo_color_selector = array(
			        '.woocommerce-pagination .page-numbers li span.current',
			        '.woocommerce-pagination .page-numbers li a:hover',
			        '.mkdf-woocommerce-page .select2-results .select2-highlighted',
			        '.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
			        '.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
			        '.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
			        '.mkdf-woocommerce-page ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
			        '.woocommerce ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
			        '.woocommerce ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
			        '.woocommerce ul.products .product .mkdf-woo-product-image-holder .add_to_cart_button',
			        '.woocommerce ul.products .product .mkdf-woo-product-image-holder .product_type_simple',
			        '.mkdf-woocommerce-page ul.products .product .added_to_cart',
			        '.woocommerce ul.products .product .added_to_cart',
			        '.mkdf-woocommerce-page .price',
			        '.woocommerce .price',
			        '.mkdf-woocommerce-page .star-rating:before',
			        '.woocommerce .star-rating:before',
			        '.mkdf-woocommerce-page .star-rating span:before',
			        '.woocommerce .star-rating span:before',
			        '.single-product .mkdf-single-product-summary .product_meta a:hover',
			        '.single-product .woocommerce-tabs.mkdf-tabs .mkdf-tabs-nav li.ui-state-active a',
			        '.single-product .woocommerce-tabs.mkdf-tabs .mkdf-tabs-nav li a:hover',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_product_categories ul.product-categories li:hover a',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content > a:hover',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content ins',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content .amount',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_recent_reviews a:hover',
			        '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-left a:hover',
			        '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-right .remove:hover',
			        '.mkdf-shopping-cart-dropdown span.mkdf-total span',
			        '.mkdf-shopping-cart-dropdown span.mkdf-quantity',
			        '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
			        '.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .woocommerce-shipping-calculator > p a:hover',
			        '.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a',
			        '.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:hover a',
			        '.select2-container--default.select2-container--open .select2-selection--single',
			        '.select2-container--default .select2-results__option[aria-disabled=true]',
			        '.select2-container--default .select2-results__option[aria-selected=true]',
			        '.select2-container--default .select2-results__option--highlighted[aria-selected]'
		        );
	        }
	
	        $color_selector = array_merge($color_selector, $woo_color_selector);

            $color_important_selector = array(
            	'.mkdf-icon-list-item a:hover .mkdf-icon-list-text',
	            '.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-hover-color):hover',
	            '.woocommerce .button:not(.mkdf-btn-custom-hover-color):hover',
				'.post-password-form input[type=\'submit\']:not(.mkdf-btn-custom-hover-color):hover',
	            'input.mkdf-btn-hover-outline.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
	            '.mkdf-btn.mkdf-btn-hover-white:not(.mkdf-btn-custom-hover-color):hover',
	            '.woocommerce .mkdf-btn-hover-white.button:not(.mkdf-btn-custom-hover-color):hover',
				'.post-password-form input.mkdf-btn-hover-white[type=\'submit\']:not(.mkdf-btn-custom-hover-color):hover',
	            'input.mkdf-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
	            '.mkdf-tours-list-holder .mkdf-tour-list-filter-item.mkdf-tour-list-current-filter a'
            );

            $background_color_selector = array(
				'.mkdf-st-loader .pulse',
	            '.mkdf-st-loader .double_pulse .double-bounce1',
	            '.mkdf-st-loader .double_pulse .double-bounce2',
	            '.mkdf-st-loader .cube',
	            '.mkdf-st-loader .rotating_cubes .cube1',
	            '.mkdf-st-loader .rotating_cubes .cube2',
	            '.mkdf-st-loader .stripes > div',
	            '.mkdf-st-loader .wave > div',
	            '.mkdf-st-loader .two_rotating_circles .dot1',
	            '.mkdf-st-loader .two_rotating_circles .dot2',
	            '.mkdf-st-loader .five_rotating_circles .container1 > div',
	            '.mkdf-st-loader .five_rotating_circles .container2 > div',
	            '.mkdf-st-loader .five_rotating_circles .container3 > div',
	            '.mkdf-st-loader .atom .ball-1:before',
	            '.mkdf-st-loader .atom .ball-2:before',
				'.mkdf-st-loader .atom .ball-3:before',
				'.mkdf-st-loader .atom .ball-4:before',
	            '.mkdf-st-loader .clock .ball:before',
	            '.mkdf-st-loader .mitosis .ball',
	            '.mkdf-st-loader .lines .line1',
				'.mkdf-st-loader .lines .line2',
				'.mkdf-st-loader .lines .line3',
				'.mkdf-st-loader .lines .line4',
	            '.mkdf-st-loader .fussion .ball',
	            '.mkdf-st-loader .fussion .ball-1',
	            '.mkdf-st-loader .fussion .ball-2',
	            '.mkdf-st-loader .fussion .ball-3',
	            '.mkdf-st-loader .fussion .ball-4',
	            '.mkdf-st-loader .wave_circles .ball',
	            '.mkdf-st-loader .pulse_circles .ball',
	            '.mkdf-carousel-pagination .owl-page.active span',
	            '.wpb_widgetised_column .widget .searchform input[type=submit]',
				'aside.mkdf-sidebar .widget .searchform input[type=submit]',
	            '#ui-datepicker-div table.ui-datepicker-calendar thead',
	            '.mkdf-top-bar',
	            '.mkdf-top-header-enabled .mkdf-page-header .mkdf-menu-area:before',
	            'footer .mkdf-footer-top-holder .widget .searchform input[type=submit]',
	            '.mkdf-blog-date-on-side .mkdf-date-format',
	            '.single .mkdf-single-tags-holder .mkdf-tags a',
	            '.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
	            '.mkdf-team .mkdf-icon-shortcode.circle a:hover .mkdf-icon-element',
	            '.mkdf-team .mkdf-icon-shortcode.square a:hover .mkdf-icon-element',
	            '.mkdf-icon-shortcode.mkdf-circle',
	            '.mkdf-icon-shortcode.mkdf-square',
	            '.mkdf-icon-shortcode.mkdf-dropcaps.mkdf-circle',
	            '.mkdf-progress-bar .mkdf-progress-content-outer .mkdf-progress-content',
	            '.mkdf-testimonials.owl-carousel .owl-dots .owl-dot.active span',
	            '.mkdf-price-table .mkdf-price-table-inner .mkdf-pt-label-holder .mkdf-pt-label-inner',
	            '.mkdf-price-table.mkdf-pt-active .mkdf-price-table-inner',
	            '.mkdf-pie-chart-doughnut-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
	            '.mkdf-pie-chart-pie-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
	            '.mkdf-tabs .mkdf-tabs-nav .mkdf-tab-line',
	            '.mkdf-btn.mkdf-btn-solid, .woocommerce .button',
				'.post-password-form input[type=\'submit\'], input.wpcf7-form-control.wpcf7-submit',
	            '.mkdf-btn.mkdf-btn-hover-black .mkdf-btn-helper',
	            '.woocommerce .mkdf-btn-hover-black.button .mkdf-btn-helper',
				'.post-password-form input.mkdf-btn-hover-black[type=\'submit\'] .mkdf-btn-helper',
	            'input.mkdf-btn-hover-black.wpcf7-form-control.wpcf7-submit .mkdf-btn-helper',
	            '.mkdf-image-gallery .owl-dots .owl-dot.active span',
	            '.mkdf-dropcaps.mkdf-square',
	            '.mkdf-dropcaps.mkdf-circle',
	            '.mkdf-comparision-pricing-tables-holder .mkdf-cpt-table .mkdf-cpt-table-btn a',
	            '.mkdf-vertical-progress-bar-holder .mkdf-vpb-active-bar',
	            '.mkdf-weather-widget-holder .mkdf-date-format',
	            '.widget_mkdf_call_to_action_button .mkdf-call-to-action-button',
	            '.mkdf-tour-item-label',
	            '.mkdf-tours-standard-item .mkdf-tours-standard-item-bottom-content',
	            '.mkdf-tour-item-single-holder .mkdf-tour-item-section .mkdf-route-id',
	            '.mkdf-tours-search-main-filters-holder input[type=checkbox]:checked + label:before',
	            '.mkdf-tours-search-main-filters-holder .mkdf-tours-range-input',
	            '.mkdf-tours-search-main-filters-holder .mkdf-tours-range-input .noUi-connect',
	            '.mkdf-tours-search-main-filters-holder .mkdf-tours-range-input .noUi-handle'
            );
	
	        $woo_background_color_selector = array();
	        if(gotravel_mikado_is_woocommerce_installed()) {
		        $woo_background_color_selector = array(
			        '.mkdf-woocommerce-page .woocommerce-info',
			        '.mkdf-woocommerce-page .mkdf-onsale',
			        '.mkdf-woocommerce-page .mkdf-out-of-stock',
			        '.woocommerce .mkdf-onsale',
			        '.woocommerce .mkdf-out-of-stock',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_price_filter .ui-slider .ui-slider-handle',
			        '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
			        '.mkdf-shopping-cart-outer .mkdf-shopping-cart-header .mkdf-header-cart .mkdf-cart-count'
		        );
	        }
	
	        $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $background_color_important_selector = array(
            	'.mkdf-btn.mkdf-btn-hover-black:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
	            '.woocommerce .mkdf-btn-hover-black.button:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
				'.post-password-form input.mkdf-btn-hover-black[type=\'submit\']:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
	            'input.mkdf-btn-hover-black.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
	            '.mkdf-tours-booking-form-holder input[type=submit]:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-custom-border-hover):not(.mkdf-btn-with-animation):hover'
            );

            $border_color_selector = array(
            	'.mkdf-st-loader .pulse_circles .ball',
	            '.single .mkdf-single-tags-holder .mkdf-tags a',
	            '.mkdf-btn.mkdf-btn-solid, .woocommerce .button',
	            '.post-password-form input[type=\'submit\'], input.wpcf7-form-control.wpcf7-submit',
	            '.mkdf-btn.mkdf-btn-outline, .woocommerce .mkdf-btn-outline.button',
				'.post-password-form input.mkdf-btn-outline[type=\'submit\']',
	            'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit'
            );
	        
	        $woo_border_color_selector = array();
	        if(gotravel_mikado_is_woocommerce_installed()) {
		        $woo_border_color_selector = array(
			        '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus'
		        );
	        }
	
	        $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            $border_color_important_selector = array(
            	'.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-border-hover):hover',
	            '.woocommerce .button:not(.mkdf-btn-custom-border-hover):hover',
				'.post-password-form input[type=\'submit\']:not(.mkdf-btn-custom-border-hover):hover',
	            'input.mkdf-btn-hover-outline.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover',
	            '.mkdf-btn.mkdf-btn-hover-black:not(.mkdf-btn-custom-border-hover):hover',
	            '.woocommerce .mkdf-btn-hover-black.button:not(.mkdf-btn-custom-border-hover):hover',
				'.post-password-form input.mkdf-btn-hover-black[type=\'submit\']:not(.mkdf-btn-custom-border-hover):hover',
	            'input.mkdf-btn-hover-black.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover',
	            '.mkdf-tours-booking-form-holder input[type=submit]:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-custom-border-hover):not(.mkdf-btn-with-animation):hover'
            );

            $stroke_selector = array(
            	'.mkdf-plane-holder .st0',
            	'.mkdf-plane-holder .st1'
        	);

			$first_color = gotravel_mikado_options()->getOptionValue('first_color');

            echo gotravel_mikado_dynamic_css($color_selector, array('color' => $first_color));
            echo gotravel_mikado_dynamic_css($color_important_selector, array('color' => $first_color.'!important'));
            echo gotravel_mikado_dynamic_css('::selection', array('background' => $first_color));
            echo gotravel_mikado_dynamic_css('::-moz-selection', array('background' => $first_color));
            echo gotravel_mikado_dynamic_css($background_color_selector, array('background-color' => $first_color));
            echo gotravel_mikado_dynamic_css($background_color_important_selector, array('background-color' => $first_color.'!important'));
            echo gotravel_mikado_dynamic_css($border_color_selector, array('border-color' => $first_color));
            echo gotravel_mikado_dynamic_css($border_color_important_selector, array('border-color' => $first_color.'!important'));
            echo gotravel_mikado_dynamic_css($stroke_selector, array('stroke' => $first_color));
        }

        if(gotravel_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkdf-wrapper-inner',
                '.mkdf-content',
                '.mkdf-content-inner > .mkdf-container'
            );
            echo gotravel_mikado_dynamic_css($background_color_selector, array('background-color' => gotravel_mikado_options()->getOptionValue('page_background_color')));
        }

        if(gotravel_mikado_options()->getOptionValue('selection_color')) {
            echo gotravel_mikado_dynamic_css('::selection', array('background' => gotravel_mikado_options()->getOptionValue('selection_color')));
            echo gotravel_mikado_dynamic_css('::-moz-selection', array('background' => gotravel_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if(gotravel_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = gotravel_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if(gotravel_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(gotravel_mikado_options()->getOptionValue('boxed_background_image')).')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat']   = 'no-repeat';
        }

        if(gotravel_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image']    = 'url('.esc_url(gotravel_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat']   = 'repeat';
        }

        if(gotravel_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (gotravel_mikado_options()->getOptionValue('boxed_background_image_attachment'));
        }

        echo gotravel_mikado_dynamic_css('.mkdf-boxed .mkdf-wrapper', $boxed_background_style);
    }

    add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_design_styles');
}

if(!function_exists('gotravel_mikado_content_styles')) {
	/**
	 * Generates content custom styles
	 */
	function gotravel_mikado_content_styles() {
		$content_style = array();
		
		$padding_top = gotravel_mikado_options()->getOptionValue('page_padding');
		if ($padding_top !== '') {
			$content_style['padding'] = $padding_top;
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner'
		);
		
		echo gotravel_mikado_dynamic_css($content_selector, $content_style);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_content_styles');
}

if(!function_exists('gotravel_mikado_404_footer_top_general_styles')) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function gotravel_mikado_404_footer_top_general_styles() {
		$background_color = gotravel_mikado_options()->getOptionValue('404_page_background_color');
		$background_image = gotravel_mikado_options()->getOptionValue('404_page_background_image');
		$pattern_background_image = gotravel_mikado_options()->getOptionValue('404_page_background_pattern_image');
		
		$item_styles = array();
		if(!empty($background_color)) {
			$item_styles['background-color'] = $background_color;
		}
		
		if (!empty($background_image)) {
			$item_styles['background-image'] = 'url('.$background_image.')';
			$item_styles['background-position'] = 'center 0';
			$item_styles['background-size'] = 'cover';
			$item_styles['background-repeat'] = 'no-repeat';
		}
		
		if (!empty($pattern_background_image)) {
			$item_styles['background-image'] = 'url('.$pattern_background_image.')';
			$item_styles['background-position'] = '0 0';
			$item_styles['background-repeat'] = 'repeat';
		}
		
		$item_selector = array(
			'.mkdf-404-page .mkdf-content'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_404_footer_top_general_styles');
}

if (!function_exists('gotravel_mikado_h1_styles')) {
	
	function gotravel_mikado_h1_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h1_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h1_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h1');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h1_styles');
}

if (!function_exists('gotravel_mikado_h2_styles')) {
	
	function gotravel_mikado_h2_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h2_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h2_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h2');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h2_styles');
}

if (!function_exists('gotravel_mikado_h3_styles')) {
	
	function gotravel_mikado_h3_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h3_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h3_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h3');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h3_styles');
}

if (!function_exists('gotravel_mikado_h4_styles')) {
	
	function gotravel_mikado_h4_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h4_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h4_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h4');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h4_styles');
}

if (!function_exists('gotravel_mikado_h5_styles')) {
	
	function gotravel_mikado_h5_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h5_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h5_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h5');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h5_styles');
}

if (!function_exists('gotravel_mikado_h6_styles')) {
	
	function gotravel_mikado_h6_styles() {
		$margin_top = gotravel_mikado_options()->getOptionValue('h6_margin_top');
		$margin_bottom = gotravel_mikado_options()->getOptionValue('h6_margin_bottom');
		
		$item_styles = gotravel_mikado_get_typography_styles('h6');
		
		if($margin_top !== '') {
			$item_styles['margin-top'] = gotravel_mikado_filter_px($margin_top).'px';
		}
		if($margin_bottom !== '') {
			$item_styles['margin-bottom'] = gotravel_mikado_filter_px($margin_bottom).'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_h6_styles');
}

if (!function_exists('gotravel_mikado_text_styles')) {
	
	function gotravel_mikado_text_styles() {
		$item_styles = gotravel_mikado_get_typography_styles('text');
		
		$item_selector = array(
			'p'
		);
		
		echo gotravel_mikado_dynamic_css($item_selector, $item_styles);
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_text_styles');
}

if (!function_exists('gotravel_mikado_link_styles')) {
	
	function gotravel_mikado_link_styles() {
		
		$link_styles = array();
		
		if(gotravel_mikado_options()->getOptionValue('link_color') !== '') {
			$link_styles['color'] = gotravel_mikado_options()->getOptionValue('link_color');
		}
		if(gotravel_mikado_options()->getOptionValue('link_fontstyle') !== '') {
			$link_styles['font-style'] = gotravel_mikado_options()->getOptionValue('link_fontstyle');
		}
		if(gotravel_mikado_options()->getOptionValue('link_fontweight') !== '') {
			$link_styles['font-weight'] = gotravel_mikado_options()->getOptionValue('link_fontweight');
		}
		if(gotravel_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
			$link_styles['text-decoration'] = gotravel_mikado_options()->getOptionValue('link_fontdecoration');
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if (!empty($link_styles)) {
			echo gotravel_mikado_dynamic_css($link_selector, $link_styles);
		}
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_link_styles');
}

if (!function_exists('gotravel_mikado_link_hover_styles')) {
	
	function gotravel_mikado_link_hover_styles() {
		
		$link_hover_styles = array();
		
		if(gotravel_mikado_options()->getOptionValue('link_hovercolor') !== '') {
			$link_hover_styles['color'] = gotravel_mikado_options()->getOptionValue('link_hovercolor');
		}
		if(gotravel_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
			$link_hover_styles['text-decoration'] = gotravel_mikado_options()->getOptionValue('link_hover_fontdecoration');
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if (!empty($link_hover_styles)) {
			echo gotravel_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
		}
		
		$link_heading_hover_styles = array();
		
		if(gotravel_mikado_options()->getOptionValue('link_hovercolor') !== '') {
			$link_heading_hover_styles['color'] = gotravel_mikado_options()->getOptionValue('link_hovercolor');
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if (!empty($link_heading_hover_styles)) {
			echo gotravel_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
		}
	}
	
	add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_link_hover_styles');
}

if(!function_exists('gotravel_mikado_smooth_page_transition_styles')) {

    function gotravel_mikado_smooth_page_transition_styles() {

        $loader_style = array();

        if(gotravel_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = gotravel_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkdf-smooth-transition-loader');

        if(!empty($loader_style)) {
            echo gotravel_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(gotravel_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = gotravel_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkdf-st-loader .pulse',
            '.mkdf-st-loader .double_pulse .double-bounce1',
            '.mkdf-st-loader .double_pulse .double-bounce2',
            '.mkdf-st-loader .cube',
            '.mkdf-st-loader .rotating_cubes .cube1',
            '.mkdf-st-loader .rotating_cubes .cube2',
            '.mkdf-st-loader .stripes > div',
            '.mkdf-st-loader .wave > div',
            '.mkdf-st-loader .two_rotating_circles .dot1',
            '.mkdf-st-loader .two_rotating_circles .dot2',
            '.mkdf-st-loader .five_rotating_circles .container1 > div',
            '.mkdf-st-loader .five_rotating_circles .container2 > div',
            '.mkdf-st-loader .five_rotating_circles .container3 > div',
            '.mkdf-st-loader .atom .ball-1:before',
            '.mkdf-st-loader .atom .ball-2:before',
            '.mkdf-st-loader .atom .ball-3:before',
            '.mkdf-st-loader .atom .ball-4:before',
            '.mkdf-st-loader .clock .ball:before',
            '.mkdf-st-loader .mitosis .ball',
            '.mkdf-st-loader .lines .line1',
            '.mkdf-st-loader .lines .line2',
            '.mkdf-st-loader .lines .line3',
            '.mkdf-st-loader .lines .line4',
            '.mkdf-st-loader .fussion .ball',
            '.mkdf-st-loader .fussion .ball-1',
            '.mkdf-st-loader .fussion .ball-2',
            '.mkdf-st-loader .fussion .ball-3',
            '.mkdf-st-loader .fussion .ball-4',
            '.mkdf-st-loader .wave_circles .ball',
            '.mkdf-st-loader .pulse_circles .ball'
        );

        if(!empty($spinner_style)) {
            echo gotravel_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }

        $airplane_spinner_style = array();

        if(gotravel_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $airplane_spinner_style['stroke'] = gotravel_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $airplane_spinner_selectors = array(
            '.mkdf-st-loader .mkdf-plane-holder .st0',
            '.mkdf-st-loader .mkdf-plane-holder .st1'
        );

        if(!empty($airplane_spinner_style)) {
            echo gotravel_mikado_dynamic_css($airplane_spinner_selectors, $airplane_spinner_style);
        }
    }

    add_action('gotravel_mikado_style_dynamic', 'gotravel_mikado_smooth_page_transition_styles');
}