<?php
/**
 * Helpers library
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function ittour_create_session_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'ittour_sessions';

    $sql = $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table_name);

    $result = $wpdb->query($sql);

    if(0 < $result) {
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $collate = '';

    if ( $wpdb->has_cap( 'collation' ) ) {
        $collate = $wpdb->get_charset_collate();
    }

    $sql = "
CREATE TABLE {$wpdb->prefix}ittour_sessions (
  session_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  session_key char(32) NOT NULL,
  session_value longtext NOT NULL,
  session_expiry BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY  (session_id),
  UNIQUE KEY session_key (session_key)
) $collate;        
    ";

    dbDelta( $sql );
}

add_filter( 'wp_nav_menu_items', 'add_logout_link', 10, 2);

/**
 * Add a login link to the members navigation
 */
function add_logout_link( $items, $args )
{
    $items .= '<li><button href="#find-me-tour-popup" class="modal-popup btn size-xs bg-success-color font-weight-900 font-alt text-uppercase shape-rnd">'.__('Find me a tour', 'snthwp').'</button></li>';

    return $items;
}