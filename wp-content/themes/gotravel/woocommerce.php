<?php
/*
Template Name: WooCommerce
*/
?>
<?php
get_header();

gotravel_mikado_get_title();
get_template_part( 'slider' );

$mkdf_full_width = false;
$mkdf_sidebar    = gotravel_mikado_sidebar_layout();

if ( gotravel_mikado_options()->getOptionValue( 'mkdf_woo_products_list_full_width' ) == 'yes' && ! is_singular( 'product' ) ) {
	$mkdf_full_width = true;
}

if ( $mkdf_full_width ) { ?>
<div class="mkdf-full-width">
	<?php } else { ?>
	<div class="mkdf-container">
		<?php }
		if ( $mkdf_full_width ) { ?>
		<div class="mkdf-full-width-inner">
			<?php } else { ?>
			<div class="mkdf-container-inner clearfix">
				<?php }
				
				//Woocommerce content
				if ( ! is_singular( 'product' ) ) {
					
					switch ( $mkdf_sidebar ) {
						
						case 'sidebar-33-right': ?>
							<div class="mkdf-two-columns-66-33 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<div class="mkdf-column-inner">
										<?php gotravel_mikado_woocommerce_content(); ?>
									</div>
								</div>
								<div class="mkdf-column2">
									<?php get_sidebar(); ?>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-25-right': ?>
							<div class="mkdf-two-columns-75-25 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1 mkdf-content-left-from-sidebar">
									<div class="mkdf-column-inner">
										<?php gotravel_mikado_woocommerce_content(); ?>
									</div>
								</div>
								<div class="mkdf-column2">
									<?php get_sidebar(); ?>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-33-left': ?>
							<div class="mkdf-two-columns-33-66 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<?php get_sidebar(); ?>
								</div>
								<div class="mkdf-column2">
									<div class="mkdf-column-inner">
										<?php gotravel_mikado_woocommerce_content(); ?>
									</div>
								</div>
							</div>
							<?php
							break;
						case 'sidebar-25-left': ?>
							<div class="mkdf-two-columns-25-75 grid2 mkdf-woocommerce-with-sidebar clearfix">
								<div class="mkdf-column1">
									<?php get_sidebar(); ?>
								</div>
								<div class="mkdf-column2 mkdf-content-right-from-sidebar">
									<div class="mkdf-column-inner">
										<?php gotravel_mikado_woocommerce_content(); ?>
									</div>
								</div>
							</div>
							<?php
							break;
						default:
							gotravel_mikado_woocommerce_content();
					}
					
				} else {
					gotravel_mikado_woocommerce_content();
				} ?>
			
			</div>
		</div>
		<?php get_footer(); ?>
