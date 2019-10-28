<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 17:33
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$i = 1;

$total_offers = count($result['hotels']);
$country_info = array();
$regions_info = array();

if (!empty($country_id)) {
    $country_info = ittour_destination_by_ittour_id($country_id);
}

if (!empty($region_id)) { // If search includes Region get region info from DB or API
    $region_info = ittour_destination_by_ittour_id($region_id);

    if (empty($region_info)) {
        $region_info = ittour_get_region($region_id);
    }

    if (!empty($region_info)) {
        $regions_info[$region_id] = $region_info;
    }
}

foreach ($result['hotels'] as $hotel) {
    $delay = $i / 10;
    $first_offer = $hotel['offers'][0];
    $hotel_region_id = !empty($hotel["region_id"]) ? $hotel["region_id"] : false;

    if (!empty($hotel_region_id) && empty($regions_info[$hotel_region_id])) {
        $hotel_region_info = ittour_destination_by_ittour_id($hotel_region_id);

        if (empty($hotel_region_info)) {
            $hotel_region_info = ittour_get_region($hotel_region_id);
        }

        if (!empty($hotel_region_info)) {
            $regions_info[$hotel_region_id] = $hotel_region_info;
        }
    }

    unset ($hotel['offers'][0]);

    $template_args = array(
        'country_info' => $country_info,
        'regions_info' => $regions_info,
        'hotel' => $hotel,
        'first_offer' => $first_offer,
        'delay' => $delay,
        'total' => $total_offers,
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
        'from_city' => $from_city,
    );

    if (!empty($child_age)) {
        $template_args['child_age'] = $child_age;
    }

    ittour_show_template('loop-hotel/tour-list-default.php', $template_args);
    $i++;
}
?>

<div id="search-result" class="search-result">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row common-height clearfix">
                <?php ittour_show_template('search/pagination.php', array('result' => $result, 'url' => $url)); ?>
            </div>
        </div>
    </div>
</div>
