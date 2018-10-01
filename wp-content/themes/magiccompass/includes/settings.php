<?php
/**
 * Theme settings
 *
 * @package  Jointswp/Includes
 */

defined( 'ABSPATH' ) || exit;

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