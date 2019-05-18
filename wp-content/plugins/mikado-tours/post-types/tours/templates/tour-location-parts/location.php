<?php
$location_excerpt              = get_post_meta(get_the_ID(), 'mkdf_tours_location_excerpt', true);
$location_content              = get_post_meta(get_the_ID(), 'mkdf_tours_location_content', true);
$google_map_params             = array(
	'custom_map_style' => 'yes',
	'location_map' => 'yes'
);
$google_map_params['address1'] = get_post_meta(get_the_ID(), 'mkdf_tours_location_address1', true);
$google_map_params['address2'] = get_post_meta(get_the_ID(), 'mkdf_tours_location_address2', true);
$google_map_params['address3'] = get_post_meta(get_the_ID(), 'mkdf_tours_location_address3', true);
$google_map_params['address4'] = get_post_meta(get_the_ID(), 'mkdf_tours_location_address4', true);
$google_map_params['address5'] = get_post_meta(get_the_ID(), 'mkdf_tours_location_address5', true);
?>

<div class="mkdf-location-part">

    <h3 class="mkdf-tour-location">
        <?php esc_html_e('TOUR LOCATION', 'mikado-tours'); ?>
    </h3>

    <p class="mkdf-location-excerpt">
        <?php echo esc_html($location_excerpt) ?>
    </p>

    <div class="mkdf-location-addresses">
        <?php
        if(count($google_map_params)) {
            echo gotravel_mikado_execute_shortcode('mkdf_google_map', $google_map_params);
        }
        ?>
    </div>

    <div class="mkdf-location-content">
        <?php echo do_shortcode($location_content); ?>
    </div>

</div>