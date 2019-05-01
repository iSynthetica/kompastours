<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>

<section id="single-tour-main-info__container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <?php
                    if (!empty($tour_info['hotel_info']['hotel_facilities'])) {
                        echo ittour_get_hotel_facilities($tour_info['hotel_info']['hotel_facilities']);
                    }
                    ?>
                </div>

                <div class="col-md-6 col-lg-5">
                    <h3><?php _e('Tour price includes', 'snthwp'); ?></h3>

                    <ul class="tour-details-list">
                        <?php
                        if (!empty($tour_info["duration"])) {
                            ?>
                            <li>
                                <i class="far fa-clock list-item-icon"></i>
                                <small><?php _e('Tour duration', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["duration"] ?></strong> <?php _e('nights', 'snthwp'); ?>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["meal_type"]) && !empty($tour_info["meal_type_full"])) {
                            ?>
                            <li>
                                <i class="fas fa-utensils list-item-icon"></i>
                                <small><?php _e('Meal type', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["meal_type"] ?></strong> <?php echo $tour_info["meal_type_full"] ?>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["accomodation"]) && !empty($tour_info["room_type"])) {
                            ?>
                            <li>
                                <i class="fas fa-key list-item-icon"></i>
                                <small><?php _e('Room type', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["accomodation"] ?></strong> <?php echo $tour_info["room_type"] ?>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["from_city"])) {
                            ?>
                            <li>
                                <i class="fas fa-plane-departure list-item-icon"></i>
                                <small><?php _e('Flight from', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["from_city"] ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["date_from"])) {
                            ?>
                            <li>
                                <i class="far fa-calendar-alt list-item-icon"></i>
                                <small><?php _e('Start date', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["date_from"] ?></strong>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <?php
                    if (2 !== $tour_info['type']) {
                        $flights = !empty($tour_info['flights']) ? $tour_info['flights'] : array();
                        ittour_show_template('single-tour/flights-list.php', array('flights_info' => $flights));
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="box_style_1 expose table-summary_holder">
                    <table class="table table_summary">
                        <tbody>
                        <?php
                        if (!empty($tour_info['adult_amount'])) {
                            ?>
                            <tr>
                                <td>
                                    <strong><?php echo __('Adults', 'snthwp') ?>:</strong>
                                </td>
                                <td class="text-right">
                                    <?php echo $tour_info['adult_amount']; ?>
                                </td>
                            </tr>
                            <?php

                            if (!empty($tour_info['child_amount'])) {
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo __('Children', 'snthwp') ?>:</strong>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $tour_info['child_amount']; ?>
                                    </td>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo __('Children', 'snthwp') ?>:</strong>
                                    </td>
                                    <td class="text-right">
                                        0
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo __('Price', 'snthwp') ?>:</strong>
                            </td>
                            <td class="text-right">
                                <div class="tour_price">
                                    <strong><?php echo $tour_info['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
                                </div>
                                <div class="tour_price_currency">
                                    <sup>$</sup><strong><?php echo $tour_info['prices'][1] ?></strong>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                <a class="btn_full" href="cart.html" style="margin-bottom:0;">Book now</a>
            </div>
            <!--/box_style_1 -->

            <div class="box_style_4">
                <i class="icon_set_1_icon-90"></i>
                <h4><span>Book</span> by phone</h4>
                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </div>
    </div>
</section>

<div id="single_tour_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php _e('Hotel Description', 'snthwp'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php _e('Hotel Description', 'snthwp'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php _e('Location', 'snthwp'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php
            ittour_show_template('general/tours-table-ajax.php', array(
                'country' => $tour_info["country_id"],
                'region' => $tour_info["region_id"],
                'hotel' => $tour_info["hotel_id"],
                'hotel_rating' => $tour_info["hotel_rating"],
            )); ?>
        </div>
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php
            ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info']));
            ?>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?php ittour_show_template('single-tour/hotel-map.php', array('hotel_info' => $tour_info['hotel_info'], 'hotel_title' => $tour_info['hotel'] . ' ' . ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating']))); ?>
        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <?php ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info'])); ?>
        </div>
    </div>
</div>

<!-- Hotel Description - End -->

<?php // ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>