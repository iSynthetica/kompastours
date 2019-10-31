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

function snth_ittour_tours_grid($attr = array()) {
    $atts = shortcode_atts(
        array(
            'country' => 338,
            'type' => 1,
            'kind' => '',
            'from_city' => 2014,
            'region' => '',
            'hotel' => '',
            'hotel_rating' => '78', //
            'adult_amount' => '',
            'child_amount' => '',
            'child_age' => '',
            'night_from' => '',
            'night_till' => '',
            'date_from' => '',
            'date_till' => '',
            'meal_type' => '560:512:498:496:388:1956',
            'price_from' => '',
            'price_till' => '',
            'items_per_page' => 12,
        ),
        $attr
    );

    return ittour_get_template( 'general/tours-list-ajax.php', $atts );
}
add_shortcode( 'ittour_tours_grid', 'snth_ittour_tours_grid' );

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

