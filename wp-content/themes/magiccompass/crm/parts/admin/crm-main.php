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

<h3><?php _e('Clients', 'snthwp') ?></h3>

<?php
if (empty(CRM_User::isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Clients table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="user" data-operation="create"><?php _e('Create Clients Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif (CRM_User::isTableChanged()) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('Clients table was changed, please upgrade it in your DB.', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="user" data-operation="update"><?php _e('Update Clients Table', 'snthwp') ?></button>
    </div>
    <?php
}

if (empty(CRM_Usermeta::isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Clients meta table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="usermeta" data-operation="create"><?php _e('Create Clients Meta Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif (CRM_Usermeta::isTableChanged()) {
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

<h3><?php _e('Claims', 'snthwp') ?></h3>

<?php
if (empty(CRM_Claim::isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Claims table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="claim" data-operation="create"><?php _e('Create Claims Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif (CRM_Claim::isTableChanged()) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('Claims table was changed, please upgrade it in your DB.', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="claim" data-operation="update"><?php _e('Update Claims Table', 'snthwp') ?></button>
    </div>
    <?php
}

if (empty(CRM_Claimmeta::isTableExists())) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('In order to start working with CRM you need to create Claims Meta table', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="claimmeta" data-operation="create"><?php _e('Create Claims Meta Table', 'snthwp') ?></button>
    </div>
    <?php
} elseif (CRM_Claim::isTableChanged()) {
    ?>
    <div class="fragment-holder">
        <p>
            <?php _e('Claims Meta table was changed, please upgrade it in your DB.', 'snthwp') ?>
        </p>

        <button class="updateCRMTable button button-primary" data-table="claimmeta" data-operation="update"><?php _e('Update Claims Meta Table', 'snthwp') ?></button>
    </div>
    <?php
}
?>
