<?php
$mkdf_excerpt_length_array = gotravel_mikado_blog_lists_number_of_chars();

$mkdf_excerpt_length = 0;
if ( is_array( $mkdf_excerpt_length_array ) && array_key_exists( 'standard', $mkdf_excerpt_length_array ) ) {
	$mkdf_excerpt_length = $mkdf_excerpt_length_array['standard'];
}
?>
<?php get_header(); ?>
<?php

$mkdf_blog_page_range     = gotravel_mikado_get_blog_page_range();
$mkdf_max_number_of_pages = gotravel_mikado_get_max_number_of_pages();

if ( get_query_var( 'paged' ) ) {
	$mkdf_paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$mkdf_paged = get_query_var( 'page' );
} else {
	$mkdf_paged = 1;
}
?>
<?php gotravel_mikado_get_title(); ?>
	<div class="mkdf-container">
		<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
		<div class="mkdf-container-inner clearfix">
			<div class="mkdf-container">
				<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
				<div class="mkdf-container-inner">
					<div class="mkdf-blog-holder mkdf-blog-type-standard">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="mkdf-post-content">
									<div class="mkdf-post-text">
										<div class="mkdf-post-text-inner">
											<div class="mkdf-post-info">
												<?php gotravel_mikado_post_info( array(
													'date'     => 'yes',
													'category' => 'yes',
													'comments' => 'yes',
													'like'     => 'yes'
												) ) ?>
											</div>
											<h2 class="mkdf-post-title">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
												
											</h2>
											<?php if ( get_post_type() === 'post' ) : ?>
												<?php gotravel_mikado_excerpt( $mkdf_excerpt_length ); ?>
											<?php endif; ?>
										</div>
										<div class="mkdf-author-desc clearfix">
											<div class="mkdf-image-name">
												<div class="mkdf-author-image">
													<?php echo gotravel_mikado_kses_img( get_avatar( get_the_author_meta( 'ID' ), 102 ) ); ?>
												</div>
												<div class="mkdf-author-name-holder">
													<h5 class="mkdf-author-name">
														<?php
														if ( get_the_author_meta( 'first_name' ) != "" || get_the_author_meta( 'last_name' ) != "" ) {
															echo esc_attr( get_the_author_meta( 'first_name' ) ) . " " . esc_attr( get_the_author_meta( 'last_name' ) );
														} else {
															echo esc_attr( get_the_author_meta( 'display_name' ) );
														}
														?>
													</h5>
												</div>
											</div>
											<div class="mkdf-share-icons">
												<?php $post_info_array['share'] = gotravel_mikado_options()->getOptionValue( 'enable_social_share' ) == 'yes'; ?>
												<?php if ( $post_info_array['share'] == 'yes' ): ?>
													<span class="mkdf-share-label"><?php esc_html_e( 'Share', 'gotravel' ); ?></span>
												<?php endif; ?>
												<?php echo gotravel_mikado_get_social_share_html( array(
													'type'      => 'list',
													'icon_type' => 'normal'
												) ); ?>
											</div>
										</div>
									</div>
								</div>
							</article>
						<?php endwhile; ?>
							<?php
							if ( gotravel_mikado_options()->getOptionValue( 'pagination' ) == 'yes' ) {
								gotravel_mikado_pagination( $mkdf_max_number_of_pages, $mkdf_blog_page_range, $mkdf_paged );
							}
							?>
						<?php else: ?>
							<div class="entry">
								<p><?php esc_html_e( 'No posts were found.', 'gotravel' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
					<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
				</div>
			</div>
		</div>
		<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>