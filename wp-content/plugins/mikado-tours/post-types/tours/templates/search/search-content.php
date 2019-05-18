<div class="mkdf-tours-search-content">
	<div class="mkdf-grid-row">

		<?php 

		$filtered = [];
		foreach($tours_list as $t){
		//	$tour_id =$t->ID;
			$categories = wp_get_post_terms($t->ID, 'tour-category');	
			echo "<br>--------- $t->ID - $t->term_slug ---------<br>";
		//	print_r($categories);
			foreach($categories as $c){
				if(  $t->term_slug == 'pre-built-tours' ){
					$filtered[] =$t ;
				}
			}
			
		}
		
		echo mkdf_tours_get_search_page_items_loop_html($filtered); ?>
	</div>
</div>