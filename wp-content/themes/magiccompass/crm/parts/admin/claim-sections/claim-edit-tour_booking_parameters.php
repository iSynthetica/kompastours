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

/**
 * @var $claim
 */

$claim_request_params_group = CRM_Claimmeta::getClaimMeta($claim->ID, 'tour_booking_parameters');

if (!empty($claim_request_params_group[0]["meta_value"])) {
    $claim_request_params_ids = maybe_unserialize($claim_request_params_group[0]["meta_value"]);
}

if (!is_array($claim_request_params_ids)) {
    return;
}

$claim_request_params = array();

foreach ($claim_request_params_ids as $param_id) {
    $param_obj = CRM_Claimmeta::get($param_id);

    $claim_request_params[$param_obj->meta_key] = $param_obj->meta_value;
}

if (empty($claim_request_params)) {
    return;
}
?>

<div id="booking-parameters-info__holder" class="crm-card">
    <div class="crm-card__header">
        <h3><?php echo __('Booking requests parameters', 'snthwp'); ?></h3>
    </div>

    <div class="crm-card__body">
        <div class="crm-row">
            <?php
            foreach ($claim_request_params as $key => $value) {
                ?>
                <div class="crm-col-4">
                    <p>
                        <?php echo $key ?>: <strong><?php echo $value ?></strong>
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="crm-card__footer">
        <button id="start-working"
                class="button button-primary"
        >
            <?php _e('Take to work', 'snthwp'); ?>
        </button>
    </div>
</div>
