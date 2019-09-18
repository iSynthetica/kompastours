<?php
/**
 * CRM Main File.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.2
 * @since 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

//$allowed_actions = array (
//    'add_new', 'edit'
//);
//
//if (
//    empty($_GET['action']) ||
//    !in_array($_GET['action'], $allowed_actions) ||
//    ('edit' === $_GET['action'] && empty($_GET['user_id']))
//) {
//    crm_show_template('admin/clients-list.php');
//} elseif ('add_new' === $_GET['action']) {
//    crm_show_template('admin/clients-add-new.php');
//} elseif ('edit' === $_GET['action']) {
//    crm_show_template('admin/clients-edit.php', array('user_id' => $_GET['user_id']));
//}

$upload_dir = wp_get_upload_dir();
$upload_dir_path = $upload_dir['basedir'];
$clients = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients.json');

$clients_decoded = json_decode($clients, true);
$clients_fields = $clients_decoded['struct'];
$clients_data = $clients_decoded['data'];

//var_dump($clients_fields);

//foreach ($clients_data as $client) {
//    var_dump($client);
//}
// var_dump($clients_decoded);
?>
<h2><?php _e('Clients'); ?> (<?php echo count($clients_data); ?>)</h2>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <?php foreach ($clients_fields as $clients_field) {
            ?><th><?php echo $clients_field ?></th><?php
        } ?>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php
    foreach ($clients_data as $client_data) {
        ?>
        <tr>
            <?php
            foreach ($client_data as $i => $value) {
                ?>
                <td><?php echo $value; ?></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>

    <tfoot>
    <tr>
        <?php foreach ($clients_fields as $clients_field) {
            ?><th><?php echo $clients_field ?></th><?php
        } ?>
    </tr>
    </tfoot>
</table>

MOI TURISTY
