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



function snth_tour_request_by_country_shortcode() {
    ob_start();

    snth_show_template('landings/section-order-form.php', array(
        'country' => 318,
        'title' => get_the_title()
    ));

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_tour_request_by_country', 'snth_tour_request_by_country_shortcode' );

function snth_find_me_a_tour_shortcode() {
    $form_fields = ittour_get_form_fields(array());

    ob_start();

    ittour_show_template('general/form-find-me-tour-static.php', array('form_fields' => $form_fields));

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_find_me_a_tour', 'snth_find_me_a_tour_shortcode' );

