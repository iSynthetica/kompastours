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
 * @var bool $tour_on_stop
 * @var bool $tour_outdated
 * @var bool $tour_need_to_validate
 * @var integer $price_uah
 * @var integer $price_currency
 * @var string $main_currency_label
 * @var string $tour_info_key
 * @var integer $main_currency
 */

if (!empty($tour_validated_timeout)) {
    $counter_date = get_date_from_gmt( date( 'Y-m-d H:i:s', $tour_validated_timeout ), 'Y/m/d H:i:s' );
}
?>
<div id="single-tour-price__holder" class="text-center mb-0 pb-20<?php echo !empty($tour_on_stop) ? ' tour_on_stop' : ''; ?><?php echo !empty($tour_need_to_validate) ? ' tour_need_to_validate' : ''; ?>">
    <div class="tour_price text-center font-alt d-inline-block d-md-block">
        <strong><?php echo $price_uah ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
    </div>

    <div class="tour_price_currency text-center font-alt d-inline-block d-md-block">
        <sup><?php echo $main_currency_label; ?></sup><strong><?php echo $price_currency; ?></strong>
    </div>
</div>

<?php
if (!empty($tour_need_to_validate)) {
    ?>
    <div id="validation-spinner__holder" class="text-center mb-10 mb-md-20">
        <i class="fas fa-sync-alt fa-spin fa-lg txt-success-color"></i>
    </div>
    <?php
} else if (!empty($tour_validated_timeout)) {
    ittour_show_template('single-tour/validation-timeout.php', array('counter_date' => $counter_date));
}
?>
