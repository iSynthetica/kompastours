<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/SingleTour
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($tour_info)) {
    return;
}

// TODO: Show buttons

if (!empty($tour_info["flights"]["from"]) || !empty($tour_info["flights"]["to"])) {
    if (!empty($tour_info["flights"]["from"])) {
        $from = $tour_info["flights"]['from'][0];

        $structured_val_from =   $from['code'] . '{}'
                            . $from['air_company'] . '{}'
                            . $from['travel_class'] . '{}'
                            . $from['date_from'] . '{}'
                            . $from['time_from'] . '{}'
                            . $from['from_city'] . '{}'
                            . $from['from_airport'] . '{}'
                            . $from['date_till'] . '{}'
                            . $from['time_till'] . '{}'
                            . $from['to_city'] . '{}'
                            . $from['to_airport'] . '{}'
                            . $from['duration'];

        $txt_val_from =   $from['code'] . ' - '
                     . $from['air_company'] . ' - '
                     . $from['travel_class'] . ' - '
                     . $from['date_from'] . ' - '
                     . $from['time_from'] . ' - '
                     . $from['from_city'] . ' - '
                     . $from['from_airport'] . ' - '
                     . $from['date_till'] . ' - '
                     . $from['time_till'] . ' - '
                     . $from['to_city'] . ' - '
                     . $from['to_airport'] . ' - '
                     . $from['duration'];
    }

    if (!empty($tour_info["flights"]["to"])) {
        $from = $tour_info["flights"]['to'][0];

        $structured_val_to =   $from['code'] . '{}'
                                 . $from['air_company'] . '{}'
                                 . $from['travel_class'] . '{}'
                                 . $from['date_from'] . '{}'
                                 . $from['time_from'] . '{}'
                                 . $from['from_city'] . '{}'
                                 . $from['from_airport'] . '{}'
                                 . $from['date_till'] . '{}'
                                 . $from['time_till'] . '{}'
                                 . $from['to_city'] . '{}'
                                 . $from['to_airport'] . '{}'
                                 . $from['duration'];

        $txt_val_to =   $from['code'] . ' - '
                          . $from['air_company'] . ' - '
                          . $from['travel_class'] . ' - '
                          . $from['date_from'] . ' - '
                          . $from['time_from'] . ' - '
                          . $from['from_city'] . ' - '
                          . $from['from_airport'] . ' - '
                          . $from['date_till'] . ' - '
                          . $from['time_till'] . ' - '
                          . $from['to_city'] . ' - '
                          . $from['to_airport'] . ' - '
                          . $from['duration'];

    }
}
?>

<div class="box_style_1 expose table-summary_holder">
    <?php
    $tour_on_stop = false;
    $tour_outdated = ittour_is_tour_outdated($tour_info["date_from"]);

    if ($tour_outdated) {
        $tour_on_stop = true;
    } else {
        if ('flight' === $tour_info["transport_type"] && (!empty($tour_info["stop_sale"]) || !empty($tour_info["stop_flight"]))) {
            $tour_on_stop = true;
        }
    }

    ?>

    <div id="single-tour-price__holder" class="text-center mb-0 ptb-20<?php echo !empty($tour_on_stop) ? ' tour_on_stop' : ''; ?>">
        <div class="tour_price text-center font-alt d-inline-block d-md-block">
            <strong><?php echo $tour_info['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
        </div>

        <div class="tour_price_currency text-center font-alt d-inline-block d-md-block">
            <sup><?php echo $main_currency_label; ?></sup><strong><?php echo $tour_info['prices'][$main_currency]; ?></strong>
        </div>
    </div>

    <?php
    if (!empty($tour_on_stop)) {
        ?>
        <h5 class="mt-0 mb-10 text-center"><?php echo __('Sorry, but this tour is not actual', 'snthwp'); ?></h5>
        <?php
        if ($tour_outdated) {
            ?>
            <p class="mtb-5 text-center"><?php echo __('Tour is outdated', 'snthwp'); ?></p>
            <?php
        } else {
            if (!empty($tour_info["stop_sale"])) {
                ?>
                <p class="mtb-5 text-center"><?php echo __('No rooms available', 'snthwp'); ?></p>
                <?php
            }

            if (!empty($tour_info["stop_flight"])) {
                ?>
                <p class="mtb-5 text-center"><?php echo __('No tickets available', 'snthwp'); ?></p>
                <?php
            }
        }

    } else {
        ?>
        <button class="btn shape-rnd type-hollow size-xs size-extended text-uppercase font-alt font-weight-900 validate-btn"
                data-key="<?php echo $tour_info["key"]; ?>"
                data-currency="<?php echo $main_currency; ?>"
                type="button">
            <i class="fas fa-sync-alt d-inline-block mr-10"></i> <?php echo __('Check tour actuality', 'snthwp'); ?>
        </button>

        <button class="btn modal-popup bg-success-color size-md shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 mb-0" href="#modal-popup"><?php echo __('Book now', 'snthwp'); ?></button>
        <?php
    }
    ?>

    <span class="mtb-5 text-center txt-gray-40-color d-none"><?php echo __('or', 'snthwp'); ?></span>

    <button class="btn bg-gray-50-color type-hollow size-sm shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 d-none"><?php echo __('Ask a question', 'snthwp'); ?></button>

    <div id="modal-popup" class="bg-white-color mfp-hide col-xl-5 col-md-9 col-11 m-auto modal-popup-main p-20">
        <div id="booking-form__container">
            <div id="booking-form__body">
                <form action="" id="booking-form">
                    <?php
                    if (!empty($tour_info["key"])) {
                        ?><input type="hidden" name="key" value="<?php echo $tour_info["key"] ?>"><?php
                    }

                    if (!empty($tour_info["id"])) {
                        ?><input type="hidden" name="id" value="<?php echo $tour_info["id"] ?>"><?php
                    }

                    if (!empty($tour_info["tour_id"])) {
                        ?><input type="hidden" name="tour_id" value="<?php echo $tour_info["tour_id"] ?>"><?php
                    }

                    if (!empty($tour_info["spo"])) {
                        ?><input type="hidden" name="spo" value="<?php echo $tour_info["spo"] ?>"><?php
                    }

                    if (!empty($tour_info["from_city"])) {
                        ?><input type="hidden" name="from_city_name" value="<?php echo $tour_info["from_city"] ?>"><?php
                    }

                    if (!empty($tour_info["from_city_id"])) {
                        ?><input type="hidden" name="from_city" value="<?php echo $tour_info["from_city_id"] ?>"><?php
                    }

                    if (!empty($tour_info["country"])) {
                        ?><input type="hidden" name="country_name" value="<?php echo $tour_info["country"] ?>"><?php
                    }

                    if (!empty($tour_info["country_id"])) {
                        ?><input type="hidden" name="country" value="<?php echo $tour_info["country_id"] ?>"><?php
                    }

                    if (!empty($tour_info["region"])) {
                        ?><input type="hidden" name="region_name" value="<?php echo $tour_info["region"] ?>"><?php
                    }

                    if (!empty($tour_info["region_id"])) {
                        ?><input type="hidden" name="region" value="<?php echo $tour_info["region_id"] ?>"><?php
                    }

                    if (!empty($tour_info["hotel"])) {
                        ?>
                        <input
                                type="hidden"
                                name="hotel_name"
                                value="<?php echo $tour_info["hotel"] ?><?php echo !empty($tour_info["hotel_rating"]) ? ' ' . ittour_get_hotel_number_rating_by_id($tour_info["hotel_rating"]) : ''; ?>"
                        >
                        <?php
                    }

                    if (!empty($tour_info["hotel_id"])) {
                        ?><input type="hidden" name="hotel" value="<?php echo $tour_info["hotel_id"] ?>"><?php
                    }

                    if (!empty($tour_info["meal_type"])) {
                        ?><input type="hidden" name="meal_type" value="<?php echo $tour_info["meal_type"] ?>"><?php
                    }

                    if (!empty($tour_info["duration"])) {
                        ?><input type="hidden" name="night_from" value="<?php echo $tour_info["duration"] ?>"><?php
                    }

                    if (!empty($tour_info["date_from"])) {
                        ?><input type="hidden" name="date_from" value="<?php echo $tour_info["date_from"] ?>"><?php
                    }

                    if (!empty($tour_info["adult_amount"])) {
                        ?><input type="hidden" name="adult_amount" value="<?php echo $tour_info["adult_amount"] ?>"><?php
                    }

                    if (!empty($tour_info["child_amount"])) {
                        ?><input type="hidden" name="child_amount" value="<?php echo $tour_info["child_amount"] ?>"><?php


                        if (!empty($tour_info["child_age"])) {
                            ?><input type="hidden" name="child_age" value="<?php echo $tour_info["child_age"] ?>"><?php
                        }
                    }

                    if (!empty($tour_info["prices"]['1'])) {
                        ?><input type="hidden" name="price_usd" value="<?php echo $tour_info["prices"]['1'] ?>"><?php
                    }

                    if (!empty($tour_info["prices"]['2'])) {
                        ?><input type="hidden" name="price_uah" value="<?php echo $tour_info["prices"]['2'] ?>"><?php
                    }

                    if (!empty($tour_info["prices"]['10'])) {
                        ?><input type="hidden" name="price_euro" value="<?php echo $tour_info["prices"]['10'] ?>"><?php
                    }

                    if (!empty($structured_val_from)) {
                        ?>
                        <input id="flightThere_val" type="hidden" name="flight_from" value="<?php echo $txt_val_from ?>">
                        <input id="flightThere_structured" type="hidden" name="flight_from_structured" value="<?php echo $structured_val_from ?>">
                        <?php
                    }

                    if (!empty($structured_val_to)) {
                        ?>
                        <input id="flightBack_val" type="hidden" name="flight_to" value="<?php echo $txt_val_to ?>">
                        <input id="flightBack_structured" type="hidden" name="flight_to_structured" value="<?php echo $structured_val_to ?>">
                        <?php
                    }
                    ?>

                    <header id="booking-form__header" class="mb-10 mb-md-20">
                        <h3 class="font-weight-900 mtb-0 text-center"><?php echo __('Tour booking', 'snthwp'); ?></h3>
                    </header>

                    <div id="booking-form__content">
                        <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Tour details', 'snthwp'); ?></h4>

                        <div id="booking-details__holder">
                            <div class="tour-details-list mb-20 prl-5 prl-md-10 prl-lg-20">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <i class="fas fa-map-marker-alt list-item-icon"></i>
                                        <strong>
                                            <?php echo $tour_info["country"] ?>, <?php echo $tour_info["region"] ?>
                                        </strong>
                                    </div>

                                    <div class="col-lg-6">
                                        <i class="fas fa-h-square list-item-icon"></i>
                                        <strong>
                                            <?php echo $tour_info["hotel"] ?> <?php echo ittour_get_hotel_number_rating_by_id($tour_info["hotel_rating"]) ?>
                                        </strong>
                                    </div>

                                    <?php
                                    if (!empty($tour_info["date_from"])) {
                                        ?>
                                        <div class="col-6">
                                            <i class="far fa-calendar-alt list-item-icon"></i>
                                            <strong><?php echo $tour_info["date_from"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["duration"])) {
                                        ?>
                                        <div class="col-6">
                                            <i class="far fa-clock list-item-icon"></i>
                                            <strong><?php echo $tour_info["duration"] ?> <?php _e('nights', 'snthwp'); ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["adult_amount"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-male list-item-icon"></i>
                                            <small><?php echo __('Adults', 'snthwp') ?>:</small>
                                            <strong><?php echo $tour_info["adult_amount"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["child_amount"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-baby list-item-icon"></i>
                                            <small><?php echo __('Children', 'snthwp') ?>:</small>
                                            <strong><?php echo $tour_info["child_amount"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["meal_type"]) && !empty($tour_info["meal_type_full"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-utensils list-item-icon"></i>
                                            <strong><?php echo $tour_info["meal_type"] ?> (<?php echo $tour_info["meal_type_full"] ?>)</strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["accomodation"]) && !empty($tour_info["room_type"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-key list-item-icon"></i>
                                            <?php echo $tour_info["room_type"] ?>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["transport_type"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <?php
                                            if ('flight' === $tour_info["transport_type"]) {
                                                $transport = __('Plane', 'snthwp');
                                                ?><i class="fas fa-plane list-item-icon"></i><?php
                                            } else {
                                                $transport = __('Bus', 'snthwp');
                                                ?><i class="fas fa-bus list-item-icon"></i><?php
                                            }
                                            ?>

                                            <strong><?php echo $transport; ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["from_city"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-map-pin list-item-icon"></i>
                                            <small><?php _e('Departure from', 'snthwp'); ?>:</small>
                                            <strong><?php echo $tour_info["from_city"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    ?>
                                </div>

                                <?php
                                if (!empty($tour_info["flights"]["from"]) || !empty($tour_info["flights"]["to"])) {
                                    ?>
                                    <h4 class="mt-10 mb-10 font-weight-900 text-center"><?php echo __('Flight details', 'snthwp'); ?></h4>

                                    <div class="row">
                                        <?php
                                        if (!empty($tour_info["flights"]["from"])) {
                                            $from = $tour_info["flights"]['from'][0];
                                            ?>
                                            <div class="col-md-6 mtb-5">
                                                <i class="fas fa-plane-departure list-item-icon"></i>

                                                <span id="formflightThere__holder">
                                                    <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
                                                    <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                                                    <i class="fas fa-arrow-right"></i>
                                                    <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                                                    <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
                                                </span>
                                            </div>
                                            <?php
                                        }

                                        if (!empty($tour_info["flights"]["to"])) {
                                            $from = $tour_info["flights"]['to'][0];
                                            ?>
                                            <div class="col-md-6 mtb-5">
                                                <i class="fas fa-plane-arrival list-item-icon"></i>

                                                <span id="formflightBack__holder">
                                                    <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
                                                    <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                                                    <i class="fas fa-arrow-right"></i>
                                                    <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                                                    <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
                                                </span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>


                        <div id="contact-details__holder">
                            <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Contact details', 'snthwp'); ?></h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label for="clientName"><small><?php echo __('Your name', 'snthwp'); ?> (*)</small></label>
                                        <input type="text" class="form-control" name="clientName" id="clientName" placeholder="<?php echo __('Enter your name', 'snthwp'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 text-left">
                                    <div class="form-group">
                                        <label for="clientEmail"><small><?php echo __('Your email', 'snthwp'); ?></small></label>
                                        <input type="text" class="form-control" name="clientEmail" id="clientEmail" placeholder="<?php echo __('Enter your email', 'snthwp'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row client-phone__row">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label for="clientPhone"><small><?php echo __('Your phone', 'snthwp'); ?> (*)</small></label>
                                        <input type="text" class="form-control" name="clientPhone" id="clientPhone" placeholder="+380XXXXXXXXX">
                                    </div>
                                </div>

                                <div class="col-md-6 text-left">
                                    <div class="form-group text-left">
                                        <label><small><?php echo __('Messangers for this phone', 'snthwp'); ?></small></label>

                                        <div class="mt-10">
                                            <div class="d-inline-block mr-10">
                                                <input id="clientViber" name="clientViber" type="checkbox" value="viber">
                                                <label class="mb-0" for="clientViber">Viber</label>
                                            </div>

                                            <div class="d-inline-block mr-10">
                                                <input id="clientTelegram" name="clientTelegram" type="checkbox" value="telegram">
                                                <label class="mb-0" for="clientTelegram">Telegram</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="error_messages"></div>

                    <footer id="booking-form__footer" class="text-center mt-10 mt-md-20">
                        <button type="button" class="btn bg-danger-color shape-rnd type-hollow popup-modal-dismiss">
                            <i class="fas fa-times"></i>
                        </button>

                        <button
                                type="button"
                                class="book-btn btn bg-primary-color shape-rnd font-alt text-uppercase font-weight-900"
                        >
                            <?php echo __('Book now', 'snthwp') ?>
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
