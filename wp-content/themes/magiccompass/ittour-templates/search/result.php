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

foreach ($result['hotels'] as $hotel) {
    $delay = $i / 10;
    $first_offer = $hotel['offers'][0];

    unset ($hotel['offers'][0]);

    $template_args = array(
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
