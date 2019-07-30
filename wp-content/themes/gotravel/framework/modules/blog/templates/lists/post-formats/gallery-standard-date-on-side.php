<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <?php gotravel_mikado_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
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
                <?php gotravel_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
                <?php
                gotravel_mikado_excerpt($excerpt_length);

                $args_pages = array(
                    'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
                    'after'       => '</div></div>',
                    'link_before' => '<span>'. esc_html__('Post Page Link: ', 'gotravel'),
                    'link_after'  => '</span>',
                    'pagelink'    => '%'
                );

                wp_link_pages($args_pages);
                ?>

                <div class="mkdf-author-desc clearfix">
                    <div class="mkdf-post-info">
                        <?php gotravel_mikado_post_info(array(
                            'date'     => 'yes',
                            'category' => 'yes',
                            'comments' => 'yes',
                            'like'     => 'yes'
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
    </div>
</article>