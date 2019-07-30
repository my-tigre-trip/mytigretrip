<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-quote-holder">
			<div class="mkdf-post-mark">
				<span aria-hidden="true" class="icon_quotations"></span>
			</div>
			<div class="mkdf-post-title">
				<h3>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_text_meta", true)); ?></a>
				</h3>
				<span class="quote_author">&mdash; <?php the_title(); ?></span>
			</div>
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