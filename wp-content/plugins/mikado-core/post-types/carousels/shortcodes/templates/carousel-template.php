<div class="mkdf-carousel-item-holder">
    <div class="mkdf-carousel-item-image">
        <?php if($link !== '') { ?>
            <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
        <?php } ?>
            <?php if(!empty($image_id)) { ?>
                <span class="mkdf-carousel-first-image-holder <?php echo esc_attr($hover_class); ?> <?php echo esc_attr($carousel_image_classes); ?>">
                    <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                </span>
            <?php } ?>
            <?php if(!empty($hover_image_id)) { ?>
                <span class="mkdf-carousel-second-image-holder <?php echo esc_attr($hover_class); ?> <?php echo esc_attr($carousel_image_classes); ?>">
                    <?php echo wp_get_attachment_image($hover_image_id, 'full'); ?>
                </span>
            <?php } ?>
        <?php if($link !== '') { ?>
            </a>
        <?php } ?>
    </div>
    <?php if(!empty($car_title) || !empty($text)) { ?>
        <div class="mkdf-carousel-description">
            <h5 class="mkdf-carousel-title"><?php echo esc_html($car_title) ?></h5>
            <p class="mkdf-carousel-text"><?php echo esc_html($text) ?></p>
        </div>
    <?php } ?>
</div>