<div class="mkdf-post-info-date">
    <?php if(!gotravel_mikado_post_has_title()) { ?>
    <a href="<?php the_permalink() ?>">
        <?php } ?>
        <span>
            <span class="mkdf-post-info-date-icon">
                <?php echo gotravel_mikado_icon_collections()->renderIcon('icon_calendar', 'font_elegant'); ?>
            </span>
            <?php the_time(get_option('date_format')); ?>
        </span>
        <?php if(!gotravel_mikado_post_has_title()) { ?>
    </a>
<?php } ?>
</div>