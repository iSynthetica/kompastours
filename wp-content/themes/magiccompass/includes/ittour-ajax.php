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
    $country_id = 338;
    $search = ittour_search('ru');
    $args = array(
        'from_city' => '2014',
        'hotel_rating' => '4:78',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'date_from' => '11.04.19',
        'date_till' => '21.04.19',
        'items_per_page' => 12,
        'prices_in_group' => 1,
    );

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