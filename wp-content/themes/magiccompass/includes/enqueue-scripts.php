<?php
/**
 * Enqueue scripts and styles
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function snth_enqueue_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    $query_args = array(
        'family' => 'Open+Sans:300,400,400i,700,700i|Oswald:300,400,700',
        'subset' => 'cyrillic'
    );
    wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    wp_enqueue_style('google_fonts');

    if ( defined( 'WP_PROD_ENV' ) && WP_PROD_ENV ) {
        $site_css = 'style.min.css';
        $site_js = 'scripts.min.js';
    } else {
        $site_css = 'style.css';
        $site_js = 'scripts.js';
    }

    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', SNTH_SCRIPTS_URL.'/'.$site_js, array( 'jquery' ), SNTH_VERSION, true );

    // Register main stylesheet
    wp_enqueue_style( 'site-css', SNTH_STYLES_URL.'/'.$site_css, array(), SNTH_VERSION, 'all' );

    // Google Map
    $api_key = apply_filters( 'snth_gmap_api_key', '' );
    wp_register_script('gmap', 'https://maps.googleapis.com/maps/api/js?key=' . $api_key);
    wp_register_script('gmap3', SNTH_VENDORS_URL . '/gmap/gmap3.min.js', array( 'gmap' ), SNTH_VERSION, true);
    wp_register_script('infobox', SNTH_VENDORS_URL . '/gmap/InfoBox/infobox.js', array( 'gmap' ), '', true );
    // wp_register_script('markerclusterer', SNTH_VENDORS_URL . '/gmap/js-marker-clusterer/markerclusterer.js', array( 'gmap' ), '', true );

    wp_register_script('gmapTheme', SNTH_SCRIPTS_URL . '/gmap.js', array( 'gmap3' ), SNTH_VERSION, true);
    wp_register_script('gmapLocations', SNTH_SCRIPTS_URL . '/gmapLocations.js', array( 'gmap3', 'infobox' ), SNTH_VERSION, true);

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    wp_localize_script( 'site-js', 'snthWpJsObj', array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'searchForm'       => array(
            'nights' => __('nights', 'snthwp')
        ),
        'nonce'         => wp_create_nonce( 'snth_nonce' ),
    ) );
}
add_action('wp_enqueue_scripts', 'snth_enqueue_scripts', 999);

function snth_inline_styles() {
    ob_start();
    ?>
    <style>
        body {
            background-color: #0a0a0a;
        }
    </style>
    <?php
    wp_add_inline_style( 'site-css', snth_clean_inline_css(ob_get_clean()) );
}

function snth_inline_scripts() {
    ob_start();
    ?>
    <script>
        console.log('Loaded');
    </script>
    <?php

    wp_add_inline_script( 'site-js', snth_clean_inline_js(ob_get_clean()) );
}

function snth_clean_inline_css( $custom_css )
{
    $custom_css = str_replace("<style>", "", $custom_css);
    $custom_css = str_replace("</style>", "", $custom_css);
    return $custom_css;
}

function snth_clean_inline_js( $custom_js )
{
    $custom_js = str_replace("<script>", "", $custom_js);
    $custom_js = str_replace("</script>", "", $custom_js);
    return $custom_js;
}