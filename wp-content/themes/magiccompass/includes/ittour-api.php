<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */

function ittour_api_init() {
    if (defined('ITTOUR_SLAVE')) {
        include_once ITTOUR_DIR . '/class.ittourMCApi.php';
    } else {
        include_once ITTOUR_DIR . '/class.ittourApi.php';
    }
}

function ittour_params($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourParamsApi.php';

    return new ittourParamsApi($lang);
}

function ittour_search($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourSearchApi.php';

    return new ittourSearchApi($lang);
}

function ittour_tour($key, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourTourApi.php';

    return new ittourTourApi($key, $lang);
}

function ittour_hotel($hotel_id, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourHotelApi.php';

    return new ittourHotelApi($hotel_id, $lang);
}

function ittour_excursion_params($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionParamsApi.php';

    return new ittourExcursionParamsApi($lang);
}

function ittour_excursion_search($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionSearchApi.php';

    return new ittourExcursionSearchApi($lang);
}

function ittour_excursion_tour($key, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionTourApi.php';

    return new ittourExcursionTourApi($key, $lang);
}

add_action('init', 'ittour_rewrite_rule');
/**
 * Add rewrite rule for a pattern matching "post-by-slug/<post_name>"
 */
function ittour_rewrite_rule() {
    add_rewrite_rule('^tour/(.*)/([^/]*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]&child_age=$matches[3]', 'top');
    add_rewrite_rule('^tour/(.*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]', 'top');
    add_rewrite_rule('^tour/(.*)/?', 'index.php?tour=$matches[1]', 'top');
    add_rewrite_tag( '%tour%', '(.*)' );
    add_rewrite_tag( '%from_city%', '(.*)' );
    add_rewrite_tag( '%child_age%', '(.*)' );

    add_rewrite_rule('^excursion-tour/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?excursion-tour=$matches[1]&date_from=$matches[2]&date_till=$matches[3]', 'top');
    add_rewrite_tag( '%excursion-tour%', '(.*)' );
    add_rewrite_tag( '%date_from%', '(.*)' );
    add_rewrite_tag( '%date_till%', '(.*)' );
}

add_action( 'template_redirect', function() {
    $key = get_query_var( 'tour' );

    if ( $key ) {
        $_GET['key'] = $key;

        $from_city = get_query_var( 'from_city' );

        if (!empty($from_city)) {
            $_GET['from_city'] = $from_city;
        }

        $child_age = get_query_var( 'child_age' );

        if (!empty($child_age)) {
            $_GET['child_age'] = $child_age;
        }

        global $ittour_global_tour_result;

        if (empty($_GET['key'])) {
            $ittour_global_tour_result['error'] = 'no_key';
        } else {
            $tour_key = $_GET['key'];
            $tour = ittour_tour($tour_key, ITTOUR_LANG);
            $tour_info = $tour->info();

            if (is_wp_error($tour_info)) {

            } else {
                $ittour_global_tour_result['result'] = $tour_info;
            }
        }

        include SNTH_DIR . '/templates/tour.php';
        die;
    }

    $key = get_query_var( 'excursion-tour' );

    if ( $key ) {
        $date_from = get_query_var( 'date_from' );
        $date_till = get_query_var( 'date_till' );

        $_GET['key'] = $key;
        $_GET['date_from'] = $date_from;
        $_GET['date_till'] = $date_till;

        include SNTH_DIR . '/templates/excursion-tour.php';
        die;
    }
} );