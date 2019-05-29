<?php
/**
 * CRM Create New Client.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.2
 * @since 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$clients = CRM_User::getAll();
?>

<h1 class="wp-heading-inline">
    <?php _e('CRM Clients', 'snthwp'); ?>
    <a href="/wp-admin/admin.php?page=crm-clients&action=add_new" class="page-title-action"><?php _e('Add New', 'snthwp'); ?></a>
</h1>

<hr class="wp-header-end">

<table class="wp-list-table widefat fixed striped pages">
    <thead>
        <tr>
            <th><?php _e('Name', 'snthwp'); ?></th>
            <th><?php _e('Phone', 'snthwp'); ?></th>
            <th><?php _e('Email', 'snthwp'); ?></th>
            <th><?php _e('Opened Claims', 'snthwp'); ?></th>
        </tr>
    </thead>

    <tbody id="the-list">
        <?php
        if (!empty($clients)) {
            foreach ($clients as $client) {
                ?>
                <tr>
                    <th><strong><?php echo $client->user_display_name ?></strong></th>
                    <td><?php echo $client->user_phone ?></td>
                    <td><?php echo $client->user_email ?></td>
                    <td></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>

    <tfoot>
        <tr>
            <th><?php _e('Name', 'snthwp'); ?></th>
            <th><?php _e('Phone', 'snthwp'); ?></th>
            <th><?php _e('Email', 'snthwp'); ?></th>
            <th><?php _e('Opened Claims', 'snthwp'); ?></th>
        </tr>
    </tfoot>
</table>