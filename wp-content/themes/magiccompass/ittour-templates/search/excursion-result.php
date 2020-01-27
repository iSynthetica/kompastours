<?php
/**
 * @var $tours
 */

if ( ! defined( 'ABSPATH' ) ) exit;

foreach ($tours as $tour) {
    $template_args = array(
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
        'tour' => $tour
    );

    ittour_show_template('loop-hotel/excursion-tour-list-default.php', $template_args);
    $excursion_db = ittour_get_excursion_by_ittour_key($tour['key']);
    $actual_date_from = false;
    $actual_date_till = false;

    if (!empty($tour['date_from'])) {
        $actual_date_from = snth_convert_date_format($tour['date_from'], $format_from = 'Y-m-d', $format_to = 'U');
    }

    if (!empty($tour['date_till'])) {
        $actual_date_till = snth_convert_date_format($tour['date_till'], $format_from = 'Y-m-d', $format_to = 'U');
    }

    if (!empty($tour['currency_id'])) {
        $currency_id = $tour['currency_id'];
    }


    if (empty($excursion_db)) {
        $name = $tour['name'];
        $slug = snth_get_slug_lat($name);
        $key = $tour['key'];

        $id_db = ittour_create_excursion($name, $slug, $key, $tour, $actual_date_from, $actual_date_till, $currency_id);
    } else {
        $post_id = $excursion_db[0]->ID;
        ittour_update_excursion_dates($post_id, $actual_date_from, $actual_date_till, $currency_id);
    }
}
?>


<div id="search-result" class="search-result">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row common-height clearfix">
                <?php ittour_show_template('search/pagination.php', array('result' => $result, 'url' => $url, 'type' => 'excursion-search')); ?>
            </div>
        </div>
    </div>
</div>
