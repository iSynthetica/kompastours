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

    $entity = new $class_name();

    $entity->createObjectTable();

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_crm_ajax_update_table', 'crm_update_table' );