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
 * @var array $tour_info
 * @var integer $main_currency
 * @var string $main_currency_label
 */

if (empty($tour_info)) {
    return;
}
?>

<div id="single-tour-booking__holder" class="box_style_1 expose table-summary_holder"
     data-key="<?php echo $tour_info["tour_id"]; ?>"
     data-currency="<?php // echo $main_currency; ?>"
>
    <?php

//    ittour_show_template('single-tour/price.php', array(
//        'tour_on_stop' => $tour_on_stop,
//        'tour_outdated' => $tour_outdated,
//        'tour_need_to_validate' => $tour_need_to_validate,
//        'tour_validated_timeout' => $tour_validated_timeout,
//        'price_uah' => $tour_info["prices"][2],
//        'price_currency' => $tour_info['prices'][$main_currency],
//        'main_currency_label' => $main_currency_label,
//        'main_currency' => $main_currency,
//        'tour_info_key' => $tour_info["key"],
//    ));

    ittour_show_template('single-excursion-tour/open-booking-btn.php');
    ?>

    <button id="change-parameters-btn"
            class="btn bg-primary-color type-hollow shape-rnd hvr-invert size-xs size-extended text-uppercase mb-0 font-alt font-weight-900"
            type="button"
    >
        <?php echo __('Change parameters', 'snthwp'); ?>
    </button>

    <button class="btn bg-gray-50-color type-hollow size-sm shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 d-none">
        <?php echo __('Ask a question', 'snthwp'); ?>
    </button>

    <?php
    ittour_show_template('single-excursion-tour/book-tour-form-popup.php', array(
           'tour_info' => $tour_info,
    ));
    ?>
</div>
