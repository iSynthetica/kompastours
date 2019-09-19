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

    add_submenu_page(
        'crm-page',
        __('Moi Turisty Page', 'snthwp'),
        __('Moi Turisty', 'snthwp'),
        'manage_options',
        'crm-moi-turisty',
        'crm_moi_turisty_admin_page'
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

function crm_moi_turisty_admin_page() {
    ?>
    <div class="wrap">
        <?php crm_show_template('admin/moi-turisty.php'); ?>
    </div>
    <?php
}

function crm_moi_turisty_get_client_tags($client_id) {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];

    $entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients_tags.json');
    $entity_decoded = json_decode($entity, true);
    $entity_fields = $entity_decoded['struct'];
    $entity_data = $entity_decoded['data'];

    $tf_tags = $response = file_get_contents($upload_dir_path . '/moi-turisty/tf_tags.json');
    $tf_tags_decoded = json_decode($tf_tags, true);
    $tf_tags_fields = $tf_tags_decoded['struct'];
    $tf_tags_data = $tf_tags_decoded['data'];

    $client_tags_id = array();
    $client_tags_names = array();

    if (!empty($entity_data)) {
        foreach ($entity_data as $data) {
            if ((int)$data['ci'] == (int)$client_id) {
                $client_tags_id[] = $data['ti'];
            }
        }
    }

    if (!empty($client_tags_id) && !empty($tf_tags_data)) {
        foreach ($tf_tags_data as $tag_data) {
            if (in_array($tag_data['i'], $client_tags_id)) {
                $client_tags_names[$tag_data['i']] = $tag_data['n'];
            }
        }
    }

    return $client_tags_names;
}

function crm_moi_turisty_get_client_claims($client_id) {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];

    $entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/claims.json');
    $entity_decoded = json_decode($entity, true);
    $entity_fields = $entity_decoded['struct'];
    $entity_data = $entity_decoded['data'];
    $client_claims = array();

    if (!empty($entity_data)) {
        foreach ($entity_data as $data) {
            if ((int)$data['ci'] == (int)$client_id) {
                $client_claims[$data['i']] = $data;
            }
        }
    }

    return $client_claims;
}

function crm_moi_turisty_get_claims_by_client_id() {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];

    $entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/claims.json');
    $entity_decoded = json_decode($entity, true);
    $entity_fields = $entity_decoded['struct'];
    $entity_data = $entity_decoded['data'];
    $client_claims = array();

    if (!empty($entity_data)) {
        foreach ($entity_data as $data) {
            $client_claims[$data['ci']][] = $data;
        }
    }

    return $client_claims;
}

/**
 *
 */
function crm_moi_turisty_get_clients_ids_by_tags() {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];

    $entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients_tags.json');
    $entity_decoded = json_decode($entity, true);
    $entity_fields = $entity_decoded['struct'];
    $entity_data = $entity_decoded['data'];

    $tags_array = array();

    if (!empty($entity_data)) {
        foreach ($entity_data as $data) {
            $tags_array[$data['ti']][] = $data['ci'];
        }
    }

    return $tags_array;
}

function crm_moi_turisty_get_tags_names_by_id() {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];

    $entity = $response = file_get_contents($upload_dir_path . '/moi-turisty/tf_tags.json');
    $entity_decoded = json_decode($entity, true);
    $entity_fields = $entity_decoded['struct'];
    $entity_data = $entity_decoded['data'];

    $tags_array = array();

    if (!empty($entity_data)) {
        foreach ($entity_data as $data) {
            $tags_array[$data['i']] = $data['n'];
        }
    }

    return $tags_array;
}

function crm_moi_turisty_get_clients_data_by_id($sort = 'DESC', $client_id = null) {
    $upload_dir = wp_get_upload_dir();
    $upload_dir_path = $upload_dir['basedir'];
    $clients = $response = file_get_contents($upload_dir_path . '/moi-turisty/clients.json');

    $clients_decoded = json_decode($clients, true);
    $clients_fields = $clients_decoded['struct'];

    if ('DESC' === $sort) {
        $clients_data = array_reverse($clients_decoded['data']);
    }

    $clients_array = array();

    $clients_array['struct'] = $clients_fields;

    if (!empty($clients_data)) {
        foreach ($clients_data as $data) {
            $clients_array['data'][$data['i']] = $data;
        }
    }

    return $clients_array;
}