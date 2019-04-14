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