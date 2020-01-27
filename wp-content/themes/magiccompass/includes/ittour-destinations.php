<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 14.04.19
 * Time: 12:42
 */

function ittour_create_country($name, $slug, $id, $iso, $group, $type, $transport, $ittour_currency) {
    // Prepare post data
    $post_data = array(
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'      => 'destination',
        'post_name'      => $slug,
        'post_excerpt'  => '',
    );

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'country', 'destination_type');
    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));
    $transport_array = array_map('trim',explode(',', $transport));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_iso', $iso, $post_id );
    $update_field = update_field( 'ittour_country_group', $group, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );
    $update_field = update_field( 'ittour_transport', $transport_array, $post_id );
    $update_field = update_field( 'main_currency', $ittour_currency, $post_id );

    return $post_id;
}

function ittour_update_country($post_id, $name, $slug, $id, $iso, $group, $type, $transport, $ittour_currency) {
    // Prepare post data
    $post_data = array(
        'ID'             => $post_id,
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'      => 'destination',
        'post_name'      => $slug,
        'post_excerpt'  => '',
    );

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'country', 'destination_type');
    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));
    $transport_array = array_map('trim',explode(',', $transport));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_iso', $iso, $post_id );
    $update_field = update_field( 'ittour_country_group', $group, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );
    $update_field = update_field( 'ittour_transport', $transport_array, $post_id );
    $update_field = update_field( 'main_currency', $ittour_currency, $post_id );

    return $post_id;
}

function ittour_get_region($region_id) {
    $region = null;
    $region_en = null;

    $params_obj = ittour_params(ITTOUR_LANG);
    $params = $params_obj->get();
    $regions = $params['regions'];

    $params_obj_en = ittour_params('en');
    $params_en = $params_obj_en->get();
    $regions_en = $params_en['regions'];

    foreach ($regions as $key => $region_data) {
        if ((int)$region_data['id'] === (int) $region_id) {
            $region = $region_data;
            $region_en = $regions_en[$key];

            if ((int)$region_en['id'] !== (int) $region['id']) {
                foreach ($regions_en as $key_en => $region_en_data) {
                    if ((int)$region_en_data['id'] === (int) $region_id) {
                        $region_en = $region_en_data;

                        break;
                    }
                }
            }

            break;
        }
    }

    if (empty($region)) {
        return false;
    }

    $destination_country_id = $region['country_id'];
    $country_info = ittour_destination_by_ittour_id($destination_country_id);

    if (empty($country_info)) {
        return false;
    }

    $parent_post_ID = $country_info['ID'];
    $destination_id = $region['id'];
    $destination_name = $region['name'];
    $destination_type = $region['type_id'];

    if (!empty($region_en)) {
        $destination_slug = snth_get_slug_lat($region_en['name']);
    } else {
        $destination_slug = snth_get_slug_lat($region['name']);
    }

    $post_id = ittour_create_region($destination_name, $destination_slug, $destination_id, $destination_type, $destination_country_id, $parent_post_ID);

    if (empty($post_id)) {
        return false;
    }

    $destination_types = get_the_terms( $post_id, 'destination_type' );
    $destination_info['type'] = $destination_types[0]->slug;
    $destination_info['type_name'] = $destination_types[0]->name;

    return array(
        'ID' => $post_id,
        'title' => $destination_name,
        'slug' => $destination_slug,
        'type' => $destination_types[0]->slug,
        'type_name' => $destination_types[0]->name,
        'ittour_id' => $destination_id,
        'ittour_country_id' => $destination_country_id,
        'ittour_type' => array_map('trim',explode(',', $destination_type)),
    );
}

function ittour_create_region($name, $slug, $id, $type, $country_id, $parent_id = 0) {
    // Prepare post data
    $post_data = array(
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'      => 'destination',
        'post_name'      => $slug,
        'post_excerpt'  => '',
    );

    if (!empty($parent_id)) {
        $post_data['post_parent'] = (int) $parent_id;
    }

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'region', 'destination_type');
    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    return $post_id;
}

function ittour_update_region($post_id, $name, $slug, $id, $type, $country_id, $parent_id = 0) {
    // Prepare post data
    $post_data = array(
        'ID'            => $post_id,
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'destination',
        'post_name'     => $slug,
        'post_excerpt'  => '',
    );

    if (!empty($parent_id)) {
        $post_data['post_parent'] = (int) $parent_id;
    }

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'region', 'destination_type');
    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    return $post_id;
}

function ittour_get_destination_by_ittour_id($id) {
    $args = array(
        'numberposts' => '1',
        'post_type'   => 'destination',
        'meta_query' => array(
            array(
                'key'     => 'ittour_id',
                'value'   => $id,
                'compare' => '='
            )
        )
    );

    $destinations = get_posts($args);

    wp_reset_postdata();

    return $destinations;
}

function ittour_destination_by_ittour_id($id) {
    $args = array(
        'numberposts' => '1',
        'post_type'   => 'destination',
        'meta_query' => array(
            array(
                'key'     => 'ittour_id',
                'value'   => $id,
                'compare' => '='
            )
        )
    );

    $destinations = get_posts($args);

    wp_reset_postdata();

    if (empty($destinations)) {
        return false;
    }

    $destination_info = array(
        'ID' => $destinations[0]->ID,
        'title' => $destinations[0]->post_title,
        'slug' => $destinations[0]->post_name,
    );

    $destination_types = get_the_terms( $destinations[0]->ID, 'destination_type' );

    $destination_info['type'] = $destination_types[0]->slug;
    $destination_info['type_name'] = $destination_types[0]->name;

    $destination_info['ittour_id'] = get_field('ittour_id', $destinations[0]->ID);

    if ('country' === $destination_types[0]->slug) {
        $destination_info['ittour_iso'] = get_field('ittour_iso', $destinations[0]->ID);
        $destination_info['ittour_country_group'] = get_field('ittour_country_group', $destinations[0]->ID);
        $destination_info['ittour_type'] = get_field('ittour_type', $destinations[0]->ID);
        $destination_info['ittour_transport'] = get_field('ittour_transport', $destinations[0]->ID);
        $main_currency = get_field('main_currency', $destinations[0]->ID);
        $destination_info['main_currency'] = !empty($main_currency) ? $main_currency : '10';
    } else if ('region' === $destination_types[0]->slug) {
        $destination_info['ittour_country_id'] = get_field('ittour_country_id', $destinations[0]->ID);
        $destination_info['ittour_type'] = get_field('ittour_type', $destinations[0]->ID);
    } else if ('hotel' === $destination_types[0]->slug) {
        $destination_info['ittour_hotel_rating'] = get_field('ittour_hotel_rating', $destinations[0]->ID);
        $destination_info['ittour_country_id'] = get_field('ittour_country_id', $destinations[0]->ID);
        $destination_info['ittour_region_id'] = get_field('ittour_region_id', $destinations[0]->ID);
        $destination_info['ittour_type'] = get_field('ittour_type', $destinations[0]->ID);
    }

    return $destination_info;
}

function ittour_create_hotel($name, $slug, $id, $rating, $type, $country_id, $region_id, $parent_id = 0, $hotel_info = '') {
    // Prepare post data
    $post_data = array(
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'      => 'destination',
        'post_name'      => $slug,
        'post_excerpt'  => '',
    );

    if (!empty($parent_id)) {
        $post_data['post_parent'] = (int) $parent_id;
    }

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'hotel', 'destination_type');

    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_hotel_rating', $rating, $post_id );
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_region_id', $region_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    if (!empty($hotel_info)) {
        $update_field = update_field( 'ittour_info', $hotel_info, $post_id );
    }

    return $post_id;
}

function ittour_update_hotel($post_id, $name, $slug, $id, $rating, $type, $country_id, $region_id, $parent_id = 0, $hotel_info = '') {
    // Prepare post data
    $post_data = array(
        'ID'             => $post_id,
        'post_title'    => wp_strip_all_tags( $name ),
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'      => 'destination',
        'post_name'      => $slug,
        'post_excerpt'  => '',
    );

    if (!empty($parent_id)) {
        $post_data['post_parent'] = (int) $parent_id;
    }

    $post_id = wp_insert_post( $post_data );

    $term = get_term_by('slug', 'hotel', 'destination_type');
    wp_set_post_terms( $post_id, $term->term_id, 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_hotel_rating', $rating, $post_id );
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_region_id', $region_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    return $post_id;
}

function ittour_get_destinations_list_sort_by_ittour_id($destination_type = 'country', $params = array()) {
    $args = array(
        'numberposts' => '-1',
        'post_type'   => 'destination',
        'tax_query' => array(
            array(
                'taxonomy' => 'destination_type',
                'field'    => 'slug',
                'terms'    => $destination_type
            )
        )
    );

    if (!empty($params)) {
        $args = array_merge($args, $params);
    }

    $destinations = get_posts($args);

    $destinations_by_ittour_id = array();

    foreach ($destinations as $destination) {
        $ittour_id = get_field('ittour_id', $destination->ID);

        if (!empty($ittour_id)) {
            $destinations_by_ittour_id[$ittour_id] = array(
                'ID'  => $destination->ID,
                'name'  => $destination->post_title,
                'modified' => $destination->post_modified
            );
        }
    }

    wp_reset_postdata();

    return $destinations_by_ittour_id;
}

function ittour_is_tour_outdated($date, $format = 'Y-m-d') {
    $date_obj = date_create_from_format($format, $date);
    $date_timestamp = date_format($date_obj, 'U');
    $current_timestamp = time();


    return $date_timestamp < $current_timestamp;
}

function ittour_get_region_prices_by_rating($country) {
    global $wpdb;

    $sql = "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%ittour_prices_by_rating_".$country."_%';";
    $result = $wpdb->get_results( $sql, ARRAY_A );
    $prices = array();

    if (!empty($result)) {
        foreach ($result as $item) {
            $region_id = explode('_', $item['option_name'])[5];
            $price = unserialize($item['option_value']);

            $prices[$region_id] = $price;
        }
    }

    return $prices;
}

function ittour_get_excursion_by_ittour_key($key) {
    $args = array(
        'numberposts' => '1',
        'post_type'   => 'excursion',
        'meta_query' => array(
            array(
                'key'     => 'ittour_key',
                'value'   => $key,
                'compare' => '='
            )
        )
    );

    $destinations = get_posts($args);

    wp_reset_postdata();

    return $destinations;
}

function ittour_create_excursion($name, $slug, $key, $data, $date_from, $date_till, $currency_id) {
    // Prepare post data
    $post_data = array(
        'post_title'    => wp_strip_all_tags( $name ),
        'post_status'   => 'publish',
        'post_type'      => 'excursion',
        'post_name'      => $slug,
    );

    $post_id = wp_insert_post( $post_data );


    $update_field = update_field( 'ittour_key', $key, $post_id );
    $update_field = update_field( 'ittour_currency_id', $currency_id, $post_id );

    if (!empty($date_from) && !empty($date_till)) {
        $update_field = update_field( 'ittour_date_from', $date_from, $post_id );
        $update_field = update_field( 'ittour_date_till', $date_till, $post_id );
    }

    return $post_id;
}

function ittour_update_excursion_dates($post_id, $date_from, $date_till, $currency_id) {
    $update_field = update_field( 'ittour_currency_id', $currency_id, $post_id );

    if (!empty($date_from) && !empty($date_till)) {
        $update_field = update_field( 'ittour_date_from', $date_from, $post_id );
        $update_field = update_field( 'ittour_date_till', $date_till, $post_id );
    }

    return $post_id;
}

function ittour_update_excursion_info($post_id, $info) {
    $update_field = update_field( 'ittour_info', $info, $post_id );

    return $post_id;
}