<?php
/**
 * Shortcodes
 *
 * @package Magiccompass/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function snth_footer_first_sidebar_shortcode() {
    ob_start();

    snth_show_template('shortcodes/footer-sidebar-need-help.php');

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_footer_first_sidebar', 'snth_footer_first_sidebar_shortcode' );

