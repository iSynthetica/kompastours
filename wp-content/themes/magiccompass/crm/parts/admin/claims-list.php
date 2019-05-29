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

$claims = CRM_Claim::getAll();
?>
<h1 class="wp-heading-inline">
    <?php _e('CRM Claims', 'snthwp'); ?>
    <a href="/wp-admin/admin.php?page=crm-claims&action=add_new" class="page-title-action"><?php _e('Add New', 'snthwp'); ?></a>
</h1>

<hr class="wp-header-end">

<table class="wp-list-table widefat fixed striped pages">
    <thead>
        <tr>
            <th><?php _e('#', 'snthwp'); ?></th>
            <th><?php _e('Claim', 'snthwp'); ?></th>
            <th><?php _e('Client', 'snthwp'); ?></th>
            <th><?php _e('Status', 'snthwp'); ?></th>
            <th><?php _e('Date', 'snthwp'); ?></th>
            <th><?php _e('Type', 'snthwp'); ?></th>
            <th><?php _e('Manager', 'snthwp'); ?></th>
        </tr>
    </thead>

    <tbody id="the-list">
    <?php
    if (!empty($claims)) {
        foreach ($claims as $claim_item) {
            $claim = new CRM_Claim($claim_item->ID);
            $client = $claim->client;
            $manager = $claim->manager;
            ?>
            <tr>
                <td><strong><?php echo CRM_Claim::$initial_claim_number + $claim->ID; ?></strong></td>
                <td><strong><a href="/wp-admin/admin.php?page=crm-claims&action=edit&claim_id=<?php echo $claim->ID ?>"><?php echo $claim->title ?></a></strong></td>
                <td><?php echo $client->user_display_name ?></td>
                <td><?php echo CRM_Claim::getStatuses()[$claim->status]; ?></td>
                <td><?php echo $claim->created ?></td>
                <td><?php echo CRM_Claim::getTypes()[$claim->type]; ?></td>
                <td><?php echo !empty($claim->manager) ? $claim->manager->display_name : '-' ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>

    <tfoot>
        <tr>
            <th><?php _e('#', 'snthwp'); ?></th>
            <th><?php _e('Claim', 'snthwp'); ?></th>
            <th><?php _e('Client', 'snthwp'); ?></th>
            <th><?php _e('Status', 'snthwp'); ?></th>
            <th><?php _e('Date', 'snthwp'); ?></th>
            <th><?php _e('Type', 'snthwp'); ?></th>
            <th><?php _e('Manager', 'snthwp'); ?></th>
        </tr>
    </tfoot>
</table>
