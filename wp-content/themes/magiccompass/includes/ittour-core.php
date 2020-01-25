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
    $items .= '<li><button href="#find-me-tour-popup" class="modal-popup btn size-xs bg-primary-color font-weight-900 font-alt text-uppercase shape-rnd">'.__('Find me a tour', 'snthwp').'</button></li>';

    return $items;
}

function get_search_page_id($type = 'tour') {
    $allowed_types = array('tour', 'excursion');

    if (in_array($type, $allowed_types)) {
        if ('tour' === $type) {
            $id = get_field('tour_search_page', 'options');
        } else {
            $id = get_field('excursion_search_page', 'options');
        }

        return $id;
    }

    return false;
}

function get_ittour_error($error) {
    $errors = array(
        'no_country' => __('Country field is required', 'snthwp'),
        'no_excursion_tours' => __('Sorry, no tours found for your parameters.', 'snthwp'),
        'Field date_from must be more or equal to the current date.' => __('Field date_from must be more or equal to the current date.', 'snthwp'),
    );

    if (!empty($errors[$error])) {
        return $errors[$error];
    }

    return $error;
}

function get_excursion_allowed_parameters() {
    return array(
        'country' => array(
            'title' => __('Countries', 'snthwp'),
            'required' => true,
            'description' => "ID's стран",
        ),
        'transport_type' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "ID's типов транспорта",
        ),
        'from_city' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "ID's городов вылета",
        ),
        'city' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "ID's городов на маршруте",
        ),
        'date' => array(
            'title' => __('Tour date', 'snthwp'),
            'required' => false,
            'description' => "Дата отправления от (формат d.m.y)",
            'options' => array(
                'date_from' => array(
                    'title' => __('Transport', 'snthwp'),
                    'required' => false,
                    'description' => "Дата отправления от (формат d.m.y)",
                ),
                'date_till' => array(
                    'title' => __('Transport', 'snthwp'),
                    'required' => false,
                    'description' => "Дата отправления до (формат d.m.y, не больше 30-ти дней от date_from)",
                ),
            ),
        ),
        'show_selected_countries' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Маршруты по выбранным странам (0 - нет)",
        ),
        'show_selected_cities' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "	Маршруты по выбранным городам (0 - нет)",
        ),
        'night_moves' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Ночный переездов. По умолчанию: 0 (Любой)",
        ),
        'page' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Номер страницы. По умолчанию: 1",
        ),
        'items_per_page' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Количество туров на странице (от 1 до 100). По умолчанию: 10",
        ),
        'country_image_count' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Количество изображений отеля (от 0 до 20). По умолчанию: 1",
        ),
        'accomodation' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "ID типа размещения (от 1 до 8)",
        ),
        'adult' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Количество взрослых, чел. По умолчанию: 1",
        ),
        'child' => array(
            'title' => __('Transport', 'snthwp'),
            'required' => false,
            'description' => "Количество детей, чел (от 0 до 1). По умолчанию: 0",
        ),
    );
}