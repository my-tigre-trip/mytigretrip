<?php get_header(); ?>


<div class="mkdf-container">
	
	
	<div class="mkdf-container-inner clearfix">

		<div class="mkdf-tours-search-page-holder">
			<h2>What we offer</h2>
			<p>Please choose between these options</p>

	<?php do_action( 'gotravel_mikado_after_container_open' ); ?>
			<div class="mkdf-grid-row-medium-gutter">
				<?php the_content(); ?>
				<div class="mkdf-grid-col-9">
					<a href="#">
					<div class="mkdf-grid-col-4">
						<h3>Actividades</h3>
						<img src="http://localhost/mytigretrip/wp-content/uploads/2016/11/009.-Tigre-Art-Museum-.jpg">
							
					</div>
					</a>
					
				
	</div>
					
				
				</div>
				<div class="mkdf-grid-col-3">
					<aside class="mkdf-sidebar">
						<div class="widget mkdf-tours-main-search-filters">
							
						</div>
						
						
					</aside>
				</div>
			</div>
		</div>
	</div>
	<?php do_action( 'gotravel_mikado_before_container_close' ); ?>
</div>

<?php get_footer(); ?>
