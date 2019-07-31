<?php
$mkdf_blog_archive_pages_classes = gotravel_mikado_blog_archive_pages_classes( gotravel_mikado_get_default_blog_list() );
?>
<?php get_header(); ?>
<?php gotravel_mikado_get_title(); ?>
	<div class="<?php echo esc_attr( $mkdf_blog_archive_pages_classes['holder'] ); ?>">
		<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $mkdf_blog_archive_pages_classes['inner'] ); ?>">
			<?php gotravel_mikado_get_blog( gotravel_mikado_get_default_blog_list() ); ?>
		</div>
		<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>