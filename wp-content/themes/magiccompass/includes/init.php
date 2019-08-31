<?php
/**
 * Init Hook Functions
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function snth_init() {
    if ( snth_is_request( 'frontend' ) && !snth_is_request( 'ajax' )  ) {
        $cookie = ittour_get_session_cookie();



        if ( $cookie ) {

        } else {
            ittour_set_customer_session_cookie( true );
        }
    }
}

add_action( 'init', 'snth_init', 0 );

function snth_wp_logout() {
    $customer_id = ittour_generate_customer_id();
}

add_action( 'wp_logout', 'snth_wp_logout' );