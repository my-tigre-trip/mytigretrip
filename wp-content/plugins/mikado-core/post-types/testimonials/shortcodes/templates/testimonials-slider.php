<div id="mkdf-testimonials<?php echo esc_attr($current_id) ?>" class="mkdf-testimonial-content <?php echo esc_attr($testimonial_type); ?>">
	<div class="mkdf-testimonial-content-inner">
		<div class="mkdf-testimonial-text-holder">
			<div class="mkdf-testimonial-text-inner <?php echo esc_attr($light_class); ?>">
				<?php if($show_title == "yes") { ?>
					<h2 class="mkdf-testimonial-title <?php echo esc_attr($light_class); ?>"><?php echo esc_html($title); ?></h2>
				<?php } ?>
				<p class="mkdf-testimonial-text"><?php echo trim($text) ?></p>
				<?php if($show_author == "yes") { ?>
					<div class="mkdf-testimonial-author">
						<h5 class="mkdf-testimonial-author-text <?php echo esc_attr($light_class); ?>"><?php echo esc_html($author) ?>, </h5>
						<?php if($show_position == "yes" && $job !== '') { ?>
							<span class="mkdf-testimonials-job <?php echo esc_attr($light_class); ?>"><?php echo esc_html($job) ?></span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
