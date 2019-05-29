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

    wp_set_post_terms( $post_id, 'country', 'destination_type', false );

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

    wp_set_post_terms( $post_id, 'country', 'destination_type', false );

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

    wp_set_post_terms( $post_id, 'region', 'destination_type', false );

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

    wp_set_post_terms( $post_id, 'region', 'destination_type', false );

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

function ittour_create_hotel($name, $slug, $id, $rating, $type, $country_id, $region_id, $parent_id = 0) {
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

    wp_set_post_terms( $post_id, 'hotel', 'destination_type', false );

    $type_array = array_map('trim',explode(',', $type));

    $update_field = update_field( 'ittour_id', $id, $post_id );
    $update_field = update_field( 'ittour_hotel_rating', $rating, $post_id );
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_region_id', $region_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    return $post_id;
}

function ittour_update_hotel($post_id, $name, $slug, $id, $rating, $type, $country_id, $region_id, $parent_id = 0) {
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

    wp_set_post_terms( $post_id, 'hotel', 'destination_type', false );

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