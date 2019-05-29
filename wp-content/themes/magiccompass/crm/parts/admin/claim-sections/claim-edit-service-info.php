<?php
/**
 * CRM Create New Client.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.2
 * @since 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div id="service-info__holder" class="crm-card">
    <div class="crm-card__header">
        <h3><?php echo __('Service info', 'snthwp'); ?></h3>
    </div>

    <div class="crm-card__body">
        <ul id="service_info" class="crm-card__item">
            <li>
                <strong><?php _e('Status', 'snthwp'); ?></strong>: <?php echo CRM_Claim::getStatuses()[$claim->status] ?>
            </li>

            <li>
                <strong><?php _e('Type', 'snthwp'); ?></strong>: <?php echo CRM_Claim::getTypes()[$claim->type] ?>
            </li>

            <li>
                <strong><?php _e('Created', 'snthwp'); ?></strong>: <?php echo $claim->created ?>
            </li>

            <li>
                <strong><?php _e('Modified', 'snthwp'); ?></strong>: <?php echo $claim->modified ?>
            </li>
            <?php
            if (!empty($claim->manager)) {
                ?>
                <li>
                    <strong><?php _e('Manager', 'snthwp'); ?></strong>: <?php echo $claim->manager->display_name ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>

    <div class="crm-card__footer">
        <button id="start-working"
                class="button button-primary"
                data-claim-id="<?php echo $claim->ID ?>"
                data-user-id="<?php echo $user ?>"
        >
            <?php _e('Take to work', 'snthwp'); ?>
        </button>
    </div>

</div>
