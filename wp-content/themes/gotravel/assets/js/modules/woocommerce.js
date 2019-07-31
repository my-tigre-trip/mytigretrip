(function($) {
    'use strict';

    var woocommerce = {};
    mkdf.modules.woocommerce = woocommerce;

    woocommerce.mkdfInitQuantityButtons = mkdfInitQuantityButtons;
    woocommerce.mkdfInitSelect2 = mkdfInitSelect2;

    woocommerce.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitQuantityButtons();
        mkdfInitSelect2();
	    mkdfInitSingleProductLightbox();
    }
    
    /*
     ** Init quantity buttons to increase/decrease products for cart
     */
    function mkdfInitQuantityButtons() {
        
        $(document).on( 'click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function(e) {
            e.stopPropagation();
            
            var button = $(this),
                inputField = button.siblings('.mkdf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;
            
            if (button.hasClass('mkdf-quantity-minus')) {
                minus = true;
            }
            
            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            
            inputField.trigger( 'change' );
        });
    }
    
    /*
     ** Init select2 script for select html dropdowns
     */
    function mkdfInitSelect2() {
        
        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
	            minimumResultsForSearch: Infinity
            });
        }
        
        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }
        
        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }
    }
    
    /*
     ** Init Product Single Pretty Photo attributes
     */
	function mkdfInitSingleProductLightbox() {
		var item = $('.mkdf-woocommerce-single-page .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof mkdf.modules.common.mkdfPrettyPhoto === "function") {
				mkdf.modules.common.mkdfPrettyPhoto();
			}
		}
	}

})(jQuery);