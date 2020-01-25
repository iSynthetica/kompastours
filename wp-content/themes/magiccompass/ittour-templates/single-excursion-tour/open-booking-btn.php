<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/SingleTour
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @var bool $tour_need_to_validate
 */
?>

<div id="open-booking-btn_holder">
    <button id="open-booking-btn" class="btn modal-popup bg-success-color size-md shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 mb-0"
            href="#modal-popup"
    >
        <?php echo __('Book now', 'snthwp'); ?>
    </button>

    <span class="mtb-5 text-center txt-gray-40-color d-block"><?php echo __('or', 'snthwp'); ?></span>
</div>
