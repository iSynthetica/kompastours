<?php
/**
 * Price validation
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/SingleTour/Price
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @var string $counter_date
 */
?>
<div id="validation-timeout__holder" class="text-center mb-10 mb-md-20">
    <h6 class="mt-0 mb-5"><?php _e('Price can be changed in', 'snthwp'); ?></h6>

    <div data-enddate="<?php echo $counter_date ?>" data-min-label="<?php echo _x('min', 'short time', 'snthwp') ?>" data-sec-label="<?php echo _x('sec', 'short time', 'snthwp') ?>" class="validate-countdown text-center mb-10"></div>

    <button id="validate-btn" class="btn shape-rnd type-hollow size-xs size-extended text-uppercase font-alt font-weight-900 validate-btn" style="display: none" type="button">
        <i class="fas fa-sync-alt d-inline-block mr-10"></i> <?php echo __('Check tour actuality', 'snthwp'); ?>
    </button>
</div>
