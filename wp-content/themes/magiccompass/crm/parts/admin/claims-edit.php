<?php
/**
 * CRM Main File.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.2
 * @since 0.0.2
 */

/**
 * @var $claim_id
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$claim = new CRM_Claim($claim_id);
$client = $claim->client;
$current_user_id = get_current_user_id();
?>

<h1 class="wp-heading-inline">
    <?php echo $claim->title ?>
</h1>

<hr class="wp-header-end">


<div class="crm-container">
    <div class="crm-row">
        <div class="crm-col-9">

            <?php
            crm_show_template('admin/claim-sections/claim-edit-tour_booking_parameters.php', array(
                'claim' => $claim
            ));
            ?>

            <section id="client_info">
                <h2><?php _e('Client', 'snthwp'); ?></h2>
            </section>
        </div>

        <div class="crm-col-3">
            <?php
            crm_show_template('admin/claim-sections/claim-edit-excerpt-info.php', array(
                'claim' => $claim
            ));

            crm_show_template('admin/claim-sections/claim-edit-service-info.php', array(
                'claim' => $claim,
                'user'  => $current_user_id
            ));
            ?>
        </div>
    </div>
</div>