<?php
/*
Template Name: Blog: Masonry
*/
?>
<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
<?php get_template_part( 'slider' ); ?>
	<div class="mkdf-container">
		<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="mkdf-blog-template-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>
			
			<?php gotravel_mikado_get_blog( 'masonry' ); ?>
		</div>
		<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>