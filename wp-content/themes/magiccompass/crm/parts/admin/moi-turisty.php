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
    <li><a href="?page=crm-moi-turisty&tab=clients_phones">Clients Phones</a></li>
    <li><a href="?page=crm-moi-turisty&tab=claims">Claims</a></li>
</ul>
<?php

if (
    empty($_GET['tab']) || $_GET['tab'] === 'clients'
) {
    crm_show_template('admin/moi-turisty-clients.php');
} else {
    crm_show_template('admin/moi-turisty-'.$_GET['tab'].'.php');
}
?>
