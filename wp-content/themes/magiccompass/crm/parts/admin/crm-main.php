<?php
/**
 * CRM Admin Main Page.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM/Parts/Admin
 * @version 0.0.1
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<h3>Clients</h3>

<?php
if (empty(CRM_User::isTableExists())) {
    ?>
    <p>
        <?php _e('In order to start working with CRM you need to create Clients table', 'snthwp') ?>
    </p>

    <button id="updateClientTable" class="button button-primary"><?php _e('Create Clients Table', 'snthwp') ?></button>
    <?php
    // CRM_User::createObjectTable();
} elseif (CRM_User::isTableChanged()) {
    ?>
    <p>
        <?php _e('Clients table was changed, please upgrade it in your DB.', 'snthwp') ?>
    </p>

    <button id="updateClientTable" class="button button-primary"><?php _e('Update Clients Table', 'snthwp') ?></button>
    <?php
    // CRM_User::createObjectTable();
}
?>
