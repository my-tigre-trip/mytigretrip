<div <?php gotravel_mikado_inline_style($holder_styles); ?> <?php gotravel_mikado_class_attribute($holder_classes); ?>>
	<?php if ($link !== ''){ ?>
		<a href="<?php echo esc_url($link);?>" target="<?php echo esc_attr($link_target);?>">
	<?php } ?>
	<div class="mkdf-icon-list-icon-holder">
		<div class="mkdf-icon-list-icon-holder-inner clearfix">
			<?php echo gotravel_mikado_icon_collections()->renderIcon($icon, $icon_pack, $params);
			?>
		</div>
	</div>
	<p class="mkdf-icon-list-text" <?php echo gotravel_mikado_get_inline_style($title_style) ?> > <?php echo esc_attr($title) ?></p>
	<?php if ($link !== ''){ ?>
		</a>
	<?php } ?>
</div>