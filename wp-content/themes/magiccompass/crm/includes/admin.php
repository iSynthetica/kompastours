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

function crm_enqueue_admin_scripts() {
    // Adding scripts file in the footer
    wp_enqueue_script( 'crm-admin-js', CRM_ASSETS_JS.'/admin.js', array( 'jquery' ), CRM_VERSION, true );

    // Register main stylesheet
    wp_enqueue_style( 'crm-admin-css', CRM_ASSETS_CSS.'/admin.css', array(), CRM_VERSION, 'all' );
}
add_action( 'admin_enqueue_scripts', 'crm_enqueue_admin_scripts' );

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

    add_submenu_page(
        'crm-page',
        __('Claims Page', 'snthwp'),
        __('Claims', 'snthwp'),
        'manage_options',
        'crm-claims',
        'crm_claims_admin_page'
    );

    add_submenu_page(
        'crm-page',
        __('Clients Page', 'snthwp'),
        __('Clients', 'snthwp'),
        'manage_options',
        'crm-clients',
        'crm_clients_admin_page'
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

function crm_claims_admin_page() {
    ?>
    <div class="wrap">
        <?php
        crm_show_template('admin/claims.php');
        ?>
    </div>
    <?php
}

function crm_clients_admin_page() {
    ?>
    <div class="wrap">
        <?php crm_show_template('admin/clients.php'); ?>
    </div>
    <?php
}