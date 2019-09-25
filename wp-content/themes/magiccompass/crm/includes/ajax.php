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

add_action( 'admin_post_print.csv', 'print_csv' );

function print_csv()
{
    if ( ! current_user_can( 'manage_options' ) )
        return;

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=example.csv');
    header('Pragma: no-cache');

    $only_mail = !empty($_GET['only_mail']) ? $_GET['only_mail'] : false;

    if ($only_mail && 'no' === $only_mail) {
        $only_mail = false;
    }

    $tag_id = !empty($_GET['tag_id']) ? $_GET['tag_id'] : '';

    if ($tag_id && 'no' === $tag_id) {
        $tag_id = '';
    }

    $tags_names = crm_moi_turisty_get_tags_names_by_id();
    $clients_ids_by_tags = crm_moi_turisty_get_clients_ids_by_tags();

    if (!empty($tag_id)) {
        $tag_id_array = explode(':', $tag_id);
        $clients_only_tags = array();

        foreach ($tag_id_array as $tag_id_item) {
            if (!empty($clients_ids_by_tags[$tag_id_item]) ) {
                $clients_only_tags = array_merge($clients_only_tags, $clients_ids_by_tags[$tag_id_item]);
            }
        }

        $clients_only_tags = array_values(array_unique($clients_only_tags));
    }

    $client_array = crm_moi_turisty_get_clients_data_by_id();

    $clients_decoded = $client_array;
    $clients_fields = $clients_decoded['struct'];
    $clients_data = $clients_decoded['data'];

    $show_array = array(
        'i',
        'n',
        'm',
        'p',
        'c',
        //'a',
        //'cn'
    );

    $output = '';

    $i = 1;
    $num = count($show_array);
    foreach ($show_array as $field_i) {
        $output .= $clients_fields[$field_i];

        if ($i < $num) {
            $output .= ',';
        }
        $i++;
    }

    $output .= PHP_EOL;

    foreach ($clients_data as $client_id => $client_data) {
        $i = 1;
        $num = count($show_array);
        foreach ($show_array as $field_i) {
            $output .= '"' . $client_data[$field_i] . '"';

            if ($i < $num) {
                $output .= ',';
            }
            $i++;
        }
        $output .= PHP_EOL;
    }

    echo $output;

    // output the CSV data
}