<?php
/**
 * Ajax Tours List.
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/General
 * @version 0.0.9
 * @since 0.0.9
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$country = !empty($country) ? $country : false;

if (!$country) {
    ?>
    <div id="tours-list-empty__container">
        <h2><?php echo __('No tours found', 'snthwp') ?></h2>
    </div>
    <?php

    return;
} else {
    $template = !empty($template) ? $template : 'grid';

    $tours_list_data = '';

    $tours_list_data .= ' data-country="'.$country.'"';

    if (!empty($type)) $tours_list_data                 .= ' data-tour-type="'.$type.'"';
    if (!empty($kind)) $tours_list_data                 .= ' data-tour-kind="'.$kind.'"';
    if (!empty($from_city)) $tours_list_data            .= ' data-from-city="'.$from_city.'"';
    if (!empty($region)) $tours_list_data               .= ' data-region="'.$region.'"';
    if (!empty($hotel)) $tours_list_data                .= ' data-hotel="'.$hotel.'"';
    if (!empty($hotel_rating)) $tours_list_data         .= ' data-hotel-rating="'.$hotel_rating.'"';
    if (!empty($adult_amount)) $tours_list_data         .= ' data-adult-amount="'.$adult_amount.'"';
    if (!empty($child_amount)) $tours_list_data         .= ' data-child-amount="'.$child_amount.'"';
    if (!empty($child_age)) $tours_list_data            .= ' data-child-age="'.$child_age.'"';
    if (!empty($night_from)) $tours_list_data           .= ' data-night-from="'.$night_from.'"';
    if (!empty($night_till)) $tours_list_data           .= ' data-night-till="'.$night_till.'"';
    if (!empty($date_from)) $tours_list_data            .= ' data-date-from="'.$date_from.'"';
    if (!empty($date_till)) $tours_list_data            .= ' data-date-till="'.$date_till.'"';
    if (!empty($meal_type)) $tours_list_data            .= ' data-meal-type="'.$meal_type.'"';
    if (!empty($price_from)) $tours_list_data           .= ' data-price-from="'.$price_from.'"';
    if (!empty($price_till)) $tours_list_data           .= ' data-price-till="'.$price_till.'"';
    if (!empty($page)) $tours_list_data                 .= ' data-page="'.$page.'"';
    if (!empty($items_per_page)) $tours_list_data       .= ' data-items-per-page="'.$items_per_page.'"';
    if (!empty($prices_in_group)) $tours_list_data      .= ' data-prices-in-group="'.$prices_in_group.'"';
    if (!empty($template)) $tours_list_data             .= ' data-template="'.$template.'"';

    ?>
    <div class="tours-list-ajax__container"<?php echo $tours_list_data; ?>>

        <?php
        if (!empty($prices_by_rating)) {
            ittour_show_template('general/prices-by-rating.php', array(
                'country' => $country,
                'prices_by_rating' => $prices_by_rating
            ));
        } else {
            ?>
            <div class="progress-bar__container" style="padding:10px;">
                <div class="row">
                    <div class="col-12">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}