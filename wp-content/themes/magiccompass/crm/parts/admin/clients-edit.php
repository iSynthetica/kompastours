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
$client = new CRM_User($user_id);
?>

<h1 class="wp-heading-inline">
    <?php _e('Edit Client', 'snthwp'); ?>: <?php echo $client->user_display_name ?>
</h1>

<hr class="wp-header-end">

<div class="crm-container">
    <div class="crm-row">
        <div class="crm-col-9">
            <?php foreach (CRM_UserManager::getUserDataSections() as $section => $settings) {
                ?>
                <div id="client-<?php echo $section; ?>__holder" class="crm-card">
                    <div class="crm-card__header">
                        <h3><?php echo $settings['title']; ?></h3>
                    </div>

                    <div class="crm-card__body">
                        <div id="claim_description" class="crm-card__item">

                        </div>
                    </div>

                    <div class="crm-card__footer"></div>
                </div>
                <?php
            } ?>
        </div>

        <div class="crm-col-3">

        </div>
    </div>
</div>