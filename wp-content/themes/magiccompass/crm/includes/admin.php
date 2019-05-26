<?php
/**
 * CRM Admin Functions.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.1
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

function crm_admin_menu() {
    add_menu_page(
        __('CRM Settings', 'snthwp'),
        __('CRM', 'snthwp'),
        'manage_options',
        'crm-page',
        'crm_admin_page',
        'dashicons-id-alt',
        6
    );
}
add_action( 'admin_menu', 'crm_admin_menu' );

function crm_admin_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('CRM Settings', 'snthwp'); ?></h2>

        <?php
        crm_show_template('admin/crm-main.php');
        ?>
    </div>
    <?php
}