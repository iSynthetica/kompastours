<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */


function ittour_ajax_load_single_tour() {
    if(isset($_POST['key'])) {
        $key = sanitize_key( $_POST['key'] );
    }

    $tour = ittour_tour($key);
    $tour_info = $tour->info();

    ob_start();
    ?>
    <?php ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>
    <?php
    $tour_content = ob_get_clean();

    $message = array(
        'fragments' => array(
            '.single-tour__content' => $tour_content,
        ),
    );

    echo json_encode(array( "status" => 'success', 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_single_tour', 'ittour_ajax_load_single_tour');
add_action('wp_ajax_ittour_ajax_load_single_tour', 'ittour_ajax_load_single_tour');

function ittour_ajax_load_search_form() {
    ob_start();
    ?>
    <?php ittour_show_template('form/search-tab.php'); ?>
    <?php
    $search_form_content = ob_get_clean();

    $message = array(
        'fragments' => array(
            '.search-form__holder' => $search_form_content,
        ),
    );

    echo json_encode(array( "status" => 'success', 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_search_form', 'ittour_ajax_load_search_form');
add_action('wp_ajax_ittour_ajax_load_search_form', 'ittour_ajax_load_search_form');

function ittour_ajax_get_tours_list() {
    $country_id = !empty($_POST['countryId']) ? (int)$_POST['countryId']  : 338;
    $region_id = !empty($_POST['regionId']) ? (int)$_POST['regionId']  : false;
    $search = ittour_search('ru');

    $args = array(
        'from_city' => '2014',
        'hotel_rating' => '4:78',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'date_from' => '25.04.19',
        'date_till' => '30.04.19',
        'items_per_page' => 12,
        'prices_in_group' => 1,
        'currency' => 1,
    );

    if (!empty($region_id)) {
        $args['region'] = $region_id;
    }

    $search_result = $search->get($country_id, $args);

    ob_start();
    ittour_show_template('search/ajax-result.php', array('result' => $search_result));
    $result = ob_get_clean();

    $message = array(
        'fragments' => array(
            '.search-form__holder' => $result,
        ),
    );

    echo json_encode(array( "status" => 'success', 'message' => $result ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_tours_list', 'ittour_ajax_get_tours_list');
add_action('wp_ajax_ittour_ajax_get_tours_list', 'ittour_ajax_get_tours_list');

function ittour_ajax_load_select_child() {
    ob_start();

    ittour_show_template('form/search-select-child-amount.php');

    $html = ob_get_clean();

    echo json_encode(array( "status" => 'success', 'html' => $html ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_select_child', 'ittour_ajax_load_select_child');
add_action('wp_ajax_ittour_ajax_load_select_child', 'ittour_ajax_load_select_child');

function ittour_ajax_get_country_parameters() {

    if(empty($_POST['country_id'])) {
        echo json_encode(array( "status" => 'success', 'message' => 'Select country first' ));
    }

    $country_id = sanitize_key( $_POST['country_id'] );

    $args = array();

    if (!empty($_POST['region'])) {
        $args['region'] = sanitize_key( $_POST['region'] );
    }

    $params_obj = ittour_params();
    $params = $params_obj->getCountry($country_id, $args);

    echo json_encode(array( "status" => 'success', 'message' => $params ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_country_parameters', 'ittour_ajax_get_country_parameters');
add_action('wp_ajax_ittour_ajax_get_country_parameters', 'ittour_ajax_get_country_parameters');

function ittour_ajax_load_hotel_tour_calendar() {
    $month = !empty($_POST['month']) ? $_POST['month'] : false;
    $year = !empty($_POST['year']) ? $_POST['year'] : false;
    $country_id = !empty($_POST['country']) ? $_POST['country'] : false;
    $hotel_id = !empty($_POST['hotelId']) ? $_POST['hotelId'] : false;
    $hotel_rating = !empty($_POST['hotelRating']) ? $_POST['hotelRating'] : false;

    $hotel_calendar = ittour_get_hotel_tours_calendar($country_id, $hotel_id, $hotel_rating, $month, $year);

    $response = array('success' => 1, 'error' => 0, 'message' => array(
        'table_html' => $hotel_calendar['table_html']
    ));

    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_nopriv_ittour_ajax_load_hotel_tour_calendar', 'ittour_ajax_load_hotel_tour_calendar');
add_action('wp_ajax_ittour_ajax_load_hotel_tour_calendar', 'ittour_ajax_load_hotel_tour_calendar');

function ittour_ajax_load_hotel_tours_table() {
    $month = !empty($_POST['month']) ? $_POST['month'] : false;
    $year = !empty($_POST['year']) ? $_POST['year'] : false;
    $country_id = !empty($_POST['country']) ? $_POST['country'] : false;
    $hotel_id = !empty($_POST['hotelId']) ? $_POST['hotelId'] : false;
    $hotel_rating = !empty($_POST['hotelRating']) ? $_POST['hotelRating'] : false;

    $hotel_calendar = ittour_get_hotel_tours_section($country_id, $hotel_id, $hotel_rating);

    $response = array('success' => 1, 'error' => 0, 'message' => array(
        'table_html' => $hotel_calendar['table_html']
    ));

    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_nopriv_ittour_ajax_load_hotel_tours_table', 'ittour_ajax_load_hotel_tours_table');
add_action('wp_ajax_ittour_ajax_load_hotel_tours_table', 'ittour_ajax_load_hotel_tours_table');

/**
 * Add Single Ittour country
 */
function ajax_admin_add_country() {
    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $post_id = !empty($_POST['postId']) ? $_POST['postId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_iso = !empty($_POST['ittourIso']) ? $_POST['ittourIso'] : false;
    $ittour_group = !empty($_POST['ittourGroup']) ? $_POST['ittourGroup'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;
    $ittour_transport = !empty($_POST['ittourTransport']) ? $_POST['ittourTransport'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if ($post_id) {
        $post_created = ittour_update_country($post_id, $ittour_name, $ittour_slug, $ittour_id, $ittour_iso, $ittour_group, $ittour_type, $ittour_transport);
    } else {
        $post_created = ittour_create_country($ittour_name, $ittour_slug, $ittour_id, $ittour_iso, $ittour_group, $ittour_type, $ittour_transport);
    }

    $params_obj = ittour_params();
    $params = $params_obj->getCountry($ittour_id);

    $from_cities_array = get_option('ittour_from_cities');

    if (empty($from_cities_array)) {
        $from_cities_array = array();
    }

    foreach ($params['from_cities'] as $from_city) {
        if (!empty($from_cities_array[$from_city['id']])) {

        } else {
            $from_cities_array[$from_city['id']] = array(
                'name' => $from_city['name'],
                'genitive_case' => $from_city['genitive_case']
            );
        }
    }

    $option_added = update_option( 'ittour_from_cities', $from_cities_array );

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_country', 'ajax_admin_add_country' );

/**
 * Add Single Ittour country
 */
function ajax_admin_add_region() {

    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $parent_id = !empty($_POST['parentId']) ? $_POST['parentId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_country_id = !empty($_POST['ittourCountryId']) ? $_POST['ittourCountryId'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    $post_id = ittour_create_region($ittour_name, $ittour_slug, $ittour_id, $ittour_type, $ittour_country_id, $parent_id);

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_region', 'ajax_admin_add_region' );

/**
 * Add Single Ittour country
 */
function ajax_admin_add_hotel() {
    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $parent_id = !empty($_POST['parentId']) ? $_POST['parentId'] : false;
    $post_id = !empty($_POST['postId']) ? $_POST['postId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_rating = !empty($_POST['ittourRating']) ? $_POST['ittourRating'] : false;
    $ittour_country_id = !empty($_POST['ittourCountryId']) ? $_POST['ittourCountryId'] : false;
    $ittour_region_id = !empty($_POST['ittourRegionId']) ? $_POST['ittourRegionId'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if ($post_id) {
        $post_created = ittour_update_hotel($post_id, $ittour_name, $ittour_slug, $ittour_id, $ittour_rating, $ittour_type, $ittour_country_id, $ittour_region_id, $parent_id);
    } else {
        $post_created = ittour_create_hotel($ittour_name, $ittour_slug, $ittour_id, $ittour_rating, $ittour_type, $ittour_country_id, $ittour_region_id, $parent_id);
    }

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_hotel', 'ajax_admin_add_hotel' );