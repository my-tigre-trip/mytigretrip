<?php do_action('gotravel_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
	<?php if($show_fixed_wrapper) : ?>
	<div class="mkdf-fixed-wrapper">
		<?php endif; ?>
		<div class="mkdf-menu-area">
			<div class="mkdf-grid">
				<?php do_action('gotravel_mikado_after_header_menu_area_html_open') ?>
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-left">
						<div class="mkdf-position-left-inner">
							<?php if(!$hide_logo) {
								gotravel_mikado_get_logo();
							} ?>
						</div>
					</div>
					<div class="mkdf-position-right">
						<div class="mkdf-position-right-inner">
							<?php gotravel_mikado_get_main_menu(); ?>
							<?php if(is_active_sidebar('mkdf-right-from-main-menu')) : ?>
								<div class="mkdf-main-menu-widget-area">
									<div class="mkdf-main-menu-widget-area-inner">
										<?php dynamic_sidebar('mkdf-right-from-main-menu'); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($show_fixed_wrapper) : ?>
	</div>
<?php endif; ?>
	<?php if($show_sticky) {
		gotravel_mikado_get_sticky_header();
	} ?>
</header>

<?php do_action('gotravel_mikado_after_page_header'); ?>

