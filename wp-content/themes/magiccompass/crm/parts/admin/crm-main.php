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
$user = new CRM_User();

if (empty($user->isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Clients table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="user" data-operation="create"><?php _e('Create Clients Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif ($user->isTableChanged()) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('Clients table was changed, please upgrade it in your DB.', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="user" data-operation="update"><?php _e('Update Clients Table', 'snthwp') ?></button>
    </div>
    <?php
}

$user_meta = new CRM_Usermeta();

if (empty($user_meta->isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Clients meta table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="usermeta" data-operation="create"><?php _e('Create Clients Meta Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif ($user_meta->isTableChanged()) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('Clients meta table was changed, please upgrade it in your DB.', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="usermeta" data-operation="update"><?php _e('Update Clients Meta Table', 'snthwp') ?></button>
    </div>
    <?php
}
?>
