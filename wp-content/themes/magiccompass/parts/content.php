<?php
/**
 * Content template file
 *
 * @package Hooka
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            $action = '';

            if(!empty($_GET['action'])) {
                $action = $_GET['action'];
            }

            $params_obj = ittour_params('ru');
            $countries_en = $params_obj->get()['regions'];
            var_dump($countries_en);

            // Initial action
            if ('init' === $action) {
                $params_obj = ittour_params('en');
                $countries_en = $params_obj->get()['countries'];

                foreach ($countries_en as $key => $country) {
                    // Prepare slug
                    $name_array = explode(',', $country['name']);
                    $name_last = count($name_array) - 1;
                    $slug = str_replace(' ', '_', strtolower(trim($name_array[$name_last])));

                    // Prepare post data
                    $post_data = array(
                        'post_title'    => wp_strip_all_tags( $country['name'] ),
                        'post_content'  => '',
                        'post_status'   => 'publish',
                        'post_type'      => 'destination',
                        'post_name'      => $slug,
                        'post_excerpt'  => '',
                    );

                    $post_id = wp_insert_post( $post_data );

                    // Save ittour identifiers
                    update_post_meta( $post_id, 'ittour_id', $country['id'] );
                    update_post_meta( $post_id, 'ittour_iso', $country['iso'] );

                    // Set Country group
                    $country_group = 2;
                    if ( '2' === $country['group_id'] ) {
                        $country_group = 3;
                    } else if( '3' === $country['group_id'] ) {
                        $country_group = 4;
                    }

                    wp_set_post_terms( $post_id, array($country_group), 'country_group', false );
                }
            }

            if ('translate' === $action) {
                ?>
                <p>Start translation</p>
                <?php
                $params_obj = ittour_params('ru');
                $countries_ru = $params_obj->get()['countries'];

                foreach ($countries_ru as $key => $country) {
                    global $wpdb;
                    $results = $wpdb->get_results( "select post_id from $wpdb->postmeta where meta_value = '" . $country['id'] . "' and meta_key = 'ittour_id'", ARRAY_A );
                    $post_id = $results[0]['post_id'];

                    // Prepare post data
                    $post_data = array(
                        'ID'             => $post_id,
                        'post_title'    => wp_strip_all_tags( $country['name'] ),
                        'post_content'  => '',
                    );

                    $post_id = wp_update_post( $post_data );

                    var_dump($post_id);
                }
                ?>
                <p>End translation</p>
                <?php
            }





            // var_dump(count($countries_en));


            if (false) {
                foreach ($countries_en as $key => $country) {

                    global $wpdb;
                    $results = $wpdb->get_results( "select post_id from $wpdb->postmeta where meta_value = '" . $country['iso'] . "' and meta_key = 'ittour_iso'", ARRAY_A );

                    //var_dump($results[0]['post_id']);

                    $post_id = $results[0]['post_id'];

                    // $post_id = wp_insert_post( $post_data );

//                $country_group = 2;
//
//                if ( '2' === $country['group_id'] ) {
//                    $country_group = 3;
//                } else if( '3' === $country['group_id'] ) {
//                    $country_group = 4;
//                }

//                wp_set_post_terms( $post_id, array($country_group), 'country_group', false );
//
//                update_post_meta( $post_id, 'ittour_id', $country['id'] );
//                update_post_meta( $post_id, 'ittour_iso', $country['iso'] );

//                var_dump(trim($post_id));
//                var_dump(trim($slug));
//
//                var_dump($country);
                }
            }
            ?>
        </main>
    </div>
</div>
content
