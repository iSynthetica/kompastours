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

$upload_dir = wp_get_upload_dir();
$upload_dir_path = $upload_dir['basedir'];
$clients = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients.json');

$clients_decoded = json_decode($clients, true);
$clients_fields = $clients_decoded['struct'];
$clients_data = array_reverse($clients_decoded['data']);

var_dump($clients_fields);
?>
<h2><?php _e('Clients'); ?> (<?php echo count($clients_data); ?>)</h2>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <th>#</th>
        <?php foreach ($clients_fields as $clients_field) {
            ?><th><?php echo $clients_field ?></th><?php
        } ?>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php
    $num = 1;
    foreach ($clients_data as $client_data) {
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <?php
            $client_id = '';
            foreach ($client_data as $i => $value) {
                if ('i' === $i) {
                    $client_id = $value;
                }
                if ('i' === $i || 'n' === $i) {
                    ?><td><a href="admin.php?page=crm-moi-turisty&tab=clients&client_id=<?php echo $client_id; ?>"><?php echo $value; ?></td></a><?php
                } else {
                    ?><td><?php echo $value; ?></td><?php
                }
                ?>

                <?php
            }
            ?>
        </tr>
        <?php
        $num++;
    }
    ?>
    </tbody>

    <tfoot>
    <tr>
        <th>#</th>
        <?php foreach ($clients_fields as $clients_field) {
            ?><th><?php echo $clients_field ?></th><?php
        } ?>
    </tr>
    </tfoot>
</table>
