<?php
/**
 * Theme settings
 *
 * @package  Jointswp/Includes
 */

defined( 'ABSPATH' ) || exit;

add_filter('show_admin_bar', '__return_false');

function snth_settings_gmap_api_key( $key ) {
    return 'AIzaSyDBeGNjLt_srVFXjDjduGyHtGu-fzn_Pt4';
}
add_filter( 'snth_gmap_api_key', 'snth_settings_gmap_api_key', 999 );

/**
 *
 * @param $logos
 *
 * @return array
 */
function snth_settings_theme_logos ( $logos ) {
    return array(
        'alt_logo' => array(
            'label' => __('Alternative Logo', 'jointswp'),
            'description' => __('Alternative Logo for using f.e. on other BG color', 'jointswp'),
        ),
        'footer_logo' => array(
            'label' => __('Footer Logo', 'jointswp'),
            'description' => __('Footer Logo', 'jointswp'),
        ),
    );
}
add_filter( 'snth_custom_logos', 'snth_settings_theme_logos', 999 );

function snth_settings_media_image_sizes ( $sizes ) {
    return array(
        'archive_photo_thumb' => array (
            'w'     =>  950,
            'h'     =>  375,
            'c'  =>  true,
            'label' =>  __('Archive Photo Template', 'snthwp')
        ),
        'blog_thumb' => array (
            'w'     =>  900,
            'h'     =>  650,
            'c'  =>  true,
            'label' =>  __('Archive Blog Thumb', 'snthwp')
        ),
        'share_thumb' => array (
            'w'     =>  900,
            'h'     =>  474,
            'c'  =>  true,
            'label' =>  __('Picture for sharing', 'snthwp')
        ),
        'long_small_thumb' => array (
            'w'     =>  510,
            'h'     =>  200,
            'c'  =>  true,
            'label' =>  __('Picture for long preview', 'snthwp')
        ),
        'logo_thumb' => array (
            'w'     =>  220,
            'h'     =>  128,
            'c'  =>  true,
            'label' =>  __('Logo thumbnails', 'snthwp')
        ),
    );
}
add_filter( 'snth_image_sizes', 'snth_settings_media_image_sizes', 999 );

function snth_settings_sidebars($sidebars) {
    return array(
        array(
            'id' => 'footer1',
            'name' => __('Footer 1', 'snthwp'),
            'description' => __('The first footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ),
        array(
            'id' => 'footer2',
            'name' => __('Footer 2', 'snthwp'),
            'description' => __('The second footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ),
        array(
            'id' => 'footer3',
            'name' => __('Footer 3', 'snthwp'),
            'description' => __('The third footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ),
        array(
            'id' => 'footer4',
            'name' => __('Footer 4', 'snthwp'),
            'description' => __('The fourth footer sidebar.', 'snthwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>',
        ),
        array(
            'id' => 'blog-sidebar',
            'name' => __('Blog Sidebar', 'snthwp'),
            'description' => __('Blog sidebar.', 'snthwp'),
            'before_widget' => '<hr><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        )
    );
}
add_filter( 'snth_sidebars', 'snth_settings_sidebars', 999 );