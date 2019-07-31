<?php

if(!function_exists('gotravel_mikado_register_widgets')) {

    function gotravel_mikado_register_widgets() {

        $widgets = array(
            'GoTravelMikadoLatestPosts',
            'GoTravelMikadoSearchOpener',
            'GoTravelMikadoSideAreaOpener',
            'GoTravelMikadoSocialIconWidget',
            'GoTravelMikadoSeparatorWidget',
            'GoTravelMikadoCallToActionButton',
            'GoTravelMikadoWeatherWidget'
        );

        if(gotravel_mikado_tours_plugin_installed()) {
            $widgets[] = 'GoTravelMikadoTourItems';
            $widgets[] = 'GoTravelMikadoDestinationTours';
        }

        foreach($widgets as $widget) {
            register_widget($widget);
        }
    }
}

add_action('widgets_init', 'gotravel_mikado_register_widgets');