<div <?php post_class(array('mkdf-tours-gallery-item',mkdf_tours_get_tour_rating_class())); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-gallery-item-image-holder">
			<?php if(mkdf_tours_get_tour_label_html()) : ?>
				<span class="mkdf-tours-gallery-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>
			
			<div class="mkdf-tours-gallery-item-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
				
				<div class="mkdf-tours-gallery-item-content-holder">
					<div class="mkdf-tours-gallery-item-content-inner">
						<div class="mkdf-tours-gallery-title-holder">
							<h4 class="mkdf-tour-title" <?php gotravel_mikado_inline_style($title_style);?>><?php the_title(); ?></h4>
							<span class="mkdf-tours-gallery-item-price-holder">
							<?php echo mkdf_tours_get_tour_price_html(); ?>
						</span>
						</div>
						<?php if(mkdf_tours_get_tour_excerpt()) : ?>
							<div class="mkdf-tours-gallery-item-excerpt">
								<div class="mkdf-tours-gallery-item-excerpt-inner">
									<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<a class="mkdf-tours-gallery-item-link" href="<?php the_permalink(); ?>"></a>
		</div>
	<?php endif; ?>
</div>