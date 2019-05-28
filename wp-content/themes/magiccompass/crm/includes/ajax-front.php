<?php
/**
 * CRM Templates Functions.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM/Includes
 * @version 0.0.1
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function ittour_ajax_book_tour() {
    $message = array('Success');
    $key = '';
    $id = '';
    $tour_id = '';
    $spo = '';
    $country_id = '';
    $region_id = '';
    $hotel_id = '';
    $meal_type = '';
    $duration = '';
    $date_from = '';
    $adult_amount = '';
    $price_usd = '';
    $price_uah = '';
    $price_euro = '';
    $destination = '';
    $hotel = '';

    $clientName = '';
    $clientEmail = '';
    $clientPhone = '';
    $clientViber = '';
    $clientTelegram = '';

    if (!empty($_POST['formData'])) {
        foreach ($_POST['formData'] as $form_data) {
            $name = $form_data['name'];
            $value = $form_data['value'];

            extract(array($name => $value));
        }
    }

    if (empty($clientName)) {
        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => __('Input your name, please', 'snthwp') ));
        die;
    }

    if (empty($clientPhone)) {
        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => __('Input your phone, please', 'snthwp') ));
        die;
    }

    $user = CRM_User::getByField('user_phone', $clientPhone);

    if (!$user) {
        $user_data = array(
            'user_display_name' => $clientName,
            'user_email' => $clientEmail,
            'user_phone' => $clientPhone,
            'user_registered' => gmdate( 'Y-m-d H:i:s' ),
        );

        if (!empty($clientViber)) {
            $user_data['user_viber'] = 1;
        }

        if (!empty($clientTelegram)) {
            $user_data['user_telegram'] = 1;
        }

        $user_id = CRM_User::insert($user_data);
    }

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_book_tour', 'ittour_ajax_book_tour');
add_action('wp_ajax_ittour_ajax_book_tour', 'ittour_ajax_book_tour');
