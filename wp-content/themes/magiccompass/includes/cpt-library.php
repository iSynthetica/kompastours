<?php
function snth_create_testimonial($data) {
    $post_data = array(
        'post_title'    => 'Testimonial ' . time(),
        'post_content'  => $data['clientMessage'],
        'post_status'   => 'draft',
        'post_type'      => 'testimonial',
    );

    $post_id = wp_insert_post( $post_data );

    $update_field = update_field( 'name', $data['clientName'], $post_id );
    $update_field = update_field( 'email', $data['clientEmail'], $post_id );
    $update_field = update_field( 'phone', $data['clientPhone'], $post_id );
}