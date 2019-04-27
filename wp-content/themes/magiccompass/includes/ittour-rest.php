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
    register_rest_route( 'ittour/v1', '/params/', array(
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
    register_rest_route( 'ittour/v1', '/params/(?P<country_id>\d+)', array(
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
    $country_id = $request['country_id'];
    $params_obj = ittour_params();

    if ($country_id) {
        $params = $params_obj->getCountry($country_id);
    } else {
        $params = $params_obj->get();
    }


    return $params;
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
    $tour = ittour_tour($request['key']);

    $tour_info = $tour->info();

    return $tour_info;
}

function ittour_check_permission($request) {
    $headers = $request->get_headers();

    return true;
}