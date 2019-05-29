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

$claim = CRM_Claim::get($claim_id);
$client = CRM_User::get($claim->client_id);
?>

<h1 class="wp-heading-inline">
    <?php _e('Claim Title', 'snthwp'); ?>: <?php echo $claim->title ?>
</h1>

<hr class="wp-header-end">


<div class="crm-container">
    <div class="crm-row">
        <div class="crm-col-9">
            <section id="claim_info">
                <h2><?php _e('Claim Info', 'snthwp'); ?></h2>

                <div id="claim_description">
                    <?php echo $claim->excerpt ?>
                </div>
            </section>

            <section id="client_info">
                <h2><?php _e('Client', 'snthwp'); ?></h2>


            </section>
        </div>

        <div class="crm-col-3">
            <h2><?php echo __('Service info', 'snthwp'); ?></h2>

            <ul id="service_info">
                <li><strong><?php _e('Status', 'snthwp'); ?></strong>: <?php echo $claim->status ?></li>
                <li><strong><?php _e('Type', 'snthwp'); ?></strong>: <?php echo $claim->type ?></li>
                <li><strong><?php _e('Created', 'snthwp'); ?></strong>: <?php echo $claim->created ?></li>
                <li><strong><?php _e('Last modified', 'snthwp'); ?></strong>: <?php echo $claim->modified ?></li>
                <li><strong><?php _e('Manager', 'snthwp'); ?></strong>: <?php echo $claim->manager_id ?></li>
            </ul>
        </div>
    </div>
</div>