<?php
/**
 * Theme settings
 *
 * @package  Jointswp/Includes
 */

defined( 'ABSPATH' ) || exit;

add_filter('show_admin_bar', '__return_false');

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