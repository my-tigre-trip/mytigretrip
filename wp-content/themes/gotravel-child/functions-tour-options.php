<?php
function tour_options_list_shortcodes(){
?>
<div class="wpb_column vc_column_container vc_col-sm-12">
<div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h2></h2>

		</div>
	</div>
<div class="mkdf-elements-holder mkdf-responsive-mode-768">
	<div class="mkdf-eh-item mkdf-horizontal-alignment-center" data-item-class="mkdf-eh-custom-191505" data-1280-1600="21px 26% 0 26%" data-1024-1280="21px 25% 0 25%" data-768-1024="21px 19% 0 19%" data-600-768="21px 7% 0 7%" data-480-600="21px 5% 0 5%" data-480="21px 5% 0 5%">

	<div class="mkdf-eh-item-inner">
		<div class="mkdf-eh-item-content mkdf-eh-custom-191505" style="padding: 21px 32% 0 32%">

		<h6 class="mkdf-custom-font-holder" style="color: #808285">
			Lorem ipsum dolor sit amet This is Photoshop’s version of Lorem Ipsn gravida. Ing business like this takes much more effort than doing your own.</h6>
		</div>
	</div>
	</div>
</div>




</div>
</div>

<style type="text/css">
	.mtt-tour-option{
		/*
		width: 30%;
		float: left;
		margin: 5px;*/
	}

	@media screen and (max-width: 480px) {
    	.mtt-tour-option {
    	 /*   width: 100%;
			margin: auto;*/

    	}
	}

</style>

<?php
}

add_shortcode( 'lista-de-opciones', 'tour_options_list_shortcodes' );

/**
* ITEM
*/

function tour_options_item_shortcodes($atts){
	$atts = shortcode_atts( array(

        'titulo' =>  'ingrese titulo', 'opcion' => '',
        'info' => '',
        'precio' => '',
        'imagen' => 'http://tigre-private-boat-tours.com/wp-content/uploads/2016/11/210-600x463.jpg',
        'pie' => '',
        'enlace' => '#'

    ), $atts, 'item-de-opcion' );
     global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
	$link = $atts['enlace'];
?>
<!-------  INICIO ITEM -->
 <div class="mtt-tour-option vc_col-md-4  vc_col-sm-12">

 	<div class="owl-stage" >

        <div class="mkdf-tours-standard-item post-3727 tour-item type-tour-item status-publish has-post-thumbnail hentry tour-category-lunch-lounge tour-category-sightseeing-relaxing tour-category-suggested-for-children">
			<div class="mkdf-tours-standard-item-image-holder">
			<a href="<?php echo $link;?>"  >
				<img src="<?php echo $atts['imagen'] ?>" alt="Tigre horse riding private tour" width="600" height="463">			</a>
							<span class="mkdf-tours-standard-item-label-holder">

		<span class="mkdf-tour-item-label">
			<span class="mkdf-tour-item-label-inner">
							</span>
		</span>

						</span>
					</div>
<div class="mkdf-tours-standard-item-content-holder">
	<div class="mkdf-tours-standard-item-content-inner">
		<div class="mkdf-tours-standard-item-title-price-holder">
			<h4 class="mkdf-tour-title">
			<a href="<?php echo $link;?>"><?php echo $atts['titulo']?></a>

			<span class="mkdf-tours-standard-item-price-holder">
			<span class="mkdf-tours-price-holder">
						<span class="mkdf-tours-item-price">Private Trip</span>
						<span class="mkdf-tours-item-price">From</span>
			      <span class="mkdf-tours-item-price"><?php echo  $atts['precio']?></span>
			</span>
			</span>

			<?php  if( $atts['titulo'] !== '' ): ?>
			<?php  endif; ?>
			</h4>
		</div>

		<div class="mkdf-tours-standard-item-excerpt"><?php echo $atts['info']?></div>
	</div>
	<?php  if( $atts['pie'] !== '' ): ?>
	<div class="mkdf-tours-standard-item-bottom-content">
		<div class="mkdf-tours-standard-item-bottom-item">

			<div class="mkdf-tour-duration-holder">
			    <span class="mkdf-tour-duration-icon mkdf-tour-info-icon">
					<span class="icon_calendar"></span>
			    </span>
				<span class="mkdf-tour-info-label">15 Days</span>
			</div>
		</div>

		<div class="mkdf-tours-standard-item-bottom-item">

			<div class="mkdf-tour-min-age-holder">
			    <span class="mkdf-tour-min-age-icon mkdf-tour-info-icon">
				    <span class="icon_group"></span>
			    </span>

				<span class="mkdf-tour-info-label">14+</span>
			</div>
		</div>
	</div>
	<?php  endif; ?>
	</div>
</div>



        </div>
    </div>
<!-------  FIN ITEM -->

<?php
}
add_shortcode( 'item-de-opcion', 'tour_options_item_shortcodes' );

/**
*
* Seleccion de tipo de lancha
*/
function boat_options_item_shortcodes($atts){
	$atts = shortcode_atts( array(

        'titulo' =>  'ingrese titulo', 'opcion' => '',
        'info' => 'ingrese texto',
        'precio' => '',
        'imagen' => 'http://tigre-private-boat-tours.com/wp-content/uploads/2016/11/210-600x463.jpg',
        'pie' => ''

    ), $atts, 'opcion-de-lancha' );
     global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
	//$link = $current_url.'/boat-selector?boat='.$atts['opcion'].'&back='.$current_url;
	$link = home_url().'/'.$atts['opcion'];
?>
<!-------  INICIO ITEM -->
 <div class="mtt-tour-option vc_col-md-4  vc_col-sm-12">

 	<div class="owl-stage" >

        <div class="mkdf-tours-standard-item post-3727 tour-item type-tour-item status-publish has-post-thumbnail hentry tour-category-lunch-lounge tour-category-sightseeing-relaxing tour-category-suggested-for-children">
			<div class="mkdf-tours-standard-item-image-holder">
			<a href="<?php echo $link;?>"  >
				<img src="<?php echo $atts['imagen'] ?>" alt="Tigre horse riding private tour" width="600" height="463">			</a>
							<span class="mkdf-tours-standard-item-label-holder">

		<span class="mkdf-tour-item-label">
			<span class="mkdf-tour-item-label-inner">
							</span>
		</span>

						</span>
					</div>
<div class="mkdf-tours-standard-item-content-holder">
	<div class="mkdf-tours-standard-item-content-inner">
		<div class="mkdf-tours-standard-item-title-price-holder">
			<h4 class="mkdf-tour-title">
			<a href="<?php echo $link;?>"><?php echo $atts['titulo']?></a>

			<span class="mkdf-tours-standard-item-price-holder">
			<span class="mkdf-tours-price-holder"> From<br>
				<span class="mkdf-tours-item-price">USD <?php echo  $atts['precio']?></span>
			</span>
			</span>
			<?php  if( $atts['titulo'] !== '' ): ?>
			<?php  endif; ?>
			</h4>
		</div>

		<div class="mkdf-tours-standard-item-excerpt"><?php echo $atts['info']?></div>
	</div>
	<?php  if( $atts['pie'] !== '' ): ?>
	<div class="mkdf-tours-standard-item-bottom-content">
		<div class="mkdf-tours-standard-item-bottom-item">

			<div class="mkdf-tour-duration-holder">
			    <span class="mkdf-tour-duration-icon mkdf-tour-info-icon">
					<span class="icon_calendar"></span>
			    </span>
				<span class="mkdf-tour-info-label">15 Days</span>
			</div>
		</div>

		<div class="mkdf-tours-standard-item-bottom-item">

			<div class="mkdf-tour-min-age-holder">
			    <span class="mkdf-tour-min-age-icon mkdf-tour-info-icon">
				    <span class="icon_group"></span>
			    </span>

				<span class="mkdf-tour-info-label">14+</span>
			</div>
		</div>
	</div>
	<?php  endif; ?>
	</div>
</div>



        </div>
    </div>
<!-------  FIN ITEM -->

<?php
}


add_shortcode( 'opcion-de-lancha', 'boat_options_item_shortcodes' );
?>
