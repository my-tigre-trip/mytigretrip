<?php if($show_header_top) : ?>

	<?php do_action('gotravel_mikado_before_header_top'); ?>

	<div class="mkdf-top-bar">
		<?php if($top_bar_in_grid) : ?>
		<div class="mkdf-grid">
			<?php endif; ?>
			<?php do_action('gotravel_mikado_after_header_top_html_open'); ?>
			<div class="mkdf-vertical-align-containers">
				<div class="mkdf-position-left mkdf-top-bar-widget-area">
					<div class="mkdf-position-left-inner mkdf-top-bar-widget-area-inner">
						<?php if(is_active_sidebar('mkdf-top-bar-left')) : ?>
							<?php dynamic_sidebar('mkdf-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="mkdf-position-right mkdf-top-bar-widget-area">
					<div class="mkdf-position-right-inner mkdf-top-bar-widget-area-inner">
						<?php if(is_active_sidebar('mkdf-top-bar-right')) : ?>
							<?php dynamic_sidebar('mkdf-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if($top_bar_in_grid) : ?>
		</div>
	<?php endif; ?>
	</div>

	<?php do_action('gotravel_mikado_after_header_top'); ?>

<?php endif; ?>