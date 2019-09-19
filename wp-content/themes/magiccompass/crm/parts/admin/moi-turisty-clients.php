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

if (!empty($_GET['client_id'])) {
    crm_show_template('admin/moi-turisty-client_info.php');
} else {
    crm_show_template('admin/moi-turisty-clients_list.php');
}
