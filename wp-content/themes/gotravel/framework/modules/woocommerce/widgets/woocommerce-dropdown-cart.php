<?php

class GoTravelMikadoWoocommerceDropdownCart extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'mkdf_woocommerce_dropdown_cart', // Base ID
            esc_html__('Mikado Woocommerce Dropdown Cart', 'gotravel'), // Name
            array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'gotravel'),) // Args
        );
    }

    public function widget($args, $instance) {
        extract($args);

        global $woocommerce;

        print $args['before_widget'];
        ?>
        <div class="mkdf-shopping-cart-outer">
            <div class="mkdf-shopping-cart-inner">
                <div class="mkdf-shopping-cart-header">
                    <a class="mkdf-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
                        <span class="mkdf-cart-icon"><span class="icon_bag_alt"></span></span>
                        <span class="mkdf-cart-count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
                    </a>

                    <div class="mkdf-shopping-cart-dropdown">
                        <?php $cart_is_empty = sizeof($woocommerce->cart->get_cart()) <= 0; ?>
                        <ul>
                            <?php if(!$cart_is_empty) : ?>
                                <?php foreach($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                                    $_product      = $cart_item['data'];

                                    // Only display if allowed
                                    if(!$_product->exists() || $cart_item['quantity'] == 0) {
                                        continue;
                                    }

                                    // Get price
                                    $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
                                    ?>
                                    <li>
                                        <div class="mkdf-item-image-holder">
                                            <a href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                                <?php echo wp_kses($_product->get_image(), array(
                                                    'img' => array(
                                                        'src'    => true,
                                                        'width'  => true,
                                                        'height' => true,
                                                        'class'  => true,
                                                        'alt'    => true,
                                                        'title'  => true,
                                                        'id'     => true
                                                    )
                                                )); ?>
                                            </a>
                                        </div>
                                        <div class="mkdf-item-info-holder">
                                            <div class="mkdf-item-left">
                                                <a href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                                    <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product); ?>
                                                </a>
												<span class="mkdf-quantity"><?php echo esc_html($cart_item['quantity']);
                                                    _e(' x ', 'gotravel'); ?>
                                                    <?php echo apply_filters('woocommerce_cart_item_price_html', wc_price($product_price), $cart_item, $cart_item_key); ?>
                                            </div>
                                            <div class="mkdf-item-right">
                                                <?php echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), esc_html__('Remove this item', 'gotravel')), $cart_item_key); ?>
                                            </div>
                                        </div>
                                    </li>

                                <?php endforeach; ?>
                                <div class="mkdf-cart-bottom">
                                    <div class="mkdf-subtotal-holder clearfix">
                                        <span class="mkdf-total"><?php esc_html_e('TOTAL', 'gotravel'); ?>:</span>
										<span class="mkdf-total-amount">
											<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
                                                'span' => array(
                                                    'class' => true,
                                                    'id'    => true
                                                )
                                            )); ?>
										</span>
                                    </div>
                                    <div class="mkdf-btns-holder clearfix">
                                        <?php echo gotravel_mikado_get_button_html(array(
                                            'link'         => $woocommerce->cart->get_checkout_url(),
                                            'custom_class' => 'checkout',
                                            'text'         => esc_html__('Checkout', 'gotravel'),
                                            'size'         => 'small',
                                            'type'         => 'solid'
                                        )); ?>
                                        <?php echo gotravel_mikado_get_button_html(array(
                                            'link'         => $woocommerce->cart->get_cart_url(),
                                            'custom_class' => 'view-cart',
                                            'text'         => esc_html__('View Cart', 'gotravel'),
                                            'size'         => 'small',
                                            'type'         => 'solid'
                                        )); ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <li class="mkdf-empty-cart"><?php esc_html_e('No products in the cart.', 'gotravel'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php

        print $args['after_widget'];
    }
}

add_action('widgets_init', create_function('', 'register_widget( "GoTravelMikadoWoocommerceDropdownCart" );'));
?>
<?php
add_filter('add_to_cart_fragments', 'gotravel_mikado_woocommerce_header_add_to_cart_fragment');
function gotravel_mikado_woocommerce_header_add_to_cart_fragment($fragments) {
    global $woocommerce;

    ob_start();
    ?>
    <div class="mkdf-shopping-cart-header">
        <a class="mkdf-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
            <span class="mkdf-cart-icon"><span class="icon_bag_alt"></span></span>
            <span class="mkdf-cart-count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
        </a>
        <div class="mkdf-shopping-cart-dropdown">
            <?php $cart_is_empty = sizeof($woocommerce->cart->get_cart()) <= 0; ?>
            <ul>
                <?php if(!$cart_is_empty) : ?>
                    <?php foreach($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                        $_product      = $cart_item['data'];

                        // Only display if allowed
                        if(!$_product->exists() || $cart_item['quantity'] == 0) {
                            continue;
                        }

                        // Get price
                        $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
                        ?>
                        <li>
                            <div class="mkdf-item-image-holder">
                                <?php echo wp_kses($_product->get_image(), array(
                                    'img' => array(
                                        'src'    => true,
                                        'width'  => true,
                                        'height' => true,
                                        'class'  => true,
                                        'alt'    => true,
                                        'title'  => true,
                                        'id'     => true
                                    )
                                )); ?>
                            </div>
                            <div class="mkdf-item-info-holder">
                                <div class="mkdf-item-left">
                                    <a href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">
                                        <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product); ?>
                                    </a>
                                    <span class="mkdf-quantity"><?php echo esc_html($cart_item['quantity']);
                                    esc_html_e(' x ', 'gotravel'); ?>
                                    <?php echo apply_filters('woocommerce_cart_item_price_html', wc_price($product_price), $cart_item, $cart_item_key); ?>
                                </div>
                                <div class="mkdf-item-right">
                                    <?php echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), esc_html__('Remove this item', 'gotravel')), $cart_item_key); ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <div class="mkdf-cart-bottom">
                        <div class="mkdf-subtotal-holder clearfix">
                            <span class="mkdf-total"><?php esc_html_e('TOTAL', 'gotravel'); ?>:</span>
                            <span class="mkdf-total-amount">
                                <?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
                                    'span' => array(
                                        'class' => true,
                                        'id'    => true
                                    )
                                )); ?>
                            </span>
                        </div>
                        <div class="mkdf-btns-holder clearfix">
                            <?php echo gotravel_mikado_get_button_html(array(
                                'link'         => $woocommerce->cart->get_checkout_url(),
                                'custom_class' => 'checkout',
                                'text'         => esc_html__('Checkout', 'gotravel'),
                                'size'         => 'small',
                                'type'         => 'solid'
                            )); ?>
                            <?php echo gotravel_mikado_get_button_html(array(
                                'link'         => $woocommerce->cart->get_cart_url(),
                                'custom_class' => 'view-cart',
                                'text'         => esc_html__('View Cart', 'gotravel'),
                                'size'         => 'small',
                                'type'         => 'solid'
                            )); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <li class="mkdf-empty-cart"><?php esc_html_e('No products in the cart.', 'gotravel'); ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php
    $fragments['div.mkdf-shopping-cart-header'] = ob_get_clean();

    return $fragments;
}
?>