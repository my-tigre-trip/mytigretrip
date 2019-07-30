<div <?php post_class('mkdf-blog-carousel-item'); ?>>
    <div class="mkdf-blog-carousel-item-inner" <?php gotravel_mikado_inline_style($item_style); ?>>
        <?php if(!$caller->featuredImageHidden($params)) : ?>
            <div class="mkdf-blog-carousel-item-image-holder">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="mkdf-blog-carousel-item-content-holder">
            <span class="mkdf-blog-carousel-info-item mkdf-blog-carousel-item-post-date">
					<?php the_time(get_option('date_format')); ?>
            </span>
            <h4 class="mkdf-blog-carousel-item-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>

            <div class="mkdf-blog-carousel-item-excerpt">
                <?php if($text_length != '0') {
                    $excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
                    <p><?php echo esc_html($excerpt) ?></p>
                <?php } ?>
            </div>

            <div class="mkdf-blog-carousel-item-info clearfix">
                <div class="mkdf-author-image">
                    <?php echo gotravel_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 30)); ?>
                </div>
                <div class="mkdf-author-name-holder">
                    <h6 class="mkdf-author-name">
                        <span><?php esc_html_e('by', 'gotravel'); ?></span>
                        <a href="<?php echo esc_url(gotravel_mikado_get_author_posts_url()); ?>">
                            <?php
                            if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
                                echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
                            } else {
                                echo esc_attr(get_the_author_meta('display_name'));
                            }
                            ?>
                        </a>
                    </h6>
                </div>

            </div>
        </div>
    </div>
</div>