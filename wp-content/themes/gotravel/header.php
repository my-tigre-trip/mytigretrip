<?php
session_start();
if( (!isset($_SESSION['myTrip']) && is_page('my-trip')) || (!isset($_SESSION['myTrip']) && is_page('my-trip-contact-information')) ){
  wp_redirect(home_url());
}elseif(isset($_SESSION['myTrip']) && is_page('my-trip')) {
  $myTrip = unserialize($_SESSION['myTrip']);
  $validation = $myTrip->validateCalculator();
  if(!$validation['valid']){
    wp_redirect(home_url());
  }
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see gotravel_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    do_action('gotravel_mikado_header_meta');
    do_action('mttAddOpenGraph');

	wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109851945-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109851945-1');
    </script>
</head>
<body <?php body_class();?>>
    <?php gotravel_mikado_get_side_area(); ?>

    <?php if(gotravel_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") { ?>
        <div class="mkdf-smooth-transition-loader mkdf-mimic-ajax">
            <div class="mkdf-st-loader">
                <div class="mkdf-st-loader1">
                    <?php echo gotravel_mikado_loading_spinners(); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="mkdf-wrapper">
        <div class="mkdf-wrapper-inner">
            <?php gotravel_mikado_get_header(); ?>

            <?php if (gotravel_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
                <a id='mkdf-back-to-top'  href='#'>
                    <span class="mkdf-icon-stack">
                         <?php echo gotravel_mikado_icon_collections()->renderIcon('lnr-chevron-up', 'linear_icons'); ?>
                    </span>
                    <span class="mkdf-back-to-top-inner">
                        <span class="mkdf-back-to-top-text"><?php esc_html_e('Top', 'gotravel'); ?></span>
                    </span>
                </a>
            <?php } ?>
            <div class="mkdf-content" <?php gotravel_mikado_content_elem_style_attr(); ?>>
                <div class="mkdf-content-inner">
