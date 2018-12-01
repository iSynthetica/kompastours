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