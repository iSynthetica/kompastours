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
$claim = new CRM_Claim($claim_id);
$client = $claim->client;
$current_user_id = get_current_user_id();
?>

<h1 class="wp-heading-inline">
    <?php _e('Claim Title', 'snthwp'); ?>: <?php echo $claim->title ?>
</h1>

<hr class="wp-header-end">


<div class="crm-container">
    <div class="crm-row">
        <div class="crm-col-9">

            <div id="claim_info__holder" class="crm-card">
                <div class="crm-card__header">
                    <h3><?php _e('Claim Info', 'snthwp'); ?></h3>
                </div>

                <div class="crm-card__body">
                    <div id="claim_description" class="crm-card__item">
                        <?php echo $claim->excerpt ?>
                    </div>
                </div>

                <div class="crm-card__footer"></div>
            </div>

            <section id="client_info">
                <h2><?php _e('Client', 'snthwp'); ?></h2>
            </section>
        </div>

        <div class="crm-col-3">
            <?php
            crm_show_template('admin/claim-sections/claim-edit-service-info.php', array(
                'claim' => $claim,
                'user'  => $current_user_id
            ));
            ?>
        </div>
    </div>
</div>