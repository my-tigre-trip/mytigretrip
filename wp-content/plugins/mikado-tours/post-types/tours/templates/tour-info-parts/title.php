<?php
$title = get_the_title();
//$subtitle = gotravel_mikado_subtitle_text();
$subtitle = isTourCategory('build-your-own-tigre-trip-stop',get_the_ID())?"I'm also in a mood for..." :"I'm in a mood for...";
?>

<div class="mkdf-info-section-part mkdf-tour-item-title-holder">

	<p class="mkdf-subtitle" <?php gotravel_mikado_inline_style($subtitle_color); ?>><span><?php echo $subtitle;//gotravel_mikado_subtitle_text(); ?></span></p>

	<?php if($title !== '') : ?>
		<h1 class="mkdf-tour-item-title">
			<?php echo esc_html($title) ?>
		</h1>
	<?php endif; ?>

	<?php //mtt if( getTourPrice(get_the_ID()) != '0' ): ?>
	<div class="mkdf-tour-item-price-holder">
		<span class="mkdf-tour-item-price">
			<?php echo get_post_meta( get_the_ID(), 'mkdf_tours_price', true);//mkdf_tours_get_tour_price_html(get_the_ID());	?>
		</span>
    <?php /*
		<span class="mkdf-tour-item-price-text">
			<?php esc_html_e('per person', 'mikado-tours'); ?>

		</span>
		*/ ?>
	</div>
	<?php//mtt endif; ?>
</div>
