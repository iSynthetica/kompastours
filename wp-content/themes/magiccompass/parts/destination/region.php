<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.9
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$template_args = array(
    'type' => 1,
    'country' => $country_id,
    'region' => $region_id,
    'tour_type'     => 1,
    'tour_kind'     => 1,
    'meal_type'     => '560:512:498',
    'items_per_page' => 12,
);
?>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 ">
    <div class="container">
        <?php
        ittour_show_template('form/section-search.php', array(
            'country'       => $country_id,
            'region'        => $region_id,
//            'hotel'         => $hotel,
            'hotel_rating'  => '78:4',
//            'from_city'     => $from_city,
//            'date_from'     => $date_from,
//            'date_till'     => $date_till,
//            'night_from'    => $night_from,
//            'night_till'    => $night_till,
//            'adult_amount'  => $adult_amount,
//            'child_amount'  => $child_amount,
//            'child_age'     => $child_age,
//            'price_limit'   => $price_limit,
            'tour_type'     => 1,
            'tour_kind'     => 1,
            'meal_type'     => '560:512:498',
        ));
        ?>
    </div>
</section>

<?php snth_show_template('breadcrumbs.php'); ?>

<?php
ittour_show_template('general/tours-list-ajax.php', $template_args);
?>
