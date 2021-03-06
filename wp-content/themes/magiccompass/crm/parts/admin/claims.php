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
    ('edit' === $_GET['action'] && empty($_GET['claim_id']))
) {
    crm_show_template('admin/claims-list.php');
} elseif ('add_new' === $_GET['action']) {
    crm_show_template('admin/claims-add-new.php');
} elseif ('edit' === $_GET['action']) {
    crm_show_template('admin/claims-edit.php', array('claim_id' => $_GET['claim_id']));
}
?>