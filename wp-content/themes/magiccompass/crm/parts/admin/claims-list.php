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
?>
<h1 class="wp-heading-inline">
    <?php _e('CRM Claims', 'snthwp'); ?>
    <a href="/wp-admin/admin.php?page=crm-claims&action=add_new" class="page-title-action"><?php _e('Add New', 'snthwp'); ?></a>
</h1>

<hr class="wp-header-end">

<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <th><?php _e('Claim', 'snthwp'); ?></th>
        <th><?php _e('Status', 'snthwp'); ?></th>
        <th><?php _e('Date', 'snthwp'); ?></th>
        <th><?php _e('Type', 'snthwp'); ?></th>
        <th><?php _e('Client', 'snthwp'); ?></th>
        <th><?php _e('Manager', 'snthwp'); ?></th>
    </tr>
    </thead>

    <tbody id="the-list">

    </tbody>

    <tfoot>
    <tr>
        <th><?php _e('Claim', 'snthwp'); ?></th>
        <th><?php _e('Status', 'snthwp'); ?></th>
        <th><?php _e('Date', 'snthwp'); ?></th>
        <th><?php _e('Type', 'snthwp'); ?></th>
        <th><?php _e('Client', 'snthwp'); ?></th>
        <th><?php _e('Manager', 'snthwp'); ?></th>
    </tr>
    </tfoot>
</table>
