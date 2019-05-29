<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts
 * @version 0.1.2
 * @since 0.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$country_info = ittour_destination_by_ittour_id($country);

$main_currency = $country_info["main_currency"];

if ('10' === $main_currency) {
    $main_currency_label = __('€', 'snthwp');
} else if ('1' === $main_currency) {
    $main_currency_label = __('$', 'snthwp');
} else if ('2' === $main_currency) {
    $main_currency_label = __('UAH', 'snthwp');
}

if (empty($result)) {
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
}
?>


<div class="row">
    <div class="col-12">
        <?php
        if (!empty($title)) {
            $margin_class = 'mb-20 mb-md-40';

            if (!empty($subtitle)) {
                $margin_class = 'mb-10';
            }
            ?>
            <h3 class="section-title text-uppercase font-weight-900 text-center mt-15 <?php echo $margin_class; ?>">
                <?php echo $title; ?>
            </h3>
            <?php
        }

        if (!empty($subtitle)) {
            ?>
            <h5 class="section-subtitle text-center mt-0 mb-20 mb-md-40">
                <?php echo $subtitle; ?>
            </h5>
            <?php
        }
        ?>
    </div>
</div>

<?php
if (empty($result)) {
    ?>
    <div class="tours-list-ajax__container" <?php echo $tours_list_data; ?> data-template="min-prices-by-month">

    </div>
    <?php
} else {
    ?>
    <div class="tours-list-ajax">
        <div class="row">
            <?php
            foreach($result as $month => $data) {
                ?>
                <div class="col-6 col-md-3 mb-15">
                    <h6 class="text-uppercase text-center font-weight-900 mb-10">
                        <?php echo ittour_get_month_by_number($month); ?>
                        <?php echo $data['year']; ?>
                    </h6>

                    <?php
                    foreach ($data['results'] as $rating => $offer) {
                        ?>
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4 font-weight-900 font-alt">
                                <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
                            </div>

                            <div class="col-6 col-md-4">
                                <small><?php echo __('from', 'snthwp') ?></small>
                                <strong class="font-weight-900 font-alt">
                                    <?php echo $offer['prices'][$main_currency] ?> <?php echo $main_currency_label; ?>
                                </strong>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
?>

