<?php

if ( ! defined( 'ABSPATH' ) ) exit;

$upload_dir = wp_get_upload_dir();
$upload_dir_path = $upload_dir['basedir'];
$clients = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients.json');

$clients_decoded = json_decode($clients, true);
$clients_fields = $clients_decoded['struct'];
$clients_data = $clients_decoded['data'];
$client_data_by_id = array();

$show_client_info_array = array(
    'p', 'm', 's', 'b', 'ci', 'c', 'd', 'nse', 'nsm', 'a', 'lcv', 'cvd', 'cn'
);
$show_claims_array = array(
    'i', 'lb', 'cn', 'ct', 'ht'
);

foreach ($clients_data as $client_data) {
    if ($client_data['i'] == $_GET['client_id']) {
        $client_data_by_id = $client_data;
        break;
    }
}

if (!empty($client_data_by_id)) {
    $client_id = $client_data_by_id['i'];
    $client_tags = crm_moi_turisty_get_client_tags($client_id);
    $client_claims = crm_moi_turisty_get_client_claims($client_id);
    ?>
    <h2><?php echo $client_data_by_id['n'] ?>: ID <?php echo $client_data_by_id['i'] ?></h2>
    <?php
    ?>
    <ul>
        <?php
        foreach ($show_client_info_array as $field_i) {
            if (!empty($clients_fields[$field_i])) {
                ?>
                <li>
                    <strong><?php echo $clients_fields[$field_i] ?></strong>:
                    <?php echo !empty($client_data_by_id[$field_i]) ? $client_data_by_id[$field_i] : '-' ?>
                </li>
                <?php
            }
        }

        if (!empty($client_tags)) {
            ?>
            <li>
                <strong><?php echo 'client_tags' ?></strong>:
                <?php
                $count = count($client_tags);
                $i = 1;
                foreach ($client_tags as $ti => $tn) {
                    ?>
                    <?php echo $tn ?><?php echo $i < $count ? ', ' : '' ?>
                    <?php
                    $i++;
                }
                ?>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    if (!empty($client_claims)) {
        ?>
        <table class="wp-list-table widefat fixed striped pages">
            <thead>
            <tr>
                <?php
                foreach ($show_claims_array as $field_i) {
                    ?><th><?php echo $field_i ?></th><?php
                }
                ?>
            </tr>
            </thead>

            <tbody id="the-list">
            <?php
            foreach ($client_claims as $client_claims_item) {
                ?>
                <tr>
                    <?php
                    foreach ($show_claims_array as $field_i) {
                        ?><td><?php echo $client_claims_item[$field_i] ?></td><?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>

            <tfoot>
            <tr>
                <?php
                foreach ($show_claims_array as $field_i) {
                    ?><th><?php echo $field_i ?></th><?php
                }
                ?>
            </tr>
            </tfoot>
        </table>
        <?php
    }
} else {
    echo 'No Client with id ' . $_GET['client_id'];
}

