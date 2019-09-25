<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 21:00
 */

function crm_update_table() {
    $table = $_POST['table'];
    $operation = $_POST['operation'];

    $class_name = 'CRM_' . ucfirst($table);

    $class_name::createObjectTable();

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_crm_ajax_update_table', 'crm_update_table' );

function crm_start_claim() {
    $claim_id = $_POST['claimId'];
    $user_id = $_POST['userId'];

    $data = array(
        'ID' => $claim_id,
        'manager_id' => $user_id,
        'status' => 'in_progress',
        'modified' => gmdate( 'Y-m-d H:i:s' ),
    );

    $updated = CRM_Claim::insert($data);

    if (!$updated) {
        $response = array('success' => 0, 'error' => 1, 'message' => __("Can't update current claim", 'wp2leads'));

        echo json_encode($response);
        wp_die();
    }

    $claim = new CRM_Claim($claim_id);

    ob_start();

    crm_show_template('admin/claim-sections/claim-edit-service-info.php', array(
        'claim' => $claim,
        'user'  => $user_id
    ));

    $service_info = ob_get_clean();

    $message = array(
        'fragments' => array(
            '#service-info__holder' => $service_info,
        ),
    );

    $response = array('success' => 1, 'error' => 0, 'message' => $message);

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_crm_ajax_start_claim', 'crm_start_claim' );

function crm_moi_turisty_download_csv() {
    $only_mail = $_POST['onlyMail'];
    $tag_id = $_POST['tagId'];


//    $response = array('success' => 1, 'error' => 0, 'message' => 'Success');
//
//    echo json_encode($response);

    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=search_results.csv");
    wp_die();
}

add_action( 'wp_ajax_crm_ajax_moi_turisty_download_csv', 'crm_moi_turisty_download_csv' );