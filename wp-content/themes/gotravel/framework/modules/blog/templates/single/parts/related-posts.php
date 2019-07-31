<div class="mkdf-related-posts-holder">
	<?php if($related_posts && $related_posts->have_posts()) : ?>
		<h4 class="mkdf-related-posts-title"><span><?php esc_html_e('Related Posts', 'gotravel'); ?></span></h4>
		<div class="mkdf-related-posts-inner clearfix">
			<?php while($related_posts->have_posts()) :
				$related_posts->the_post();
				?>
				<div class="mkdf-related-post">
					<?php if(has_post_thumbnail()) { ?>
						<div class="mkdf-related-post-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						</div>
					<?php } ?>
					<h5 class="mkdf-related-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
				</div>
				<?php
			endwhile; ?>
		</div>
	<?php endif;
	wp_reset_postdata();
	?>
</div>