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
<?php ittour_show_template('single-tour/change-parameters.php', array(
    'tour_info' => $tour_info
)) ?>
<section id="single-tour-main-info__container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <?php
                    // Show gallery images
                    if (!empty($tour_info["hotel_info"]["images"][0]['full'])) {
                        $images_count = count($tour_info["hotel_info"]["images"]);
                        ittour_show_template('general/tour-gallery.php', array('gallery_images' => $tour_info["hotel_info"]["images"]));
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

                    <?php snth_the_social_share(); ?>
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
                                <strong><?php echo snth_convert_date_to_human($tour_info["date_from"]); ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["duration"])) {
                            ?>
                            <li>
                                <i class="far fa-clock list-item-icon"></i>
                                <small><?php _e('Tour duration', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["duration"] ?> <?php _e('nights', 'snthwp'); ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["adult_amount"])) {
                            ?>
                            <li>
                                <i class="fas fa-male list-item-icon"></i>
                                <small><?php echo __('Adults', 'snthwp') ?>:</small>
                                <strong><?php echo $tour_info["adult_amount"] ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["child_amount"])) {
                            ?>
                            <li>
                                <i class="fas fa-baby list-item-icon"></i>
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
                                <strong><?php echo $tour_info["meal_type"] ?> (<?php echo $tour_info["meal_type_full"] ?>)</strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["accomodation"]) && !empty($tour_info["room_type"])) {
                            ?>
                            <li>
                                <i class="fas fa-key list-item-icon"></i>
                                <small><?php _e('Room type', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["room_type"] ?></strong>
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

                        if (!empty($tour_info["online_booking_form"])) {
                            echo ittour_get_tour_operator($tour_info["online_booking_form"]);
                        }
                        ?>
                    </ul>

                    <?php
                    if (2 !== $tour_info['type'] && 'flight' === $tour_info["transport_type"]) {
                        $flights = !empty($tour_info['flights']) ? $tour_info['flights'] : array();

                        ittour_show_template('single-tour/flights-list.php', array('flights_info' => $flights));
                    }
                    ?>
                </div>

                <?php
                if (!empty($tour_info["comment"])) {
                    ?>
                    <div class="col-12 mb-20">
                        <hr>

                        <h4 class="mt-10 mt-md-20"><?php _e('Tour comment', 'snthwp'); ?></h4>
                        <?php
                        echo $tour_info["comment"];
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <?php
            ittour_show_template('single-tour/book-tour.php', array(
                    'tour_info' => $tour_info,
                    'main_currency_label' => $main_currency_label,
                    'main_currency' => $main_currency,
                )
            );
            ?>

            <?php ittour_show_template('single-tour/book-by-phone.php') ?>
        </div>
    </div>
</section>

<div id="single_tour_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
        $first = true;

        if (!empty($tour_info["hotel_info"]["hotel_review_rate"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">
                    <?php _e('Hotel Reviews', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }
        ?>

        <li class="nav-item">
            <a class="nav-link<?php echo $first ? ' active' : ''; ?>"
               id="calendar-tab"
               data-toggle="tab"
               href="#calendar"
               role="tab"
               aria-controls="calendar"
               aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
            >
                <?php _e('More Tours', 'snthwp'); ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">
                <?php _e('Hotel Description', 'snthwp'); ?>
            </a>
        </li>

        <?php
        if (!empty($tour_info["hotel_info"]['lat']) && !empty($tour_info["hotel_info"]['lng'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <?php _e('Location', 'snthwp'); ?>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>

    <div class="tab-content" id="myTabContent">
        <?php
        $first_tab = true;

        if (!empty($tour_info["hotel_info"]["hotel_review_rate"])) {
            ?>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="home-tab">
                <?php
                ittour_show_template('single-tour/hotel-reviews.php', array('hotel_id' => $tour_info["hotel_id"]));
                ?>
            </div>
            <?php
            $first_tab = false;
        }
        ?>

        <div class="tab-pane fade<?php echo $first_tab ? ' show active' : ''; ?>" id="calendar" role="tabpanel" aria-labelledby="home-tab">
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

            if (!empty($tour_info['adult_amount'])) {
                $template_args['adult_amount'] = $tour_info["adult_amount"];
            }

            if (!empty($tour_info['from_city_id'])) {
                $template_args['from_city'] = $tour_info["from_city_id"];
            }

            if (!empty($tour_info['child_amount']) && !empty($tour_info['child_age'])) {
                $template_args['child_amount'] = $tour_info["child_amount"];
                $template_args['child_age'] = $tour_info["child_age"];
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



        <?php
        if (!empty($tour_info["hotel_info"]['lat']) && !empty($tour_info["hotel_info"]['lng'])) {
            ?>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                ittour_show_template('single-tour/hotel-map.php', array(
                    'hotel_info' => $tour_info['hotel_info'],
                    'hotel_title' => $tour_info['hotel'] . ' ' . ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating'])
                ));
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- Hotel Description - End -->

<?php // ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>