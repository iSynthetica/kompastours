<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$upload_dir = wp_get_upload_dir();
$upload_dir_path = $upload_dir['basedir'];
$clients = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients.json');

$clients_decoded = json_decode($clients, true);
$clients_fields = $clients_decoded['struct'];
$clients_data = $clients_decoded['data'];
$client_data_by_id = array();

foreach ($clients_data as $client_data) {
    if ($client_data['i'] == $_GET['client_id']) {
        $client_data_by_id = $client_data;
        break;
    }
}

if (!empty($client_data_by_id)) {
    $client_id = $client_data_by_id['i'];
    $client_tags = crm_moi_turisty_get_client_tags($client_id);
    ?>
    <h2><?php echo $client_data_by_id['n'] ?>: ID <?php echo $client_data_by_id['i'] ?></h2>
    <?php
    var_dump($client_data_by_id);
    var_dump($client_tags);
} else {
    echo 'No Client with id ' . $_GET['client_id'];
}

