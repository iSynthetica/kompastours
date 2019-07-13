<?php
/**
 * Helpers library
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function ittour_init_session_cookie() {

}

function ittour_has_session() {
    return isset( $_COOKIE[ ITTOUR_SESSION ] );
}

function ittour_get_session_cookie() {
    $cookie_value = isset( $_COOKIE[ ITTOUR_SESSION ] ) ? wp_unslash( $_COOKIE[ ITTOUR_SESSION ] ) : false;

    if ( empty( $cookie_value ) || ! is_string( $cookie_value ) ) {
        return false;
    }

    list( $customer_id, $session_expiration, $session_expiring, $cookie_hash ) = explode( '||', $cookie_value );

    if ( empty( $customer_id ) ) {
        return false;
    }

    // Validate hash.
    $to_hash = $customer_id . '|' . $session_expiration;
    $hash    = hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );

    if ( empty( $cookie_hash ) || ! hash_equals( $hash, $cookie_hash ) ) {
        return false;
    }

    return array( $customer_id, $session_expiration, $session_expiring, $cookie_hash );
}

/**
 * Sets the session cookie on-demand (usually after adding an item to the cart).
 *
 * Since the cookie name (as of 2.1) is prepended with wp, cache systems like batcache will not cache pages when set.
 *
 * Warning: Cookies will only be set if this is called before the headers are sent.
 *
 * @param bool $set Should the session cookie be set.
 */
function ittour_set_customer_session_cookie( $set ) {
    if ( $set ) {
        $customer_id = ittour_generate_customer_id();
        $session_expiration = ittour_get_session_expiration();
        $to_hash           = $customer_id . '|' . $session_expiration['session_expiration'];
        $cookie_hash       = hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );
        $cookie_value      = $customer_id . '||' . $session_expiration['session_expiration'] . '||' . $session_expiration['session_expiring'] . '||' . $cookie_hash;

        if ( ! isset( $_COOKIE[ ITTOUR_SESSION ] ) || $_COOKIE[ ITTOUR_SESSION ] !== $cookie_value ) {
            snth_setcookie( ITTOUR_SESSION, $cookie_value, $session_expiration['session_expiration'], snth_use_secure_cookie(), true );
        }
    }
}

/**
 * Generate a unique customer ID for guests, or return user ID if logged in.
 *
 * Uses Portable PHP password hashing framework to generate a unique cryptographically strong ID.
 *
 * @return string
 */
function ittour_generate_customer_id() {
    $customer_id = '';

    if ( is_user_logged_in() ) {
        $customer_id = get_current_user_id();
    }

    if ( empty( $customer_id ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $hasher      = new PasswordHash( 8, false );
        $customer_id = md5( $hasher->get_random_bytes( 32 ) );
    }

    return $customer_id;
}

function ittour_get_session_expiration() {
    return array(
        'session_expiring' => time() + intval( 60 * 5 ),
        'session_expiration' => time() + intval( 60 * 6 ),
    );
}

function ittour_delete_session( $customer_id ) {
    global $wpdb;

    $wpdb->delete(
        $wpdb->prefix . 'ittour_sessions',
        array(
            'session_key' => $customer_id,
        )
    );
}

function forget_session() {
    snth_setcookie( ITTOUR_SESSION, '', time() - YEAR_IN_SECONDS, snth_use_secure_cookie(), true );
}