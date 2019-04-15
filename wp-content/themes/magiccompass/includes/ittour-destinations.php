<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 14.04.19
 * Time: 12:42
 */

function ittour_create_country($name, $slug, $id, $iso, $group, $type, $transport) {
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

function ittour_create_hotel($name, $slug, $id, $type, $country_id, $region_id, $parent_id = 0) {
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
    $update_field = update_field( 'ittour_country_id', $country_id, $post_id );
    $update_field = update_field( 'ittour_region_id', $region_id, $post_id );
    $update_field = update_field( 'ittour_type', $type_array, $post_id );

    return $post_id;
}

function ittour_get_destination_by_ittour_id($destination_type = 'country') {
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