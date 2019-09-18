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

?>
<ul>
    <li><a href="?page=crm-moi-turisty&tab=clients">Clients</a></li>
    <li><a href="?page=crm-moi-turisty&tab=claims">Claims</a></li>
</ul>
<?php

if (
    empty($_GET['tab']) || $_GET['tab'] === 'clients'
) {
    crm_show_template('admin/moi-turisty-clients.php');
} elseif ('claims' === $_GET['tab']) {
    crm_show_template('admin/moi-turisty-claims.php');
} elseif ('edit' === $_GET['action']) {
    crm_show_template('admin/clients-edit.php', array('user_id' => $_GET['user_id']));
}
?>
