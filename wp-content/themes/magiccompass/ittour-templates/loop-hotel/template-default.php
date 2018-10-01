<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 17:59
 */
?>
<div class="hotel-loop__item col-xs-12 col-md-6 col-lg-4">
    <?php ittour_show_template('loop-hotel/part-title.php', array('hotel' => $hotel)); ?>

    <?php ittour_show_template('loop-hotel/part-price.php', array(
        'price' => $hotel['min_price'],
        'adult_amount' => $hotel['adult_amount'],
        'child_amount' => $hotel['child_amount'],
    )); ?>

    <?php
    $hotel_facilities = !empty($hotel['hotel_facilities']) ? $hotel['hotel_facilities'] : false;
    ?>
    <?php // ittour_show_template('loop-hotel/part-facilities.php', array('facilities' => $hotel_facilities)); ?>

    <?php ittour_show_template('loop-hotel/part-offers.php', array('offers' => $hotel['offers'])); ?>

    <?php
    unset($hotel['country']);
    unset($hotel['region_id']);
    unset($hotel['region']);
    unset($hotel['hotel_rating']);
    unset($hotel['min_price']);
    unset($hotel['hotel']);
    unset($hotel['hotel_id']);
    //unset($hotel['hotel_facilities']);
    unset($hotel['offers']);
    ?>

    <?php // var_dump($hotel); ?>
</div>