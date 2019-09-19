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

$show_array = array(
    'i', 'n', 'm', 'p', 'c', 'a', 'cn'
);
?>
<h2><?php _e('Clients'); ?> (<?php echo count($clients_data); ?>)</h2>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <th>#</th>
        <?php foreach ($show_array as $field_i) {
            ?><th><?php echo $clients_fields[$field_i] ?></th><?php
        } ?>
        <th>tags</th>
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
            $client_id = $client_data['i'];

            foreach ($show_array as $field_i) {
                if ('i' === $field_i || 'n' === $field_i) {
                    ?><td><a href="admin.php?page=crm-moi-turisty&tab=clients&client_id=<?php echo $client_id; ?>"><?php echo $client_data[$field_i]; ?></td></a><?php
                } else {
                    ?><th><?php echo $client_data[$field_i] ?></th><?php
                }

            }
            ?>
            <td>
                <?php
                $client_tags = crm_moi_turisty_get_client_tags($client_id);

                if (!empty($client_tags)) {
                    foreach ($client_tags as $tag_i => $tag_n) {
                        ?>
                        <?php echo $tag_n ?><br>
                        <?php
                    }
                }
                ?>
            </td>
        </tr>
        <?php
        $num++;
    }
    ?>
    </tbody>

    <tfoot>
    <tr>
        <th>#</th>
        <?php foreach ($clients_fields as $i => $clients_field) {
            if (in_array($i, $show_array)) {
                ?><th><?php echo $clients_field ?></th><?php
            }
        } ?>
        <th>tags</th>
    </tr>
    </tfoot>
</table>
