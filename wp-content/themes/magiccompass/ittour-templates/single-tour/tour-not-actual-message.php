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
 * @var bool $tour_outdated
 * @var bool $tour_stop_sale
 * @var bool $tour_stop_flight
 */
?>

<div id="tour-not-actual-message_holder" class="mb-10 mb-md-20">
    <h5 class="mt-0 mb-10 text-center"><?php echo __('Sorry, but this tour is not actual', 'snthwp'); ?></h5>
    <?php
    if ($tour_outdated) {
        ?>
        <p class="mtb-5 text-center"><?php echo __('Tour is outdated', 'snthwp'); ?></p>
        <?php
    } else {
        if (!empty($tour_stop_sale)) {
            ?>
            <p class="mtb-5 text-center"><?php echo __('No rooms available', 'snthwp'); ?></p>
            <?php
        }

        if (!empty($tour_stop_flight)) {
            ?>
            <p class="mtb-5 text-center"><?php echo __('No tickets available', 'snthwp'); ?></p>
            <?php
        }
    }
    ?>
</div>
