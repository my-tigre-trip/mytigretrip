<?php
/*
Template Name: Full Width
*/
?>
<?php
$mkdf_sidebar = gotravel_mikado_sidebar_layout(); ?>

<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
<?php get_template_part( 'slider' ); ?>
	
	<div class="mkdf-full-width">
		<div class="mkdf-full-width-inner">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="mkdf-grid-row-medium-gutter">
					<div <?php echo gotravel_mikado_get_content_sidebar_class(); ?>>
						<?php the_content(); ?>
						<?php do_action( 'gotravel_mikado_page_after_content' ); ?>
					</div>
					
					<?php if ( ! in_array( $mkdf_sidebar, array( 'default', '' ) ) ) : ?>
						<div <?php echo gotravel_mikado_get_sidebar_holder_class(); ?>>
							<?php get_sidebar(); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
<div id="mtt-scroll-down">
    <span>Scroll down to see more options</span>  
    <span class="mkdf-icon-stack">
      <?php echo gotravel_mikado_icon_collections()->renderIcon('lnr-chevron-down', 'linear_icons'); ?>
    </span>
 </div>
<?php get_footer(); ?>