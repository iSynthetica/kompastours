<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 11.04.19
 * Time: 16:29
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<div class="tour_list_container wow fadeIn mt-20 mb-20" data-wow-delay="<?php echo $delay; ?>s">

    <div class="tour-list-item">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="img_container__wrapper mb-20 mb-md-0">
                    <div class="img_container">
                        <img src="<?php echo SNTH_IMAGES_URL; ?>/placeholder-520x450.png" class="img-fluid" alt="Image">
                        <?php
                        if (!empty($hotel['images'][0]['full'])) {
                            ?>
                            <div class="img-overlay" style="background-image: url('<?php echo $hotel['images'][0]['full'] ?>')"></div>
                            <?php
                        }
                        ?>
                        <div class="short_info p-10 d-block d-md-none">
                            <?php
                            if (!empty($hotel['hotel_review_rate'])) {
                                ?>
                                <div class="tour_review_rate">
                                    <?php echo ittour_get_hotel_review_rate_by_value($hotel['hotel_review_rate']) ?>
                                    <span><?php echo $hotel['hotel_review_rate']; ?></span> <?php echo __('out of', 'snthwp'); ?> <span>10</span>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="hotel_title m-0">
                                <strong><?php echo $hotel['hotel']; ?> <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating']); ?></strong>
                            </h3>

                            <div class="hotel_location"><?php echo $hotel['country'] . ', ' .$hotel['region']; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="row">
                    <div class="col-12">
                        <div class="tour_list_description pt-md-10 pr-lg-20 pb-10 pb-xl-20 d-none d-md-block">
                            <?php
                            if (!empty($hotel['hotel_review_rate'])) {
                                ?>
                                <div class="tour_review_rate">
                                    <?php echo ittour_get_hotel_review_rate_by_value($hotel['hotel_review_rate']) ?>
                                    <span><?php echo $hotel['hotel_review_rate']; ?></span> <?php echo __('out of', 'snthwp'); ?> <span>10</span>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="hotel_title m-0">
                                <strong><?php echo $hotel['hotel']; ?> <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating']); ?></strong>
                            </h3>

                            <div class="hotel_location"><?php echo $hotel['country'] . ', ' .$hotel['region']; ?></div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12">
                        <?php
                        if (!empty($hotel['hotel_facilities'])) {
                            $hotel_facilities_html = ittour_get_hotel_facilities($hotel['hotel_facilities']);

                            if (!empty($hotel_facilities_html)) {
                                ?>
                                <div class="hotel_facilities text-center text-md-left mb-20 mb-md-10 mb-xl-20 pr-lg-20">
                                    <?php echo $hotel_facilities_html; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <div class="tour_list_details pl-10 pr-10 pl-md-0 pr-md-0 mb-10">
                            <div class="row">
                                <?php
                                if (!empty($hotel["adult_amount"])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-male list-item-icon"></i>
                                            <strong><?php echo $hotel["adult_amount"] ?></strong> <?php _e('adults', 'snthwp'); ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($hotel["child_amount"])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-baby list-item-icon"></i>
                                            <strong><?php echo $hotel["child_amount"] ?></strong> <?php _e('children', 'snthwp'); ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($first_offer["duration"])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="far fa-clock list-item-icon"></i>
                                            <strong><?php echo $first_offer["duration"] ?></strong> <?php _e('nights', 'snthwp'); ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="col-6">
                                    <p>
                                        <i class="far fa-calendar-alt list-item-icon"></i>
                                        <?php echo $first_offer['date_from']; ?>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p>
                                        <?php
                                        if (2 === $first_offer['type']) {
                                            ?><i class="fas fa-plane list-item-icon"></i> <?php
                                            echo __('Not included', 'snthwp');
                                        } else {
                                            if ('bus' === $first_offer["transport_type"]) {
                                                ?><i class="fas fa-bus list-item-icon"></i> <?php
                                            } else {
                                                ?><i class="fas fa-plane list-item-icon"></i> <?php
                                            }

                                            if (!empty($first_offer['from_city'])) {
                                                echo $first_offer['from_city'];
                                            } else {
                                                echo __('Ask manager', 'snthwp');
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p>
                                        <i class="fas fa-key list-item-icon"></i>
                                        <?php echo $first_offer['room_type']; ?>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p>
                                        <i class="fas fa-utensils list-item-icon"></i>
                                        <strong><?php echo $first_offer['meal_type']; ?></strong> (<?php echo $first_offer['meal_type_full']; ?>)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="tour_list_price">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12 col-7">
                                        <div class="tour_price d-inline-block d-lg-block mr-10 mr-lg-0">
                                            <strong><?php echo $first_offer['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
                                        </div>

                                        <div class="tour_price_currency d-inline-block d-lg-block mb-lg-10">
                                            <sup>$</sup><strong><?php echo $first_offer['prices'][1] ?></strong>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-5">
                                        <a
                                                href="/tour/<?php echo $first_offer['key'] ?>"
                                                class="btn shape-rnd type-hollow hvr-invert size-sm size-extended"
                                        >
                                            <?php echo __('Details', 'snthwp'); ?>
                                        </a>
                                    </div>

                                    <?php
                                    if (!empty($hotel['offers']) && 1 !== $total) {
                                    $count_offers = count($hotel['offers']);
                                        ?>
                                        <div class="col-12">
                                            <div class="mt-10 mt-lg-20">
                                                <span class="more-offers__link">
                                                    <span class="show-more-offers">
                                                        <?php echo __('More offers', 'snthwp'); ?> (<?php echo $count_offers; ?>)
                                                        <i class="fas fa-chevron-down"></i>
                                                    </span>
                                                    <span class="hide-more-offers">
                                                        <?php echo __('Hide offers', 'snthwp'); ?>
                                                        <i class="fas fa-chevron-up"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (!empty($hotel['offers'])) {
        ?>
        <div class="tour_list_more scroll-content"<?php echo 1 === $total ? '' : ' style="display:none;"';?>>
            <?php
            foreach ($hotel['offers'] as $offer) {
                ?>
                <div class="tour_list_more-item">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-7 col-xl-8">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="tour_list_more_transit">
                                        <?php
                                        if (2 === $offer['type']) {
                                            ?><i class="fas fa-plane"></i> <?php
                                            echo __('Not included', 'snthwp');
                                        } else {
                                            if ('bus' === $offer["transport_type"]) {
                                                ?><i class="fas fa-bus"></i> <?php
                                            } else {
                                                ?><i class="fas fa-plane"></i> <?php
                                            }

                                            if (!empty($offer['from_city'])) {
                                                echo $offer['from_city'];
                                            } else {
                                                echo __('Ask manager', 'snthwp');
                                            }
                                        }
                                        ?> - <?php echo $offer['date_from'] ?>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="tour_list_more_room">
                                        <?php echo $offer['room_type']; ?>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="tour_list_more_meal">
                                        <strong><?php echo $offer['meal_type']; ?></strong> (<?php echo $offer['meal_type_full']; ?>)
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="tour_list_more_duration tour_list_more_guests">
                                        <?php echo ittour_get_guests_icon($hotel['adult_amount'], $hotel['child_amount']); ?> /
                                        <?php echo $offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="tour_list_more_price">
                                        <strong><?php echo $offer['prices'][2] ?></strong><small> <?php echo __('uah.', 'snthwp'); ?></small>

                                        <span>(<sup>$</sup><strong><?php echo $offer['prices'][1] ?></strong>)</span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="tour_list_more_button">
                                        <a
                                                href="/tour/<?php echo $offer['key'] ?>"
                                                class="btn shape-rnd type-hollow hvr-invert size-xs"
                                        >
                                            <?php echo __('Details', 'snthwp'); ?>
                                        </a>
                                    </div>
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
    ?>
</div>
