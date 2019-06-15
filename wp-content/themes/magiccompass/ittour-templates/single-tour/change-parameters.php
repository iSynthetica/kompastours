<?php
/**
 * Display Single Tour change parameters form
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour/SingleTour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($tour_info["country_id"])) {
    return;
}
?>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 mb-20" style="display: none">
    <div class="container">
        <?php
        $template_args = array(
            'country'       => $tour_info["country_id"],
        );

        if (!empty($tour_info["from_city_id"]))     $template_args['from_city'] = $tour_info["from_city_id"];
        if (!empty($tour_info["region_id"]))     $template_args['region'] = $tour_info["region_id"];
        if (!empty($tour_info["hotel_rating"]))     $template_args['hotel_rating'] = $tour_info["hotel_rating"];
        if (!empty($tour_info["adult_amount"]))     $template_args['adult_amount'] = $tour_info["adult_amount"];
        if (!empty($tour_info["duration"]))     $template_args['night_from'] = $tour_info["duration"];
        if (!empty($tour_info["duration"]))     $template_args['night_till'] = $tour_info["duration"];
        if (!empty($tour_info["type"]))     $template_args['tour_type'] = $tour_info["type"];
        if (!empty($tour_info["date_from"]))     $template_args['date_from'] = snth_convert_date_format($tour_info["date_from"]);
        if (!empty($tour_info["date_from"]))     $template_args['date_till'] = snth_convert_date_format($tour_info["date_from"]);

        if (!empty($tour_info["transport_type"])) {
            if ('flight' === $tour_info["transport_type"]) {
                $template_args['tour_kind'] = 1;
            } elseif ('bus' === $tour_info["transport_type"]) {
                $template_args['tour_kind'] = 2;
            }
        }

        ittour_show_template('form/section-search-ajax.php', $template_args);
        ?>
    </div>
</section>
