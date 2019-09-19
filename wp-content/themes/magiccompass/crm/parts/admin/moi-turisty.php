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

$active_tab = !empty($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'clients';
?>
<h2 class="nav-tab-wrapper">
    <a href="?page=crm-moi-turisty&tab=clients" class="nav-tab<?php echo $active_tab == 'clients' ? ' nav-tab-active' : ''; ?>">Clients</a>
    <a href="?page=crm-moi-turisty&tab=clients_phones" class="nav-tab<?php echo $active_tab == 'clients_phones' ? ' nav-tab-active' : ''; ?>">Clients Phones</a>
    <a href="?page=crm-moi-turisty&tab=clients_tags" class="nav-tab<?php echo $active_tab == 'clients_phones' ? ' nav-tab-active' : ''; ?>">Clients Tags</a>
    <a href="?page=crm-moi-turisty&tab=claims" class="nav-tab<?php echo $active_tab == 'claims' ? ' nav-tab-active' : ''; ?>">Claims</a>
    <a href="?page=crm-moi-turisty&tab=claims_bookings" class="nav-tab<?php echo $active_tab == 'claims_bookings' ? ' nav-tab-active' : ''; ?>">Claim Bookings</a>
</h2>

<?php crm_show_template('admin/moi-turisty-'.$active_tab.'.php'); ?>
