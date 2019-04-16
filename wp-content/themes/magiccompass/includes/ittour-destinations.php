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

function ittour_get_hotel_tours_calendar($country_id, $hotel_id, $hotel_rating, $month, $year, $args = array()) {
    $search = ittour_search('ru');

    if (is_wp_error($search)) {
        return false;
    }

    $current_month = date("n");
    $current_year = date("Y");

    $is_current_month = ($current_month === $month && $current_year === $year);

    $args = wp_parse_args( $args, array(
        'from_city' => '2014',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'items_per_page' => 1,
        'prices_in_group' => 1,
        'currency' => 1,
    ) );

    $args['hotel'] = $hotel_id;
    $args['hotel_rating'] = $hotel_rating;

    $date = mktime(12, 0, 0, $month, 1, $year);
    $daysInMonth = date("t", $date);
    $offset = (date("w", $date)-1)%7;
    $searchMonth = date('m', $date);
    $searchYear = date('y', $date);
    $rows = 1;

    ob_start();
    ?>
    <table class="table hotel-calendar_table">
        <tr>
            <th><?php _e('Monday', 'snthwp'); ?></th>
            <th><?php _e('Tuesday', 'snthwp'); ?></th>
            <th><?php _e('Wednesday', 'snthwp'); ?></th>
            <th><?php _e('Thursday', 'snthwp'); ?></th>
            <th><?php _e('Friday', 'snthwp'); ?></th>
            <th><?php _e('Saturday', 'snthwp'); ?></th>
            <th><?php _e('Sunday', 'snthwp'); ?></th>
        </tr>
        <?php
        echo "\t";
        echo "\n\t<tr>";

        for($i = 1; $i <= $offset; $i++)  {
            echo "<td></td>";
        }

        for($day = 1; $day <= $daysInMonth; $day++)
        {
            if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
                echo "</tr>\n\t<tr>";
                $rows++;
            }

            if ($day == date("j") && $is_current_month) {
                echo "<td class='current-item'>" . $day . "<br>" . __('Today', 'snthwp') . "</td>";
            } elseif ($day > date("j") || !$is_current_month) {
                $args['date_from'] = $day . '.'.$searchMonth.'.' . $searchYear;
                $args['date_till'] = $day . '.'.$searchMonth.'.' . $searchYear;

                $search_result = $search->get($country_id, $args);

                $offer_html = '';

                if (!empty($search_result['hotels'][0])) {
                    $offers = $search_result['hotels'][0]['offers'];
                    $first_offer = $offers[0];

                    $offer_html = '<br>' . __('from', 'snthwp') . ' <a href="/tour-result/?key='.$first_offer['key'].'">' . $first_offer['prices'][2] . '</a>';
                }

                echo "<td>" . $day . $offer_html . "</td>";
            } else {
                echo "<td class='outdated-item'>" . $day . "</td>";
            }
        }

        while( ($day + $offset) <= $rows * 7) {
            echo "<td></td>";
            $day++;
        }

        echo "</tr>\n";
        ?>
    </table>
    <?php
    $table_html = ob_get_clean();

    return array(
        'table_html' => $table_html
    );
}