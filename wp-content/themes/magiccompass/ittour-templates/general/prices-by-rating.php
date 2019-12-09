<?php
/**
 * Prices by rating template
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Home
 * @version 0.0.11
 * @since 0.0.11
 */

$region = !empty($region) ? $region : '';

if ( ! defined( 'ABSPATH' ) ) exit;

$url = '/search/';
$url .= '?from_city=2014';
$url .= '&country=' . $country;
$url .= '&region=' . $region;
$url .= '&tour_type=1';
$url .= '&tour_kind=1';
$url .= '&adult_amount=2';
$url .= '&night_from=7';
$url .= '&night_till=7';
$url .= '&price_limit=';
$url .= '&price_limit_from=';
$url .= '&price_limit_till=';

/**
 * @var $prices_by_rating
 */

if (empty($prices_by_rating)) {
    return;
}

foreach ($prices_by_rating as $rating => $price) {
    $search_link = $url . '&hotel_rating[]=' .  $rating;
    ?>
    <div class="row">
        <div class="col-6 font-weight-900 font-alt">
            <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
        </div>
        <div class="col-6">
            <small><?php echo __('from', 'snthwp') ?></small>
            <a href="<?php echo $search_link ?>" class="font-weight-900 font-alt">
                <?php echo $price ?> <?php echo __('uah.', 'snthwp') ?>
            </a>
        </div>
    </div>
    <?php
}
?>