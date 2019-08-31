<?php
/**
 * This file handles the admin area and functions
 *
 * @package Magiccompass/Includes
 * @version 0.0.7
 * @since 0.0.7
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function ittour_admin_menu() {
    add_menu_page(
        __('ITTour Settings', 'snthwp'),
        __('ITTour', 'snthwp'),
        'manage_options',
        'ittour-page',
        'ittour_admin_page',
        'dashicons-tickets-alt',
        6
    );

    add_submenu_page(
        'ittour-page',
        __('ITTour Countries Settings', 'snthwp'),
        __('Countries', 'snthwp'),
        'manage_options',
        'ittour-countries',
        'ittour_countries_admin_page'
    );

    add_submenu_page(
        'ittour-page',
        __('ITTour Regions Settings', 'snthwp'),
        __('Regions', 'snthwp'),
        'manage_options',
        'ittour-regions',
        'ittour_regions_admin_page'
    );

    add_submenu_page(
        'ittour-page',
        __('ITTour Hotels Settings', 'snthwp'),
        __('Hotels', 'snthwp'),
        'manage_options',
        'ittour-hotels',
        'ittour_hotels_admin_page'
    );

}
add_action( 'admin_menu', 'ittour_admin_menu' );

function ittour_admin_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('ITTour Settings', 'snthwp'); ?></h2>

        <?php ittour_show_template('admin/api-params.php') ?>
    </div>
    <?php
}

function ittour_countries_admin_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('ITTour Countries', 'snthwp'); ?></h2>

        <?php ittour_show_template('admin/api-countries.php') ?>
    </div>
    <?php
}

function ittour_regions_admin_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('ITTour Regions', 'snthwp'); ?></h2>

        <?php ittour_show_template('admin/api-regions.php') ?>
    </div>
    <?php
}

function ittour_hotels_admin_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('ITTour Hotels', 'snthwp'); ?></h2>

        <?php ittour_show_template('admin/api-hotels.php') ?>
    </div>
    <?php
}

function snth_enqueue_admin_scripts() {
    // Adding scripts file in the footer
    wp_enqueue_script( 'site-admin-js', SNTH_ASSETS_URL.'/admin/scripts/scripts.js', array( 'jquery' ), SNTH_VERSION, true );

    // Register main stylesheet
    wp_enqueue_style( 'snth-flags-css', SNTH_ASSETS_URL.'/admin/styles/flags.css', array(), SNTH_VERSION, 'all' );
    wp_enqueue_style( 'snth-admin-css', SNTH_ASSETS_URL.'/admin/styles/style.css', array(), SNTH_VERSION, 'all' );
}
add_action( 'admin_enqueue_scripts', 'snth_enqueue_admin_scripts' );