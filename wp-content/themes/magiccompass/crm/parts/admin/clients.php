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

$allowed_actions = array (
    'add_new', 'edit'
);

if (
    empty($_GET['action']) ||
    !in_array($_GET['action'], $allowed_actions) ||
    ('edit' === $_GET['action'] && empty($_GET['user_id']))
) {
    crm_show_template('admin/clients-list.php');
} elseif ('add_new' === $_GET['action']) {
    crm_show_template('admin/clients-add-new.php');
}