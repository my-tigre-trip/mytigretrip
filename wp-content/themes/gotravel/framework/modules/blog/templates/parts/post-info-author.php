<div class="mkdf-post-info-author mkdf-post-info-item">
	<?php esc_html_e('by', 'gotravel'); ?>
	<a class="mkdf-post-info-author-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
		<?php the_author_meta('display_name'); ?>
	</a>
</div>
