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
    $form_data_array = array(
        'clientName' => '',
        'clientEmail' => '',
        'clientPhone' => '',
        'clientViber' => '',
        'clientTelegram' => '',
    );

    if (!empty($_POST['formData'])) {
        foreach ($_POST['formData'] as $form_data) {
            $name = $form_data['name'];
            $value = $form_data['value'];
            $form_data_array[$name] = $value;
        }
    }

    unset($form_data);
    unset($name);
    unset($value);

    $validation_errors = array();

    if (empty($form_data_array['clientName'])) {
        $validation_errors['clientName'] = array(
            'message' => __('Input your name, please', 'snthwp')
        );
    } else {
        $form_data_array['clientName'] = filter_var($form_data_array['clientName'], FILTER_SANITIZE_STRING);
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
        } else {
            $form_data_array['clientPhone'] = $filtered_phone;
        }
    }

    unset($filtered_phone);
    unset($filtered_phone_number);

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

    unset($validation_errors);

    $user = CRM_User::getByField('user_phone', $form_data_array['clientPhone']);

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
    $form_data_array['claim_type'] = 'tour';
    $form_data_array['claim_step'] = 'tour_booking_request';
    $form_data_array['claim_meta_group'] = 'tour_booking_parameters';

    $claim_id = CRM_ClaimManager::create_new_booking_request($form_data_array);
    $fake_claim_id = $claim_id + CRM_Claim::$initial_claim_number;

    $success_message = crm_get_template('admin/messages/booking-success.php', array('claim_id' => $fake_claim_id));

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

function ittour_ajax_get_lp_proposal() {
    $form_data_array = array(
        'clientName' => '',
        'clientEmail' => '',
        'clientPhone' => '',
        'clientViber' => '',
        'clientTelegram' => '',
    );

    if (!empty($_POST['formData'])) {
        foreach ($_POST['formData'] as $form_data) {
            $name = $form_data['name'];
            $value = $form_data['value'];

            $form_data_array[$name] = $value;
        }
    }

    unset($form_data);
    unset($name);
    unset($value);

    $validation_errors = array();

    // Validating Client Name
    if (empty($form_data_array['clientName'])) {
        $validation_errors['clientName'] = array(
            'message' => __('Input your name, please', 'snthwp')
        );
    } else {
        $form_data_array['clientName'] = filter_var($form_data_array['clientName'], FILTER_SANITIZE_STRING);
    }

    // Validating client phone
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
        } else {
            $form_data_array["clientPhone"] = $filtered_phone_number;
        }

        unset($filtered_phone);
        unset($filtered_phone_number);
    }

    // Validating client Email
    if (empty($form_data_array['date_from'])) {
        $validation_errors['date_from'] = array(
            'message' => __('Select tour date, please', 'snthwp')
        );
    }

    // Validating client Email
    if (!empty($form_data_array['clientEmail'])) {
        if (!filter_var($form_data_array['clientEmail'], FILTER_VALIDATE_EMAIL)) {
            $validation_errors['clientEmail'] = array(
                'message' => __('Input correct email, please', 'snthwp')
            );
        }
    }

    // Validating Adult Amount
    if (!empty($form_data_array['adult_amount'])) {
        $filtered_adultAmount = str_replace("-", "", $form_data_array['adult_amount']);
        $filtered_adultAmount = str_replace("+", "", $filtered_adultAmount);

        if (!filter_var((int) $filtered_adultAmount, FILTER_VALIDATE_INT)) {
            $validation_errors['adult_amount'] = array(
                'message' => __('Input number as Adult amount, please', 'snthwp')
            );
        } else {
            $form_data_array['adult_amount'] = $filtered_adultAmount;
        }

        unset($filtered_adultAmount);
    }

    // Validating Children Amount
    if (!empty($form_data_array['child_amount'])) {
        $filtered_childrenAmount = str_replace("-", "", $form_data_array['child_amount']);
        $filtered_childrenAmount = str_replace("+", "", $filtered_childrenAmount);

        if (!filter_var((int) $filtered_childrenAmount, FILTER_VALIDATE_INT)) {
            $validation_errors['child_amount'] = array(
                'message' => __('Input number as Children amount, please', 'snthwp')
            );
        } else {
            $form_data_array['child_amount'] = $filtered_childrenAmount;
        }

        unset($filtered_childrenAmount);
    }

    // Validating Price from
    if (!empty($form_data_array['price_from'])) {
        $filtered_priceFrom = str_replace("-", "", $form_data_array['price_from']);
        $filtered_priceFrom = str_replace("+", "", $filtered_priceFrom);

        if (!filter_var($filtered_priceFrom, FILTER_VALIDATE_INT)) {
            $validation_errors['price_from'] = array(
                'message' => __('Input number as Price from, please', 'snthwp')
            );
        } else {
            $form_data_array['price_from'] = $filtered_priceFrom;
        }

        unset($filtered_priceFrom);
    }

    // Validating Price till
    if (!empty($form_data_array['price_till'])) {
        $filtered_priceTill = str_replace("-", "", $form_data_array['price_till']);
        $filtered_priceTill = str_replace("+", "", $filtered_priceTill);

        if (!filter_var($filtered_priceTill, FILTER_VALIDATE_INT)) {
            $validation_errors['price_till'] = array(
                'message' => __('Input number as Price till, please', 'snthwp')
            );
        } else {
            $form_data_array['price_till'] = $filtered_priceTill;
        }

        unset($filtered_priceTill);
    }

    if (!empty($validation_errors)) {
        $error_message = crm_get_template('messages/request-validation-error.php', array('errors' => $validation_errors));

        $message = array(
            'reason' => 'validation_error',
            'fragments' => array (
                '.messages__holder' => $error_message,
            ),
        );

        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => $message ));

        die;
    }

    $user = CRM_User::getByField('user_phone', $form_data_array["clientPhone"]);

    if (!$user) {
        $user_data = array(
            'user_display_name' => $form_data_array['clientName'],
            'user_email' => $form_data_array['clientEmail'],
            'user_phone' => $form_data_array['clientPhone'],
            'user_registered' => gmdate( 'Y-m-d H:i:s' ),
        );

        if (!empty($form_data_array['clientViber']) && 'viber' === $form_data_array['clientViber']) {
            $user_data['user_viber'] = 1;
        }

        if (!empty($form_data_array['clientTelegram']) && 'telegram' === $form_data_array['clientTelegram']) {
            $user_data['user_telegram'] = 1;
        }

        $user_id = CRM_User::insert($user_data);
    } else {
        $user_id = $user->ID;
    }

    $form_data_array['client_id'] = $user_id;
    $form_data_array['type'] = 'tour_search_request';

    unset($form_data_array['clientName']);
    unset($form_data_array['clientEmail']);
    unset($form_data_array['clientPhone']);
    unset($form_data_array['clientViber']);
    unset($form_data_array['clientTelegram']);

    $claim_id = CRM_ClaimManager::create_new_booking_request($form_data_array);
    $fake_claim_id = $claim_id + CRM_Claim::$initial_claim_number;

    $success_message = crm_get_template('messages/request-success.php', array('claim_id' => $fake_claim_id));

    $message = array(
        'fragments' => array(
            '.messages__holder' => $success_message,
        ),
    );

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_lp_proposal', 'ittour_ajax_get_lp_proposal');
add_action('wp_ajax_ittour_ajax_get_lp_proposal', 'ittour_ajax_get_lp_proposal');

function ittour_ajax_find_me_tour() {
    $form_data_array = array(
        'clientName' => '',
        'clientEmail' => '',
        'clientPhone' => '',
        'clientViber' => '',
        'clientTelegram' => '',
    );

    if (!empty($_POST['formData'])) {
        foreach ($_POST['formData'] as $form_data) {
            $name = $form_data['name'];
            $value = $form_data['value'];

            $form_data_array[$name] = $value;
        }
    }

    unset($form_data);
    unset($name);
    unset($value);

    $validation_errors = array();

    // Validating Client Name
    if (empty($form_data_array['clientName'])) {
        $validation_errors['clientName'] = array(
            'message' => __('Input your name, please', 'snthwp')
        );
    } else {
        $form_data_array['clientName'] = filter_var($form_data_array['clientName'], FILTER_SANITIZE_STRING);
    }

    // Validating client phone
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
        } else {
            $form_data_array["clientPhone"] = $filtered_phone_number;
        }

        unset($filtered_phone);
        unset($filtered_phone_number);
    }

    // Validating client Email
    if (empty($form_data_array['date_from'])) {
        $validation_errors['date_from'] = array(
            'message' => __('Select tour date, please', 'snthwp')
        );
    }

    // Validating client Email
    if (!empty($form_data_array['clientEmail'])) {
        if (!filter_var($form_data_array['clientEmail'], FILTER_VALIDATE_EMAIL)) {
            $validation_errors['clientEmail'] = array(
                'message' => __('Input correct email, please', 'snthwp')
            );
        }
    }

    // Validating Adult Amount
    if (!empty($form_data_array['adult_amount'])) {
        $filtered_adultAmount = str_replace("-", "", $form_data_array['adult_amount']);
        $filtered_adultAmount = str_replace("+", "", $filtered_adultAmount);

        if (!filter_var((int) $filtered_adultAmount, FILTER_VALIDATE_INT)) {
            $validation_errors['adult_amount'] = array(
                'message' => __('Input number as Adult amount, please', 'snthwp')
            );
        } else {
            $form_data_array['adult_amount'] = $filtered_adultAmount;
        }

        unset($filtered_adultAmount);
    }

    // Validating Children Amount
    if (!empty($form_data_array['child_amount'])) {
        $filtered_childrenAmount = str_replace("-", "", $form_data_array['child_amount']);
        $filtered_childrenAmount = str_replace("+", "", $filtered_childrenAmount);

        if (!filter_var((int) $filtered_childrenAmount, FILTER_VALIDATE_INT)) {
            $validation_errors['child_amount'] = array(
                'message' => __('Input number as Children amount, please', 'snthwp')
            );
        } else {
            $form_data_array['child_amount'] = $filtered_childrenAmount;
        }

        unset($filtered_childrenAmount);
    }

    // Validating Client Name
    if (empty($form_data_array['country'])) {
        $validation_errors['country'] = array(
            'message' => __('Select country, please', 'snthwp')
        );
    } else {
        $form_data_array['clientName'] = filter_var((int) $form_data_array['country'], FILTER_VALIDATE_INT);
    }

    // Validating Price from
    if (!empty($form_data_array['price_from'])) {
        $filtered_priceFrom = str_replace("-", "", $form_data_array['price_from']);
        $filtered_priceFrom = str_replace("+", "", $filtered_priceFrom);

        if (!filter_var($filtered_priceFrom, FILTER_VALIDATE_INT)) {
            $validation_errors['price_from'] = array(
                'message' => __('Input number as Price from, please', 'snthwp')
            );
        } else {
            $form_data_array['price_from'] = $filtered_priceFrom;
        }

        unset($filtered_priceFrom);
    }

    // Validating Price till
    if (!empty($form_data_array['price_till'])) {
        $filtered_priceTill = str_replace("-", "", $form_data_array['price_till']);
        $filtered_priceTill = str_replace("+", "", $filtered_priceTill);

        if (!filter_var($filtered_priceTill, FILTER_VALIDATE_INT)) {
            $validation_errors['price_till'] = array(
                'message' => __('Input number as Price till, please', 'snthwp')
            );
        } else {
            $form_data_array['price_till'] = $filtered_priceTill;
        }

        unset($filtered_priceTill);
    }

    if (!empty($validation_errors)) {
        $error_message = crm_get_template('messages/request-validation-error.php', array('errors' => $validation_errors));

        $message = array(
            'reason' => 'validation_error',
            'fragments' => array (
                '.messages__holder' => $error_message,
            ),
        );

        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => $message ));

        die;
    }

    $user = CRM_User::getByField('user_phone', $form_data_array["clientPhone"]);

    if (!$user) {
        $user_data = array(
            'user_display_name' => $form_data_array['clientName'],
            'user_email' => $form_data_array['clientEmail'],
            'user_phone' => $form_data_array['clientPhone'],
            'user_registered' => gmdate( 'Y-m-d H:i:s' ),
        );

        if (!empty($form_data_array['clientViber']) && 'viber' === $form_data_array['clientViber']) {
            $user_data['user_viber'] = 1;
        }

        if (!empty($form_data_array['clientTelegram']) && 'telegram' === $form_data_array['clientTelegram']) {
            $user_data['user_telegram'] = 1;
        }

        $user_id = CRM_User::insert($user_data);
    } else {
        $user_id = $user->ID;
    }

    $form_data_array['client_id'] = $user_id;
    $form_data_array['claim_type'] = 'tour';
    $form_data_array['claim_step'] = 'tour_booking_request';
    $form_data_array['claim_meta_group'] = 'tour_booking_parameters';

    unset($form_data_array['clientName']);
    unset($form_data_array['clientEmail']);
    unset($form_data_array['clientPhone']);
    unset($form_data_array['clientViber']);
    unset($form_data_array['clientTelegram']);

    $claim_id = CRM_ClaimManager::create_new_booking_request($form_data_array);
    $fake_claim_id = $claim_id + CRM_Claim::$initial_claim_number;

    $success_message = crm_get_template('messages/request-success.php', array('claim_id' => $fake_claim_id));

    $message = array(
        'fragments' => array(
            '.messages__holder' => $success_message,
        ),
    );

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_find_me_tour', 'ittour_ajax_find_me_tour');
add_action('wp_ajax_ittour_ajax_find_me_tour', 'ittour_ajax_find_me_tour');
