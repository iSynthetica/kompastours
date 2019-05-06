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

<div class="tour_list_container wow fadeIn mt-20 mb-20 bg-white-color" data-wow-delay="<?php echo $delay; ?>s">

    <div class="tour-list-item">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="img_container__wrapper">
                    <div class="img_container">
                        <img src="<?php echo SNTH_IMAGES_URL; ?>/placeholder-520x450.png" width="800" height="533" class="img-fluid" alt="Image">
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

            <div class="col-lg-6 col-md-6">
                <div class="tour_list_description p-20 pl-md-0 d-none d-md-block">
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

                <?php
                if (!empty($hotel['hotel_facilities'])) {
                    $hotel_facilities_html = ittour_get_hotel_facilities($hotel['hotel_facilities']);

                    if (!empty($hotel_facilities_html)) {
                        ?>
                        <div class="hotel_facilities">
                            <?php echo $hotel_facilities_html; ?>
                        </div>
                        <?php
                    }
                }
                ?>

                <div class="tour_list_details p-20 pl-md-0">
                    <div class="row">
                        <div class="col-6">
                            <p>
                                <i class="far fa-calendar-alt"></i>
                                <?php echo $first_offer['date_from']; ?>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <?php
                                if (2 === $first_offer['type']) {
                                    ?><i class="fas fa-plane"></i> <?php
                                    echo __('Not included', 'snthwp');
                                } else {
                                    if ('bus' === $first_offer["transport_type"]) {
                                        ?><i class="fas fa-bus"></i> <?php
                                    } else {
                                        ?><i class="fas fa-plane"></i> <?php
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
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>
                                <i class="fas fa-key"></i>
                                <?php echo $first_offer['room_type']; ?>
                            </p>
                        </div>
                        <div class="col-6">
                            <p>
                                <i class="fas fa-utensils"></i>
                                <strong><?php echo $first_offer['meal_type']; ?></strong> (<?php echo $first_offer['meal_type_full']; ?>)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-12">
                <div class="tour_list_price">
                    <div>
                        <div class="mrl-sm-40">
                            <div class="row">
                                <div class="col-lg-12 col-4">
                                    <div class="tour_price">
                                        <strong><?php echo $first_offer['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-4">
                                    <div class="tour_price_currency">
                                        <sup>$</sup><strong><?php echo $first_offer['prices'][1] ?></strong>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-4">
                                    <div class="tour-meta">
                                        <?php
                                        if (!empty($hotel['adult_amount'])) {
                                            ?>
                                            <p>
                                                <?php
                                                echo ittour_get_guests_icon($hotel['adult_amount'], $hotel['child_amount']);
                                                ?> /
                                                <?php echo $first_offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                            </p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-20 mb-lg-0 mrl-80 mrl-md-120 mrl-lg-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tour-aside__footer">
                                        <p>
                                            <a href="/tour-result/?key=<?php echo $first_offer['key'] ?>" class="btn shape-rnd type-hollow hvr-invert size-sm size-extended"><?php echo __('Details', 'snthwp'); ?></a>
                                        </p>
                                        <?php
                                        if (!empty($hotel['offers']) && 1 !== $total) {
                                            $count_offers = count($hotel['offers']);
                                            ?>
                                            <span class="more-offers__link">
                                <span class="show-more-offers"><?php echo __('More offers', 'snthwp'); ?> (<?php echo $count_offers; ?>) <i class="fas fa-chevron-down"></i></span>
                                <span class="hide-more-offers"><?php echo __('Hide offers', 'snthwp'); ?> <i class="fas fa-chevron-up"></i></span>
                            </span>
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
    </div>

    <?php
    if (!empty($hotel['offers'])) {
        ?>
        <div class="tour_list_more"<?php echo 1 === $total ? '' : ' style="display:none;"';?>>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"><?php echo __('Transport', 'snthwp'); ?></th>
                                <th scope="col"><?php echo __('Room Type', 'snthwp'); ?></th>
                                <th scope="col"><?php echo __('Meal Type', 'snthwp'); ?></th>
                                <th scope="col"><?php echo __('Guests / Nights', 'snthwp'); ?></th>
                                <th scope="col"><?php echo __('Price', 'snthwp'); ?></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($hotel['offers'] as $offer) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $offer['date_from'] ?> <br>
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
                                        ?>
                                    </td>

                                    <td class=""><?php echo $offer['room_type']; ?></td>

                                    <td>
                                        <strong><?php echo $offer['meal_type']; ?></strong> (<?php echo $offer['meal_type_full']; ?>)
                                    </td>

                                    <td class="tour_list_more_guests">
                                        <?php echo ittour_get_guests_icon($hotel['adult_amount'], $hotel['child_amount']); ?> /
                                        <?php echo $offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                    </td>

                                    <td class="tour_list_more_price">
                                        <strong><?php echo $offer['prices'][2] ?></strong><small> <?php echo __('uah.', 'snthwp'); ?></small>

                                        <span>(<sup>$</sup><strong><?php echo $offer['prices'][1] ?></strong>)</span>
                                    </td>
                                    <td>
                                        <a href="/tour-result/?key=<?php echo $offer['key'] ?>" class="btn shape-rnd type-hollow hvr-invert size-xs size-extended"><?php echo __('Details', 'snthwp'); ?></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
