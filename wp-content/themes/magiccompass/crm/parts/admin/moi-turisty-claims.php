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
$entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/claims.json');

$entity_decoded = json_decode($entity, true);
$entity_fields = $entity_decoded['struct'];
$entity_data = $entity_decoded['data'];

// var_dump(crm_moi_turisty_get_claims_by_client_id());

var_dump($entity_fields);

$show_array = array(
    'i', 'ci', 'lb', 'cn', 'ct', 'ht', 'st', 'ps', 'cp', 'cs'
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
        <?php
        foreach ($show_array as $field_i) {
            ?><th><?php echo $entity_fields[$field_i] ?></th><?php
        }
        ?>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php
    foreach ($entity_data as $entity_item) {
        ?>
        <tr>
            <?php
            foreach ($show_array as $field_i) {
                ?><td><?php echo $entity_item[$field_i] ?></td><?php
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
        foreach ($show_array as $field_i) {
            ?><th><?php echo $entity_fields[$field_i] ?></th><?php
        }
        ?>
    </tr>
    </tfoot>
</table>
