<?php do_action('gotravel_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

	<div class="mkdf-title <?php echo gotravel_mikado_title_classes(); ?>" <?php gotravel_mikado_inline_style($title_styles); ?> data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
		<div class="mkdf-title-image"><?php if($title_background_image_src != "") { ?>
				<img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;"/> <?php } ?></div>
		<div class="mkdf-title-holder" <?php gotravel_mikado_inline_style($title_holder_height); ?>>
			<div class="mkdf-container clearfix">
				<div class="mkdf-container-inner">
					<?php /*
					<div class="mkdf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
						<div class="mkdf-title-subtitle-holder-inner">
							<?php if($has_subtitle) { ?>
								<h6 class="mkdf-subtitle" <?php gotravel_mikado_inline_style($subtitle_color); ?>><span><?php gotravel_mikado_subtitle_text(); ?></span></h6>
							<?php } ?>
							<?php if (!$hide_title_text){ ?>
								<h1 <?php gotravel_mikado_inline_style($title_color); ?>>
									<span><?php gotravel_mikado_title_text(); ?></span>
								</h1>
							<?php } ?>

						</div>
					</div> */
					?>

				</div>
			</div>
		</div>
	</div>

<?php } ?>
<?php do_action('gotravel_mikado_after_page_title'); ?>
