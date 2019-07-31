<div class="mkdf-post-info-comments-holder mkdf-post-info-item">
    <a class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
		<span class="mkdf-post-info-comments-icon">
			<?php echo gotravel_mikado_icon_collections()->renderIcon('icon_chat', 'font_elegant'); ?>
		</span>
        <?php if($show_comments_label) : ?>
            <?php comments_number('0 '.esc_html__('comments', 'gotravel'), '1 '.esc_html__('comment', 'gotravel'), '% '.esc_html__('comments', 'gotravel')); ?>
        <?php else: ?>
            <?php comments_number('0', '1', '%'); ?>
        <?php endif; ?>
    </a>
</div>