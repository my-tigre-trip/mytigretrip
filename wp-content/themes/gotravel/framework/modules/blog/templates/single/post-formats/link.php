<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-link-holder">
			<div class="mkdf-post-mark">
				<span aria-hidden="true" class="icon_link"></span>
			</div>
			<h3 class="mkdf-post-title">
				<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h3>
		</div>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<?php the_content(); ?>

				<div class="mkdf-author-desc clearfix">
					<div class="mkdf-post-info">
						<?php gotravel_mikado_post_info(array(
							'date'     => 'yes',
							'comments' => 'yes',
							'like'     => 'yes',
							'category' => 'yes'
						)) ?>
					</div>
					<div class="mkdf-share-icons">
						<?php $post_info_array['share'] = gotravel_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
						<?php echo gotravel_mikado_get_social_share_html(array(
							'type'       => 'list',
							'show_label' => 'no'
						)); ?>
					</div>
				</div>
			</div>
		</div>
		<?php do_action('gotravel_mikado_before_blog_article_closed_tag'); ?>
	</div>
</article>