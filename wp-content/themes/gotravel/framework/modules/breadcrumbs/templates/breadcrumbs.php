<?php if($enable_breadcrumbs_area) : ?>
	<div class="mkdf-breadcrumbs-area-holder">
		<div class="mkdf-grid">
			<div class="mkdf-grid-row">
				<div class="<?php echo esc_attr($breadcrumbs_class); ?>">
					<div class="mkdf-breadcrumbs-holder">
						<?php gotravel_mikado_custom_breadcrumbs(); ?>
					</div>
				</div>

				<?php if($enable_social_share) : ?>
					<div class="mkdf-grid-col-6">
						<div class="mkdf-breadcrumbs-social-holder">
							<?php echo gotravel_mikado_get_social_share_html(); ?>
						</div>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>