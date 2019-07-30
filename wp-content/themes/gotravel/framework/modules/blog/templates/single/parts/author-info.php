<?php
$author_info_box   = esc_attr(gotravel_mikado_options()->getOptionValue('blog_author_info'));
$author_info_email = esc_attr(gotravel_mikado_options()->getOptionValue('blog_author_info_email'));
$social_networks   = gotravel_mikado_core_installed() ? gotravel_mikado_get_user_custom_fields() : false;
?>
<?php if($author_info_box === 'yes') { ?>
	<div class="mkdf-author-description">
		<div class="mkdf-author-description-inner clearfix">
			<div class="mkdf-author-description-image">
				<?php echo gotravel_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
			</div>
			<div class="mkdf-author-description-text-holder">
				<h5 class="mkdf-author-name">
					<?php
					if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
						echo esc_attr(get_the_author_meta('first_name'))." ".esc_attr(get_the_author_meta('last_name'));
					} else {
						echo esc_attr(get_the_author_meta('display_name'));
					}
					?>
				</h5>
				<?php if(get_the_author_meta('position') !== '') : ?>
					<div class="mkdf-author-position-holder">
						<h6 class="mkdf-author-position"><?php echo esc_html(get_the_author_meta('position')); ?></h6>
					</div>
				<?php endif; ?>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))) { ?>
					<p class="mkdf-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkdf-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if(!empty($social_networks) && $social_networks !== false) { ?>
					<div class="mkdf-author-social-holder clearfix">
						<?php foreach($social_networks as $network) { ?>
							<a href="<?php echo esc_attr($network['link']) ?>" target="blank">
								<?php echo gotravel_mikado_icon_collections()->renderIcon($network['class'], 'font_elegant'); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>