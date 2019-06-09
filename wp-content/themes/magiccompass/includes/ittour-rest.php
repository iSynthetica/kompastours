<?php
/**
 * This file handles the admin area and functions
 *
 * @package Magiccompass/Includes
 * @version 0.0.9
 * @since 0.0.9
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/module/params/', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_params',
        'args'     => array(
            'country_id' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/module/params/(?P<country_id>\d+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_params',
        'args'     => array(
            'country_id' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_rest_params($request) {
    $headers = $request->get_headers();
    $parameters = $request->get_params();
    $country_id = $request['country_id'];
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $params_obj = ittour_params($lang);

    if ($country_id) {
        $params = $params_obj->getCountry($country_id);
    } else {
        $params = $params_obj->get();
    }


    return $params;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/hotel/(?P<hotel_id>\d+)/reviews/', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_hotel_reviews',
        'args'     => array(
            'hotel_id' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_hotel_reviews($request) {
    $headers = $request->get_headers();
    $hotel_id = $request['hotel_id'];
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $hotel_obj = ittour_hotel($hotel_id, $lang);

    if ($hotel_id) {
        $reviews = $hotel_obj->reviews();
    }


    return $reviews;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/tour/info/(?P<key>[a-zA-Z0-9-]+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_tour_info',
        'args'     => array(
            'key' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_rest_tour_info($request) {
    $headers = $request->get_headers();
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $tour = ittour_tour($request['key'], $lang);

    $tour_info = $tour->info();

    return $tour_info;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/tour/validate/(?P<key>[a-zA-Z0-9-]+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_tour_validate',
        'args'     => array(
            'key' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_rest_tour_validate($request) {
    $headers = $request->get_headers();
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $tour = ittour_tour($request['key'], $lang);

    $tour_info = $tour->validate();

    return $tour_info;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/tour/flighs/(?P<key>[a-zA-Z0-9-]+)', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_tour_validate',
        'args'     => array(
            'key' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_rest_tour_flighs($request) {
    $headers = $request->get_headers();
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $tour = ittour_tour($request['key'], $lang);

    $tour_info = $tour->flighs();

    return $tour_info;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/module/search/', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_search',
        'args'     => array(
            'key' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'ittour/v1', '/module/search-list/', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'ittour_rest_search_list',
        'args'     => array(
            'key' => array(
                'required' => false
            ),
        ),
        'permission_callback' => 'ittour_check_permission'
    ) );
} );

function ittour_rest_search($request) {
    $headers = $request->get_headers();
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $parameters = $request->get_params();

    return ittour_get_search_result($parameters, 'search', $lang);
}

function ittour_rest_search_list($request) {
    $headers = $request->get_headers();
    $lang = 'ru';

    if (!empty($headers['accept_language'][0])) {
        $rest_lang = $headers['accept_language'][0];

        if (in_array($rest_lang, array('ru', 'uk', 'en'))) {
            $lang = $rest_lang;
        }
    }

    $parameters = $request->get_params();

    return ittour_get_search_result($parameters, 'search-list', $lang);
}

function ittour_check_permission($request) {
    $headers = $request->get_headers();

    return true;
}

function ittour_get_search_result($parameters, $module = 'search', $lang = 'ru') {
    $search = ittour_search($lang);

    $country            = !empty($parameters['country']) ? (int) sanitize_text_field($parameters['country'])  : false;

    $type               = !empty($parameters['type']) ? (int) sanitize_text_field($parameters['type']) : false;
    $kind               = !empty($parameters['kind']) ? (int) sanitize_text_field($parameters['kind']) : false;
    $from_city          = !empty($parameters['from_city']) ? (int) sanitize_text_field($parameters['from_city']) : false;
    $region             = !empty($parameters['region']) ? sanitize_text_field($parameters['region'])  : false;
    $hotel              = !empty($parameters['hotel']) ? sanitize_text_field($parameters['hotel']) : false;
    $hotel_rating       = !empty($parameters['hotel_rating']) ? sanitize_text_field($parameters['hotel_rating']) : false;
    $adult_amount       = !empty($parameters['adult_amount']) ? (int) sanitize_text_field($parameters['adult_amount']) : false;
    $child_amount       = !empty($parameters['child_amount']) ? (int) sanitize_text_field($parameters['child_amount']) : false;
    $child_age          = !empty($parameters['child_age']) ? sanitize_text_field($parameters['child_age']) : false;
    $night_from         = !empty($parameters['night_from']) ? (int) sanitize_text_field($parameters['night_from']) : false;
    $night_till         = !empty($parameters['night_till']) ? (int) sanitize_text_field($parameters['night_till']) : false;
    $date_from          = !empty($parameters['date_from']) ? sanitize_text_field($parameters['date_from']) : false;
    $date_till          = !empty($parameters['date_till']) ? sanitize_text_field($parameters['date_till']) : false;
    $meal_type          = !empty($parameters['meal_type']) ? sanitize_text_field($parameters['meal_type']) : false;
    $price_from         = !empty($parameters['price_from']) ? (int) sanitize_text_field($parameters['price_from']) : false;
    $price_till         = !empty($parameters['price_till']) ? (int) sanitize_text_field($parameters['price_till']) : false;
    $page               = !empty($parameters['page']) ? (int) sanitize_text_field($parameters['page']) : false;
    $items_per_page     = !empty($parameters['items_per_page']) ? (int) sanitize_text_field($parameters['items_per_page']) : false;
    $prices_in_group    = !empty($parameters['prices_in_group']) ? (int) sanitize_text_field($parameters['prices_in_group']) : false;

    $args = array();

    if ($type)              $args['type']               = $type;
    if ($kind)              $args['kind']               = $kind;
    if ($from_city)         $args['from_city']          = $from_city;
    if ($region)            $args['region']             = $region;
    if ($hotel)             $args['hotel']              = $hotel;
    if ($hotel_rating)      $args['hotel_rating']       = $hotel_rating;
    if ($adult_amount)      $args['adult_amount']       = $adult_amount;
    if ($child_amount)      $args['child_amount']       = $child_amount;
    if ($child_age)         $args['child_age']          = $child_age;
    if ($night_from)        $args['night_from']         = $night_from;
    if ($night_till)        $args['night_till']         = $night_till;
    if ($date_from)         $args['date_from']          = $date_from;
    if ($date_till)         $args['date_till']          = $date_till;
    if ($meal_type)         $args['meal_type']          = $meal_type;
    if ($price_from)        $args['price_from']         = $price_from;
    if ($price_till)        $args['price_till']         = $price_till;
    if ($page)              $args['page']               = $page;
    if ($items_per_page)    $args['items_per_page']     = $items_per_page;
    if ($prices_in_group)   $args['prices_in_group']    = $prices_in_group;

    if ($module === 'search') {
        $search_result = $search->get($country, $args);
    } else {
        $search_result = $search->getList($country, $args);
    }

    return $search_result;
}