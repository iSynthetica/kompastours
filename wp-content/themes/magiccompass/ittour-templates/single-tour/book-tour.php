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

// TODO: Show buttons
$tour_info_json = $tour_info;

unset ($tour_info_json["comment"]);
unset ($tour_info_json["hotel_info"]);
unset ($tour_info_json["online_booking_form"]);

$tour_info_json = json_encode($tour_info_json, JSON_FORCE_OBJECT);
?>

<div id="single-tour-booking__holder" class="box_style_1 expose table-summary_holder"
     data-key="<?php echo $tour_info["key"]; ?>"
     data-currency="<?php echo $main_currency; ?>"
     data-tour-info='<?php echo $tour_info_json; ?>'
>
    <?php
    $tour_outdated = ittour_is_tour_outdated($tour_info["date_from"]);

    $tour_need_to_validate = false;
    $tour_validated_timeout = false;
    $tour_validated = get_transient('ittour_validated_' . $tour_info["key"]);

    if (!$tour_outdated) {
        if ($tour_validated) $tour_validated_timeout = snth_get_transient_timeout('ittour_validated_' . $tour_info["key"]);

        if (empty($tour_validated)) $tour_need_to_validate = true;
    }

    $tour_on_stop = false;

    if ($tour_outdated || !empty($tour_info["stop_sale"]) || !empty($tour_info["stop_flight"])) $tour_on_stop = true;

    ittour_show_template('single-tour/price.php', array(
        'tour_on_stop' => $tour_on_stop,
        'tour_outdated' => $tour_outdated,
        'tour_need_to_validate' => $tour_need_to_validate,
        'tour_validated_timeout' => $tour_validated_timeout,
        'price_uah' => $tour_info["prices"][2],
        'price_currency' => $tour_info['prices'][$main_currency],
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
        'tour_info_key' => $tour_info["key"],
    ));

    if (!empty($tour_on_stop)) {
        ittour_show_template('single-tour/tour-not-actual-message.php', array(
            'tour_outdated' => $tour_outdated,
            'tour_stop_sale' => $tour_info["stop_sale"],
            'tour_stop_flight' => $tour_info["stop_flight"],
        ));
    } else {
        ittour_show_template('single-tour/open-booking-btn.php', array('tour_need_to_validate' => $tour_need_to_validate));
    }
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
    ittour_show_template('single-tour/book-tour-form-popup.php', array(
           'tour_info' => $tour_info,
    ));
    ?>
</div>
