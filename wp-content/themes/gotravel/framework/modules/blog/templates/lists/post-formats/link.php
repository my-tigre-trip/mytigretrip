<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content clearfix">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <?php echo gotravel_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
                </div>
                <h4 class="mkdf-post-title"><?php the_title(); ?></h4>
                <div class="mkdf-post-info">
	                <?php gotravel_mikado_post_info(array(
		                'date'     => 'yes',
		                'category' => 'yes',
		                'comments' => 'yes'
	                )) ?>
                </div>
            </div>
        </div>
    </div>
	<?php
		$post_link_link = esc_html(get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true));
		if (!empty($post_link_link)) { ?>
			<a class="mkdf-post-link-link" href="<?php echo esc_url($post_link_link); ?>" target="_blank"></a>
		<?php }
	?>
</article>