<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="mkdf-post-content clearfix">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-mark">
                    <?php echo gotravel_mikado_icon_collections()->renderIcon('icon_quotations', 'font_elegant'); ?>
                </div>
                <div class="mkdf-post-title-holder">
                    <a href="<?php the_permalink() ?>">
                        <h4 class="mkdf-post-title"><?php echo esc_html(get_post_meta(get_the_ID(), 'mkdf_post_quote_text_meta', true)); ?></h4>

                        <p class="mkdf-quote-author"><?php the_title(); ?></p>
                    </a>
                </div>
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
</article>