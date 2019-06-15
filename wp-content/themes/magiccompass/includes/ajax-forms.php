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

function snth_ajax_contact_form() {
    $form_data_array = array (
        'clientName' => '',
        'clientEmail' => '',
        'clientPhone' => '',
        'clientViber' => '',
        'clientTelegram' => '',
        'clientMessage' => '',
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

    if (empty($form_data_array['clientEmail'])) {
        $validation_errors['clientEmail'] = array(
            'message' => __('Input your email, please', 'snthwp')
        );
    } else {
        if (!filter_var($form_data_array['clientEmail'], FILTER_VALIDATE_EMAIL)) {
            $validation_errors['clientEmail'] = array(
                'message' => __('Input correct email, please', 'snthwp')
            );
        }
    }

    if (!empty($form_data_array['clientPhone'])) {
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
        $error_message = snth_get_template('global/validation-errors.php', array('errors' => $validation_errors));

        $message = array(
            'reason' => 'validation_error',
            'fragments' => array (
                '.message-holder' => $error_message,
            ),
        );

        echo json_encode(array( 'success' => 0, 'error' => 1, 'message' => $message ));

        die;
    }

    unset($validation_errors);

    // $user = CRM_User::getByField('user_phone', $form_data_array['clientPhone']);

//    if (!$user) {
//        $user_data = array(
//            'user_display_name' => $form_data_array['clientName'],
//            'user_email' => $form_data_array['clientEmail'],
//            'user_phone' => $form_data_array['clientPhone'],
//            'user_registered' => gmdate( 'Y-m-d H:i:s' ),
//        );
//
//        if (!empty($form_data_array['clientViber'])) {
//            $user_data['user_viber'] = 1;
//        }
//
//        if (!empty($form_data_array['clientTelegram'])) {
//            $user_data['user_telegram'] = 1;
//        }
//
//        $user_id = CRM_User::insert($user_data);
//    } else {
//        $user_id = $user->ID;
//    }
//
//    unset($form_data_array['clientName']);
//    unset($form_data_array['clientEmail']);
//    unset($form_data_array['clientPhone']);
//    unset($form_data_array['clientViber']);
//    unset($form_data_array['clientTelegram']);
//
//    $form_data_array['client_id'] = $user_id;
//    $form_data_array['claim_type'] = 'tour';
//    $form_data_array['claim_step'] = 'tour_booking_request';
//    $form_data_array['claim_meta_group'] = 'tour_booking_parameters';
//
//    $claim_id = CRM_ClaimManager::create_new_booking_request($form_data_array);
//    $fake_claim_id = $claim_id + CRM_Claim::$initial_claim_number;

    $tos = array (
        'i.synthetica@gmail.com',
        'info@kompas.tours',
        'tetlisna@gmail.com',
    );

    $subject = __('Message from contact form');

    $headers = array (
        'From: '.$form_data_array['clientName'].' <'.$form_data_array['clientEmail'].'>',
        'content-type: text/html',
    );

    $message = '';

    $message .= snth_get_template('email/email-header.php', array(
        'email_heading' => $subject
    ));

    $message .= snth_get_template('email/email-title.php', array(
        'email_heading' => $subject
    ));

    $message .= snth_get_template('email/email-contact-form.php', array(
        'email_heading' => $subject,
        'message' => $form_data_array['clientMessage']
    ));

    $message .= snth_get_template('email/email-footer.php');

    // $message = $form_data_array['clientMessage'];

    foreach ($tos as $to) {
        $result = wp_mail( $to, $subject, $message, $headers );
    }

    $success_message = snth_get_template('global/message-contact-form-success.php');

    $message = array(
        'fragments' => array(
            '.message-holder' => $success_message,
        ),
    );

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_snth_ajax_contact_form', 'snth_ajax_contact_form');
add_action('wp_ajax_snth_ajax_contact_form', 'snth_ajax_contact_form');