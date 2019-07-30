<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-audio-image-holder">
            <?php gotravel_mikado_get_module_template_part('templates/single/parts/image', 'blog'); ?>

            <?php if(has_post_thumbnail()) : ?>
                <div class="mkdf-audio-player-holder">
                    <?php gotravel_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!has_post_thumbnail()) : ?>
            <?php gotravel_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
        <?php endif; ?>
        <div class="mkdf-date-format">
            <?php if(!gotravel_mikado_post_has_title()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php endif; ?>

                <span class="mkdf-day"><?php the_time($time_j) ?></span>
                <span class="mkdf-month"><?php the_time($time_m) ?></span>

                <?php if(!gotravel_mikado_post_has_title()) : ?>
            </a>
        <?php endif; ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php gotravel_mikado_get_module_template_part('templates/single/parts/title', 'blog'); ?>
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