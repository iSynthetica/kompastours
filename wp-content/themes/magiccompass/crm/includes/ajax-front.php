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

    $form_data_array = array(
        'clientName' => '',
        'clientEmail' => '',
        'clientPhone' => '',
        'clientViber' => '',
        'clientTelegram' => '',
    );

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
    $flight_from = '';
    $flight_from_structured = '';
    $flight_to = '';
    $flight_to_structured = '';

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

            $form_data_array[$name] = $value;
        }
    }

    $validation_errors = array();

    if (empty($form_data_array['clientName'])) {
        $validation_errors['clientName'] = array(
            'message' => __('Input your name, please', 'snthwp')
        );
    }

    if (!empty($form_data_array['clientEmail'])) {
        if (!filter_var($form_data_array['clientEmail'], FILTER_VALIDATE_EMAIL)) {
            $validation_errors['clientEmail'] = array(
                'message' => __('Input correct email, please', 'snthwp')
            );
        }
    }

    if (empty($form_data_array['clientPhone'])) {
        $validation_errors['clientPhone'] = array(
            'message' => __('Input your phone, please', 'snthwp')
        );
    } else {
        $filtered_phone = trim($form_data_array['clientPhone']);
        $filtered_phone = str_replace("-", "", $filtered_phone);
        $filtered_phone = str_replace(" ", "", $filtered_phone);
        $filtered_phone = str_replace(".", "", $filtered_phone);
        $filtered_phone = str_replace("(", "", $filtered_phone);
        $filtered_phone = str_replace(")", "", $filtered_phone);

        $filtered_phone_number = filter_var($filtered_phone, FILTER_SANITIZE_NUMBER_INT);

        if (strlen($filtered_phone_number) < 10 || strlen($filtered_phone_number) > 14) {
            $validation_errors['clientPhone'] = array(
                'message' => __('Input correct phone, please', 'snthwp')
            );
        }
    }

    if (!empty($validation_errors)) {
        $error_message = crm_get_template('admin/messages/booking-validation-error.php', array('errors' => $validation_errors));

        $message = array(
            'reason' => 'validation_error',
            'fragments' => array (
                '.error_messages' => $error_message,
            ),
        );

        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => $message ));

        die;
    }

    $user = CRM_User::getByField('user_phone', $clientPhone);

    if (!$user) {
        $user_data = array(
            'user_display_name' => $form_data_array['clientName'],
            'user_email' => $form_data_array['clientEmail'],
            'user_phone' => $form_data_array['clientPhone'],
            'user_registered' => gmdate( 'Y-m-d H:i:s' ),
        );

        if (!empty($form_data_array['clientViber'])) {
            $user_data['user_viber'] = 1;
        }

        if (!empty($form_data_array['clientTelegram'])) {
            $user_data['user_telegram'] = 1;
        }

        $user_id = CRM_User::insert($user_data);
    } else {
        $user_id = $user->ID;
    }

    unset($form_data_array['clientName']);
    unset($form_data_array['clientEmail']);
    unset($form_data_array['clientPhone']);
    unset($form_data_array['clientViber']);
    unset($form_data_array['clientTelegram']);

    $form_data_array['client_id'] = $user_id;

    $claim_id = CRM_ClaimManager::create_new_booking_request($form_data_array);

    $success_message = crm_get_template('admin/messages/booking-success.php');

    $message = array(
        'fragments' => array(
            '#contact-details__holder' => $success_message,
        ),
    );

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_book_tour', 'ittour_ajax_book_tour');
add_action('wp_ajax_ittour_ajax_book_tour', 'ittour_ajax_book_tour');
