<article class="<?php echo esc_attr($item_classes) ?>">
	<div class="mkdf-mg-content">
		<?php if (has_post_thumbnail()) { ?>
			<div class="mkdf-mg-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>
		<div class="mkdf-mg-item-outer">
			<div class="mkdf-mg-item-inner">
				<div class="mkdf-mg-item-content">
					<?php if (!empty($item_title)) { ?>
						<<?php echo esc_attr($item_title_tag); ?> class="mkdf-mg-item-title entry-title"><?php echo esc_html($item_title); ?></<?php echo esc_attr($item_title_tag); ?>>
					<?php } ?>
					<?php if (!empty($item_text)) { ?>
						<p class="mkdf-mg-item-text"><?php echo esc_html($item_text); ?></p>
					<?php } ?>
					<?php if (!empty($item_additional_text)) { ?>
						<h4 class="mkdf-mg-item-additional-text"><?php echo esc_html($item_additional_text); ?></h4>
					<?php } ?>
				</div>
				<?php if (!empty($item_link)) { ?>
					<a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_link_target); ?>" class="mkdf-mg-item-link"></a>
				<?php } ?>
			</div>
		</div>
	</div>
</article>
