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
$entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients_tags.json');

$entity_decoded = json_decode($entity, true);
$entity_fields = $entity_decoded['struct'];
$entity_data = $entity_decoded['data'];

var_dump(crm_moi_turisty_get_tags_names_by_id());
var_dump(crm_moi_turisty_get_clients_ids_by_tags());

var_dump($entity_fields);

$show_array = array(
    'i', 'ci', 'ti'
);

//foreach ($clients_data as $client) {
//    var_dump($client);
//}
// var_dump($entity_decoded);
?>
<h2><?php _e('Clients'); ?> (<?php echo count($entity_data); ?>)</h2>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <th>#</th>
        <?php foreach ($entity_fields as $i => $entity_field) {
            if (in_array($i, $show_array)) {
                ?><th><?php echo $entity_field ?></th><?php
            }
        } ?>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php
    $num = 1;
    foreach ($entity_data as $entity_item) {
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <?php
            foreach ($entity_item as $i => $value) {
                if (in_array($i, $show_array)) {
                    ?>
                    <td><?php echo $value; ?></td>
                    <?php
                }
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
        <?php foreach ($entity_fields as $i => $entity_field) {
            if (in_array($i, $show_array)) {
                ?><th><?php echo $entity_field ?></th><?php
            }
        } ?>
    </tr>
    </tfoot>
</table>
