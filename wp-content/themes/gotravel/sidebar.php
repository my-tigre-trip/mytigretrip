<?php
$mkdf_sidebar = gotravel_mikado_get_sidebar();
?>
<div class="mkdf-column-inner">
	<aside class="mkdf-sidebar">
		<?php
		if ( is_active_sidebar( $mkdf_sidebar ) ) {
			dynamic_sidebar( $mkdf_sidebar );
		}
		?>
	</aside>
</div>
