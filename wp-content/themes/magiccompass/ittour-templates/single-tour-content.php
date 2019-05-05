<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<section id="single-tour-main-info__container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <?php
                    if (!empty($tour_info["hotel_info"]["images"][0]['full'])) {
                        ?>
                        <div id="single-tour-gallery__container" class="mb-20">
                            <div class="single-tour-thumbnail__container">
                                <img style="max-width: 100%" src="<?php echo $tour_info["hotel_info"]["images"][0]['full'] ?>" alt="">
                            </div>

                            <?php
                            if (false) {
                                ?>
                                <div class="single-tour-slider__container">
                                    <div class="row">
                                        <?php
                                        foreach ($tour_info["hotel_info"]["images"] as $image) {
                                            ?>
                                            <div class="col-3">
                                                <img src="<?php echo $image['thumb']; ?>" alt="" style="max-width: 100%">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    
                    
                    if (!empty($tour_info['hotel_info']['hotel_facilities'])) {
                        $hotel_facilities_html = ittour_get_hotel_facilities($tour_info['hotel_info']['hotel_facilities']);

                        if (!empty($hotel_facilities_html)) {
                            ?>
                            <div class="hotel_facilities text-center mb-20">
                                <?php echo $hotel_facilities_html; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="col-md-12 col-lg-5">
                    <h3><?php _e('Tour price includes', 'snthwp'); ?></h3>

                    <ul class="tour-details-list">
                        <?php
                        if (!empty($tour_info["date_from"])) {
                            ?>
                            <li>
                                <i class="far fa-calendar-alt list-item-icon"></i>
                                <small><?php _e('Start date', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["date_from"] ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["duration"])) {
                            ?>
                            <li>
                                <i class="far fa-clock list-item-icon"></i>
                                <small><?php _e('Tour duration', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["duration"] ?></strong> <?php _e('nights', 'snthwp'); ?>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["adult_amount"])) {
                            ?>
                            <li>
                                <i class="fas fa-male"></i>
                                <small><?php echo __('Adults', 'snthwp') ?>:</small>
                                <strong><?php echo $tour_info["adult_amount"] ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["child_amount"])) {
                            ?>
                            <li>
                                <i class="fas fa-baby"></i>
                                <small><?php echo __('Children', 'snthwp') ?>:</small>
                                <strong><?php echo $tour_info["child_amount"] ?></strong>
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

                        if (!empty($tour_info["transport_type"])) {
                            ?>
                            <li>
                                <?php
                                if ('flight' === $tour_info["transport_type"]) {
                                    $transport = __('Plane', 'snthwp');
                                    ?><i class="fas fa-plane list-item-icon"></i><?php
                                } else {
                                    $transport = __('Bus', 'snthwp');
                                    ?><i class="fas fa-bus list-item-icon"></i><?php
                                }
                                ?>

                                <small><?php _e('Transport', 'snthwp'); ?>:</small>
                                <strong><?php echo $transport; ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["from_city"])) {
                            ?>
                            <li>
                                <i class="fas fa-map-pin list-item-icon"></i>
                                <small><?php _e('Departure from', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["from_city"] ?></strong>
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
                <div class="text-center mb-10 mb-md-20">
                    <div class="tour_price">
                        <strong><?php echo $tour_info['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
                    </div>
                    <div class="tour_price_currency">
                        <sup>$</sup><strong><?php echo $tour_info['prices'][1] ?></strong>
                    </div>
                </div>

                <a class="btn bg-success-color size-lg shape-rnd type-hollow hvr-invert size-extended" href="cart.html" style="margin-bottom:0;">Book now</a>
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
            <a class="nav-link active" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="home" aria-selected="true">
                <?php _e('More Tours', 'snthwp'); ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#description" role="tab" aria-controls="home" aria-selected="true">
                <?php _e('Hotel Description', 'snthwp'); ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                <?php _e('Location', 'snthwp'); ?>
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="calendar" role="tabpanel" aria-labelledby="home-tab">
            <?php
            $template_args = array(
                'country' => $tour_info["country_id"],
                'region' => $tour_info["region_id"],
                'hotel' => $tour_info["hotel_id"],
                'hotel_rating' => $tour_info["hotel_rating"],
            );

            if (!empty($tour_info['date_from'])) {
                $date_obj = date_create_from_format('Y-m-d', $tour_info['date_from']);
                $tour_date = date_format($date_obj, 'd.m.y');

                $date_range = ittour_get_date_range($tour_date, 2);

                $template_args['date_from'] = $date_range["date_from"];
                $template_args['date_till'] = $date_range["date_till"];
            }

            if (!empty($tour_info["type"])) {
                $template_args['type'] = $tour_info["type"];

                if (1 === $tour_info["type"] && !empty($tour_info["transport_type"])) {
                    $kind = 1;

                    if ('bus' === $tour_info["transport_type"]) {
                        $kind = 2;
                    }

                    $template_args['kind'] = $kind;
                }
            }

            $template_args['template'] = 'table-sort-by-date';

            ittour_show_template('general/tours-list-ajax.php', $template_args); ?>
        </div>

        <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="home-tab">
            <?php
            ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info']));
            ?>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?php
            ittour_show_template('single-tour/hotel-map.php', array(
                'hotel_info' => $tour_info['hotel_info'],
                'hotel_title' => $tour_info['hotel'] . ' ' . ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating'])
            ));
            ?>
        </div>
    </div>
</div>

<!-- Hotel Description - End -->

<?php // ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>